<?php
$wa_url = 'https://wa.me/' . htmlspecialchars(SITE_WHATSAPP) . '?text=' . rawurlencode(SITE_WHATSAPP_TEMPLATE);
?>

<!-- ==================== HERO ==================== -->
<section class="hero" id="home"<?php if (HERO_IMAGE): ?> style="--hero-image: url('<?= htmlspecialchars(HERO_IMAGE) ?>')"<?php endif; ?>>
    <div class="hero__bg"></div>
    <div class="container">
        <div class="hero__content">
            <div class="hero__label">
                <span>Consulting</span>
                <span class="hero__label-dot"></span>
                <span>Training</span>
                <span class="hero__label-dot"></span>
                <span>Competency Re-Assessment</span>
            </div>
            <h1>Building safer, smarter,<br>more compliant<br><span class="text-accent">operations.</span></h1>
            <p class="hero__subtitle"><?= htmlspecialchars(SITE_NAME) ?> delivers strategic and practical HSSE consulting, safety training &amp; competency re-assessment solutions for high-risk industries, moving organizations beyond compliance toward measurable safety culture.</p>
            <div class="hero__actions">
                <a href="#contact" class="btn btn--accent">Start a project &rarr;</a>
                <a href="#services" class="btn btn--ghost">Explore services</a>
            </div>
        </div>
    </div>
</section>

<!-- ==================== STATS ==================== -->
<section class="stats">
    <div class="container">
        <div class="stats__grid">
            <div class="stats__item">
                <span class="stats__number" data-target="50">0</span><span class="stats__plus">+</span>
                <span class="stats__label">Projects Completed</span>
            </div>
            <div class="stats__item">
                <span class="stats__number" data-target="100">0</span><span class="stats__plus">+</span>
                <span class="stats__label">Corporate Clients</span>
            </div>
            <div class="stats__item">
                <span class="stats__number" data-target="30">0</span><span class="stats__plus">+</span>
                <span class="stats__label">Industries Served</span>
            </div>
            <div class="stats__item">
                <span class="stats__number" data-target="<?= date('Y') - SITE_YEAR_FOUNDED ?>">0</span><span class="stats__plus">+</span>
                <span class="stats__label">Years Experience</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CLIENTS ==================== -->
<section class="clients" id="clients">
    <div class="container">
        <p class="clients__heading">Trusted &amp; Invited by Leading Industries &amp; Institutions Since <?= SITE_YEAR_FOUNDED ?></p>
        <div class="clients__marquee">
            <div class="clients__track">
                <?php
                $industries = [
                    'Oil & Gas', 'Manufacturing', 'Mining & Energy', 'Construction',
                    'Healthcare', 'Education', 'Government', 'Transportation',
                    'Petrochemical', 'Telecommunications', 'Banking & Finance', 'FMCG',
                ];
                foreach ($industries as $ind): ?>
                <div class="clients__item"><?= htmlspecialchars($ind) ?></div>
                <?php endforeach;
                foreach ($industries as $ind): ?>
                <div class="clients__item"><?= htmlspecialchars($ind) ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ==================== SERVICES ==================== -->
<section class="services" id="services">
    <div class="container">
        <div class="section-label">Our Core Services</div>
        <h2 class="section-title">Focused services designed<br>for real field implementation.</h2>

        <div class="services__grid">
            <div class="services__card">
                <div class="services__card-visual">
                    <div class="services__card-icon">
                        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    </div>
                    <div class="services__card-cat">Strategic Advisory</div>
                    <h3>Consulting</h3>
                </div>
                <p>HSSE management systems, safety culture development, risk assessment, and contractor safety management consulting for high-risk industries.</p>
                <ul class="services__list">
                    <li>HSSE Management System</li>
                    <li>Safety Culture Development &amp; Implementation</li>
                    <li>CSMS (Contractor Safety Management System)</li>
                    <li>Risk Assessment</li>
                    <li>HSSE Audit &amp; Compliance</li>
                </ul>
            </div>

            <div class="services__card">
                <div class="services__card-visual">
                    <div class="services__card-icon">
                        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div class="services__card-cat">Competence Building</div>
                    <h3>Training</h3>
                </div>
                <p>Practical safety training programs focused on building safety behavior and strengthening safety culture across your organization.</p>
                <ul class="services__list">
                    <li>Safety Behavior &amp; Safety Culture</li>
                    <li>HSSE Awareness Training</li>
                    <li>Hazard Identification &amp; Risk Control</li>
                    <li>Emergency Response Training</li>
                </ul>
            </div>

            <div class="services__card">
                <div class="services__card-visual">
                    <div class="services__card-icon">
                        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="services__card-cat">Certification &amp; Assessment</div>
                    <h3>Competency Re-Assessment</h3>
                </div>
                <p>Competency re-assessment and certification for heavy equipment operators, scaffolders, and riggers to ensure operational safety compliance.</p>
                <ul class="services__list">
                    <li>Heavy Equipment Operator (Dump Truck, Forklift, Crane, Excavator)</li>
                    <li>Scaffolder</li>
                    <li>Rigger</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ==================== ABOUT ==================== -->
