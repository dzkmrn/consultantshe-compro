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

/**
 * Search and social metadata. Titles and descriptions come from index.php;
 * everything below is the same on every page.
 */
$og_image = site_url(ltrim(asset(SITE_OG_IMAGE), '/'));

$structured_data = [
    '@context' => 'https://schema.org',
    '@type'    => 'ProfessionalService',
    'name'        => SITE_NAME,
    'alternateName' => SITE_SHORT_NAME,
    'description' => SITE_DESCRIPTION,
    'url'         => site_url(),
    'logo'        => site_url(ltrim(asset('images/logo-lockup.png'), '/')),
    'image'       => $og_image,
    'email'       => SITE_EMAIL,
    'telephone'   => SITE_PHONE,
    'foundingDate' => (string) SITE_YEAR_FOUNDED,
    'address' => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => SITE_ADDRESS_PARTS['street'],
        'addressLocality' => SITE_ADDRESS_PARTS['locality'],
        'addressRegion'   => SITE_ADDRESS_PARTS['region'],
        'postalCode'      => SITE_ADDRESS_PARTS['postal'],
        'addressCountry'  => SITE_ADDRESS_PARTS['country'],
    ],
    'areaServed' => ['@type' => 'Country', 'name' => 'Indonesia'],
    'knowsAbout' => SITE_KEYWORDS,
    'sameAs'     => ['https://instagram.com/' . SITE_INSTAGRAM],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($page_title) ?></title>
    <meta name="description" content="<?= e($page_description) ?>">
    <meta name="keywords" content="<?= e(implode(', ', SITE_KEYWORDS)) ?>">
    <meta name="author" content="<?= e(SITE_NAME) ?>">
    <meta name="robots" content="<?= $page_indexable ? 'index, follow' : 'noindex, follow' ?>">
    <link rel="canonical" href="<?= e($page_canonical) ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:title" content="<?= e($page_title) ?>">
    <meta property="og:description" content="<?= e($page_description) ?>">
    <meta property="og:url" content="<?= e($page_canonical) ?>">
    <meta property="og:image" content="<?= e($og_image) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_US">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($page_title) ?>">
    <meta name="twitter:description" content="<?= e($page_description) ?>">
    <meta name="twitter:image" content="<?= e($og_image) ?>">

    <link rel="icon" type="image/webp" href="<?= asset('images/logo.webp') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">

    <script type="application/ld+json"><?= json_encode($structured_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body class="page page--<?= e($page) ?>">
    <a class="skip-link" href="#main">Skip to content</a>

    <header class="navbar" id="navbar">
        <div class="container navbar__inner">
            <a href="<?= BASE_URL ?>" class="navbar__brand" aria-label="<?= e(SITE_NAME) ?> — home">
                <img src="<?= asset('images/logo-lockup.png') ?>" alt="<?= e(SITE_NAME) ?>" class="navbar__logo" width="916" height="240">
            </a>

            <button class="navbar__toggle" id="navToggle" aria-label="Open menu" aria-expanded="false" aria-controls="navMenu">
                <span></span><span></span><span></span>
            </button>

            <nav class="navbar__nav" id="navMenu" aria-label="Main navigation">
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
