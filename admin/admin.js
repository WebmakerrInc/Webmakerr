/**
 * Webmakerr Admin Dashboard Enhancements
 * Mirrors Tailwind-style mobile sidebar behaviour for the Shopify-inspired layout.
 */
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        var body = document.body;

        if (!body.classList.contains('wp-admin')) {
            return;
        }

        body.classList.remove('auto-fold', 'folded');
        body.classList.add('wm-admin-ready');

        var menuWrap = document.getElementById('adminmenuwrap');
        var menuBack = document.getElementById('adminmenuback');
        var toggleLink = document.querySelector('#wp-admin-bar-menu-toggle > a');
        var BREAKPOINT = 640;
        var adminBar = document.getElementById('wpadminbar');
        var wpContent = document.getElementById('wpcontent');
        var wpBodyContent = document.getElementById('wpbody-content');
        var wpFooter = document.getElementById('wpfooter');

        if (adminBar) {
            adminBar.classList.add('wm-admin-header');
        }

        if (wpContent) {
            wpContent.classList.add('wm-admin-content');
        }

        if (wpBodyContent) {
            wpBodyContent.classList.add('wm-admin-main');

            var wrapElements = wpBodyContent.querySelectorAll(':scope > .wrap');

            wrapElements.forEach(function (wrap) {
                wrap.classList.add('wm-admin-wrap');

                var wrapSurfaceSelectors = [
                    ':scope > form',
                    ':scope > .card',
                    ':scope > .postbox',
                    ':scope > .stuffbox',
                    ':scope > #dashboard-widgets-wrap',
                    ':scope > .webmakerr-license-card',
                ];

                wrapSurfaceSelectors.forEach(function (selector) {
                    wrap.querySelectorAll(selector).forEach(function (section) {
                        section.classList.add('wm-admin-surface');
                    });
                });
            });

            var surfaceSelectors = [
                ':scope > form',
                ':scope > #dashboard-widgets-wrap',
                ':scope > .card',
            ];

            surfaceSelectors.forEach(function (selector) {
                wpBodyContent.querySelectorAll(selector).forEach(function (section) {
                    section.classList.add('wm-admin-surface');
                });
            });
        }

        if (wpFooter) {
            wpFooter.classList.add('wm-admin-footer');
        }

        if (!menuWrap) {
            return;
        }

        menuWrap.classList.add('wm-admin-sidebar');

        if (menuBack) {
            menuBack.classList.add('wm-admin-sidebar', 'wm-admin-sidebar-backdrop');
        }

        var submenuItems = menuWrap.querySelectorAll('#adminmenu > li.wp-has-submenu');

        submenuItems.forEach(function (item) {
            var trigger = item.querySelector(':scope > a');
            var submenu = item.querySelector(':scope > .wp-submenu');

            if (!trigger || !submenu) {
                return;
            }

            item.classList.remove('opensub');

            function isExpanded() {
                return item.classList.contains('wm-submenu-open') && !item.classList.contains('wm-submenu-closing');
            }

            submenu.addEventListener('transitionend', function (event) {
                if (event.propertyName !== 'max-height') {
                    return;
                }

                if (item.classList.contains('wm-submenu-open') && !item.classList.contains('wm-submenu-closing')) {
                    submenu.style.maxHeight = 'none';
                } else {
                    item.classList.remove('wm-submenu-open');
                    item.classList.remove('wm-submenu-closing');
                    submenu.style.maxHeight = '';
                }
            });

            function openSubmenu(animate) {
                item.classList.remove('wm-submenu-closing');
                item.classList.add('wm-submenu-open');
                item.classList.remove('opensub');
                trigger.setAttribute('aria-expanded', 'true');

                if (!animate) {
                    submenu.style.transition = 'none';
                    submenu.style.maxHeight = 'none';
                    requestAnimationFrame(function () {
                        submenu.style.transition = '';
                    });
                    return;
                }

                submenu.style.maxHeight = '0px';
                submenu.offsetHeight;
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
            }

            function closeSubmenu(animate) {
                trigger.setAttribute('aria-expanded', 'false');
                item.classList.remove('opensub');

                if (!animate) {
                    item.classList.remove('wm-submenu-open');
                    item.classList.remove('wm-submenu-closing');
                    submenu.style.transition = 'none';
                    submenu.style.maxHeight = '';
                    requestAnimationFrame(function () {
                        submenu.style.transition = '';
                    });
                    return;
                }

                if (submenu.style.maxHeight === 'none' || submenu.style.maxHeight === '' || submenu.style.maxHeight === 'auto') {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                }

                item.classList.add('wm-submenu-closing');
                submenu.offsetHeight;
                submenu.style.maxHeight = '0px';
            }

            var shouldOpen = item.classList.contains('wp-has-current-submenu') || item.classList.contains('current');

            if (shouldOpen) {
                openSubmenu(false);
            } else {
                closeSubmenu(false);
            }

            trigger.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
            trigger.setAttribute('aria-haspopup', 'true');

            trigger.addEventListener('click', function (event) {
                if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0) {
                    return;
                }

                event.preventDefault();

                if (isExpanded()) {
                    closeSubmenu(true);
                } else {
                    openSubmenu(true);
                }
            });
        });

        window.addEventListener('resize', function () {
            submenuItems.forEach(function (item) {
                if (item.classList.contains('wm-submenu-open') && !item.classList.contains('wm-submenu-closing')) {
                    var panel = item.querySelector(':scope > .wp-submenu');

                    if (panel && panel.style.maxHeight !== 'none') {
                        panel.style.maxHeight = 'none';
                    }
                }
            });
        });

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