<section class="about" id="about">
    <div class="container">
        <div class="about__grid">
            <div class="about__content">
                <div class="section-label">Who We Are</div>
                <h2 class="section-title">Strategic and implementable HSSE solutions for high-risk industries.</h2>
                <p>Established in <?= SITE_YEAR_FOUNDED ?>, <?= htmlspecialchars(SITE_NAME) ?> has grown into a comprehensive HSSE consulting, training, and competency re-assessment firm serving high-risk industries across Indonesia.</p>
                <p>We help organizations build stronger safety culture, ensure HSSE compliance, and maintain workforce competency through consulting, practical training, and professional re-assessment services.</p>
            </div>
            <div class="about__image">
                <img src="<?= ASSETS_URL ?>images/logo.webp" alt="<?= htmlspecialchars(SITE_NAME) ?>">
            </div>
        </div>
    </div>
</section>

<!-- ==================== VISION & MISSION ==================== -->
<section class="vision-mission">
    <div class="container">
        <div class="vm__grid">
            <div class="vm__left">
                <div class="section-label section-label--light">Vision &amp; Mission</div>
                <h2 class="vm__title">Building sustainable HSSE performance through systems, people, and culture.</h2>
                <div class="vm__vision-box">
                    <div class="vm__vision-label">Our Vision</div>
                    <p>To become a trusted partner in delivering excellent, innovative, and sustainable HSSE solutions for high-risk industries.</p>
                </div>
            </div>
            <div class="vm__right">
                <div class="vm__mission-label">Mission Focus</div>
                <div class="vm__missions">
                    <div class="vm__mission-item">
                        <span class="vm__mission-num">01</span>
                        <p>Provide innovative, effective, and practical HSSE consulting aligned with regulations and operational needs.</p>
                    </div>
                    <div class="vm__mission-item">
                        <span class="vm__mission-num">02</span>
                        <p>Improve HSSE competence and awareness through quality training and best-practice mentoring.</p>
                    </div>
                    <div class="vm__mission-item">
                        <span class="vm__mission-num">03</span>
                        <p>Develop integrated safety management systems, including CSMS, HSSE Management System, and risk assessment frameworks.</p>
                    </div>
                    <div class="vm__mission-item">
                        <span class="vm__mission-num">04</span>
                        <p>Ensure workforce competency through professional re-assessment for heavy equipment operators, scaffolders, and riggers.</p>
                    </div>
                    <div class="vm__mission-item">
                        <span class="vm__mission-num">05</span>
                        <p>Build long-term partnerships through collaborative, trust-based, and results-oriented approaches.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CONTACT / CTA ==================== -->
<section class="contact" id="contact">
    <div class="container">
        <div class="contact__grid">
            <div class="contact__info">
                <div class="section-label">Partner With Us</div>
                <h2 class="section-title">Ready to strengthen your safety performance?</h2>
                <p class="contact__desc">Tell us about your operation. We'll respond with a practical next step, an assessment, a training proposal, or a consulting plan.</p>

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
            <div class="contact__visual">
                <div class="contact__visual-inner">
                    <div class="contact__quote-label"><?= htmlspecialchars(SITE_NAME) ?></div>
                    <blockquote class="contact__quote">"Building competence,<br><span class="text-accent">ensuring compliance.</span>"</blockquote>
                    <a href="<?= $wa_url ?>" target="_blank" rel="noopener" class="btn btn--accent">Start the conversation &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>
