<?php
/**
 * Gallery page — justified grid styled after
 * reference2/Gallery Section Reference.png.
 */
require_once __DIR__ . '/../includes/gallery.php';

$photos = gallery_photos();
?>

<section class="page-hero">
    <div class="container">
        <h1 class="section-title section-title--bar">Moments From the Field &amp; Classroom</h1>
        <p class="section-lead">A look at our consulting sessions, competency assessments, and training programmes delivered across Indonesia.</p>
    </div>
</section>

<section class="gallery">
    <div class="gallery__bleed">
        <?php if (!$photos): ?>
        <p class="openings__empty">Belum ada foto yang ditampilkan.</p>
        <?php else: ?>
        <div class="gallery__grid" id="galleryGrid">
            <?php foreach ($photos as $i => $photo): ?>
            <button type="button" class="gallery__item" style="--ratio: <?= $photo['ratio'] ?>" aria-label="Perbesar foto <?= $i + 1 ?>">
                <img src="<?= e($photo['url']) ?>"
                     alt="Dokumentasi kegiatan <?= e(SITE_NAME) ?> <?= $i + 1 ?>"
                     width="<?= $photo['w'] ?>" height="<?= $photo['h'] ?>"
                     loading="lazy" decoding="async">
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php if ($photos): ?>
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto">
    <button type="button" class="lightbox__close" data-lightbox-close aria-label="Tutup">&times;</button>
    <button type="button" class="lightbox__nav lightbox__nav--prev" data-lightbox-prev aria-label="Foto sebelumnya">&lsaquo;</button>
    <img src="" alt="" class="lightbox__img" data-lightbox-image>
    <button type="button" class="lightbox__nav lightbox__nav--next" data-lightbox-next aria-label="Foto berikutnya">&rsaquo;</button>
    <span class="lightbox__counter" data-lightbox-counter></span>
</div>
<?php endif; ?>

<?php require __DIR__ . '/../includes/contact-cta.php'; ?>
