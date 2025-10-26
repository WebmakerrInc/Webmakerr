(function () {
    const activateButton = document.getElementById('webmakerr-activate-license');
    if (!activateButton || typeof window.webmakerrLicenseData === 'undefined') {
        return;
    }

    const input = document.getElementById('webmakerr-license-key');
    const feedback = document.getElementById('webmakerr-license-feedback');
    const statusText = document.getElementById('webmakerr-license-status-text');
    const spinner = document.querySelector('.webmakerr-license-spinner');
    const expiryContainer = document.getElementById('webmakerr-license-expiry');

    const {
        endpoint,
        nonce,
        messages,
        labels,
        storedStatus,
        expiration,
        expirationMessages,
        licenseMessages,
    } = window.webmakerrLicenseData;

    const updateStatus = (status) => {
        if (!statusText) {
            return;
        }

        statusText.className = `status-${status}`;
        const fallback = labels?.inactive || 'Inactive';
        statusText.textContent = (labels && labels[status]) || fallback;
    };

    const setFeedback = (message, type) => {
        if (!feedback) {
            return;
        }

        feedback.textContent = message;
        feedback.classList.remove('success', 'error');
        if (type) {
            feedback.classList.add(type);
        }
    };

    const toggleLoading = (isLoading) => {
        if (!spinner) {
            return;
        }

        spinner.hidden = !isLoading;
        activateButton.disabled = isLoading;
    };

    const formatTemplate = (template, value) => {
        if (typeof template !== 'string') {
            return '';
        }

        if (Array.isArray(value)) {
            return value.reduce((result, item) => formatTemplate(result, item), template);
        }

        if (typeof value === 'number') {
            return template.replace('%d', String(value)).replace('%s', String(value));
        }

        return template.replace('%s', String(value));
    };

    const formatDate = (iso) => {
        if (typeof iso !== 'string' || iso === '') {
            return '';
        }

        const parsed = new Date(iso);
        if (Number.isNaN(parsed.getTime())) {
            const [fallback] = iso.split('T');
            return fallback || iso;
        }

        try {
            return new Intl.DateTimeFormat(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            }).format(parsed);
        } catch (error) {
            const [fallback] = iso.split('T');
            return fallback || iso;
        }
    };

    const normalizeDaysRemaining = (expiresAt, providedDays) => {
        if (typeof providedDays === 'number' && !Number.isNaN(providedDays)) {
            return providedDays;
        }

        if (typeof expiresAt !== 'string' || expiresAt === '') {
            return null;
        }

        const parsed = new Date(expiresAt);
        if (Number.isNaN(parsed.getTime())) {
            return null;
        }

        const diff = parsed.getTime() - Date.now();
        if (diff <= 0) {
            return 0;
        }

        const dayInMs = 24 * 60 * 60 * 1000;
        return Math.floor(diff / dayInMs);
    };

    const describeDaysRemaining = (days) => {
        if (typeof days !== 'number' || Number.isNaN(days)) {
            return '';
        }

        if (days <= 0) {
            return expirationMessages?.lessThanDay || 'less than 1 day';
        }

        if (days === 1) {
            return expirationMessages?.singleDay || '1 day';
        }

        const template = expirationMessages?.multipleDays || '%d days';
        return formatTemplate(template, days);
    };

    const updateExpiry = (status, expiresAt, daysRemaining, message = '', licenseType = '') => {
        if (!expiryContainer) {
            return;
        }

        const normalizedStatus = typeof status === 'string' ? status : 'inactive';
        const normalizedMessage = typeof message === 'string' ? message.trim() : '';
        const normalizedType = typeof licenseType === 'string' ? licenseType.toLowerCase() : '';

        expiryContainer.classList.remove('is-active', 'is-expired');
        expiryContainer.hidden = true;

        if (normalizedMessage) {
            expiryContainer.textContent = normalizedMessage;
            expiryContainer.hidden = false;

            if (normalizedStatus === 'expired') {
                expiryContainer.classList.add('is-expired');
            } else {
                expiryContainer.classList.add('is-active');
            }

            return;
        }

        if (normalizedStatus === 'active' && normalizedType === 'lifetime') {
            const lifetimeMessage = (licenseMessages && licenseMessages.lifetime)
                || (expirationMessages && expirationMessages.lifetime)
                || '✅ License active – lifetime access';

            expiryContainer.textContent = lifetimeMessage;
            expiryContainer.hidden = false;
            expiryContainer.classList.add('is-active');
            return;
        }

        const hasDate = typeof expiresAt === 'string' && expiresAt !== '';

        expiryContainer.classList.remove('is-active', 'is-expired');

        if (!hasDate) {
            expiryContainer.textContent = '';
            expiryContainer.hidden = true;
            return;
        }

        if (normalizedStatus === 'expired') {
            const template = expirationMessages?.expired || '❌ License expired on %s';
            const message = formatTemplate(template, formatDate(expiresAt));
            expiryContainer.textContent = message;
            expiryContainer.hidden = false;
            expiryContainer.classList.add('is-expired');
            return;
        }

        if (normalizedStatus === 'active') {
            const normalizedDays = normalizeDaysRemaining(expiresAt, daysRemaining);
            const dayDescription = describeDaysRemaining(normalizedDays);

            if (dayDescription) {
                const template = expirationMessages?.active || '✅ License active – expires in %s';
                const message = formatTemplate(template, dayDescription);
                expiryContainer.textContent = message;
                expiryContainer.hidden = false;
                expiryContainer.classList.add('is-active');
                return;
            }
        }

        expiryContainer.textContent = '';
        expiryContainer.hidden = true;
    };

    if (storedStatus) {
        const fallbackExpiresAt = expiryContainer ? (expiryContainer.dataset.expiresAt || '') : '';
        const initialExpiresAt = (expiration && typeof expiration.expires_at === 'string')
            ? expiration.expires_at
            : fallbackExpiresAt;
        const initialDays = (expiration && typeof expiration.days_remaining === 'number')
            ? expiration.days_remaining
            : null;

        updateStatus(storedStatus);
        const initialMessage = (expiration && typeof expiration.message === 'string')
            ? expiration.message
            : (expiryContainer ? expiryContainer.textContent.trim() : '');
        const initialType = (expiration && typeof expiration.license_type === 'string')
            ? expiration.license_type
            : (expiryContainer ? (expiryContainer.dataset.licenseType || '') : '');

        updateExpiry(storedStatus, initialExpiresAt, initialDays, initialMessage, initialType);
    }

    activateButton.addEventListener('click', () => {
        if (!input) {
            return;
        }

        const key = input.value.trim();
        if (!key) {
            setFeedback(messages.empty, 'error');
            updateStatus('invalid');
            updateExpiry('invalid', '', null);
            return;
        }

        toggleLoading(true);
        setFeedback('', '');

        const url = `${endpoint}?key=${encodeURIComponent(key)}`;

        fetch(url, {
            method: 'GET',
            headers: {
                'X-WP-Nonce': nonce,
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Request failed');
                }
                return response.json();
            })
            .then((data) => {
                const status = typeof data.status === 'string' ? data.status : (data.valid ? 'active' : 'invalid');

                if (data.valid) {
                    setFeedback(messages.success, 'success');
                } else {
                    const customMessage = typeof data.message === 'string' && data.message ? data.message : messages.error;
                    setFeedback(customMessage, 'error');
                }

                if (expiryContainer) {
                    expiryContainer.dataset.expiresAt = typeof data.expires_at === 'string' ? data.expires_at : '';
                    expiryContainer.dataset.licenseType = typeof data.license_type === 'string' ? data.license_type : '';
                }

                updateStatus(status);
                updateExpiry(
                    status,
                    typeof data.expires_at === 'string' ? data.expires_at : '',
                    data.days_remaining ?? null,
                    typeof data.license_message === 'string' ? data.license_message : '',
                    typeof data.license_type === 'string' ? data.license_type : ''
                );
            })
            .catch(() => {
                setFeedback(messages.error, 'error');
                updateStatus('invalid');
                updateExpiry('invalid', '', null);
            })
            .finally(() => {
                toggleLoading(false);
            });
    });
})();
