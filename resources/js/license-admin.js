(function () {
    const activateButton = document.getElementById('webmakerr-activate-license');
    if (!activateButton || typeof window.webmakerrLicenseData === 'undefined') {
        return;
    }

    const input = document.getElementById('webmakerr-license-key');
    const feedback = document.getElementById('webmakerr-license-feedback');
    const statusText = document.getElementById('webmakerr-license-status-text');
    const spinner = document.querySelector('.webmakerr-license-spinner');
    const { endpoint, nonce, messages, labels, storedStatus } = window.webmakerrLicenseData;

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

    if (storedStatus) {
        updateStatus(storedStatus);
    }

    activateButton.addEventListener('click', () => {
        if (!input) {
            return;
        }

        const key = input.value.trim();
        if (!key) {
            setFeedback(messages.empty, 'error');
            updateStatus('invalid');
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
                if (data.valid) {
                    setFeedback(messages.success, 'success');
                    updateStatus('active');
                } else {
                    const status = typeof data.status === 'string' ? data.status : 'invalid';
                    setFeedback(messages.error, 'error');
                    updateStatus(status);
                }
            })
            .catch(() => {
                setFeedback(messages.error, 'error');
                updateStatus('invalid');
            })
            .finally(() => {
                toggleLoading(false);
            });
    });
})();
