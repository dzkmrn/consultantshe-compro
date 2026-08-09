<?php
$form_status = '';
$form_errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') {
        $form_errors[] = 'Nama wajib diisi.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_errors[] = 'Alamat email tidak valid.';
    }
    if ($message === '') {
        $form_errors[] = 'Pesan wajib diisi.';
    }

    if (!$form_errors) {
        $body = "Nama: $name\nEmail: $email\nTelepon: $phone\nPerusahaan: $company\nLayanan: $service\n\nPesan:\n$message";
        $headers = 'From: noreply@' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . "\r\nReply-To: " . $email;
        @mail(SITE_EMAIL, 'Contact Form: ' . $name, $body, $headers);
        $form_status = 'success';
    }
}

$contact_methods = [
    ['icon' => 'map-pin-solid',   'label' => 'Alamat',    'value' => SITE_ADDRESS],
    ['icon' => 'mail-solid',      'label' => 'Email',     'value' => SITE_EMAIL],
    ['icon' => 'whatsapp',        'label' => 'WhatsApp',  'value' => SITE_PHONE],
    ['icon' => 'instagram-solid', 'label' => 'Instagram', 'value' => SITE_INSTAGRAM],
];
?>

<section class="page-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Let&rsquo;s start a conversation about your SHE needs</p>
    </div>
</section>

<section class="section">
    <div class="container contact-page__grid">
        <div>
            <h2>Get in Touch</h2>
            <p style="margin-top: 0.75rem; color: var(--gray-500);">Ada pertanyaan tentang layanan kami atau butuh proposal khusus? Kami siap membantu.</p>
            <ul class="contact-list">
                <?php foreach ($contact_methods as $method): ?>
                <li>
                    <?= icon($method['icon'], 20) ?>
                    <div>
                        <strong><?= e($method['label']) ?></strong>
                        <span><?= e($method['value']) ?></span>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div>
            <?php if ($form_status === 'success'): ?>
            <div class="alert alert--success"><strong>Terima kasih!</strong> Pesan Anda sudah terkirim. Kami akan segera menghubungi Anda.</div>
            <?php endif; ?>

            <?php if ($form_errors): ?>
            <div class="alert alert--error">
                <ul>
                    <?php foreach ($form_errors as $error): ?>
                    <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form method="post" action="<?= BASE_URL ?>contact" class="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama Lengkap *</label>
                        <input type="text" id="name" name="name" required value="<?= e($_POST['name'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" value="<?= e($_POST['phone'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="company">Perusahaan</label>
                        <input type="text" id="company" name="company" value="<?= e($_POST['company'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="service">Layanan yang Diminati</label>
                    <select id="service" name="service">
                        <option value="">Pilih layanan…</option>
                        <?php foreach (content('services') as $service): ?>
                        <option value="<?= e($service['title']) ?>"><?= e($service['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Pesan *</label>
                    <textarea id="message" name="message" rows="5" required><?= e($_POST['message'] ?? '') ?></textarea>
                </div>
                <button type="submit" name="contact_submit" class="btn btn--primary btn--block btn--lg">Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>
