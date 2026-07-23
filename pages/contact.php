<?php
$wa_url = 'https://wa.me/' . htmlspecialchars(SITE_WHATSAPP) . '?text=' . rawurlencode(SITE_WHATSAPP_TEMPLATE);

$form_status = '';
$form_errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '')    $form_errors[] = 'Name is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $form_errors[] = 'A valid email is required.';
    if ($message === '') $form_errors[] = 'Message is required.';

    if (empty($form_errors)) {
        $to = SITE_EMAIL;
        $subject = "Contact Form: " . htmlspecialchars($name) . " - " . htmlspecialchars($service);
        $body = "Name: $name\nEmail: $email\nPhone: $phone\nCompany: $company\nService: $service\n\nMessage:\n$message";
        $headers = "From: noreply@" . $_SERVER['HTTP_HOST'] . "\r\nReply-To: $email";
        @mail($to, $subject, $body, $headers);
        $form_status = 'success';
    }
}
?>

<section class="page-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Let's start a conversation about your HSSE needs</p>
    </div>
</section>

<section class="contact-page section">
    <div class="container">
        <div class="contact-page__grid">
            <div class="contact-page__info">
                <h2>Get in Touch</h2>
                <p>Have questions about our HSSE services? Need a custom proposal? We'd love to hear from you.</p>

                <div class="contact__cards">
                    <a href="mailto:<?= htmlspecialchars(SITE_EMAIL) ?>" class="contact__card">
                        <div class="contact__card-icon contact__card-icon--email">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <span class="contact__card-label">Email</span>
                            <span class="contact__card-value"><?= htmlspecialchars(SITE_EMAIL) ?></span>
                        </div>
                    </a>
                    <a href="<?= $wa_url ?>" target="_blank" rel="noopener" class="contact__card">
                        <div class="contact__card-icon contact__card-icon--wa">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                        </div>
                        <div>
                            <span class="contact__card-label">WhatsApp</span>
                            <span class="contact__card-value"><?= htmlspecialchars(SITE_PHONE) ?></span>
                        </div>
                    </a>
                    <div class="contact__card">
                        <div class="contact__card-icon contact__card-icon--ig">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </div>
                        <div>
                            <span class="contact__card-label">Instagram</span>
                            <span class="contact__card-value"><?= htmlspecialchars(SITE_INSTAGRAM) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <?php if ($form_status === 'success'): ?>
                <div class="alert alert--success">
                    <strong>Thank you!</strong> Your message has been sent. We'll get back to you shortly.
                </div>
                <?php endif; ?>

                <?php if (!empty($form_errors)): ?>
                <div class="alert alert--error">
                    <ul>
                        <?php foreach ($form_errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>contact" class="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" id="company" name="company" value="<?= htmlspecialchars($_POST['company'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="service">Service of Interest</label>
                        <select id="service" name="service">
                            <option value="">Select a service...</option>
                            <option value="Consulting">Consulting</option>
                            <option value="Training">Training</option>
                            <option value="Competency Re-Assessment">Competency Re-Assessment</option>
                            <option value="Custom Solution">Custom Solution</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="5" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" name="contact_submit" class="btn btn--accent btn--submit">Send Message &rarr;</button>
                </form>
            </div>
        </div>
    </div>
</section>
