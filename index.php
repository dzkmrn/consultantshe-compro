<?php
require_once __DIR__ . '/config.php';

$page = isset($_GET['page']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['page']) : 'home';
$page_file = __DIR__ . '/pages/' . $page . '.php';

if (!is_file($page_file)) {
    http_response_code(404);
    $page = '404';
    $page_file = __DIR__ . '/pages/404.php';
}

$page_titles = [
    'home'     => SITE_NAME . ' - ' . SITE_TAGLINE,
    'careers'  => 'Career - ' . SITE_NAME,
    'gallery'  => 'Gallery - ' . SITE_NAME,
    'about'    => 'About Us - ' . SITE_NAME,
    'services' => 'Our Services - ' . SITE_NAME,
    'clients'  => 'Our Clients - ' . SITE_NAME,
    'contact'  => 'Contact Us - ' . SITE_NAME,
    '404'      => 'Page Not Found - ' . SITE_NAME,
];

$page_title = $page_titles[$page] ?? SITE_NAME;

require __DIR__ . '/includes/header.php';
require $page_file;
require __DIR__ . '/includes/footer.php';
