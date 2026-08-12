<?php
require_once __DIR__ . '/../includes/gallery.php';

$services  = content('services');
$partners  = content('partners');
$about     = content('about');
$centers   = content('centers');
$map       = content('locations');

// Every photo, split into the two rows of the auto-scrolling home strip.
$gallery = gallery_photos();
$gallery_rows = $gallery ? array_chunk($gallery, (int) ceil(count($gallery) / 2)) : [];

/** Plate-carree projection — see data/locations.php for the frame contract. */
$pin_position = static function (array $pin) use ($map): array {
    $f = $map['frame'];
    return [
        'x' => round(($pin['lng'] - $f['lng_min']) / ($f['lng_max'] - $f['lng_min']) * 100, 3),
        'y' => round(($f['lat_max'] - $pin['lat']) / ($f['lat_max'] - $f['lat_min']) * 100, 3),
    ];
};
?>

<!-- ============================================================
     DARK STAGE — hero and services share one continuous backdrop
     ============================================================ -->
<div class="stage stage--dark">

    <section class="hero" id="top">
        <div class="hero__photo">
            <img class="hero__bg" src="<?= asset('images/HeroBackground.png') ?>" alt="" width="1440" height="1000" fetchpriority="high">
            <img class="hero__crew" src="<?= asset('images/HeroPeopleImage.png') ?>" alt="The <?= e(SITE_NAME) ?> team" width="1647" height="955" fetchpriority="high">
        </div>
        <div class="container hero__inner">
            <h1 class="hero__title">Building Safer Workplaces, Stronger Teams, and Better Operations</h1>
            <p class="hero__lead">We help organizations strengthen Safety, Health, and Environment (SHE) practices through consulting, competency development, assessment, and procurement support.</p>
            <div class="hero__actions">
                <a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener" class="btn btn--primary">Discuss Your SHE Needs</a>
                <a href="#services" class="btn btn--ghost">Explore Our Services</a>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="container">
            <h2 class="section-title section-title--on-dark">Our Services</h2>

            <div class="services__grid">
                <?php foreach ($services as $service): ?>
                <article class="card">
                    <span class="card__icon"><?= icon($service['icon'], 24) ?></span>
                    <h3 class="card__title"><?= e($service['title']) ?></h3>

                    <ul class="card__list">
                        <?php foreach ($service['items'] as $item): ?>
                        <li>
                            <span class="card__bullet"><?= icon('check-circle', 18) ?></span>
                            <span><?php
                                // A nested array is one bullet whose lines are kept as authored.
                                echo is_array($item)
                                    ? implode('<br>', array_map('e', $item))
                                    : e($item);
                            ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <a href="<?= e(wa_link('Halo, saya ingin bertanya mengenai layanan ' . $service['title'] . '.')) ?>"
                       target="_blank" rel="noopener" class="btn btn--frost card__action">
                        Contact Us <?= icon('arrow-up-right', 16) ?>
                    </a>
                </article>
                <?php endforeach; ?>
            </div>

            <div class="services__footer">
                <p>Need help choosing the right service?</p>
                <a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener" class="btn btn--primary">
                    Talk to Our Team <?= icon('arrow-circle', 20) ?>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- ============================================================
     LIGHT STAGE — partners through training centres
     ============================================================ -->
