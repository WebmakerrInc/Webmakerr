<?php
if (! defined('ABSPATH')) {
    exit;
}

if (! function_exists('webmakerr_onboarding_should_show')) {
    function webmakerr_onboarding_should_show(): bool
    {
        if (is_admin()) {
            return false;
        }

        if (defined('DOING_AJAX') && DOING_AJAX) {
            return false;
        }

        if (defined('REST_REQUEST') && REST_REQUEST) {
            return false;
        }

        if (function_exists('wp_doing_cron') && wp_doing_cron()) {
            return false;
        }

        $status = get_option('webmakerr_theme_license_status', 'inactive');

        return $status !== 'active';
    }
}

if (! function_exists('webmakerr_onboarding_template_include')) {
    function webmakerr_onboarding_template_include(string $template): string
    {
        if (! webmakerr_onboarding_should_show()) {
            return $template;
        }

        if (! defined('WEBMAKERR_ONBOARDING_RENDER')) {
            define('WEBMAKERR_ONBOARDING_RENDER', true);
        }

        return __DIR__.'/onboarding.php';
    }

    add_filter('template_include', 'webmakerr_onboarding_template_include', 0);
}

if (! function_exists('webmakerr_onboarding_send_json_error')) {
    function webmakerr_onboarding_send_json_error(string $message, int $code = 400): void
    {
        wp_send_json(
            [
                'success' => false,
                'message' => $message,
            ],
            $code
        );
    }
}

if (! function_exists('webmakerr_onboarding_handle_business_type')) {
    function webmakerr_onboarding_handle_business_type(): void
    {
        check_ajax_referer('webmakerr_onboarding_nonce', 'nonce');

        $businessType = sanitize_text_field(wp_unslash($_POST['businessType'] ?? ''));

        if ($businessType === '') {
            webmakerr_onboarding_send_json_error(__('Please select a business type to continue.', 'webmakerr'));
        }

        update_option('webmakerr_onboarding_business_type', $businessType, true);

        wp_send_json_success([
            'message' => __('Business type saved.', 'webmakerr'),
        ]);
    }

    add_action('wp_ajax_webmakerr_onboarding_save_business_type', 'webmakerr_onboarding_handle_business_type');
    add_action('wp_ajax_nopriv_webmakerr_onboarding_save_business_type', 'webmakerr_onboarding_handle_business_type');
}

if (! function_exists('webmakerr_onboarding_handle_tools')) {
    function webmakerr_onboarding_handle_tools(): void
    {
        check_ajax_referer('webmakerr_onboarding_nonce', 'nonce');

        $tools = [];

        if (isset($_POST['tools']) && is_array($_POST['tools'])) {
            foreach ($_POST['tools'] as $tool) {
                $tools[] = sanitize_text_field(wp_unslash($tool));
            }
        }

        update_option('webmakerr_onboarding_selected_tools', $tools, true);

        wp_send_json_success([
            'message' => __('Tools preference saved.', 'webmakerr'),
        ]);
    }

    add_action('wp_ajax_webmakerr_onboarding_save_tools', 'webmakerr_onboarding_handle_tools');
    add_action('wp_ajax_nopriv_webmakerr_onboarding_save_tools', 'webmakerr_onboarding_handle_tools');
}

