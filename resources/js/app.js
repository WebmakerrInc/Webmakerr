const selectors = {
    navigation: 'primary-navigation',
    toggle: 'primary-menu-toggle',
    overlay: 'primary-navigation-overlay',
};

const focusableSelector = 'a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])';

function setupPrimaryNavigation() {
    const navigation = document.getElementById(selectors.navigation);
    const toggle = document.getElementById(selectors.toggle);
    const overlay = document.getElementById(selectors.overlay);

    if (!navigation || !toggle) {
        return;
    }

    const desktopQuery = window.matchMedia('(min-width: 768px)');
    let userInteracted = false;

    const updateState = (isOpen) => {
        const value = isOpen ? 'true' : 'false';

        toggle.setAttribute('aria-expanded', value);
        navigation.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
        navigation.setAttribute('data-open', value);

        if (overlay) {
            overlay.setAttribute('data-open', value);
            overlay.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
        }

        if (isOpen && !desktopQuery.matches) {
            document.body.classList.add('mobile-menu-open');
            const firstInteractiveChild = navigation.querySelector(focusableSelector);

            if (firstInteractiveChild instanceof HTMLElement) {
                firstInteractiveChild.focus();
            }
        } else {
            document.body.classList.remove('mobile-menu-open');
        }
    };

    const closeMenu = () => {
        userInteracted = true;
        updateState(false);
        toggle.focus();
    };

    const syncWithViewport = () => {
        if (desktopQuery.matches) {
            updateState(true);
            return;
        }

        if (userInteracted) {
            const expanded = toggle.getAttribute('aria-expanded') === 'true';
            updateState(expanded);
            return;
        }

        updateState(false);
    };

    toggle.addEventListener('click', (event) => {
        event.preventDefault();
        userInteracted = true;
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';
        updateState(!isOpen);
    });

    if (overlay) {
        overlay.addEventListener('click', (event) => {
            event.preventDefault();
            closeMenu();
        });
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true' && !desktopQuery.matches) {
            closeMenu();
        }
    });

    syncWithViewport();

    if (typeof desktopQuery.addEventListener === 'function') {
        desktopQuery.addEventListener('change', syncWithViewport);
    } else if (typeof desktopQuery.addListener === 'function') {
        desktopQuery.addListener(syncWithViewport);
    }
}

function setupFooterAccordions() {
    const items = document.querySelectorAll('[data-footer-accordion-item]');

    if (!items.length) {
        return;
    }

    const desktopQuery = window.matchMedia('(min-width: 768px)');

    items.forEach((item) => {
        const trigger = item.querySelector('[data-footer-accordion-trigger]');
        const content = item.querySelector('[data-footer-accordion-content]');
        const icon = item.querySelector('[data-footer-accordion-icon]');

        if (!(trigger instanceof HTMLElement) || !(content instanceof HTMLElement)) {
            return;
        }

        const close = () => {
            content.classList.remove('max-h-96', 'opacity-100', 'pointer-events-auto');
            content.classList.add('max-h-0', 'opacity-0', 'pointer-events-none');
            content.setAttribute('aria-hidden', 'true');
            trigger.setAttribute('aria-expanded', 'false');

            if (icon instanceof HTMLElement) {
                icon.classList.remove('rotate-45');
            }
        };

        const open = () => {
            content.classList.remove('max-h-0', 'opacity-0', 'pointer-events-none');
            content.classList.add('max-h-96', 'opacity-100', 'pointer-events-auto');
            content.setAttribute('aria-hidden', 'false');
            trigger.setAttribute('aria-expanded', 'true');

            if (icon instanceof HTMLElement) {
                icon.classList.add('rotate-45');
            }
        };

        const syncWithViewport = () => {
            if (desktopQuery.matches) {
                content.classList.remove('max-h-0', 'max-h-96', 'opacity-0', 'opacity-100', 'pointer-events-none', 'pointer-events-auto');
                content.setAttribute('aria-hidden', 'false');
                trigger.setAttribute('aria-expanded', 'true');

                if (icon instanceof HTMLElement) {
                    icon.classList.remove('rotate-45');
                }

                return;
            }

            close();
        };

        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            const expanded = trigger.getAttribute('aria-expanded') === 'true';

            if (expanded) {
                close();
            } else {
                open();
            }
        });

        syncWithViewport();

        if (typeof desktopQuery.addEventListener === 'function') {
            desktopQuery.addEventListener('change', syncWithViewport);
        } else if (typeof desktopQuery.addListener === 'function') {
            desktopQuery.addListener(syncWithViewport);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    setupPrimaryNavigation();
    setupFooterAccordions();
});
