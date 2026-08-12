<?php
/**
 * Site configuration.
 * Everything here is content that changes without touching markup.
 */

define('SITE_NAME', 'PT Jasa General Consultant SHE');
define('SITE_SHORT_NAME', 'PT Jasa General ConsultantSHE');
define('SITE_TAGLINE', 'Building Safer Workplaces, Stronger Teams, and Better Operations');
define('SITE_DESCRIPTION', 'PT Jasa General Consultant SHE helps organizations strengthen Safety, Health, and Environment practices through consulting, competency development, assessment, and procurement support.');

define('SITE_EMAIL', 'jasageneral@jasagenshe.com');
define('SITE_PHONE', '+62 859 7755 5933');
define('SITE_WHATSAPP', '6285977555933');
define('SITE_WHATSAPP_TEMPLATE', 'Halo PT Jasa General Consultant SHE, saya tertarik dengan layanan perusahaan Anda. Boleh minta informasi lebih lanjut?');
define('SITE_INSTAGRAM', 'general_consultantshe');

// Rendered one line per entry in the contact card.
define('SITE_ADDRESS_LINES', [
    'RA Premiere',
    'Jl. Intan No.25 1, RT.1/RW.2, Cilandak Barat',
    'Kec. Cilandak, Kota Jakarta Selatan',
    'Daerah Khusus Ibukota Jakarta 12430',
]);
define('SITE_ADDRESS', implode(', ', SITE_ADDRESS_LINES));

// Same address, split the way schema.org/PostalAddress wants it.
define('SITE_ADDRESS_PARTS', [
    'street'   => 'RA Premiere, Jl. Intan No.25 1, RT.1/RW.2',
    'locality' => 'Cilandak Barat, Kec. Cilandak, Kota Jakarta Selatan',
    'region'   => 'Daerah Khusus Ibukota Jakarta',
    'postal'   => '12430',
    'country'  => 'ID',
]);

define('SITE_YEAR_FOUNDED', 2018);

// Recruitment inbox printed on the Career page ("Career ENGLISH.docx").
define('CAREERS_EMAIL', 'generalconsultant@jasagenshe.com');

define('BASE_URL', '/');
define('ASSETS_URL', BASE_URL . 'assets/');

// Search keywords, most important first.
define('SITE_KEYWORDS', [
    'HSE Competency Assessment',
    'SHE consultant Indonesia',
    'competency assessment center',
    'TUK LSP K3',
    'safety leadership training',
    'HSE training provider Jakarta',
    'K3 consulting',
    'safety health environment consultant',
]);

// Sharing card. 1200x630 is what Facebook, LinkedIn and WhatsApp expect.
define('SITE_OG_IMAGE', 'images/og-image.jpg');

require_once __DIR__ . '/includes/icons.php';

/**
 * Origin the page is being served from, used for canonical and og:url.
 *
 * Read off the request rather than hard-coded so the Vercel preview host and a
 * custom domain each point at themselves instead of at a stale URL.
 */
function site_origin(): string
{
    $forwarded = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
    $https = $forwarded === 'https'
        || (($_SERVER['HTTPS'] ?? 'off') !== 'off' && ($_SERVER['HTTPS'] ?? '') !== '');

    return ($https ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost');
}

/** Absolute URL for a path on this site. */
function site_url(string $path = ''): string
{
    return site_origin() . '/' . ltrim($path, '/');
}

/** Prefilled WhatsApp deep link used by every CTA on the site. */
function wa_link(?string $message = null): string
{
    return 'https://wa.me/' . SITE_WHATSAPP . '?text=' . rawurlencode($message ?? SITE_WHATSAPP_TEMPLATE);
}

/**
 * Absolute URL for a file inside assets/, stamped with the file's mtime.
 *
 * The stamp is what stops a CDN or a browser from holding on to last week's
 * stylesheet after a deploy: the file changes, the URL changes with it, and the
 * long cache lifetime the host sets becomes an advantage rather than a trap.
 */
function asset(string $path): string
{
    $relative = ltrim($path, '/');
    $file = __DIR__ . '/assets/' . rawurldecode($relative);
    $stamp = is_file($file) ? filemtime($file) : false;

    return ASSETS_URL . $relative . ($stamp ? '?v=' . $stamp : '');
}

/** Loads a content array from data/. */
function content(string $name): array
{
    return require __DIR__ . '/data/' . $name . '.php';
}

/** Shorthand for escaped output. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
