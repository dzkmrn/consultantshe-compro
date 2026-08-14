<?php
/**
 * Closing call-to-action card. Include it at the bottom of any page.
 */
$contact_rows = [
    [
        'label' => 'Address',
        'icon'  => 'map-pin-solid',
        'lines' => SITE_ADDRESS_LINES,
        'url'   => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode(SITE_ADDRESS),
    ],
    [
        'label' => 'Email',
        'icon'  => 'mail-solid',
        'lines' => [SITE_EMAIL],
        'url'   => 'mailto:' . SITE_EMAIL,
    ],
    [
        'label' => 'Phone',
        'icon'  => 'whatsapp',
        'lines' => [SITE_PHONE],
        'url'   => wa_link(),
    ],
    [
        'label' => 'Instagram',
        'icon'  => 'instagram-solid',
        'lines' => [SITE_INSTAGRAM],
        'url'   => 'https://instagram.com/' . SITE_INSTAGRAM,
    ],
];

// An email address has no natural place to wrap, so mark one after the @. On a
// narrow phone the alternative is the browser snapping the domain mid-word.
$contact_line = static fn (string $line): string => str_replace('@', '@<wbr>', e($line));
?>
<section class="contact-cta" id="contact">
    <div class="container">
        <div class="contact-cta__card">
            <span class="contact-cta__bg" aria-hidden="true"></span>

            <div class="contact-cta__body">
                <h2 class="contact-cta__title">Let&rsquo;s Discuss Your SHE Needs</h2>

                <ul class="contact-cta__rows">
                    <?php foreach ($contact_rows as $row): ?>
                    <li class="contact-row">
                        <span class="contact-row__label"><?= e($row['label']) ?></span>
                        <a class="contact-row__value" href="<?= e($row['url']) ?>"<?= str_starts_with($row['url'], 'mailto:') ? '' : ' target="_blank" rel="noopener"' ?>>
                            <span class="contact-row__icon"><?= icon($row['icon'], 18) ?></span>
                            <span><?= implode('<br>', array_map($contact_line, $row['lines'])) ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="contact-cta__figure">
                <img src="<?= asset('images/ic_user_train.png') ?>" alt="" loading="lazy" width="302" height="625">
                <a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener" class="btn btn--frost contact-cta__action">
                    Start a Conversation <?= icon('arrow-up-right', 16) ?>
                </a>
            </div>
        </div>
    </div>
</section>
