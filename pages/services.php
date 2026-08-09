<?php
$services = content('services');
?>

<section class="page-hero">
    <div class="container">
        <h1>Our Services</h1>
        <p>Consulting, competency development, assessment, and procurement support</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="stack">
            <?php foreach ($services as $service): ?>
            <article class="panel">
                <h2 style="display: flex; align-items: center; gap: 0.85rem; color: var(--green-deep);">
                    <?= icon($service['icon'], 28) ?>
                    <?= e($service['title']) ?>
                </h2>
                <ul class="bullet-list" style="margin-top: 1.25rem; columns: 2; column-gap: 2.5rem;">
                    <?php foreach ($service['items'] as $item): ?>
                    <li><?= is_array($item) ? implode(' ', array_map('e', $item)) : e($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/contact-cta.php'; ?>
