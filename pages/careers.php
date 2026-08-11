<?php
/**
 * Career page — layout follows reference2/Page Careers.jpg.
 * Vacancy content lives in data/jobs.php.
 */
$jobs = content('jobs');

$hero_points = [
    'Grow through real-world SHE projects',
    'Learn from experienced industry professionals',
    'Develop technical and professional skills',
    'Work with teams across diverse industries',
];
?>

<section class="career-hero">
    <div class="container career-hero__grid">
        <div class="career-hero__content">
            <h1>Build Your Career. Help Shape Safer Workplaces.</h1>
            <p class="career-hero__lead">Join <?= e(SITE_SHORT_NAME) ?> and grow your career while contributing to safer, healthier, and more responsible workplaces across industries.</p>

            <ul class="career-hero__points">
                <?php foreach ($hero_points as $point): ?>
                <li><?= icon('check-circle-solid', 22) ?><span><?= e($point) ?></span></li>
                <?php endforeach; ?>
            </ul>

            <a href="#openings" class="btn btn--primary btn--lg">Explore Career Opportunities</a>
        </div>

        <figure class="career-hero__media">
            <img src="<?= asset('images/career-hero.jpg') ?>" alt="The <?= e(SITE_NAME) ?> team on site" width="931" height="861">
            <figcaption>Grow with us, make an impact, and build a safer future as part of our team.</figcaption>
        </figure>
    </div>
</section>

<section class="openings" id="openings">
    <div class="container">
        <h2 class="section-title">Current Openings</h2>
        <p class="section-lead">Explore our current career opportunities and find the role that fits your expertise.</p>

        <?php if (!$jobs): ?>
        <p class="openings__empty">
            There are no openings at the moment. Send your CV to
            <a href="mailto:<?= e(CAREERS_EMAIL) ?>"><?= e(CAREERS_EMAIL) ?></a>
            and we will keep it on file for future roles.
        </p>
        <?php else: ?>

        <div class="openings__list">
            <?php foreach ($jobs as $i => $job):
                $panel_id = 'job-detail-' . $i;
                $apply_url = 'mailto:' . CAREERS_EMAIL . '?subject=' . rawurlencode('Application - ' . $job['title']);
            ?>
            <article class="job">
                <div class="job__banner">
                    <img src="<?= asset($job['banner']) ?>" alt="" loading="lazy">
                </div>

                <div class="job__body">
                    <div class="job__main">
                        <?php if (!empty($job['urgent'])): ?>
                        <p class="job__badge"><?= icon('push-pin', 16) ?>Urgently Hiring</p>
                        <?php endif; ?>

                        <h3 class="job__title"><?= e($job['title']) ?></h3>
                        <p class="job__summary"><?= e($job['summary']) ?></p>

                        <button type="button" class="job__toggle" data-job-toggle aria-expanded="false" aria-controls="<?= $panel_id ?>"
                                data-label-closed="View Job Details" data-label-open="Hide Job Details">
                            <span data-job-toggle-label>View Job Details</span>
                            <?= icon('chevron-down', 16) ?>
                        </button>
                    </div>

                    <!-- Details come before the apply box so that once they are open the
                         stacked layout ends on the button. Wide screens place both with
                         grid, where source order does not decide what sits where. -->
                    <div class="job__details" id="<?= $panel_id ?>" hidden>
                        <h4>Qualifications</h4>
                        <ul class="job__quals">
                            <?php foreach ($job['quals'] as $qual): ?>
                            <li>
                                <?= icon('check-circle-solid', 20) ?>
                                <div>
                                    <p><?= e($qual['text']) ?></p>
                                    <?php if (!empty($qual['items'])): ?>
                                    <ul class="job__chips">
                                        <?php foreach ($qual['items'] as $item): ?>
                                        <li><?= e($item) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <p class="job__footnote">
                            <span>Send your application to <a href="<?= e($apply_url) ?>"><?= e(CAREERS_EMAIL) ?></a></span>
                        </p>
                    </div>

                    <aside class="job__aside">
                        <ul class="job__meta">
                            <li><?= icon('briefcase', 18) ?><?= e($job['type']) ?></li>
                            <li><?= icon('map-pin', 18) ?><?= e($job['location']) ?></li>
                        </ul>
                        <a class="btn btn--primary btn--block" href="<?= e($apply_url) ?>">Apply for This Position</a>
                    </aside>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>
    </div>
</section>