if (! function_exists('webmakerr_onboarding_handle_license')) {
    function webmakerr_onboarding_handle_license(): void
    {
        check_ajax_referer('webmakerr_onboarding_nonce', 'nonce');

        $licenseKey = sanitize_text_field(wp_unslash($_POST['licenseKey'] ?? ''));

        if ($licenseKey === '') {
            webmakerr_onboarding_send_json_error(__('Please enter your license key.', 'webmakerr'));
        }

        $response = wp_remote_post(
            WEBMAKERR_LICENSE_SERVER_URL,
            [
                'body'    => wp_json_encode([
                    'license_key' => $licenseKey,
                ]),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 15,
            ]
        );

        if (is_wp_error($response)) {
            webmakerr_onboarding_send_json_error(__('Unable to connect to the license server. Please try again.', 'webmakerr'), 500);
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (! is_array($data) || ! isset($data['status'])) {
            webmakerr_onboarding_send_json_error(__('Unexpected response from the license server. Please try again.', 'webmakerr'), 500);
        }

        if ($data['status'] !== 'success') {
            update_option('webmakerr_theme_license_status', 'inactive', true);

            $message = $data['message'] ?? __('Invalid license key.', 'webmakerr');

            webmakerr_onboarding_send_json_error(esc_html($message));
        }

        update_option('webmakerr_theme_license_status', 'active', true);
        update_option('webmakerr_theme_license_key', $licenseKey, true);

        wp_send_json_success([
            'message' => $data['message'] ?? __('License activated successfully.', 'webmakerr'),
        ]);
    }

    add_action('wp_ajax_webmakerr_onboarding_validate_license', 'webmakerr_onboarding_handle_license');
    add_action('wp_ajax_nopriv_webmakerr_onboarding_validate_license', 'webmakerr_onboarding_handle_license');
}

if (defined('WEBMAKERR_ONBOARDING_RENDER') && WEBMAKERR_ONBOARDING_RENDER) {
    $businessType = get_option('webmakerr_onboarding_business_type', '');
    $selectedTools = (array) get_option('webmakerr_onboarding_selected_tools', []);
    $licenseKey = get_option('webmakerr_theme_license_key', '');
    $nonce = wp_create_nonce('webmakerr_onboarding_nonce');
    $ajaxUrl = admin_url('admin-ajax.php');
    $homeUrl = home_url('/');

    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <meta charset="<?php bloginfo('charset'); ?>" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title><?php esc_html_e('Welcome to Webmakerr', 'webmakerr'); ?></title>
            <?php wp_head(); ?>
            <style>
                :root {
                    --wm-font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
                    --wm-bg: #ffffff;
                    --wm-text: #18181b;
                    --wm-muted: #52525b;
                    --wm-border: #e4e4e7;
                    --wm-primary: #2563eb;
                    --wm-primary-hover: #1d4ed8;
                    --wm-card-shadow: 0 24px 48px rgba(15, 23, 42, 0.08), 0 8px 16px rgba(15, 23, 42, 0.08);
                    --wm-radius: 18px;
                    --wm-transition: 280ms ease;
                }

                * {
                    box-sizing: border-box;
                }

                body {
                    margin: 0;
                    font-family: var(--wm-font-family);
                    background: var(--wm-bg);
                    color: var(--wm-text);
                }

                .wm-onboarding {
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 32px 16px;
                    background: linear-gradient(135deg, rgba(37, 99, 235, 0.04), rgba(59, 130, 246, 0.02));
                }

                .wm-card {
                    width: min(100%, 520px);
                    background: #fff;
                    border-radius: var(--wm-radius);
                    box-shadow: var(--wm-card-shadow);
                    padding: 48px;
                    display: flex;
                    flex-direction: column;
                    gap: 32px;
                    position: relative;
                    overflow: hidden;
                }

                .wm-brand {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }

                .wm-brand svg {
                    width: 36px;
                    height: 36px;
                }

                .wm-brand span {
                    font-size: 1.125rem;
                    font-weight: 600;
                    letter-spacing: -0.02em;
                }

                .wm-progress {
                    height: 4px;
                    background: rgba(37, 99, 235, 0.12);
                    border-radius: 999px;
                    overflow: hidden;
                    position: relative;
                }

                .wm-progress-bar {
                    height: 100%;
                    width: 33.33%;
                    background: var(--wm-primary);
                    transition: width var(--wm-transition);
                }

                .wm-step {
                    opacity: 0;
                    transform: translateY(16px);
                    transition: opacity var(--wm-transition), transform var(--wm-transition);
                    display: none;
                }

                .wm-step.is-active {
                    opacity: 1;
                    transform: translateY(0);
                    display: block;
                }

                .wm-step h1 {
                    margin: 0 0 12px;
                    font-size: 1.75rem;
                    font-weight: 600;
                }

                .wm-step p {
                    margin: 0;
                    color: var(--wm-muted);
                    font-size: 0.95rem;
                    line-height: 1.6;
                }

                .wm-options {
                    display: grid;
                    gap: 12px;
                    margin-top: 24px;
                }

                .wm-option {
                    border: 1px solid var(--wm-border);
                    border-radius: 14px;
                    padding: 16px 20px;
                    background: #fff;
                    cursor: pointer;
                    transition: border-color var(--wm-transition), box-shadow var(--wm-transition), transform var(--wm-transition);
                    position: relative;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .wm-option input {
                    position: absolute;
                    opacity: 0;
                    pointer-events: none;
                }

                .wm-option span {
                    font-size: 1rem;
                    font-weight: 500;
                }

                .wm-option.is-selected {
                    border-color: var(--wm-primary);
                    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.12);
                    transform: translateY(-2px);
                }

                .wm-tools {
                    display: grid;
                    gap: 12px;
                    margin-top: 24px;
                }

                .wm-tool {
                    border: 1px solid var(--wm-border);
                    border-radius: 12px;
                    padding: 14px 18px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    cursor: pointer;
                    transition: border-color var(--wm-transition), background var(--wm-transition), box-shadow var(--wm-transition);
                    position: relative;
                }

                .wm-tool input {
                    position: absolute;
                    opacity: 0;
                    pointer-events: none;
                }

                .wm-tool span {
                    font-size: 0.95rem;
                    font-weight: 500;
                }

                .wm-tool.is-selected {
                    border-color: var(--wm-primary);
                    background: rgba(37, 99, 235, 0.06);
                    box-shadow: 0 10px 24px rgba(37, 99, 235, 0.08);
                }

                .wm-actions {
                    display: flex;
                    justify-content: flex-end;
                    gap: 12px;
                    margin-top: 32px;
                }

                .wm-button {
                    appearance: none;
                    border: none;
                    border-radius: 999px;
                    padding: 12px 24px;
                    font-size: 0.95rem;
                    font-weight: 600;
                    cursor: pointer;
                    transition: background var(--wm-transition), box-shadow var(--wm-transition), transform var(--wm-transition);
                }

                .wm-button:disabled {
                    opacity: 0.5;
                    cursor: not-allowed;
                }

                .wm-button--primary {
                    background: var(--wm-primary);
                    color: #fff;
                    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.24);
                }

                .wm-button--primary:not(:disabled):hover {
                    background: var(--wm-primary-hover);
                    transform: translateY(-1px);
                }

                .wm-license-input {
                    width: 100%;
                    border: 1px solid var(--wm-border);
                    border-radius: 12px;
                    padding: 14px 16px;
                    font-size: 1rem;
                    transition: border-color var(--wm-transition), box-shadow var(--wm-transition);
                    outline: none;
                    font-family: var(--wm-font-family);
                }

                .wm-license-input:focus {
                    border-color: var(--wm-primary);
                    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
                }

                .wm-error {
                    color: #dc2626;
                    font-size: 0.9rem;
                    margin-top: -12px;
                }

                .wm-step-footer {
                    display: flex;
                    flex-direction: column;
                    gap: 16px;
                    margin-top: 32px;
                }

                .wm-hint {
                    color: var(--wm-muted);
                    font-size: 0.85rem;
                    text-align: center;
                }

                @media (max-width: 600px) {
                    .wm-card {
                        padding: 32px 24px;
                    }

                    .wm-step h1 {
                        font-size: 1.5rem;
                    }
                }
            </style>
        </head>
        <body <?php body_class('wm-onboarding-body'); ?>>
            <main class="wm-onboarding" aria-live="polite">
                <section class="wm-card" role="dialog" aria-modal="true">
                    <div class="wm-brand" aria-label="Webmakerr">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <rect x="2" y="2" width="44" height="44" rx="12" fill="#2563EB" opacity="0.08" />
                            <path d="M16 16L24 32L32 16" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 24H34" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span><?php esc_html_e('Webmakerr Theme', 'webmakerr'); ?></span>
                    </div>

                    <div class="wm-progress" aria-hidden="true">
                        <div class="wm-progress-bar" data-progress></div>
                    </div>

                    <div class="wm-step is-active" data-step="1">
                        <header>
                            <h1><?php esc_html_e('What type of business do you run?', 'webmakerr'); ?></h1>
                            <p><?php esc_html_e('We’ll tailor your setup so the theme feels like home from day one.', 'webmakerr'); ?></p>
                        </header>
                        <div class="wm-options" role="radiogroup" aria-label="<?php esc_attr_e('Select your business type', 'webmakerr'); ?>">
                            <?php
                            $businessOptions = [
                                'sell-online'    => __('Sell Online', 'webmakerr'),
                                'freelancer'     => __('Freelancer', 'webmakerr'),
                                'business-owner' => __('Business Owner', 'webmakerr'),
                            ];

                            foreach ($businessOptions as $value => $label) :
                                $isSelected = $businessType === $value;
                                ?>
                                <label class="wm-option<?php echo $isSelected ? ' is-selected' : ''; ?>">
                                    <input type="radio" name="businessType" value="<?php echo esc_attr($value); ?>" <?php checked($isSelected); ?> />
                                    <span><?php echo esc_html($label); ?></span>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                        <path d="M16.25 5.75L8.25 13.75L4 9.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </label>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="wm-step-footer">
                            <p class="wm-hint"><?php esc_html_e('You can update this later in Theme Settings.', 'webmakerr'); ?></p>
                            <div class="wm-actions">
                                <button type="button" class="wm-button wm-button--primary" data-action="next" data-next-step="2" disabled>
                                    <?php esc_html_e('Continue', 'webmakerr'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="wm-step" data-step="2">
                        <header>
                            <h1><?php esc_html_e('What tools do you need?', 'webmakerr'); ?></h1>
                            <p><?php esc_html_e('Pick your essentials. We’ll surface the right integrations and starter content.', 'webmakerr'); ?></p>
                        </header>
                        <div class="wm-tools" role="group" aria-label="<?php esc_attr_e('Select the tools you need', 'webmakerr'); ?>">
                            <?php
                            $toolOptions = [
                                'email-marketing' => __('Email Marketing', 'webmakerr'),
                                'crm'             => __('CRM', 'webmakerr'),
                                'checkout-system' => __('Checkout System', 'webmakerr'),
                                'booking-system'  => __('Booking System', 'webmakerr'),
                            ];

                            foreach ($toolOptions as $value => $label) :
                                $isChecked = in_array($value, $selectedTools, true);
                                ?>
                                <label class="wm-tool<?php echo $isChecked ? ' is-selected' : ''; ?>">
                                    <input type="checkbox" name="tools[]" value="<?php echo esc_attr($value); ?>" <?php checked($isChecked); ?> />
                                    <span><?php echo esc_html($label); ?></span>
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                        <path d="M16.25 5.75L8.25 13.75L4 9.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </label>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="wm-step-footer">
                            <p class="wm-hint"><?php esc_html_e('Select everything that applies—we’ll use this to personalize recommendations.', 'webmakerr'); ?></p>
                            <div class="wm-actions">
                                <button type="button" class="wm-button" data-action="back" data-prev-step="1">
                                    <?php esc_html_e('Back', 'webmakerr'); ?>
                                </button>
                                <button type="button" class="wm-button wm-button--primary" data-action="next" data-next-step="3">
                                    <?php esc_html_e('Continue', 'webmakerr'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="wm-step" data-step="3">
                        <header>
                            <h1><?php esc_html_e('Activate your license', 'webmakerr'); ?></h1>
                            <p><?php esc_html_e('Enter your Webmakerr license key to unlock the full theme experience.', 'webmakerr'); ?></p>
                        </header>
                        <form class="wm-license" data-license-form>
                            <label for="wm-license-key" class="screen-reader-text"><?php esc_html_e('License key', 'webmakerr'); ?></label>
                            <input
                                id="wm-license-key"
                                class="wm-license-input"
                                type="text"
                                name="licenseKey"
                                value="<?php echo esc_attr($licenseKey); ?>"
                                placeholder="<?php esc_attr_e('WEBMAKERR-XXXX', 'webmakerr'); ?>"
                                autocomplete="off"
                                required
                            />
                            <p class="wm-error" data-error-message hidden></p>
                            <div class="wm-step-footer">
                                <p class="wm-hint"><?php esc_html_e('Need help? Reach out to support and we’ll get you activated in minutes.', 'webmakerr'); ?></p>
                                <div class="wm-actions">
                                    <button type="button" class="wm-button" data-action="back" data-prev-step="2">
                                        <?php esc_html_e('Back', 'webmakerr'); ?>
                                    </button>
                                    <button type="submit" class="wm-button wm-button--primary" data-activate-button>
                                        <?php esc_html_e('Activate License', 'webmakerr'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </main>
            <script>
                (function () {
                    const onboarding = {
                        steps: Array.from(document.querySelectorAll('[data-step]')),
                        progress: document.querySelector('[data-progress]'),
                        ajaxUrl: '<?php echo esc_url($ajaxUrl); ?>',
                        nonce: '<?php echo esc_attr($nonce); ?>',
                        homeUrl: '<?php echo esc_url($homeUrl); ?>'
                    };

                    let activeStepIndex = onboarding.steps.findIndex(step => step.classList.contains('is-active'));
                    if (activeStepIndex === -1) {
                        activeStepIndex = 0;
                    }

                    const errorMessage = document.querySelector('[data-error-message]');
                    const activateButton = document.querySelector('[data-activate-button]');
                    const licenseForm = document.querySelector('[data-license-form]');

                    function updateProgress() {
                        const percent = ((activeStepIndex + 1) / onboarding.steps.length) * 100;
                        onboarding.progress.style.width = percent + '%';
                    }

                    function showStep(index) {
                        onboarding.steps.forEach((step, idx) => {
                            step.classList.toggle('is-active', idx === index);
                        });
                        activeStepIndex = index;
                        updateProgress();
                    }

                    function sendRequest(action, payload = {}) {
                        const formData = new FormData();
                        formData.append('action', action);
                        formData.append('nonce', onboarding.nonce);

                        Object.entries(payload).forEach(([key, value]) => {
                            if (Array.isArray(value)) {
                                value.forEach(item => formData.append(key + '[]', item));
                            } else {
                                formData.append(key, value);
                            }
                        });

                        return fetch(onboarding.ajaxUrl, {
                            method: 'POST',
                            credentials: 'same-origin',
                            body: formData
                        }).then(response => response.json());
                    }

                    function handleBusinessSelection(step) {
                        const options = Array.from(step.querySelectorAll('input[name="businessType"]'));
                        const nextButton = step.querySelector('[data-action="next"]');

                        function syncState() {
                            const selected = options.find(option => option.checked);
                            step.querySelectorAll('.wm-option').forEach(label => {
                                const input = label.querySelector('input');
                                label.classList.toggle('is-selected', input.checked);
                            });
                            nextButton.disabled = !selected;
                        }

                        options.forEach(option => {
                            option.addEventListener('change', syncState);
                        });

                        nextButton.addEventListener('click', () => {
                            const selected = options.find(option => option.checked);
                            if (!selected) {
                                return;
                            }

                            nextButton.disabled = true;

                            sendRequest('webmakerr_onboarding_save_business_type', {
                                businessType: selected.value
                            }).then(result => {
                                nextButton.disabled = false;
                                if (!result.success) {
                                    return;
                                }

                                showStep(1);
                            }).catch(() => {
                                nextButton.disabled = false;
                            });
                        });

                        syncState();
                    }

                    function handleToolsSelection(step) {
                        const checkboxes = Array.from(step.querySelectorAll('input[name="tools[]"]'));
                        const backButton = step.querySelector('[data-action="back"]');
                        const nextButton = step.querySelector('[data-action="next"]');

                        function syncState() {
                            step.querySelectorAll('.wm-tool').forEach(label => {
                                const input = label.querySelector('input');
                                label.classList.toggle('is-selected', input.checked);
                            });
                        }

                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', () => {
                                syncState();
                            });
                        });

                        backButton.addEventListener('click', () => {
                            showStep(0);
                        });

                        nextButton.addEventListener('click', () => {
                            nextButton.disabled = true;

                            const values = checkboxes.filter(input => input.checked).map(input => input.value);

                            sendRequest('webmakerr_onboarding_save_tools', {
                                tools: values
                            }).then(result => {
                                nextButton.disabled = false;
                                if (!result.success) {
                                    return;
                                }

                                showStep(2);
                            }).catch(() => {
                                nextButton.disabled = false;
                            });
                        });

                        syncState();
                    }

                    function handleLicenseStep(step) {
                        const backButton = step.querySelector('[data-action="back"]');
                        const input = step.querySelector('input[name="licenseKey"]');

                        backButton.addEventListener('click', () => {
                            showStep(1);
                        });

                        licenseForm.addEventListener('submit', event => {
                            event.preventDefault();

                            if (activateButton) {
                                activateButton.disabled = true;
                            }

                            if (errorMessage) {
                                errorMessage.hidden = true;
                                errorMessage.textContent = '';
                            }

                            sendRequest('webmakerr_onboarding_validate_license', {
                                licenseKey: input.value.trim()
                            }).then(result => {
                                if (!result.success) {
                                    if (errorMessage) {
                                        errorMessage.hidden = false;
                                        errorMessage.textContent = result.message || '<?php echo esc_js(__('Something went wrong. Please try again.', 'webmakerr')); ?>';
                                    }

                                    if (activateButton) {
                                        activateButton.disabled = false;
                                    }

                                    return;
                                }

                                window.location.href = onboarding.homeUrl;
                            }).catch(() => {
                                if (errorMessage) {
                                    errorMessage.hidden = false;
                                    errorMessage.textContent = '<?php echo esc_js(__('Unable to reach the server. Please try again.', 'webmakerr')); ?>';
                                }

                                if (activateButton) {
                                    activateButton.disabled = false;
                                }
                            });
                        });
                    }

                    onboarding.steps.forEach((step, index) => {
                        switch (index) {
                            case 0:
                                handleBusinessSelection(step);
                                break;
                            case 1:
                                handleToolsSelection(step);
                                break;
                            case 2:
                                handleLicenseStep(step);
                                break;
                            default:
                                break;
                        }
                    });

                    showStep(activeStepIndex);
                })();
            </script>
            <?php wp_footer(); ?>
        </body>
    </html>
    <?php
    exit;
}
