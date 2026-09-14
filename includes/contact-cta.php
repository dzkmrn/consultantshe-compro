<?php
/**
 * Closing call-to-action card matching Figma design.
 */
$contact_items = [
    [
        'icon' => 'map-pin-solid',
        'text' => SITE_ADDRESS,
        'url' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode(SITE_ADDRESS),
        'external' => true,
    ],
    [
        'icon' => 'mail-solid',
        'text' => SITE_EMAIL,
        'url' => 'mailto:' . SITE_EMAIL,
        'external' => false,
    ],
    [
        'icon' => 'whatsapp',
        'text' => SITE_PHONE,
        'url' => wa_link(),
        'external' => true,
    ],
    [
        'icon' => 'instagram-solid',
        'text' => SITE_INSTAGRAM,
        'url' => 'https://instagram.com/' . SITE_INSTAGRAM,
        'external' => true,
    ],
];
?>
<section class="contact-cta" id="contact">

    <img src="<?= asset('images/bg_attribute_add2.png') ?>" alt="" class="contact-cta__deco-left">
    <img src="<?= asset('images/bg_attribute_add2.png') ?>" alt="" class="contact-cta__deco-right">

    <div class="container">
        <div class="contact-cta__card">
            <div class="contact-cta__content">
                <div class="contact-cta__pill">
                    <span class="contact-cta__pill-dot"></span>
                    <span>Talk to Our SHE Team</span>
                </div>

                <h2 class="contact-cta__title">Let&rsquo;s Discuss Your SHE Needs</h2>

                <ul class="contact-cta__list">
                    <?php foreach ($contact_items as $item): ?>
                        <li>
                            <a href="<?= e($item['url']) ?>" class="contact-cta__item" <?= $item['external'] ? ' target="_blank" rel="noopener"' : '' ?>>
                                <span class="contact-cta__icon"><?= icon($item['icon'], 22) ?></span>
                                <span class="contact-cta__val"><?= e($item['text']) ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="contact-cta__figure">
                <img class="contact-cta__person" src="<?= asset('images/lets_discuss_model_woman.png') ?>"
                    alt="SHE Consultant" loading="lazy" width="302" height="625">
                <a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener" class="contact-cta__btn">
                    Start a Conversation <?= icon('arrow-up-right', 18) ?>
                </a>
            </div>
        </div>
    </div>
</section>