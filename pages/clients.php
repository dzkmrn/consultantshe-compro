<?php
$partners = content('partners');

$industries = [
    'Oil & Gas', 'Manufacturing', 'Mining & Energy', 'Construction',
    'Healthcare', 'Education', 'Government', 'Transportation',
];
?>

<section class="page-hero">
    <div class="container">
        <h1>Our Clients</h1>
        <p>Supporting organizations across Indonesia since <?= SITE_YEAR_FOUNDED ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section__header">
            <h2>Trusted Across Industries</h2>
            <p>We partner with organizations across high-risk sectors including oil &amp; gas, mining, construction, manufacturing, energy, and transportation.</p>
        </div>

        <ul class="partners__logos">
            <?php foreach ($partners as $partner): ?>
            <li><img src="<?= asset('images/' . $partner['file']) ?>" alt="<?= e($partner['name']) ?>" loading="lazy"></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="section section--alt">
    <div class="container">
        <div class="section__header"><h2>Sectors We Serve</h2></div>
        <div class="grid-auto">
            <?php foreach ($industries as $industry): ?>
            <div class="panel" style="text-align: center;">
                <h4><?= e($industry) ?></h4>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/contact-cta.php'; ?>
