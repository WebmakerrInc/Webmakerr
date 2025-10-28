/**
 * Webmakerr Admin Dashboard Enhancements
 * Mirrors Tailwind-style mobile sidebar behaviour for the Shopify-inspired layout.
 */
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        var body = document.body;
        var menuWrap = document.getElementById('adminmenuwrap');
        var menuBack = document.getElementById('adminmenuback');
        var toggleLink = document.querySelector('#wp-admin-bar-menu-toggle > a');
        var BREAKPOINT = 1024;

        if (!menuWrap) {
            return;
        }

        var overlay = document.createElement('div');
        overlay.className = 'wm-admin-overlay hidden';
        overlay.setAttribute('aria-hidden', 'true');
        body.appendChild(overlay);

        function openMenu() {
            body.classList.add('wm-admin-menu-open');
            menuWrap.classList.remove('-translate-x-full');
            if (menuBack) {
                menuBack.classList.remove('-translate-x-full');
            }
            overlay.classList.remove('hidden');
        }

        function closeMenu() {
            body.classList.remove('wm-admin-menu-open');
            menuWrap.classList.add('-translate-x-full');
            if (menuBack) {
                menuBack.classList.add('-translate-x-full');
            }
            overlay.classList.add('hidden');
        }

        function isMobileLayout() {
            return window.innerWidth < BREAKPOINT;
        }

        function syncLayout() {
            if (isMobileLayout()) {
                closeMenu();
            } else {
                body.classList.remove('wm-admin-menu-open');
                menuWrap.classList.remove('-translate-x-full');
                if (menuBack) {
                    menuBack.classList.remove('-translate-x-full');
                }
                overlay.classList.add('hidden');
            }
        }

        overlay.addEventListener('click', closeMenu);

        if (toggleLink) {
            toggleLink.addEventListener('click', function (event) {
                event.preventDefault();
                if (body.classList.contains('wm-admin-menu-open')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });
        }

        menuWrap.addEventListener('click', function (event) {
            if (!isMobileLayout()) {
                return;
            }

            var link = event.target.closest('a');
            if (!link) {
                return;
            }

            var parent = link.parentElement;
            if (parent && parent.classList.contains('wp-has-submenu')) {
                return;
            }

            if (link.getAttribute('href')) {
                closeMenu();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && body.classList.contains('wm-admin-menu-open')) {
                closeMenu();
            }
        });

        window.addEventListener('resize', syncLayout);

        syncLayout();
    });
})();
