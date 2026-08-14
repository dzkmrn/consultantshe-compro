<?php
/**
 * Shared security helpers: CSRF tokens, request throttling, and mail header
 * sanitisation.
 *
 * Tokens are signed rather than kept in a session on purpose. The site is
 * served both from cPanel and from Vercel, and a Vercel function gets a fresh
 * filesystem per instance, so a session written while rendering a form is not
 * guaranteed to still exist when that form is posted back.
 */

// Long enough to write a real enquiry, short enough that a token scraped from a
// cached page stops working.
define('CSRF_TOKEN_LIFETIME', 7200);

// A human cannot fill in the form faster than this; a bot replaying the markup
// can.
define('CSRF_MIN_FILL_SECONDS', 3);

// Holds the nonce each token is signed against. Session-lifetime, so it costs
// the visitor nothing and needs no consent banner.
define('CSRF_COOKIE', 'jgc_csrf');

/** Directory the whole site is rooted at. */
function app_root(): string
{
    return dirname(__DIR__);
}

/**
 * Writable directory for state that must not be published.
 *
 * Preference is one level above the document root, which on cPanel means
 * /home/jasagen1/ — Apache never serves it, and the deploy in .cpanel.yml
 * copies into public_html only, so nothing here is touched by a deploy. Vercel
 * mounts the code read-only, so it falls back to the per-instance temp
 * directory there.
 */
function storage_path(string $name = ''): ?string
{
    static $base = null;

    if ($base === null) {
        $base = false;
        $candidates = [
            dirname(app_root()) . '/jasagenshe-storage',
            sys_get_temp_dir() . '/jasagenshe-storage',
        ];

        foreach ($candidates as $candidate) {
            if (storage_prepare($candidate)) {
                $base = $candidate;
                break;
            }
        }
    }

    if ($base === false) {
        return null;
    }

    return $name === '' ? $base : $base . '/' . $name;
}

/** Creates a storage directory and denies web access to it, if it is servable. */
function storage_prepare(string $dir): bool
{
    if (!is_dir($dir) && !@mkdir($dir, 0700, true) && !is_dir($dir)) {
        return false;
    }

    if (!is_writable($dir)) {
        return false;
    }

    $guard = $dir . '/.htaccess';
    if (!is_file($guard)) {
        @file_put_contents($guard, "Require all denied\n");
    }

    return true;
}

/**
 * Key used to sign CSRF tokens.
 *
 * APP_SECRET in the host environment wins, which is the only reliable option on
 * Vercel: each instance has its own temp directory, so a generated secret would
 * differ between the request that issues a token and the one that verifies it.
 */
function app_secret(): string
{
    static $secret = null;

    if ($secret !== null) {
        return $secret;
    }

    $env = $_ENV['APP_SECRET'] ?? $_SERVER['APP_SECRET'] ?? getenv('APP_SECRET');
    if (is_string($env) && strlen($env) >= 32) {
        return $secret = $env;
    }

    $file = storage_path('app_secret');
    if ($file !== null) {
        $stored = is_file($file) ? trim((string) @file_get_contents($file)) : '';
        if ($stored !== '') {
            return $secret = $stored;
        }

        $fresh = bin2hex(random_bytes(32));
        if (@file_put_contents($file, $fresh, LOCK_EX) !== false) {
            @chmod($file, 0600);
            return $secret = $fresh;
        }
    }

    // Nothing writable and no APP_SECRET set. This keeps tokens verifying
    // instead of locking every visitor out of the form, but it is guessable by
    // anyone who knows the deployment, so set APP_SECRET on the host.
    return $secret = hash('sha256', app_root() . '|' . PHP_VERSION . '|' . SITE_NAME);
}

/**
 * Per-visitor value the token is signed against, kept in a cookie.
 *
 * A signature on its own only proves that somebody asked this site for a token,
 * and an attacker can ask exactly as easily as a visitor can — they would just
 * fetch one and paste it into their own form. Tying it to a cookie fixes that:
 * the same-origin policy stops another site reading this one's cookies or
 * setting them, so a token minted by the attacker cannot match the pair the
 * victim's browser sends.
 */
