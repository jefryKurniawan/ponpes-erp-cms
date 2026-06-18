/* CMS Main JavaScript */
/* Pesantren CMS Public Frontend */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initNavbar();
    initAnimations();
    initCounters();
    initForms();
    initSmoothScroll();
    initBackToTop();
});

/* Navbar Functions */
function initNavbar() {
    const navbar = document.querySelector('.navbar');

    // Change navbar style on scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile menu close when clicking link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                new bootstrap.Collapse(navbarCollapse).toggle();
            }
        });
    });
}

/* Animation Functions */
function initAnimations() {
    const animatedElements = document.querySelectorAll('.animated-element');

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach(el => {
        observer.observe(el);
    });
}

/* Counter Functions */
function initCounters() {
    // Counters are handled in the HTML file with inline script
    // This function is kept for extensibility
}

/* Form Functions */
function initForms() {
    // Initialize form validation and enhancements
    const forms = document.querySelectorAll('form.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });

    // Add floating label focus effects
    const floatingLabels = document.querySelectorAll('.form-floating');

    floatingLabels.forEach(container => {
        const input = container.querySelector('.form-control, .form-select');

        if (input) {
            input.addEventListener('focus', function() {
                container.classList.add('is-focused');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    container.classList.remove('is-focused');
                }
            });

            // Check if has value on page load
            if (input.value) {
                container.classList.add('is-focused');
            }
        }
    });
}

/* Smooth Scroll for Anchor Links */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            if (href !== '#' && href.startsWith('#')) {
                e.preventDefault();

                const targetElement = document.querySelector(href);
                if (targetElement) {
                    const headerOffset = document.querySelector('.navbar') ?
                                        document.querySelector('.navbar').offsetHeight : 0;

                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
}

/* Back to Top Button */
function initBackToTop() {
    // Create back to top button if it doesn't exist
    let backToTopBtn = document.querySelector('.back-to-top');

    if (!backToTopBtn) {
        backToTopBtn = document.createElement('button');
        backToTopBtn.className = 'back-to-top btn btn-primary btn-sm position-fixed';
        backToTopBtn.style.bottom = '2rem';
        backToTopBtn.style.right = '2rem';
        backToTopBtn.style.display = 'none';
        backToTopBtn.style.zIndex = '1000';
        backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        backToTopBtn.setAttribute('aria-label', 'Back to top');
        document.body.appendChild(backToTopBtn);

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Show/hide based on scroll position
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopBtn.style.display = 'block';
        } else {
            backToTopBtn.style.display = 'none';
        }
    });
}

/* Lazy Loading for Images */
function initLazyLoading() {
    if ('loading' in HTMLImageElement.prototype) {
        // Browser supports native lazy loading
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.loading = 'lazy';
        });
    } else {
        // Fallback for browsers that don't support native lazy loading
        // Could implement a lazy loading library here if needed
    }
}

/* Print Page Functionality */
function initPrintButton() {
    const printButtons = document.querySelectorAll('.btn-print');

    printButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            window.print();
        });
    });
}

/* Theme Detection (for future dark mode) */
function detectTheme() {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
    }
}

// Initialize additional functions
initLazyLoading();
initPrintButton();
detectTheme();

/* Export functions for use in other files if needed */
window.CMS = {
    initNavbar,
    initAnimations,
    initCounters,
    initForms,
    initSmoothScroll,
    initBackToTop,
    initLazyLoading,
    initPrintButton,
    detectTheme
};