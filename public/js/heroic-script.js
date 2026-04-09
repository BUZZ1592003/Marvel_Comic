document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    const themeToggle = document.getElementById('theme-toggle');
    const root = document.documentElement;

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            const expanded = navToggle.getAttribute('aria-expanded') === 'true';
            navToggle.setAttribute('aria-expanded', String(!expanded));
            navMenu.classList.toggle('open');
        });

        document.querySelectorAll('#nav-menu a').forEach((link) => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('open');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach((toggle) => {
        const menu = toggle.parentElement?.querySelector('.dropdown-menu');
        if (!menu) {
            return;
        }

        toggle.addEventListener('click', (event) => {
            event.preventDefault();
            menu.classList.toggle('hidden');
            toggle.setAttribute('aria-expanded', String(!menu.classList.contains('hidden')));
        });
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach((menu) => {
                menu.classList.add('hidden');
            });
            document.querySelectorAll('.dropdown-toggle').forEach((toggle) => {
                toggle.setAttribute('aria-expanded', 'false');
            });
        }
    });

    const storedTheme = localStorage.getItem('vault-theme');
    if (storedTheme === 'light' || storedTheme === 'dark') {
        root.setAttribute('data-theme', storedTheme);
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const current = root.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
            const next = current === 'dark' ? 'light' : 'dark';
            root.setAttribute('data-theme', next);
            localStorage.setItem('vault-theme', next);
        });
    }

    const revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.14 });

        revealEls.forEach((el) => revealObserver.observe(el));
    } else {
        revealEls.forEach((el) => el.classList.add('is-visible'));
    }

    const previewRoot = document.getElementById('vaultPreview');
    if (previewRoot) {
        const previewTitle = document.getElementById('previewTitle');
        const previewImage = document.getElementById('previewImage');
        const previewSeries = document.getElementById('previewSeries');
        const previewDescription = document.getElementById('previewDescription');
        const previewRating = document.getElementById('previewRating');
        const previewPrice = document.getElementById('previewPrice');
        const previewLink = document.getElementById('previewLink');

        const openPreview = (button) => {
            previewTitle.textContent = button.dataset.title || 'Comic';
            previewImage.src = button.dataset.image || '';
            previewSeries.textContent = button.dataset.series || '';
            previewDescription.textContent = button.dataset.description || '';
            previewRating.textContent = `Rating ${button.dataset.rating || '4.5'}`;
            previewPrice.textContent = button.dataset.price || '$4.99';
            previewLink.href = button.dataset.url || '#';
            previewRoot.classList.add('is-open');
            previewRoot.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        };

        const closePreview = () => {
            previewRoot.classList.remove('is-open');
            previewRoot.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        };

        document.querySelectorAll('.quick-preview').forEach((button) => {
            button.addEventListener('click', () => openPreview(button));
        });

        previewRoot.querySelectorAll('[data-close-preview="true"]').forEach((el) => {
            el.addEventListener('click', closePreview);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && previewRoot.classList.contains('is-open')) {
                closePreview();
            }
        });
    }

    const hero = document.querySelector('.vault-hero__ambient');
    if (hero && window.matchMedia('(prefers-reduced-motion: no-preference)').matches) {
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (ticking) {
                return;
            }

            window.requestAnimationFrame(() => {
                const y = Math.min(window.scrollY * 0.2, 46);
                hero.style.transform = `translateY(${y}px)`;
                ticking = false;
            });
            ticking = true;
        }, { passive: true });
    }
});
