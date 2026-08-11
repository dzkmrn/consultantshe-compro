/**
 * Site behaviour. Every block is opt-in: if the markup it targets is missing
 * on a page, the block simply does nothing.
 */
(function () {
    'use strict';

    /* ---------------------------------------------------------------- Navbar */
    const navbar = document.getElementById('navbar');
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    if (navbar) {
        const onScroll = () => navbar.classList.toggle('navbar--scrolled', window.scrollY > 40);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    if (navToggle && navMenu) {
        const setMenu = (open) => {
            navMenu.classList.toggle('is-open', open);
            navToggle.setAttribute('aria-expanded', String(open));
            navToggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        };

        navToggle.addEventListener('click', () => {
            setMenu(navToggle.getAttribute('aria-expanded') !== 'true');
        });

        navMenu.addEventListener('click', (event) => {
            if (event.target.closest('a')) setMenu(false);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') setMenu(false);
        });
    }

    /* ------------------------------------------------- Career: vacancy detail */
    document.querySelectorAll('[data-job-toggle]').forEach((toggle) => {
        const panel = document.getElementById(toggle.getAttribute('aria-controls'));
        const label = toggle.querySelector('[data-job-toggle-label]');
        if (!panel) return;

        toggle.addEventListener('click', () => {
            const open = panel.hasAttribute('hidden');
            panel.toggleAttribute('hidden', !open);
            toggle.setAttribute('aria-expanded', String(open));
            // Both wordings ride on the button so the copy stays in the markup.
            if (label) {
                label.textContent = open
                    ? toggle.dataset.labelOpen || label.textContent
                    : toggle.dataset.labelClosed || label.textContent;
            }
        });
    });

    /* ----------------------------------------------------- Gallery lightbox */
    const galleryGrid = document.getElementById('galleryGrid');
    const lightbox = document.getElementById('lightbox');

    if (galleryGrid && lightbox) {
        const image = lightbox.querySelector('[data-lightbox-image]');
        const counter = lightbox.querySelector('[data-lightbox-counter]');
        const items = Array.from(galleryGrid.querySelectorAll('.gallery__item'));
        let index = 0;

        const show = (next) => {
            index = (next + items.length) % items.length;
            const source = items[index].querySelector('img');
            image.src = source.currentSrc || source.src;
            image.alt = source.alt;
            counter.textContent = `${index + 1} / ${items.length}`;
        };

        const open = (next) => {
            show(next);
            lightbox.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        };

        const close = () => {
            lightbox.classList.remove('is-open');
            document.body.style.overflow = '';
        };

        items.forEach((item, i) => item.addEventListener('click', () => open(i)));
        lightbox.addEventListener('click', (event) => {
            if (event.target.closest('[data-lightbox-close]') || event.target === lightbox) close();
            if (event.target.closest('[data-lightbox-prev]')) show(index - 1);
            if (event.target.closest('[data-lightbox-next]')) show(index + 1);
        });

        document.addEventListener('keydown', (event) => {
            if (!lightbox.classList.contains('is-open')) return;
            if (event.key === 'Escape') close();
            if (event.key === 'ArrowLeft') show(index - 1);
            if (event.key === 'ArrowRight') show(index + 1);
        });
    }

    /* ------------------------------------------------------ Reveal on scroll */
    const revealables = document.querySelectorAll(
        '.card, .about__grid, .partners__logos, .center, .job, .presence__map, .panel'
    );

    if (revealables.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        revealables.forEach((el, i) => {
            el.classList.add('fade-up');
            // Stagger siblings so grids animate in sequence rather than as a block.
            el.style.transitionDelay = `${(i % 3) * 0.08}s`;
            observer.observe(el);
        });
    }
})();
