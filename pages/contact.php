<?php
/**
 * Hands the enquiry to the MTA, returning false when it refuses.
 *
 * Every value that lands in a header is flattened first: a newline in the name
 * or the reply address would otherwise let the sender append headers of their
 * own, which is how a contact form turns into an open relay. The From domain is
 * fixed rather than read from the Host header, both to close that same hole and
 * because a matching domain is what SPF checks.
 */
function contact_send_mail(array $values, string $service): bool
{
    $body = "Nama: {$values['name']}\n"
        . "Email: {$values['email']}\n"
        . "Telepon: {$values['phone']}\n"
        . "Perusahaan: {$values['company']}\n"
        . "Layanan: {$service}\n\n"
        . "Pesan:\n{$values['message']}\n\n"
        . "-- \n"
        . 'Dikirim: ' . date('Y-m-d H:i:s T') . "\n"
        . 'IP: ' . client_ip() . "\n";

    $domain  = substr((string) strrchr(SITE_EMAIL, '@'), 1);
    $headers = implode("\r\n", [
        'From: ' . mail_header_encoded(SITE_NAME) . ' <noreply@' . $domain . '>',
        'Reply-To: ' . mail_header_value($values['email']),
        'Content-Type: text/plain; charset=UTF-8',
    ]);

    return mail(
        SITE_EMAIL,
        mail_header_encoded('Contact Form: ' . $values['name']),
        $body,
        $headers
    );
}

$form_status = '';
$form_errors = [];

$form_values = [
    'name'    => '',
    'email'   => '',
    'phone'   => '',
    'company' => '',
    'message' => '',
];

// Longest each field is allowed to be. Past this it is a paste bomb rather than
// an enquiry, so it is refused instead of quietly truncated.
$form_limits = [
    'name'    => 100,
    'email'   => 254,
    'phone'   => 32,
    'company' => 120,
    'message' => 4000,
];

// The select is populated from the same list it is checked against, so a
// hand-crafted POST cannot smuggle its own text into the notification.
$service_options = array_column(content('services'), 'title');
$service         = '';

// The success page is a separate GET, so a reload cannot resend the message.
if (isset($_GET['sent'])) {
    $form_status = 'success';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    foreach (array_keys($form_values) as $field) {
        $form_values[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    $service = trim((string) ($_POST['service'] ?? ''));

    // Hidden from real visitors by CSS, so anything in it came from a bot
    // filling in every input it could find.
    $is_bot = trim((string) ($_POST['website'] ?? '')) !== '';

    if (!rate_limit_allows('contact', 5, 3600)) {
        $form_errors[] = 'Terlalu banyak pengiriman dari koneksi ini. Silakan coba lagi dalam satu jam.';
    } elseif (!csrf_cookie_present()) {
        // Resending will not help this one, so point at the two channels beside
        // the form that work without cookies rather than leave them retrying.
        $form_errors[] = 'Browser Anda memblokir cookie yang kami perlukan untuk memverifikasi '
            . 'pengiriman formulir. Aktifkan cookie untuk situs ini lalu muat ulang halaman, atau '
            . 'kirim pesan Anda lewat email maupun WhatsApp di samping.';
    } elseif (!csrf_verify($_POST['csrf_token'] ?? null, CSRF_MIN_FILL_SECONDS)) {
        $form_errors[] = 'Sesi formulir sudah kedaluwarsa. Silakan kirim ulang pesan Anda.';
    }

    if (!$form_errors) {
        if ($form_values['name'] === '') {
            $form_errors[] = 'Nama wajib diisi.';
        }
        if (!filter_var($form_values['email'], FILTER_VALIDATE_EMAIL)) {
            $form_errors[] = 'Alamat email tidak valid.';
        }
        if ($form_values['message'] === '') {
            $form_errors[] = 'Pesan wajib diisi.';
        }
        if ($service !== '' && !in_array($service, $service_options, true)) {
            $form_errors[] = 'Layanan yang dipilih tidak dikenali.';
        }

        foreach ($form_limits as $field => $limit) {
            if (mb_strlen($form_values[$field]) > $limit) {
                $form_errors[] = "Isian terlalu panjang (maksimal {$limit} karakter).";
                break;
            }
        }
    }

    if (!$form_errors) {
        // A bot gets the same answer a person does, so failing the trap tells it
        // nothing. The message simply goes nowhere.
        $sent = $is_bot || contact_send_mail($form_values, $service);

        if ($sent) {
            // Relative on purpose. site_url() builds on the Host header, which
            // the client supplies, so an absolute redirect here would hand an
            // attacker a way to bounce visitors off this domain.
            header('Location: ' . BASE_URL . 'contact?sent=1', true, 303);
            exit;
        }

        $form_errors[] = 'Pesan gagal terkirim. Silakan hubungi kami lewat email atau WhatsApp.';
    }
}

// Every value is actionable: tapping the email opens a mail client, the number
// opens WhatsApp, and the address opens Maps.
$contact_methods = [
    [
        'icon'  => 'map-pin-solid',
        'label' => 'Alamat',
        'value' => SITE_ADDRESS,
        'url'   => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode(SITE_ADDRESS),
    ],
    [
        'icon'  => 'mail-solid',
        'label' => 'Email',
        'value' => SITE_EMAIL,
        'url'   => 'mailto:' . SITE_EMAIL,
    ],
    [
        'icon'  => 'whatsapp',
        'label' => 'WhatsApp',
        'value' => SITE_PHONE,
        'url'   => wa_link(),
    ],
    [
        'icon'  => 'instagram-solid',
        'label' => 'Instagram',
        'value' => SITE_INSTAGRAM,
        'url'   => 'https://instagram.com/' . SITE_INSTAGRAM,
    ],
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
                        <a href="<?= e($method['url']) ?>"<?= str_starts_with($method['url'], 'mailto:') ? '' : ' target="_blank" rel="noopener"' ?>><?= e($method['value']) ?></a>
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
                <?= csrf_field() ?>
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama Lengkap *</label>
                        <input type="text" id="name" name="name" required maxlength="<?= $form_limits['name'] ?>" value="<?= e($form_values['name']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required maxlength="<?= $form_limits['email'] ?>" value="<?= e($form_values['email']) ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" maxlength="<?= $form_limits['phone'] ?>" value="<?= e($form_values['phone']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="company">Perusahaan</label>
                        <input type="text" id="company" name="company" maxlength="<?= $form_limits['company'] ?>" value="<?= e($form_values['company']) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="service">Layanan yang Diminati</label>
                    <select id="service" name="service">
                        <option value="">Pilih layanan…</option>
                        <?php foreach ($service_options as $option): ?>
                        <option value="<?= e($option) ?>"<?= $option === $service ? ' selected' : '' ?>><?= e($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Pesan *</label>
                    <textarea id="message" name="message" rows="5" required maxlength="<?= $form_limits['message'] ?>"><?= e($form_values['message']) ?></textarea>
                </div>

                <!-- Left empty by anyone who can see the page; see .form-trap. -->
                <div class="form-trap" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <button type="submit" name="contact_submit" class="btn btn--primary btn--block btn--lg">Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>
