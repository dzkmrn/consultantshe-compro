<?php
/**
 * Router for PHP's built-in server:
 *
 *     php -S localhost:8000 router.php
 *
 * It mirrors the clean-URL rewrite in .htaccess so a local preview behaves the
 * same as Apache in production. Not used when the site runs on a real server.
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

// Serve existing files (assets, images) straight from disk.
if ($path !== '/' && is_file(__DIR__ . $path)) {
    return false;
}

if (preg_match('#^/([a-z0-9\-]+)/?$#', $path, $matches)) {
    $_GET['page'] = $matches[1];
}

require __DIR__ . '/index.php';
