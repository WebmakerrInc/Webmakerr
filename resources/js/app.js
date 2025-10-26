window.addEventListener('load', function () {
    const mainNavigation = document.getElementById('primary-navigation')
    const mainNavigationToggle = document.getElementById('primary-menu-toggle')

    if (mainNavigation && mainNavigationToggle) {
        mainNavigationToggle.addEventListener('click', function (event) {
            event.preventDefault()
            mainNavigation.classList.toggle('hidden')
        })
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
