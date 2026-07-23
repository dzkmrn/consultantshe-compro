<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars(SITE_DESCRIPTION) ?>">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="icon" type="image/webp" href="<?= ASSETS_URL ?>images/logo.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/style.css">
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container navbar__inner">
            <a href="<?= BASE_URL ?>" class="navbar__brand">
                <img src="<?= ASSETS_URL ?>images/logo.webp" alt="<?= htmlspecialchars(SITE_NAME) ?>" class="navbar__logo">
                <div class="navbar__brand-text">
                    <span class="navbar__company">PT Jasa General</span>
                    <span class="navbar__tagline">Consultant SHE</span>
                </div>
            </a>
            <button class="navbar__toggle" id="navToggle" aria-label="Toggle navigation">
                <span></span><span></span><span></span>
            </button>
            <ul class="navbar__menu" id="navMenu">
                <?php if ($page === 'home'): ?>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#clients">Our Clients</a></li>
                <li><a href="#contact">Contact</a></li>
                <?php else: ?>
                <li><a href="<?= BASE_URL ?>#about">About</a></li>
                <li><a href="<?= BASE_URL ?>#services">Services</a></li>
                <li><a href="<?= BASE_URL ?>#clients">Our Clients</a></li>
                <li><a href="<?= BASE_URL ?>#contact">Contact</a></li>
                <?php endif; ?>
                <li><a href="<?= BASE_URL ?>#contact" class="navbar__cta">Partner with us &rarr;</a></li>
            </ul>
        </div>
    </nav>
    <main>
