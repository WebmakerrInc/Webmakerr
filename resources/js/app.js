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

    const leadModal = document.getElementById('global-lead-modal')
    const leadForm = leadModal ? leadModal.querySelector('[data-webseo-lead-form]') : null

    if (leadModal && leadForm) {
        const overlay = leadModal.querySelector('[data-lead-overlay]')
        const dialog = leadModal.querySelector('[data-lead-dialog]')
        const closeButtons = leadModal.querySelectorAll('[data-lead-close]')
        const sourceField = leadModal.querySelector('[data-lead-source-field]')
        const messageElement = leadModal.querySelector('[data-webseo-lead-message]')
        const focusableSelector =
            'a[href], button:not([disabled]), input:not([type="hidden"]):not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([-1])'

        let lastFocusedElement = null
        let isOpen = false

        const resetMessage = function () {
            if (!messageElement) {
                return
            }

            messageElement.textContent = ''
            messageElement.classList.add('hidden')
            messageElement.classList.remove('text-green-600', 'text-red-600')
        }

        const syncAria = function (state) {
            leadModal.setAttribute('aria-hidden', state ? 'false' : 'true')
        }

        const handleEscape = function (event) {
            if (!isOpen || event.key !== 'Escape') {
                return
            }

            event.preventDefault()
            closeModal()
        }

        const handleFocusTrap = function (event) {
            if (!isOpen || event.key !== 'Tab' || !dialog) {
                return
            }

            const focusableElements = dialog.querySelectorAll(focusableSelector)

            if (!focusableElements.length) {
                return
            }

            const firstElement = focusableElements[0]
            const lastElement = focusableElements[focusableElements.length - 1]
            const activeElement = document.activeElement

            if (event.shiftKey) {
                if (activeElement === firstElement || activeElement === dialog) {
                    event.preventDefault()
                    lastElement.focus()
                }
            } else if (activeElement === lastElement) {
                event.preventDefault()
                firstElement.focus()
            }
        }

        const openModal = function (source = '') {
            if (sourceField) {
                sourceField.value = source || ''
            }

            if (isOpen) {
                return
            }

            isOpen = true
            lastFocusedElement = document.activeElement instanceof HTMLElement ? document.activeElement : null

            resetMessage()

            leadModal.classList.remove('hidden')
            syncAria(true)
            document.body.classList.add('overflow-hidden')

            window.requestAnimationFrame(function () {
                if (overlay) {
                    overlay.classList.remove('opacity-0', 'pointer-events-none')
                    overlay.classList.add('opacity-100', 'pointer-events-auto')
                }

                if (dialog) {
                    dialog.classList.remove('opacity-0', 'scale-95', 'translate-y-4', 'pointer-events-none')
                    dialog.classList.add('opacity-100', 'scale-100', 'translate-y-0')

                    const focusableElements = dialog.querySelectorAll(focusableSelector)

                    if (focusableElements.length) {
                        const firstElement = focusableElements[0]

                        if (firstElement && typeof firstElement.focus === 'function') {
                            firstElement.focus()
                        }
                    } else {
                        dialog.focus()
                    }
                }
            })

            document.addEventListener('keydown', handleEscape)
        }

        const closeModal = function () {
            if (!isOpen) {
                return
            }

            isOpen = false

            if (overlay) {
                overlay.classList.remove('opacity-100', 'pointer-events-auto')
                overlay.classList.add('opacity-0', 'pointer-events-none')
            }

            if (dialog) {
                dialog.classList.remove('opacity-100', 'scale-100', 'translate-y-0')
                dialog.classList.add('opacity-0', 'scale-95', 'translate-y-4', 'pointer-events-none')
            }

            document.removeEventListener('keydown', handleEscape)

            window.setTimeout(function () {
                leadModal.classList.add('hidden')
                syncAria(false)
                document.body.classList.remove('overflow-hidden')

                if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
                    lastFocusedElement.focus()
                }

                lastFocusedElement = null
            }, 200)
        }

        const registerTriggers = function () {
            const triggers = document.querySelectorAll('[data-lead-trigger]')

            triggers.forEach(function (trigger) {
                if (trigger.dataset.leadBound === 'true') {
                    return
                }

                trigger.dataset.leadBound = 'true'

                trigger.addEventListener('click', function (event) {
                    event.preventDefault()

                    const source = trigger.getAttribute('data-lead-source') || ''
                    openModal(source)
                })
            })
        }

        if (overlay) {
            overlay.addEventListener('click', function (event) {
                event.preventDefault()
                closeModal()
            })
        }

        if (closeButtons.length) {
            closeButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault()
                    closeModal()
                })
            })
        }

        leadModal.addEventListener('keydown', handleFocusTrap)

        registerTriggers()

        window.openLeadPopup = function (source = '') {
            openModal(source)
        }

        window.closeLeadPopup = function () {
            closeModal()
        }
    } else {
        window.openLeadPopup = function () {}
        window.closeLeadPopup = function () {}
    }

    const leadForms = document.querySelectorAll('[data-webseo-lead-form]')

    if (leadForms.length) {
        leadForms.forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!window.webseoLead || !window.webseoLead.ajaxUrl) {
                    return
                }

                event.preventDefault()

                const messageElement = form.querySelector('[data-webseo-lead-message]')
                const submitButton = form.querySelector('[data-webseo-lead-submit]')
                const loadingText = submitButton ? submitButton.getAttribute('data-webseo-loading-text') : ''
                const defaultMessageConfig = window.webseoLead.messages || {}
                const successMessageAttribute = form.getAttribute('data-webseo-lead-success')
                const successMessage = successMessageAttribute || defaultMessageConfig.success || '✅ You’re in! Check your inbox.'
                const errorMessage = defaultMessageConfig.error || 'Something went wrong. Please try again.'

                if (messageElement) {
                    messageElement.textContent = ''
                    messageElement.classList.add('hidden')
                    messageElement.classList.remove('text-green-600', 'text-red-600')
                }

                if (submitButton) {
                    submitButton.disabled = true
                    if (!submitButton.dataset.webseoOriginalText) {
                        submitButton.dataset.webseoOriginalText = submitButton.textContent || ''
                    }

                    if (loadingText) {
                        submitButton.textContent = loadingText
                    }
                }

                const formData = new FormData(form)

                formData.append('action', 'add_webseo_lead')

                if (window.webseoLead.nonce && !formData.has('webseo_lead_nonce')) {
                    formData.append('webseo_lead_nonce', window.webseoLead.nonce)
                }

                if (window.webseoLead.pageTemplate && !formData.has('page_template')) {
                    formData.append('page_template', window.webseoLead.pageTemplate)
                }

                if (!formData.has('page_url')) {
                    formData.append('page_url', window.location.href)
                }

                fetch(window.webseoLead.ajaxUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData,
                })
                    .then(function (response) {
                        return response.json()
                    })
                    .then(function (payload) {
                        const isSuccess = payload && payload.success
                        const responseMessage =
                            payload && payload.data && payload.data.message
                                ? payload.data.message
                                : isSuccess
                                ? successMessage
                                : errorMessage

                        if (messageElement && responseMessage) {
                            messageElement.textContent = responseMessage
                            messageElement.classList.remove('hidden')

                            if (isSuccess) {
                                messageElement.classList.remove('text-red-600')
                                messageElement.classList.add('text-green-600')
                            } else {
                                messageElement.classList.remove('text-green-600')
                                messageElement.classList.add('text-red-600')
                            }
                        }

                        if (isSuccess) {
                            form.reset()
                        }
                    })
                    .catch(function () {
                        if (messageElement) {
                            messageElement.textContent = errorMessage
                            messageElement.classList.remove('hidden', 'text-green-600')
                            messageElement.classList.add('text-red-600')
                        }
                    })
                    .finally(function () {
                        if (submitButton) {
                            submitButton.disabled = false
                            const originalText = submitButton.dataset.webseoOriginalText || ''

                            if (loadingText) {
                                submitButton.textContent = originalText
                            }
                        }
                    })
            })
        })
    }
})
