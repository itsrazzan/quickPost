// Scroll reveals (DESIGN.md, Motion): elements with [data-reveal] fade in once.
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const revealables = document.querySelectorAll('[data-reveal]');

if (reduceMotion || !('IntersectionObserver' in window)) {
    revealables.forEach((el) => el.classList.add('is-visible'));
} else {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.01 },
    );

    revealables.forEach((el) => observer.observe(el));
}

// Mobile menu (header.blade.php): the button owns aria-expanded, the panel toggles hidden.
const menuButton = document.querySelector('[data-menu-button]');
const menuPanel = document.querySelector('[data-menu-panel]');

if (menuButton && menuPanel) {
    menuButton.addEventListener('click', () => {
        const open = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', String(!open));
        menuPanel.hidden = open;
    });
}
