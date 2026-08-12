<?php
require_once __DIR__ . '/config.php';

/**
 * Which page to render.
 *
 * Apache hands us ?page= through the rewrite in .htaccess. Vercel and the
 * built-in server route the whole path here instead, so fall back to the first
 * segment of the URL. Anything outside [a-z0-9-] is stripped, so a page name can
 * never escape pages/.
 */
function requested_page(): string
{
    $page = $_GET['page'] ?? null;

    if ($page === null) {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $page = explode('/', trim($path, '/'))[0];
    }

    $page = preg_replace('/[^a-z0-9\-]/', '', strtolower((string) $page));

    return $page === '' ? 'home' : $page;
}

$page = requested_page();
$page_file = __DIR__ . '/pages/' . $page . '.php';

if (!is_file($page_file)) {
    http_response_code(404);
    $page = '404';
    $page_file = __DIR__ . '/pages/404.php';
}

/**
 * Title and description per page.
 *
 * Titles stay near 60 characters and descriptions near 160 so search results
 * show them whole. "HSE Competency Assessment" is the keyword being targeted,
 * so it leads wherever the page is genuinely about it.
 */
$page_meta = [
    'home' => [
        'title'       => SITE_NAME . ' - HSE Competency Assessment',
        'description' => 'PT Jasa General Consultant SHE delivers HSE competency assessment, SHE '
            . 'consulting, competency training, and procurement support for industries across Indonesia.',
    ],
    'careers' => [
        'title'       => 'Career - ' . SITE_NAME,
        'description' => 'Open positions at PT Jasa General Consultant SHE. Build your career with a team '
            . 'of HSE competency assessment, safety leadership, and SHE training professionals.',
    ],
    'gallery' => [
        'title'       => 'Gallery - ' . SITE_NAME,
        'description' => 'Documentation of HSE competency assessment, training, and consulting work by '
            . 'PT Jasa General Consultant SHE across Indonesia.',
    ],
    'about' => [
        'title'       => 'About Us - ' . SITE_NAME,
        'description' => 'PT Jasa General Consultant SHE is an Indonesian consultancy for HSE competency '
            . 'assessment, safety training, and Safety, Health, and Environment management.',
    ],
    'services' => [
        'title'       => 'Our Services - ' . SITE_NAME,
        'description' => 'HSE competency assessment, SHE consulting, competency development and training, '
            . 'and SHE procurement support from PT Jasa General Consultant SHE.',
    ],
    'clients' => [
        'title'       => 'Our Clients - ' . SITE_NAME,
        'description' => 'Companies that trust PT Jasa General Consultant SHE for HSE competency '
            . 'assessment, safety training, and SHE consulting across Indonesia.',
    ],
    'contact' => [
        'title'       => 'Contact Us - ' . SITE_NAME,
        'description' => 'Talk to PT Jasa General Consultant SHE in Jakarta about HSE competency '
            . 'assessment, SHE consulting, and safety training for your operations.',
    ],
    '404' => [
        'title'       => 'Page Not Found - ' . SITE_NAME,
        'description' => SITE_DESCRIPTION,
    ],
];

$page_title       = $page_meta[$page]['title'] ?? SITE_NAME;
$page_description = $page_meta[$page]['description'] ?? SITE_DESCRIPTION;

// Canonical is built from the resolved page, not the raw URL, so ?page= and the
// clean path both settle on one address.
$page_canonical = site_url($page === 'home' ? '' : $page);
$page_indexable = $page !== '404';

require __DIR__ . '/includes/header.php';
require $page_file;
require __DIR__ . '/includes/footer.php';
