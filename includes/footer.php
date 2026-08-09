<?php
$maps_url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode(SITE_ADDRESS);

$footer_links = [
    ['icon' => 'map-pin-solid',    'url' => $maps_url,                                   'label' => 'Lokasi kami'],
    ['icon' => 'instagram-solid',  'url' => 'https://instagram.com/' . SITE_INSTAGRAM,    'label' => 'Instagram'],
    ['icon' => 'whatsapp',         'url' => wa_link(),                                   'label' => 'WhatsApp'],
    ['icon' => 'mail-solid',       'url' => 'mailto:' . SITE_EMAIL,                      'label' => 'Email'],
];
?>
    </main>

    <footer class="footer">
        <div class="container footer__inner">
            <div class="footer__brand">
                <img src="<?= asset('images/logo-white.png') ?>" alt="<?= e(SITE_NAME) ?>" class="footer__logo" width="916" height="240">
                <p class="footer__copy">&copy; <?= date('Y') ?> <?= e(mb_strtoupper(SITE_NAME)) ?>. All Rights Reserved.</p>
            </div>

            <ul class="footer__social">
                <?php foreach ($footer_links as $link): ?>
                <li>
                    <a href="<?= e($link['url']) ?>"<?= str_starts_with($link['url'], 'mailto:') ? '' : ' target="_blank" rel="noopener"' ?> aria-label="<?= e($link['label']) ?>">
                        <?= icon($link['icon'], 22) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </footer>

    <a href="<?= e(wa_link()) ?>" class="whatsapp-fab" target="_blank" rel="noopener" aria-label="Chat lewat WhatsApp">
        <?= icon('whatsapp', 30) ?>
    </a>

    <script src="<?= asset('js/main.js') ?>" defer></script>
</body>
</html>
