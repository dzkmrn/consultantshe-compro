<section class="page-hero">
    <div class="container">
        <h1>Our Services</h1>
        <p>HSSE consulting, safety training, and competency re-assessment for high-risk industries</p>
    </div>
</section>

<?php
$services = [
    [
        'title' => 'Consulting',
        'icon' => '<svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>',
        'desc' => 'Strategic HSSE consulting services to help organizations build robust safety management systems, develop safety culture, and achieve compliance with industry standards.',
        'items' => [
            'HSSE Management System',
            'Safety Culture Development & Implementation',
            'CSMS (Contractor Safety Management System)',
            'Risk Assessment',
            'HSSE Audit & Compliance',
            'Safety Performance Improvement',
        ],
    ],
    [
        'title' => 'Training',
        'icon' => '<svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
        'desc' => 'Practical safety training programs focused on building safety behavior and strengthening safety culture across your organization.',
        'items' => [
            'Safety Behavior & Safety Culture',
            'HSSE Awareness Training',
            'Hazard Identification & Risk Control',
            'Emergency Response Training',
            'Permit to Work System',
            'Incident Investigation & Reporting',
        ],
    ],
    [
        'title' => 'Competency Re-Assessment',
        'icon' => '<svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'desc' => 'Professional competency re-assessment and certification services to ensure your workforce meets operational safety standards for high-risk roles.',
        'items' => [
            'Heavy Equipment Operator — Dump Truck',
            'Heavy Equipment Operator — Forklift',
            'Heavy Equipment Operator — Crane',
            'Heavy Equipment Operator — Excavator',
            'Scaffolder',
            'Rigger',
        ],
    ],
];
?>

<section class="services-detail section">
    <div class="container">
        <?php foreach ($services as $i => $service): ?>
        <div class="service-block <?= $i % 2 !== 0 ? 'service-block--alt' : '' ?>">
            <div class="service-block__header">
                <div class="service-block__icon"><?= $service['icon'] ?></div>
                <div>
                    <h2><?= htmlspecialchars($service['title']) ?></h2>
                    <p><?= htmlspecialchars($service['desc']) ?></p>
                </div>
            </div>
            <div class="service-block__topics">
                <h4><?= $i === 2 ? 'Assessment Areas:' : ($i === 0 ? 'Consulting Services Include:' : 'Training Topics Include:') ?></h4>
                <ul class="service-block__list">
                    <?php foreach ($service['items'] as $item): ?>
                    <li><?= htmlspecialchars($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="cta section section--alt">
    <div class="container">
        <div class="cta__content">
            <h2>Need a Custom Solution?</h2>
            <p>We design tailored HSSE consulting, training, and assessment programs to meet your organization's specific needs.</p>
            <a href="<?= BASE_URL ?>contact" class="btn btn--primary btn--lg">Request a Proposal</a>
        </div>
    </div>
</section>
