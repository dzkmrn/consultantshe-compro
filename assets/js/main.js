// Navbar scroll effect
const navbar = document.getElementById('navbar');
const hasHero = !!document.querySelector('.hero');

function updateNavbar() {
    if (hasHero) {
        navbar.classList.toggle('navbar--scrolled', window.scrollY > 60);
    } else {
        navbar.classList.add('navbar--scrolled');
    }
}

updateNavbar();
window.addEventListener('scroll', updateNavbar);

// Mobile menu toggle
const navToggle = document.getElementById('navToggle');
const navMenu = document.getElementById('navMenu');

navToggle.addEventListener('click', () => {
    const isOpen = navMenu.classList.toggle('open');
    const spans = navToggle.querySelectorAll('span');
    spans[0].style.transform = isOpen ? 'rotate(45deg) translate(5px, 5px)' : '';
    spans[1].style.opacity = isOpen ? '0' : '1';
    spans[2].style.transform = isOpen ? 'rotate(-45deg) translate(5px, -5px)' : '';
});

// Close menu on link click
navMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('open');
        const spans = navToggle.querySelectorAll('span');
        spans[0].style.transform = '';
        spans[1].style.opacity = '1';
        spans[2].style.transform = '';
    });
});

// Active section highlighting
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.navbar__menu a[href^="#"]');

function highlightNav() {
    const scrollPos = window.scrollY + 120;
    sections.forEach(section => {
        const top = section.offsetTop;
        const height = section.offsetHeight;
        const id = section.getAttribute('id');
        if (scrollPos >= top && scrollPos < top + height) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + id) {
                    link.classList.add('active');
                }
            });
        }
    });
}
window.addEventListener('scroll', highlightNav);

// Counter animation
const counters = document.querySelectorAll('.stats__number[data-target]');
let countersAnimated = false;

const animateCounter = (el) => {
    const target = +el.dataset.target;
    const duration = 1800;
    const start = performance.now();
    const update = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 4);
        el.textContent = Math.floor(eased * target);
        if (progress < 1) requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
};

// Intersection Observer for animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            if (entry.target.closest('.stats') && !countersAnimated) {
                countersAnimated = true;
                counters.forEach(animateCounter);
            }
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.12, rootMargin: '0px 0px -30px 0px' });

// Apply fade-up to elements
document.querySelectorAll(
    '.stats__grid, .services__card, .about__grid, .vm__mission-item, ' +
    '.contact__grid, .clients, .service-block, .industry-card, ' +
    '.testimonial-card, .values__item, .vm-page__card'
).forEach(el => {
    el.classList.add('fade-up');
    observer.observe(el);
});

// Staggered animation for cards
document.querySelectorAll('.services__grid, .vm__missions, .contact__cards').forEach(container => {
    container.querySelectorAll('.fade-up').forEach((el, i) => {
        el.style.transitionDelay = (i * 0.1) + 's';
    });
});
