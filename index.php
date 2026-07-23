<?php
require_once __DIR__ . '/config.php';

$page = isset($_GET['page']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['page']) : 'home';
$page_file = __DIR__ . '/pages/' . $page . '.php';

if (!file_exists($page_file)) {
    http_response_code(404);
    $page = '404';
    $page_file = __DIR__ . '/pages/404.php';
}

$page_titles = [
    'home'     => SITE_NAME . ' - ' . SITE_TAGLINE,
    'about'    => 'About Us - ' . SITE_NAME,
    'services' => 'Our Services - ' . SITE_NAME,
    'clients'  => 'Our Clients - ' . SITE_NAME,
    'contact'  => 'Contact Us - ' . SITE_NAME,
    '404'      => 'Page Not Found - ' . SITE_NAME,
];

$page_title = $page_titles[$page] ?? SITE_NAME;

require_once __DIR__ . '/includes/header.php';
require_once $page_file;
require_once __DIR__ . '/includes/footer.php';
