document.addEventListener('DOMContentLoaded', function () {
    const mainNavigation = document.getElementById('primary-navigation')
    const mainNavigationToggle = document.getElementById('primary-menu-toggle')
    const mainNavigationOverlay = document.getElementById('primary-navigation-overlay')

    if (mainNavigation && mainNavigationToggle) {
        const navBreakpoint = window.matchMedia('(min-width: 768px)')
        let userInteractedWithNavigation = false

        const applyNavigationVisibility = function (expanded) {
            const expandedValue = expanded ? 'true' : 'false'

            mainNavigationToggle.setAttribute('aria-expanded', expandedValue)
            mainNavigation.setAttribute('aria-hidden', expanded ? 'false' : 'true')
            mainNavigation.setAttribute('data-open', expandedValue)

            if (mainNavigationOverlay) {
                mainNavigationOverlay.setAttribute('data-open', expandedValue)
                mainNavigationOverlay.setAttribute('aria-hidden', expanded ? 'false' : 'true')
            }

            if (expanded && !navBreakpoint.matches) {
                document.body.classList.add('mobile-menu-open')
                const focusTarget = mainNavigation.querySelector(
                    'a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])'
                )

                if (focusTarget) {
                    focusTarget.focus()
                }
            } else {
                document.body.classList.remove('mobile-menu-open')
            }
        }

        const closeNavigation = function () {
            userInteractedWithNavigation = true
            applyNavigationVisibility(false)
            mainNavigationToggle.focus()
        }

        const syncNavigationState = function () {
            if (navBreakpoint.matches) {
                applyNavigationVisibility(true)
            } else if (userInteractedWithNavigation) {
                const expanded = mainNavigationToggle.getAttribute('aria-expanded') === 'true'
                applyNavigationVisibility(expanded)
            } else {
                applyNavigationVisibility(false)
            }
        }

        mainNavigationToggle.addEventListener('click', function (event) {
            event.preventDefault()

            const expanded = mainNavigationToggle.getAttribute('aria-expanded') === 'true'
            userInteractedWithNavigation = true
            applyNavigationVisibility(!expanded)
        })

        if (mainNavigationOverlay) {
            mainNavigationOverlay.addEventListener('click', function (event) {
                event.preventDefault()
                closeNavigation()
            })
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && mainNavigationToggle.getAttribute('aria-expanded') === 'true' && !navBreakpoint.matches) {
                closeNavigation()
            }
        })

        syncNavigationState()

        if (typeof navBreakpoint.addEventListener === 'function') {
            navBreakpoint.addEventListener('change', syncNavigationState)
        } else if (typeof navBreakpoint.addListener === 'function') {
            navBreakpoint.addListener(syncNavigationState)
        }
    }

    const footerAccordions = document.querySelectorAll('[data-footer-accordion-item]')

    if (footerAccordions.length) {
        const breakpoint = window.matchMedia('(min-width: 768px)')

        footerAccordions.forEach(function (item) {
            const trigger = item.querySelector('[data-footer-accordion-trigger]')
            const content = item.querySelector('[data-footer-accordion-content]')
            const icon = item.querySelector('[data-footer-accordion-icon]')

            if (!trigger || !content) {
                return
            }

            const close = function () {
                content.classList.remove('max-h-96', 'opacity-100', 'pointer-events-auto')
                content.classList.add('max-h-0', 'opacity-0', 'pointer-events-none')
                content.setAttribute('aria-hidden', 'true')
                trigger.setAttribute('aria-expanded', 'false')

                if (icon) {
                    icon.classList.remove('rotate-45')
                }
            }

            const open = function () {
                content.classList.remove('max-h-0', 'opacity-0', 'pointer-events-none')
                content.classList.add('max-h-96', 'opacity-100', 'pointer-events-auto')
                content.setAttribute('aria-hidden', 'false')
                trigger.setAttribute('aria-expanded', 'true')

                if (icon) {
                    icon.classList.add('rotate-45')
                }
            }

            const syncState = function () {
                if (breakpoint.matches) {
                    content.classList.remove('max-h-0', 'max-h-96', 'opacity-0', 'opacity-100', 'pointer-events-none', 'pointer-events-auto')
                    content.setAttribute('aria-hidden', 'false')
                    trigger.setAttribute('aria-expanded', 'true')

                    if (icon) {
                        icon.classList.remove('rotate-45')
                    }
                } else {
                    close()
                }
            }

            trigger.addEventListener('click', function (event) {
                event.preventDefault()

                if (trigger.getAttribute('aria-expanded') === 'true') {
                    close()
                } else {
                    open()
                }
            })

            syncState()

            if (typeof breakpoint.addEventListener === 'function') {
                breakpoint.addEventListener('change', syncState)
            } else if (typeof breakpoint.addListener === 'function') {
                breakpoint.addListener(syncState)
            }
        })
    }
})
