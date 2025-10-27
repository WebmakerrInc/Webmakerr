/**
 * Webmakerr Admin Dashboard Enhancements
 * Provides mobile sidebar toggle behaviour for the Tailwind-inspired admin UI.
 */
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        var body = document.body;
        var menuWrap = document.getElementById('adminmenuwrap');
        var menuBack = document.getElementById('adminmenuback');
        var toggleLink = document.querySelector('#wp-admin-bar-menu-toggle > a');

        if (!menuWrap) {
            return;
        }

        var overlay = document.createElement('div');
        overlay.className = 'wm-admin-overlay hidden fixed inset-0 bg-black/50 z-[98] lg:hidden';
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

        function toggleMenu(event) {
            event.preventDefault();
            if (body.classList.contains('wm-admin-menu-open')) {
                closeMenu();
            } else {
                openMenu();
            }
        }

        if (window.innerWidth < 1024) {
            closeMenu();
        } else {
            menuWrap.classList.remove('-translate-x-full');
            if (menuBack) {
                menuBack.classList.remove('-translate-x-full');
            }
        }

        overlay.addEventListener('click', closeMenu);

        if (toggleLink) {
            toggleLink.addEventListener('click', toggleMenu);
        }

        menuWrap.addEventListener('click', function (event) {
            if (window.innerWidth >= 1024) {
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

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                body.classList.remove('wm-admin-menu-open');
                menuWrap.classList.remove('-translate-x-full');
                if (menuBack) {
                    menuBack.classList.remove('-translate-x-full');
                }
                overlay.classList.add('hidden');
            } else if (!body.classList.contains('wm-admin-menu-open')) {
                closeMenu();
            }
        });
    });
})();
