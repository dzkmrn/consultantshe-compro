<?php
$about = content('about');
?>

<section class="page-hero">
    <div class="container">
        <h1>About Us</h1>
        <p><?= e($about['heading']) ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid-2" style="align-items: center;">
            <div>
                <h2 style="margin-bottom: 1.25rem;">Our Story</h2>
                <p style="color: var(--gray-500); margin-bottom: 1rem;">Established in <?= SITE_YEAR_FOUNDED ?>, <?= e(SITE_NAME) ?> has grown into a comprehensive SHE consulting, competency training, assessment, and procurement partner serving industries across Indonesia.</p>
                <p style="color: var(--gray-500); margin-bottom: 1rem;"><?= e($about['lead']) ?></p>
                <?php foreach ($about['paragraphs'] as $paragraph): ?>
                <p style="color: var(--gray-500); margin-bottom: 1rem;"><?= e($paragraph) ?></p>
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

<section class="section section--alt">
    <div class="container">
        <div class="grid-2">
            <div class="panel">
                <h3>Vision</h3>
                <p>To be a trusted SHE partner recognized for delivering measurable impact on safety performance and workforce competency.</p>
            </div>
            <div class="panel">
                <h3>Mission</h3>
                <ul class="bullet-list">
                    <li>Deliver practical SHE consulting and management system development</li>
                    <li>Build safety behaviour and culture through quality training</li>
                    <li>Ensure workforce competency through professional assessment</li>
                    <li>Support operations with reliable SHE procurement</li>
                    <li>Build long-term partnerships based on trust and results</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section__header"><h2>Our Values</h2></div>
        <div class="grid-auto">
            <?php foreach ([
                ['Integrity', 'We uphold the highest standards of honesty and ethical conduct in everything we do.'],
                ['Excellence', 'We strive for excellence in delivery, client service, and professional standards.'],
                ['Impact', 'We measure success by the real, tangible improvements we create for our clients.'],
                ['Collaboration', 'We work alongside our clients as partners, not just service providers.'],
            ] as [$title, $body]): ?>
            <div class="panel">
                <h4><?= e($title) ?></h4>
                <p><?= e($body) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/contact-cta.php'; ?>
