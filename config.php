<?php
/**
 * Site configuration.
 * Everything here is content that changes without touching markup.
 */

define('SITE_NAME', 'PT Jasa General Consultant SHE');
define('SITE_SHORT_NAME', 'PT Jasa General ConsultantSHE');
define('SITE_TAGLINE', 'Building Safer Workplaces, Stronger Teams, and Better Operations');
define('SITE_DESCRIPTION', 'PT Jasa General Consultant SHE helps organizations strengthen Safety, Health, and Environment practices through consulting, competency development, assessment, and procurement support.');

define('SITE_EMAIL', 'generalconsultant@jasagenshe.com');
define('SITE_PHONE', '+62 811 8886 8882');
define('SITE_WHATSAPP', '6281188868882');
define('SITE_WHATSAPP_TEMPLATE', 'Halo PT Jasa General Consultant SHE, saya tertarik dengan layanan perusahaan Anda. Boleh minta informasi lebih lanjut?');
define('SITE_INSTAGRAM', 'general_consultantshe');

// Rendered as two lines in the contact card.
define('SITE_ADDRESS_LINES', [
    'Pamulang Permai 1 Blok CX01/10 no 1',
    'Pamulang Barat - Tangerang Selatan',
]);
define('SITE_ADDRESS', implode(', ', SITE_ADDRESS_LINES));

define('SITE_YEAR_FOUNDED', 2018);

// Recruitment inbox printed on the Career page (reference2/Loker.png).
define('CAREERS_EMAIL', 'jasageneralconsultantshe@gmail.com');

define('BASE_URL', '/');
define('ASSETS_URL', BASE_URL . 'assets/');

require_once __DIR__ . '/includes/icons.php';

/** Prefilled WhatsApp deep link used by every CTA on the site. */
function wa_link(?string $message = null): string
{
    return 'https://wa.me/' . SITE_WHATSAPP . '?text=' . rawurlencode($message ?? SITE_WHATSAPP_TEMPLATE);
}

/** Absolute URL for a file inside assets/. */
function asset(string $path): string
{
    return ASSETS_URL . ltrim($path, '/');
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