function csrf_nonce(): string
{
    static $nonce = null;

    if ($nonce !== null) {
        return $nonce;
    }

    $existing = $_COOKIE[CSRF_COOKIE] ?? '';
    if (is_string($existing) && preg_match('/^[a-f0-9]{32}$/', $existing)) {
        return $nonce = $existing;
    }

    $nonce = bin2hex(random_bytes(16));
    $_COOKIE[CSRF_COOKIE] = $nonce;

    if (!headers_sent()) {
        setcookie(CSRF_COOKIE, $nonce, [
            'expires'  => 0,
            'path'     => '/',
            'secure'   => str_starts_with(site_origin(), 'https://'),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    return $nonce;
}

/**
 * Issue-time plus its signature over that time and the visitor's nonce.
 *
 * Minting a token also marks the response uncacheable. A token only works for
 * the one browser holding the matching cookie, so a cache that hands the same
 * copy to a second visitor breaks the form for everyone it serves. Doing it
 * here rather than in the page means it cannot be forgotten by whatever adds
 * the next form, and it costs nothing elsewhere: no other page mints a token,
 * so the rest of the site stays as cacheable as it was.
 */
function csrf_token(): string
{
    if (!headers_sent()) {
        header('Cache-Control: private, no-store, max-age=0');
        header('Vary: Cookie');
    }

    $issued = (string) time();

    return $issued . '.' . hash_hmac('sha256', $issued . '|' . csrf_nonce(), app_secret());
}

/**
 * Whether the browser sent back the cookie a token has to be checked against.
 *
 * Worth separating from csrf_verify() so a visitor who blocks cookies can be
 * told what actually went wrong instead of being shown an expiry message that
 * will never stop appearing however many times they resend.
 */
function csrf_cookie_present(): bool
{
    $nonce = $_COOKIE[CSRF_COOKIE] ?? '';

    return is_string($nonce) && preg_match('/^[a-f0-9]{32}$/', $nonce) === 1;
}

/** Hidden input carrying a fresh token. */
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

/**
 * Whether a token was issued by this site to this browser, is still current,
 * and is at least $min_age seconds old.
 */
function csrf_verify(mixed $token, int $min_age = 0): bool
{
    // Read straight from the cookie rather than through csrf_nonce(), which
    // would mint a fresh one and then cheerfully verify against it.
    if (!csrf_cookie_present()) {
        return false;
    }

    $nonce = (string) $_COOKIE[CSRF_COOKIE];

    if (!is_string($token) || !preg_match('/^(\d{1,10})\.([a-f0-9]{64})$/', $token, $matches)) {
        return false;
    }

    $age = time() - (int) $matches[1];
    if ($age < $min_age || $age > CSRF_TOKEN_LIFETIME) {
        return false;
    }

    return hash_equals(
        hash_hmac('sha256', $matches[1] . '|' . $nonce, app_secret()),
        $matches[2]
    );
}

/**
 * Best guess at who is calling.
 *
 * Both hosts sit behind a proxy, so REMOTE_ADDR is the proxy and a header is the
 * only thing that tells visitors apart. Cloudflare is asked first because it
 * overwrites CF-Connecting-IP on every request, whereas it *appends* to
 * X-Forwarded-For — a client that sends its own X-Forwarded-For keeps the value
 * it chose at the front of the list, so trusting that header first would let
 * anyone slip the throttle by making up a new address each time.
 *
 * Still only a hint, since a request aimed straight at the origin can claim
 * anything. It feeds throttling and nothing else.
 */
function client_ip(): string
{
    $candidates = [
        $_SERVER['HTTP_CF_CONNECTING_IP'] ?? '',
        trim(explode(',', (string) ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? ''))[0]),
        $_SERVER['REMOTE_ADDR'] ?? '',
    ];

    foreach ($candidates as $candidate) {
        if (filter_var($candidate, FILTER_VALIDATE_IP)) {
            return $candidate;
        }
    }

    return 'unknown';
}

/**
 * Records an attempt and reports whether the caller was still under $limit
 * attempts in the last $window seconds.
 *
 * Fails open: with no writable storage a real visitor still gets through. On
 * Vercel the counter is per instance, so it thins spam rather than stopping it;
 * cPanel, where mail() actually sends, gets the real limit.
 */
function rate_limit_allows(string $bucket, int $limit, int $window): bool
{
    $dir = storage_path('ratelimit');
    if ($dir === null || (!is_dir($dir) && !@mkdir($dir, 0700, true) && !is_dir($dir))) {
        return true;
    }

    $file = $dir . '/' . hash('sha256', $bucket . '|' . client_ip()) . '.json';
    $handle = @fopen($file, 'c+');
    if ($handle === false) {
        return true;
    }

    $now = time();
    $allowed = true;

    if (flock($handle, LOCK_EX)) {
        $hits = json_decode((string) stream_get_contents($handle), true);
        $hits = array_values(array_filter(
            is_array($hits) ? $hits : [],
            static fn ($hit): bool => is_int($hit) && $hit > $now - $window
        ));

        $allowed = count($hits) < $limit;
        if ($allowed) {
            $hits[] = $now;
        }

        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, (string) json_encode($hits));
        fflush($handle);
        flock($handle, LOCK_UN);
    }

    fclose($handle);

    if (random_int(1, 50) === 1) {
        rate_limit_sweep($dir, $window);
    }

    return $allowed;
}

/** Drops counters nobody has touched for two windows. */
function rate_limit_sweep(string $dir, int $window): void
{
    $cutoff = time() - ($window * 2);

    foreach (glob($dir . '/*.json') ?: [] as $file) {
        if (@filemtime($file) < $cutoff) {
            @unlink($file);
        }
    }
}

/**
 * Flattens a value so it cannot open a new mail header.
 *
 * Carriage returns and line feeds are what an injected "Bcc:" would ride in on.
 */
function mail_header_value(string $value): string
{
    return trim((string) preg_replace('/[\r\n\t\0]+/', ' ', $value));
}

/** Mail header value, MIME-encoded when it carries anything outside ASCII. */
function mail_header_encoded(string $value): string
{
    $clean = mail_header_value($value);

    return preg_match('/[^\x20-\x7E]/', $clean)
        ? '=?UTF-8?B?' . base64_encode($clean) . '?='
        : $clean;
}
