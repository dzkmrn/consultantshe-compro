<?php
/**
 * Primary navigation.
 *
 * 'match' is the routing key that marks the link as current. Items that jump to
 * a section of the home page leave it null so only one link is ever current.
 */
$nav_items = [
    ['label' => 'Home',      'url' => BASE_URL,                'match' => 'home'],
    ['label' => 'About Us',  'url' => BASE_URL . '#about',     'match' => null],
    ['label' => 'Services',  'url' => BASE_URL . '#services',  'match' => null],
    ['label' => 'Career',    'url' => BASE_URL . 'careers',    'match' => 'careers'],
    ['label' => 'Contact',   'url' => BASE_URL . '#contact',   'match' => null],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e(SITE_DESCRIPTION) ?>">
    <title><?= e($page_title) ?></title>
    <link rel="icon" type="image/webp" href="<?= asset('images/logo.webp') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body class="page page--<?= e($page) ?>">
    <a class="skip-link" href="#main">Skip to content</a>

    <header class="navbar" id="navbar">
        <div class="container navbar__inner">
            <a href="<?= BASE_URL ?>" class="navbar__brand" aria-label="<?= e(SITE_NAME) ?> — beranda">
                <img src="<?= asset('images/logo-lockup.png') ?>" alt="<?= e(SITE_NAME) ?>" class="navbar__logo" width="916" height="240">
            </a>

            <button class="navbar__toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="navMenu">
                <span></span><span></span><span></span>
            </button>

            <nav class="navbar__nav" id="navMenu" aria-label="Navigasi utama">
                <ul class="navbar__menu">
                    <?php foreach ($nav_items as $item): ?>
                    <li>
                        <?php $is_current = $item['match'] !== null && $item['match'] === $page; ?>
                        <a href="<?= e($item['url']) ?>"<?= $is_current ? ' class="is-active" aria-current="page"' : '' ?>><?= e($item['label']) ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener" class="btn btn--primary navbar__cta">Discuss Your SHE Needs</a>
            </nav>
        </div>
    </header>

    <main id="main">
