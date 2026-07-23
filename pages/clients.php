<section class="page-hero">
    <div class="container">
        <h1>Our Clients</h1>
        <p>Trusted by leading organizations across Indonesia</p>
    </div>
</section>

<section class="clients section">
    <div class="container">
        <div class="section__header">
            <h2>Trusted Across Industries Since <?= SITE_YEAR_FOUNDED ?></h2>
            <p>We are proud to have partnered with organizations across high-risk sectors including oil &amp; gas, mining, construction, manufacturing, energy, and transportation.</p>
        </div>

        <div class="industries__grid">
            <?php
            $industries = [
                ['Oil & Gas', '<svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>'],
                ['Manufacturing', '<svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 20h20"/><path d="M5 20V8l5 4V8l5 4V4l5 4v12"/></svg>'],
                ['Mining & Energy', '<svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>'],
                ['Construction', '<svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="12" width="6" height="10"/><rect x="9" y="8" width="6" height="14"/><rect x="17" y="4" width="6" height="18"/></svg>'],
                ['Healthcare', '<svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>'],
                ['Education', '<svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>'],
                ['Government', '<svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>'],
                ['Transportation', '<svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>'],
            ];
            foreach ($industries as $ind): ?>
            <div class="industry-card">
                <div class="industry-card__icon"><?= $ind[1] ?></div>
                <h3><?= htmlspecialchars($ind[0]) ?></h3>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="testimonials section section--alt">
    <div class="container">
        <div class="section__header">
            <h2>What Our Clients Say</h2>
        </div>
        <div class="testimonials__grid">
            <div class="testimonial-card">
                <div class="testimonial-card__stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                <p>"The HSSE consulting and safety culture program was thorough and practical. Our team gained real improvements in safety behavior on site."</p>
                <div class="testimonial-card__author">
                    <strong>HSE Manager</strong>
                    <span>Manufacturing Company</span>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-card__stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                <p>"Professional delivery with well-structured content. The competency re-assessment for our heavy equipment operators was thorough and efficient."</p>
                <div class="testimonial-card__author">
                    <strong>HR Director</strong>
                    <span>Energy Sector</span>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-card__stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                <p>"Their CSMS consulting helped us build a robust contractor safety management system. Excellent support from assessment through implementation."</p>
                <div class="testimonial-card__author">
                    <strong>Operations Director</strong>
                    <span>Construction Firm</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta section">
    <div class="container">
        <div class="cta__content">
            <h2>Join Our Growing List of Partners</h2>
            <p>Let us help your organization strengthen safety performance and workforce competency.</p>
            <a href="<?= BASE_URL ?>contact" class="btn btn--primary btn--lg">Partner With Us</a>
        </div>
    </div>
</section>