<div class="stage stage--light">

    <section class="partners">
        <div class="container">
            <p class="section-eyebrow">Trusted Across Industries</p>
            <h2 class="section-title">Supporting Organizations Across Indonesia</h2>
            <ul class="partners__logos">
                <?php foreach ($partners as $partner): ?>
                <li><img src="<?= asset('images/' . $partner['file']) ?>" alt="<?= e($partner['name']) ?>" loading="lazy"></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="about" id="about">
        <div class="container">
            <p class="section-eyebrow"><?= e($about['eyebrow']) ?></p>
            <h2 class="section-title"><?= e($about['heading']) ?></h2>

            <ul class="about__pillars">
                <?php foreach ($about['pillars'] as $pillar): ?>
                <li><?= e($pillar) ?></li>
                <?php endforeach; ?>
            </ul>

            <div class="about__grid">
                <div class="about__panel">
                    <p class="about__lead"><?= e($about['lead']) ?></p>
                    <?php foreach ($about['paragraphs'] as $paragraph): ?>
                    <p><?= e($paragraph) ?></p>
                    <?php endforeach; ?>
                </div>

                <figure class="about__portrait">
                    <img src="<?= asset($about['portrait']['image']) ?>" alt="<?= e($about['portrait']['name']) ?>" loading="lazy">
                    <figcaption>
                        <strong><?= e($about['portrait']['name']) ?></strong>
                        <span class="about__portrait-dot" aria-hidden="true"></span>
                        <?= e($about['portrait']['role']) ?>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <?php if ($gallery_rows): ?>
    <section class="gallery-strip" aria-label="Activity documentation">
        <?php foreach ($gallery_rows as $index => $row):
            // A lap covers the row's own width. Timing it off the summed aspect
            // ratios keeps both rows at the same speed however many photos each
            // one holds, and at every breakpoint.
            $laps = array_sum(array_column($row, 'ratio')); ?>
        <div class="marquee<?= $index % 2 ? ' marquee--reverse' : '' ?>" style="--marquee-duration: <?= round($laps * 5, 1) ?>s">
            <div class="marquee__track">
                <?php // Printed twice: the second pass is what makes the loop seamless.
                for ($pass = 0; $pass < 2; $pass++):
                    foreach ($row as $photo): ?>
                <div class="marquee__item" style="--ratio: <?= $photo['ratio'] ?>"<?= $pass ? ' aria-hidden="true"' : '' ?>>
                    <img src="<?= e($photo['url']) ?>" alt="" width="<?= $photo['w'] ?>" height="<?= $photo['h'] ?>" loading="lazy" decoding="async">
                </div>
                    <?php endforeach;
                endfor; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="container gallery-strip__footer">
            <a href="<?= BASE_URL ?>gallery" class="btn btn--primary">View Full Gallery</a>
        </div>
    </section>
    <?php endif; ?>

    <section class="presence">
        <div class="container">
            <h2 class="section-title">Local Presence, Wider Support</h2>
            <p class="section-lead">Our presence across multiple locations in Indonesia enables faster coordination, better access to local resources, and more responsive support for clients across regions and industries.</p>

            <div class="presence__map">
                <img class="presence__outline" src="<?= asset('images/indonesia-map.svg') ?>" alt="Map of <?= e(SITE_NAME) ?> locations across Indonesia" loading="lazy">
                <ul class="presence__pins">
                    <?php foreach ($map['pins'] as $pin):
                        $pos = $pin_position($pin); ?>
                    <li class="map-pin map-pin--<?= e($pin['place']) ?>"
                        style="--x: <?= $pos['x'] ?>%; --y: <?= $pos['y'] ?>%; --dx: <?= (float) ($pin['dx'] ?? 0) ?>; --dy: <?= (float) ($pin['dy'] ?? 0) ?>;">
                        <span class="map-pin__dot" aria-hidden="true"></span>
                        <span class="map-pin__label"><?= e(mb_strtoupper($pin['name'])) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Small screens cannot fit the pin labels without collisions, so the
                 same place names are listed as chips there instead. -->
            <ul class="presence__list">
                <?php foreach ($map['pins'] as $pin): ?>
                <li><?= e(mb_strtoupper($pin['name'])) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="centers">
        <div class="container">
            <h2 class="section-title">Our Training &amp; Assessment Centers</h2>
            <div class="centers__grid">
                <?php foreach ($centers as $center): ?>
                <article class="center">
                    <div class="center__media">
                        <img src="<?= asset('images/' . $center['image']) ?>" alt="<?= e($center['alt']) ?>" loading="lazy">
                    </div>
                    <h3 class="center__name"><?= e($center['name']) ?></h3>
                    <address class="center__address">
                        <?= implode('<br>', array_map('e', $center['address'])) ?>
                    </address>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</div>

<!-- ============================================================
     CONTACT CTA
     ============================================================ -->
<?php require __DIR__ . '/../includes/contact-cta.php'; ?>
