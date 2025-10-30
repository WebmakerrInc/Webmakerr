<?php

use Webmakerr\Framework\Assets\ViteCompiler;
use Webmakerr\Framework\Features\MenuOptions;
use Webmakerr\Framework\Theme;

if (! defined('WEBMAKERR_LICENSE_SERVER_URL')) {
    define('WEBMAKERR_LICENSE_SERVER_URL', 'https://xyz.com/api/validate-license.php');
}

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
} else {
    spl_autoload_register(function (string $class): void {
        if (str_starts_with($class, 'Webmakerr\\')) {
            $baseDir = __DIR__.'/src/';
            $relativeClass = substr($class, strlen('Webmakerr\\'));
            $file = $baseDir.str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass).'.php';

            if (is_file($file)) {
                require_once $file;
            }
        }
    });
}

if (! function_exists('webmakerr_setup')) {
    function webmakerr_setup(): void
    {
        load_theme_textdomain('webmakerr', get_template_directory().'/languages');

        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        register_nav_menus(
            [
                'primary' => esc_html__('Primary Menu', 'webmakerr'),
                'footer'  => esc_html__('Footer Menu', 'webmakerr'),
            ]
        );

        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            ]
        );

        add_theme_support(
            'custom-background',
            apply_filters(
                'webmakerr_custom_background_args',
                [
                    'default-color' => 'ffffff',
                    'default-image' => '',
                ]
            )
        );

        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support(
            'custom-logo',
            [
                'height'      => 37,
                'width'       => 142,
                'flex-width'  => false,
                'flex-height' => false,
            ]
        );
    }
}

add_action('after_setup_theme', 'webmakerr_setup');

function webmakerr(): Theme
{
    return Theme::instance()
        ->assets(static fn ($manager) => $manager
            ->withCompiler(new ViteCompiler(), static fn ($compiler) => $compiler
                ->registerAsset('build/assets/app.css')
                ->registerAsset('build/assets/app.js')
                ->editorStyleFile('build/assets/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(static fn ($manager) => $manager->add(MenuOptions::class))
        ->menus(static fn ($manager) => $manager
            ->add('primary', __('Primary Menu', 'webmakerr'))
            ->add('footer', __('Footer Menu', 'webmakerr'))
        )
        ->themeSupport(static fn ($manager) => $manager->add([
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
        ]));
}

add_filter(
    'nav_menu_css_class',
    static function (array $classes, $item, $args, int $depth): array {
        if (($args->theme_location ?? null) !== 'footer') {
            return $classes;
        }

        $normalized = ['menu-item', 'list-none'];

        if ($depth === 0) {
            $normalized[] = 'footer-menu-item';
        } else {
            $normalized[] = 'footer-submenu-item';
        }

        return array_values(array_unique($normalized));
    },
    10,
    4
);

add_filter(
    'nav_menu_submenu_css_class',
    static function (array $classes, $args, int $depth): array {
        if (($args->theme_location ?? null) !== 'footer') {
            return $classes;
        }

        $classes[] = 'list-none';

        return array_values(array_unique(array_filter($classes)));
    },
    10,
    3
);

add_filter(
    'nav_menu_link_attributes',
    static function (array $atts, $item, $args, int $depth): array {
        if (($args->theme_location ?? null) !== 'footer') {
            return $atts;
        }

        $baseClasses = 'transition-colors duration-200 ease-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-900';

        if ($depth === 0) {
            $linkClasses = 'no-underline text-sm font-semibold text-neutral-900 hover:opacity-70 md:text-base';
        } else {
            $linkClasses = 'block no-underline text-sm text-neutral-500 hover:text-neutral-900';
        }

        $atts['class'] = trim($linkClasses.' '.$baseClasses);

        return $atts;
    },
    10,
    4
);

add_action(
    'after_setup_theme',
    static function (): void {
        webmakerr();
    },
    11
);

add_action(
    'admin_menu',
    static function (): void {
        add_theme_page(
            __('Theme License', 'webmakerr'),
            __('Theme License', 'webmakerr'),
            'manage_options',
            'webmakerr-theme-license',
            'webmakerr_render_license_settings_page'
        );
    }
);

if (! function_exists('webmakerr_render_license_settings_page')) {
    function webmakerr_render_license_settings_page(): void
    {
        if (! current_user_can('manage_options')) {
            return;
        }

        $savedKey = get_option('webmakerr_theme_license_key', '');
        $savedStatus = get_option('webmakerr_theme_license_status', 'inactive');
        $statuses = [
            'active'   => __('Active', 'webmakerr'),
            'revoked'  => __('Revoked', 'webmakerr'),
            'invalid'  => __('Invalid', 'webmakerr'),
            'inactive' => __('Inactive', 'webmakerr'),
        ];
        $statusLabel = $statuses[$savedStatus] ?? $statuses['inactive'];
        ?>
        <div class="wrap webmakerr-license-page">
            <h1 class="webmakerr-license-title"><?php esc_html_e('Theme License', 'webmakerr'); ?></h1>
            <p class="webmakerr-license-description"><?php esc_html_e('Activate your Webmakerr theme license to unlock updates and premium support.', 'webmakerr'); ?></p>

            <div class="webmakerr-license-card">
                <label for="webmakerr-license-key" class="webmakerr-license-label"><?php esc_html_e('License Key', 'webmakerr'); ?></label>
                <input type="text" id="webmakerr-license-key" class="webmakerr-license-input" value="<?php echo esc_attr($savedKey); ?>" placeholder="<?php esc_attr_e('Enter your license key', 'webmakerr'); ?>" />

                <div class="webmakerr-license-actions">
                    <button type="button" class="button button-primary webmakerr-license-button" id="webmakerr-activate-license">
                        <?php esc_html_e('Activate License', 'webmakerr'); ?>
                    </button>
                    <span class="webmakerr-license-spinner" hidden></span>
                </div>

                <div class="webmakerr-license-status" data-stored-status="<?php echo esc_attr($savedStatus); ?>">
                    <strong><?php esc_html_e('Current Status:', 'webmakerr'); ?></strong>
                    <span id="webmakerr-license-status-text" class="status-<?php echo esc_attr($savedStatus); ?>"><?php echo esc_html($statusLabel); ?></span>
                </div>

                <div id="webmakerr-license-feedback" class="webmakerr-license-feedback" aria-live="polite"></div>
            </div>
        </div>
        <?php
    }
}

add_action(
    'admin_enqueue_scripts',
    static function (string $hook): void {
        if ($hook !== 'appearance_page_webmakerr-theme-license') {
            return;
        }

        wp_enqueue_style(
            'webmakerr-license-admin',
            get_template_directory_uri().'/resources/css/license-admin.css',
            [],
            wp_get_theme()->get('Version')
        );

        wp_enqueue_script(
            'webmakerr-license-admin',
            get_template_directory_uri().'/resources/js/license-admin.js',
            [],
            wp_get_theme()->get('Version'),
            true
        );

        wp_localize_script(
            'webmakerr-license-admin',
            'webmakerrLicenseData',
            [
                'endpoint'   => esc_url_raw(rest_url('webmakerr/v1/check-license')),
                'nonce'      => wp_create_nonce('wp_rest'),
                'messages'   => [
                    'empty'   => __('Please enter a license key before activating.', 'webmakerr'),
                    'success' => __('✅ License Activated Successfully', 'webmakerr'),
                    'error'   => __('❌ Invalid or Revoked License Key.', 'webmakerr'),
                ],
                'labels'     => [
                    'active'   => __('Active', 'webmakerr'),
                    'revoked'  => __('Revoked', 'webmakerr'),
                    'invalid'  => __('Invalid', 'webmakerr'),
                    'inactive' => __('Inactive', 'webmakerr'),
                ],
                'storedStatus' => get_option('webmakerr_theme_license_status', 'inactive'),
            ]
        );
    }
);

add_action(
    'rest_api_init',
    static function (): void {
        register_rest_route(
            'webmakerr/v1',
            '/check-license',
            [
                'methods'             => 'POST',
                'callback'            => 'webmakerr_rest_check_license',
                'permission_callback' => static function (): bool {
                    return current_user_can('manage_options');
                },
                'args'                => [
                    'license_key' => [
                        'required'          => true,
                        'sanitize_callback' => static function ($value) {
                            return sanitize_text_field(wp_unslash($value));
                        },
                    ],
                ],
            ]
        );
    }
);

if (! function_exists('webmakerr_validate_license_remotely')) {
    /**
     * Validate a license key against the remote server.
     */
    function webmakerr_validate_license_remotely(string $licenseKey): array
    {
        $response = wp_remote_post(
            WEBMAKERR_LICENSE_SERVER_URL,
            [
                'timeout' => 15,
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body'    => wp_json_encode([
                    'license_key' => $licenseKey,
                ]),
            ]
        );

        if (is_wp_error($response)) {
            return [
                'is_valid'      => false,
                'message'       => __('Unable to reach the license server. Please try again shortly.', 'webmakerr'),
                'status_code'   => 0,
                'request_error' => true,
            ];
        }

        $statusCode = (int) wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $decoded = json_decode($body, true);

        if (! is_array($decoded)) {
            return [
                'is_valid'      => false,
                'message'       => __('Unexpected response from the license server.', 'webmakerr'),
                'status_code'   => $statusCode >= 400 ? $statusCode : 500,
                'request_error' => true,
            ];
        }

        $serverStatus = strtolower((string) ($decoded['status'] ?? 'error'));
        $message = is_string($decoded['message'] ?? null) ? $decoded['message'] : '';
        $isValid = $serverStatus === 'success';

        if ($message === '') {
            $message = $isValid
                ? __('License activated successfully.', 'webmakerr')
                : __('Invalid license key.', 'webmakerr');
        }

        return [
            'is_valid'      => $isValid,
            'message'       => $message,
            'status_code'   => $statusCode,
            'request_error' => false,
        ];
    }
}

if (! function_exists('webmakerr_revalidate_saved_license')) {
    /**
     * Revalidate the stored license key and handle activation notices.
     */
    function webmakerr_revalidate_saved_license(): void
    {
        delete_transient('webmakerr_license_invalid_notice');

        $licenseKey = (string) get_option('webmakerr_theme_license_key', '');

        if ($licenseKey === '') {
            update_option('webmakerr_theme_license_status', 'inactive');

            return;
        }

        $validation = webmakerr_validate_license_remotely($licenseKey);

        if (! $validation['is_valid'] && ! $validation['request_error']) {
            update_option('webmakerr_theme_license_status', 'inactive');
            set_transient(
                'webmakerr_license_invalid_notice',
                __('Your license is no longer valid. Please reactivate your theme license.', 'webmakerr'),
                MINUTE_IN_SECONDS * 10
            );

            return;
        }

        if ($validation['is_valid']) {
            update_option('webmakerr_theme_license_status', 'active');
        }
    }
}

add_action(
    'after_switch_theme',
    static function (): void {
        webmakerr_revalidate_saved_license();
    }
);

add_action(
    'admin_notices',
    static function (): void {
        $notice = get_transient('webmakerr_license_invalid_notice');

        if ($notice === false) {
            return;
        }

        delete_transient('webmakerr_license_invalid_notice');

        printf(
            '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            esc_html($notice)
        );
    }
);

if (! function_exists('webmakerr_rest_check_license')) {
    function webmakerr_rest_check_license(\WP_REST_Request $request): \WP_REST_Response
    {
        $licenseKey = (string) $request->get_param('license_key');

        if ($licenseKey === '') {
            update_option('webmakerr_theme_license_status', 'inactive');

            return new WP_REST_Response(
                [
                    'valid'   => false,
                    'status'  => 'inactive',
                    'message' => __('Please provide a license key.', 'webmakerr'),
                ],
                400
            );
        }

        $validation = webmakerr_validate_license_remotely($licenseKey);

        if ($validation['request_error']) {
            update_option('webmakerr_theme_license_status', 'invalid');

            return new WP_REST_Response(
                [
                    'valid'   => false,
                    'status'  => 'invalid',
                    'message' => $validation['message'],
                ],
                $validation['status_code'] >= 400 ? $validation['status_code'] : 500
            );
        }

        if ($validation['is_valid']) {
            update_option('webmakerr_theme_license_key', $licenseKey);
            update_option('webmakerr_theme_license_status', 'active');
            delete_transient('webmakerr_license_invalid_notice');
        } else {
            update_option('webmakerr_theme_license_status', 'inactive');
        }

        $responseCode = $validation['is_valid'] ? 200 : ($validation['status_code'] >= 400 ? $validation['status_code'] : 400);

return new WP_REST_Response(
            [
                'valid'   => $validation['is_valid'],
                'status'  => $validation['is_valid'] ? 'active' : 'inactive',
                'message' => $validation['message'],
            ],
            $responseCode
        );
    }
}

add_action(
    'wp_enqueue_scripts',
    static function (): void {
        $handle = 'webmakerr-build-assets-app-js';

        if (! wp_script_is($handle, 'enqueued') && ! wp_script_is($handle, 'registered')) {
            return;
        }

        $pageTemplate = '';

        if (function_exists('get_queried_object_id')) {
            $queriedId = get_queried_object_id();

            if ($queriedId) {
                $templateSlug = get_page_template_slug($queriedId);

                if (is_string($templateSlug)) {
                    $pageTemplate = $templateSlug;
                }
            }
        }

        wp_localize_script(
            $handle,
            'webseoLead',
            [
                'ajaxUrl'      => esc_url_raw(admin_url('admin-ajax.php')),
                'nonce'        => wp_create_nonce('webseo_lead_nonce'),
                'pageTemplate' => $pageTemplate,
                'messages'     => [
                    'success' => __('✅ You’re in! Check your inbox.', 'webmakerr'),
                    'error'   => __('Something went wrong. Please try again.', 'webmakerr'),
                ],
            ]
        );
    },
    20
);

add_action(
    'wp_footer',
    static function (): void {
        if (is_admin()) {
            return;
        }

        get_template_part('templates/partials/global-lead-form');
    },
    20
);

if (! function_exists('webseo_get_template_basename')) {
    function webseo_get_template_basename(string $pageTemplate, string $pageUrl = ''): string
    {
        $template = $pageTemplate !== '' ? basename($pageTemplate) : '';

        if ($template === '' && function_exists('get_queried_object_id')) {
            $queriedId = get_queried_object_id();

            if ($queriedId) {
                $maybeTemplate = get_page_template_slug($queriedId);

                if (is_string($maybeTemplate) && $maybeTemplate !== '') {
                    $template = basename($maybeTemplate);
                }
            }
        }

        if ($template === '' && $pageUrl !== '') {
            $postId = url_to_postid($pageUrl);

            if ($postId) {
                $maybeTemplate = get_page_template_slug($postId);

                if (is_string($maybeTemplate) && $maybeTemplate !== '') {
                    $template = basename($maybeTemplate);
                }
            }
        }

        return $template;
    }
}

if (! function_exists('handle_webseo_lead')) {
    function handle_webseo_lead(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            wp_send_json_error(
                [
                    'message' => __('Invalid request method.', 'webmakerr'),
                ],
                405
            );
        }

        check_ajax_referer('webseo_lead_nonce', 'webseo_lead_nonce');

        $rawEmail = isset($_POST['email']) ? wp_unslash($_POST['email']) : '';
        $email = sanitize_email($rawEmail);

        if (empty($email) || ! is_email($email)) {
            wp_send_json_error(
                [
                    'message' => __('Please provide a valid email address.', 'webmakerr'),
                ],
                422
            );
        }

        $rawName = isset($_POST['name']) ? wp_unslash($_POST['name']) : '';
        $name = sanitize_text_field($rawName);

        if ($name !== '') {
            $name = trim(preg_replace('/\s+/', ' ', $name));
        }

        $rawSource = isset($_POST['source']) ? wp_unslash($_POST['source']) : '';
        $sanitizedSource = sanitize_key($rawSource);
        $rawTemplate = isset($_POST['page_template']) ? wp_unslash($_POST['page_template']) : '';
        $pageTemplate = sanitize_text_field($rawTemplate);
        $pageUrl = isset($_POST['page_url']) ? esc_url_raw(wp_unslash($_POST['page_url'])) : '';

        $templateBasename = webseo_get_template_basename($pageTemplate, $pageUrl);

        $source = webseo_resolve_lead_source($sanitizedSource, $pageTemplate, $pageUrl);
        $tags = webseo_resolve_lead_tags($source, $templateBasename);

        $contactNonceValid = false;

        if (isset($_POST['webmakerr_contact_nonce'])) {
            $contactNonce = sanitize_text_field(wp_unslash($_POST['webmakerr_contact_nonce']));
            $contactNonceValid = (bool) wp_verify_nonce($contactNonce, 'webmakerr_contact_form');
        }

        $contactErrors = [];
        $contactData = [];

        if ($contactNonceValid) {
            $contactData['full_name'] = isset($_POST['full_name']) ? sanitize_text_field(wp_unslash($_POST['full_name'])) : '';
            $contactData['company_name'] = isset($_POST['company_name']) ? sanitize_text_field(wp_unslash($_POST['company_name'])) : '';
            $contactData['use_case'] = isset($_POST['use_case']) ? sanitize_text_field(wp_unslash($_POST['use_case'])) : '';
            $contactData['description'] = isset($_POST['description']) ? sanitize_textarea_field(wp_unslash($_POST['description'])) : '';
            $contactData['newsletter'] = isset($_POST['newsletter']) ? __('Yes', 'webmakerr') : __('No', 'webmakerr');

            if ($contactData['full_name'] === '') {
                $contactErrors[] = __('Please provide your full name.', 'webmakerr');
            }

            if ($contactData['description'] === '') {
                $contactErrors[] = __('Please provide a brief description of your project.', 'webmakerr');
            }
        }

        if (! empty($contactErrors)) {
            wp_send_json_error(
                [
                    'message' => $contactErrors[0],
                    'errors'  => $contactErrors,
                ],
                422
            );
        }

        if ($name === '' && ! empty($contactData['full_name'])) {
            $name = trim(preg_replace('/\s+/', ' ', $contactData['full_name']));
        }

        $subscriberData = [
            'email'  => $email,
            'status' => 'subscribed',
        ];

        if ($name !== '') {
            $nameParts = preg_split('/\s+/', $name);

            if (is_array($nameParts) && ! empty($nameParts)) {
                $subscriberData['first_name'] = array_shift($nameParts);

                if (! empty($nameParts)) {
                    $subscriberData['last_name'] = implode(' ', $nameParts);
                }
            }
        }

        $subscriberClass = webseo_get_fluentcrm_model_class('Subscriber');

        if (! $subscriberClass) {
            wp_send_json_error(
                [
                    'message' => __('FluentCRM is not active.', 'webmakerr'),
                ],
                500
            );
        }

        try {
            $listId = webseo_ensure_fluentcrm_list('database', 'Database');
            $tagIds = webseo_ensure_fluentcrm_tags($tags);

            $listsToApply = $listId ? [$listId] : [];
            $tagsToApply = ! empty($tagIds) ? $tagIds : [];

            $supportsRelationshipArgs = webseo_fluentcrm_subscriber_supports_relationship_args($subscriberClass);

            $subscriber = null;
            $contactApi = webseo_get_fluentcrm_contact_api();

            if (is_object($contactApi) && method_exists($contactApi, 'createOrUpdate')) {
                $contactPayload = $subscriberData;

                if (! empty($listsToApply)) {
                    $contactPayload['lists'] = $listsToApply;
                }

                if (! empty($tagsToApply)) {
                    $contactPayload['tags'] = $tagsToApply;
                }

                $apiResult = webseo_fluentcrm_object_call($contactApi, 'createOrUpdate', [$contactPayload]);

                if ($apiResult !== null) {
                    if (is_wp_error($apiResult)) {
                        throw new \RuntimeException($apiResult->get_error_message());
                    }

                    $subscriber = $apiResult;
                }
            }

            if ($subscriber === null) {
                if ($supportsRelationshipArgs) {
                    $subscriber = $subscriberClass::createOrUpdate($subscriberData, $listsToApply, $tagsToApply);
                } else {
                    $subscriber = $subscriberClass::createOrUpdate($subscriberData);
                }
            }

            if (is_wp_error($subscriber)) {
                throw new \RuntimeException($subscriber->get_error_message());
            }

            $subscriber = webseo_normalize_fluentcrm_subscriber_result($subscriberClass, $subscriber, $email);

            if (! is_object($subscriber)) {
                throw new \RuntimeException(__('Unable to save your details at the moment. Please try again later.', 'webmakerr'));
            }

            webseo_sync_fluentcrm_contact_relations($subscriber, $subscriberClass, $email, $listsToApply, $tagsToApply, ! $supportsRelationshipArgs);

            if ($contactNonceValid) {
                webseo_maybe_send_contact_notification($email, $contactData);
            }
        } catch (\Throwable $exception) {
            wp_send_json_error(
                [
                    'message' => __('Unable to save your details at the moment. Please try again later.', 'webmakerr'),
                ],
                500
            );
        }

        wp_send_json_success(
            [
                'message' => __('✅ You’re in! Check your inbox.', 'webmakerr'),
                'source'  => $source,
                'tags'    => $tags,
            ]
        );
    }
}

add_action('wp_ajax_add_webseo_lead', 'handle_webseo_lead');
add_action('wp_ajax_nopriv_add_webseo_lead', 'handle_webseo_lead');

if (! function_exists('webseo_resolve_lead_source')) {
    function webseo_resolve_lead_source(string $source, string $pageTemplate, string $pageUrl): string
    {
        if ($source !== '') {
            return $source;
        }

        $template = webseo_get_template_basename($pageTemplate, $pageUrl);

        switch ($template) {
            case 'page-theme.php':
                return 'theme-page';
            case 'page-webseo.php':
                return 'seo-page';
            case 'page-booking.php':
                return 'app-page';
            case 'page-webuilder.php':
                return 'builder-page';
            case 'page-pricing.php':
                return 'pricing';
            case 'page-contact.php':
                return 'contact';
            default:
                return 'footer-cta';
        }
    }
}

if (! function_exists('webseo_resolve_lead_tags')) {
    /**
     * @return array<int, string>
     */
    function webseo_resolve_lead_tags(string $source, string $templateBasename = ''): array
    {
        $template = $templateBasename !== '' ? basename($templateBasename) : '';

        $templateMap = [
            'page-theme.php'     => ['theme'],
            'page-webseo.php'    => ['webseo'],
            'page-booking.php'   => ['booking'],
            'page-webuilder.php' => ['webuilder'],
        ];

        if ($template !== '' && isset($templateMap[$template])) {
            return $templateMap[$template];
        }

        $sourceMap = [
            'theme-page'   => ['theme'],
            'seo-page'     => ['webseo'],
            'app-page'     => ['booking'],
            'builder-page' => ['webuilder'],
            'pricing'      => ['lead'],
            'contact'      => ['lead'],
            'footer-cta'   => ['lead'],
        ];

        $normalizedSource = $source !== '' ? $source : 'footer-cta';

        if (isset($sourceMap[$normalizedSource])) {
            return $sourceMap[$normalizedSource];
        }

        return ['lead'];
    }
}

if (! function_exists('webseo_ensure_fluentcrm_list')) {
    function webseo_ensure_fluentcrm_list(string $slug, string $title): ?int
    {
        $listClass = webseo_get_fluentcrm_model_class('Lists');

        if (! $listClass) {
            return null;
        }

        $normalizedSlug = sanitize_key($slug);

        if ($normalizedSlug === '') {
            $normalizedSlug = sanitize_title($title);
        }

        $normalizedTitle = sanitize_text_field($title);
        $list = null;

        if ($normalizedSlug !== '') {
            $list = webseo_find_fluentcrm_model($listClass, 'slug', $normalizedSlug);
        }

        if (! $list && $normalizedTitle !== '') {
            $list = webseo_find_fluentcrm_model($listClass, 'title', $normalizedTitle);
        }

        if (! $list && $normalizedSlug !== '') {
            $list = webseo_find_fluentcrm_record_via_db('fc_lists', 'slug', $normalizedSlug);
        }

        if (! $list && $normalizedTitle !== '') {
            $list = webseo_find_fluentcrm_record_via_db('fc_lists', 'title', $normalizedTitle);
        }

        if (! $list && $normalizedSlug !== '') {
            $list = webseo_fluentcrm_static_call(
                $listClass,
                'firstOrCreate',
                [
                    ['slug' => $normalizedSlug],
                    ['title' => $normalizedTitle !== '' ? $normalizedTitle : $title],
                ]
            );
        }

        if (! $list) {
            $createPayload = ['title' => $normalizedTitle !== '' ? $normalizedTitle : $title];

            if ($normalizedSlug !== '') {
                $createPayload['slug'] = $normalizedSlug;
            }

            $list = webseo_fluentcrm_static_call(
                $listClass,
                'create',
                [$createPayload]
            );
        }

        if ($list && isset($list->id)) {
            return (int) $list->id;
        }

        return null;
    }
}

if (! function_exists('webseo_ensure_fluentcrm_tags')) {
    /**
     * @param array<int, string> $tags
     * @return array<int, int>
     */
    function webseo_ensure_fluentcrm_tags(array $tags): array
    {
        $tagClass = webseo_get_fluentcrm_model_class('Tag');

        if (! $tagClass) {
            return [];
        }

        $tagIds = [];

        foreach ($tags as $tag) {
            $slug = sanitize_key($tag);

            if ($slug === '') {
                $slug = sanitize_title($tag);
            }

            if ($slug === '') {
                continue;
            }

            $title = sanitize_text_field(ucwords(str_replace(['-', '_'], ' ', $slug)));
            $tagModel = webseo_find_fluentcrm_model($tagClass, 'slug', $slug);

            if (! $tagModel && $title !== '') {
                $tagModel = webseo_find_fluentcrm_model($tagClass, 'title', $title);
            }

            if (! $tagModel) {
                $tagModel = webseo_find_fluentcrm_record_via_db('fc_tags', 'slug', $slug);
            }

            if (! $tagModel && $title !== '') {
                $tagModel = webseo_find_fluentcrm_record_via_db('fc_tags', 'title', $title);
            }

            if (! $tagModel) {
                $tagModel = webseo_fluentcrm_static_call(
                    $tagClass,
                    'firstOrCreate',
                    [
                        ['slug' => $slug],
                        ['title' => $title !== '' ? $title : ucwords(str_replace('-', ' ', $tag))],
                    ]
                );
            }

            if (! $tagModel) {
                $tagModel = webseo_fluentcrm_static_call(
                    $tagClass,
                    'create',
                    [
                        ['slug' => $slug, 'title' => $title !== '' ? $title : ucwords(str_replace('-', ' ', $tag))],
                    ]
                );
            }

            if ($tagModel && isset($tagModel->id)) {
                $tagIds[] = (int) $tagModel->id;
            }
        }

        return array_values(array_unique($tagIds));
    }
}

if (! function_exists('webseo_get_fluentcrm_model_class')) {
    function webseo_get_fluentcrm_model_class(string $model): ?string
    {
        static $resolved = [];

        $normalizedModel = ltrim($model, '\\');

        if (array_key_exists($normalizedModel, $resolved)) {
            return $resolved[$normalizedModel];
        }

        $namespaces = apply_filters(
            'webseo_fluentcrm_model_namespaces',
            [
                '\\FluentCrm\\App\\Models\\',
                '\\WebCrm\\App\\Models\\',
            ],
            $normalizedModel
        );

        if (is_array($namespaces)) {
            foreach ($namespaces as $namespace) {
                $namespace = '\\' . ltrim($namespace, '\\');
                $candidate = rtrim($namespace, '\\') . '\\' . $normalizedModel;

                if (class_exists($candidate)) {
                    $resolved[$normalizedModel] = $candidate;

                    return $candidate;
                }
            }
        }

        $suffix = '\\App\\Models\\' . $normalizedModel;
        $suffixLength = strlen($suffix);

        foreach (get_declared_classes() as $declared) {
            if ($suffixLength > 0 && substr($declared, -$suffixLength) === $suffix && class_exists($declared)) {
                $candidate = '\\' . ltrim($declared, '\\');
                $resolved[$normalizedModel] = $candidate;

                return $candidate;
            }
        }

        $resolved[$normalizedModel] = null;

        return null;
    }
}

if (! function_exists('webseo_fluentcrm_subscriber_supports_relationship_args')) {
    function webseo_fluentcrm_subscriber_supports_relationship_args(string $subscriberClass): bool
    {
        if (! method_exists($subscriberClass, 'createOrUpdate')) {
            return false;
        }

        try {
            $method = new \ReflectionMethod($subscriberClass, 'createOrUpdate');
        } catch (\ReflectionException $exception) {
            return true;
        }

        $parameters = $method->getParameters();
        $parameterCount = count($parameters);

        if ($parameterCount >= 3) {
            return true;
        }

        if ($parameterCount < 2) {
            return false;
        }

        $secondParameter = $parameters[1];
        $type = $secondParameter->getType();

        if ($type instanceof \ReflectionNamedType) {
            if (! $type->isBuiltin()) {
                return true;
            }

            return $type->getName() === 'array';
        }

        if ($type instanceof \ReflectionUnionType) {
            foreach ($type->getTypes() as $named) {
                if ($named instanceof \ReflectionNamedType) {
                    if (! $named->isBuiltin()) {
                        return true;
                    }

                    if ($named->getName() === 'array') {
                        return true;
                    }
                }
            }

            return false;
        }

        if ($secondParameter->isDefaultValueAvailable()) {
            $defaultValue = $secondParameter->getDefaultValue();

            if (is_array($defaultValue) || $defaultValue === null) {
                return true;
            }
        }

        return true;
    }
}

if (! function_exists('webseo_get_fluentcrm_contact_api')) {
    function webseo_get_fluentcrm_contact_api()
    {
        static $resolved = false;
        static $instance = null;

        if ($resolved) {
            return $instance;
        }

        $resolved = true;

        if (function_exists('fluentcrm_api')) {
            $maybeApi = fluentcrm_api('contacts');

            if (is_object($maybeApi)) {
                $instance = $maybeApi;

                return $instance;
            }
        }

        if (function_exists('FluentCrmApi')) {
            $maybeApi = FluentCrmApi('contacts');

            if (is_object($maybeApi)) {
                $instance = $maybeApi;

                return $instance;
            }
        }

        $contactApiClass = webseo_get_fluentcrm_model_class('Services\\Contacts\\ContactApi');

        if ($contactApiClass && class_exists($contactApiClass)) {
            try {
                $maybeApi = new $contactApiClass();

                if (is_object($maybeApi)) {
                    $instance = $maybeApi;
                }
            } catch (\Throwable $throwable) {
                $instance = null;
            }
        }

        return $instance;
    }
}

if (! function_exists('webseo_try_fluentcrm_contact_api_methods')) {
    function webseo_try_fluentcrm_contact_api_methods(int $subscriberId, array $items, array $methods): void
    {
        if ($subscriberId <= 0 || empty($items)) {
            return;
        }

        $api = webseo_get_fluentcrm_contact_api();

        if (! is_object($api)) {
            return;
        }

        foreach ($methods as $method) {
            if (! is_string($method) || $method === '') {
                continue;
            }

            $result = webseo_fluentcrm_object_call($api, $method, [$subscriberId, $items]);

            if ($result !== null) {
                break;
            }
        }
    }
}

if (! function_exists('webseo_normalize_fluentcrm_subscriber_result')) {
    function webseo_normalize_fluentcrm_subscriber_result(string $subscriberClass, $subscriber, string $email)
    {
        if (is_object($subscriber)) {
            return $subscriber;
        }

        if (function_exists('is_wp_error') && is_wp_error($subscriber)) {
            return $subscriber;
        }

        $possibleEmail = $email;
        $possibleId = 0;
        $normalizeEmail = static function ($value): string {
            if (! is_scalar($value)) {
                return '';
            }

            $value = (string) $value;

            if ($value === '') {
                return '';
            }

            if (function_exists('sanitize_email')) {
                $value = sanitize_email($value);
            } else {
                $filtered = filter_var($value, FILTER_SANITIZE_EMAIL);
                $value = is_string($filtered) ? $filtered : '';
            }

            return $value !== '' ? $value : '';
        };

        if (is_array($subscriber)) {
            if (isset($subscriber['subscriber'])) {
                $maybeSubscriber = $subscriber['subscriber'];

                if (is_object($maybeSubscriber)) {
                    return $maybeSubscriber;
                }

                if (is_array($maybeSubscriber)) {
                    if (isset($maybeSubscriber['id']) && is_scalar($maybeSubscriber['id'])) {
                        $possibleId = (int) $maybeSubscriber['id'];
                    }

                    if (isset($maybeSubscriber['email'])) {
                        $maybeEmail = $normalizeEmail($maybeSubscriber['email']);

                        if ($maybeEmail !== '') {
                            $possibleEmail = $maybeEmail;
                        }
                    }
                }
            }

            foreach (['data', 'result', 'contact'] as $nestedKey) {
                if (! array_key_exists($nestedKey, $subscriber)) {
                    continue;
                }

                $nestedCandidate = $subscriber[$nestedKey];

                if ($nestedCandidate === $subscriber) {
                    continue;
                }

                $normalizedCandidate = webseo_normalize_fluentcrm_subscriber_result($subscriberClass, $nestedCandidate, $possibleEmail);

                if (is_object($normalizedCandidate)) {
                    return $normalizedCandidate;
                }

                if (function_exists('is_wp_error') && is_wp_error($normalizedCandidate)) {
                    return $normalizedCandidate;
                }

                if (is_array($nestedCandidate)) {
                    if ($possibleId <= 0 && isset($nestedCandidate['id']) && is_scalar($nestedCandidate['id'])) {
                        $possibleId = (int) $nestedCandidate['id'];
                    }

                    if (isset($nestedCandidate['email'])) {
                        $maybeEmail = $normalizeEmail($nestedCandidate['email']);

                        if ($maybeEmail !== '') {
                            $possibleEmail = $maybeEmail;
                        }
                    }
                }
            }

            if ($possibleId <= 0) {
                foreach (['id', 'subscriber_id', 'ID'] as $key) {
                    if (isset($subscriber[$key]) && is_scalar($subscriber[$key])) {
                        $possibleId = (int) $subscriber[$key];

                        if ($possibleId > 0) {
                            break;
                        }
                    }
                }
            }

            if (isset($subscriber['email'])) {
                $maybeEmail = $normalizeEmail($subscriber['email']);

                if ($maybeEmail !== '') {
                    $possibleEmail = $maybeEmail;
                }
            }

            if ($possibleId > 0) {
                $found = webseo_find_fluentcrm_model($subscriberClass, 'id', (string) $possibleId);

                if (is_object($found)) {
                    return $found;
                }
            }
        }

        if (is_numeric($subscriber)) {
            $found = webseo_find_fluentcrm_model($subscriberClass, 'id', (string) $subscriber);

            if (is_object($found)) {
                return $found;
            }
        }

        if ($subscriber === true) {
            $found = webseo_find_fluentcrm_model($subscriberClass, 'email', $possibleEmail);

            if (is_object($found)) {
                return $found;
            }
        }

        if ($possibleEmail !== '') {
            $found = webseo_find_fluentcrm_model($subscriberClass, 'email', $possibleEmail);

            if (is_object($found)) {
                return $found;
            }
        }

        if ($email !== '' && $possibleEmail !== $email) {
            $found = webseo_find_fluentcrm_model($subscriberClass, 'email', $email);

            if (is_object($found)) {
                return $found;
            }
        }

        return null;
    }
}

if (! function_exists('webseo_sync_fluentcrm_contact_relations')) {
    function webseo_sync_fluentcrm_contact_relations($subscriber, string $subscriberClass, string $email, array $lists, array $tags, bool $force = false): void
    {
        if (empty($lists) && empty($tags)) {
            return;
        }

        if (! is_object($subscriber)) {
            $subscriber = webseo_find_fluentcrm_model($subscriberClass, 'email', $email);
        }

        if (! is_object($subscriber)) {
            return;
        }

        $subscriberId = isset($subscriber->id) ? (int) $subscriber->id : 0;

        if (! empty($lists)) {
            $attached = webseo_fluentcrm_object_call($subscriber, 'attachLists', [$lists]);

            if ($attached === null) {
                $attached = webseo_fluentcrm_object_call($subscriber, 'syncLists', [$lists]);
            }

            if ($attached === null && $force && $subscriberId > 0) {
                webseo_try_fluentcrm_contact_api_methods($subscriberId, $lists, ['attachLists', 'syncLists', 'attachToLists']);
            }
        }

        if (! empty($tags)) {
            $attached = webseo_fluentcrm_object_call($subscriber, 'attachTags', [$tags]);

            if ($attached === null) {
                $attached = webseo_fluentcrm_object_call($subscriber, 'syncTags', [$tags]);
            }

            if ($attached === null && $force && $subscriberId > 0) {
                webseo_try_fluentcrm_contact_api_methods($subscriberId, $tags, ['attachTags', 'syncTags', 'attachToTags']);
            }
        }

        webseo_fluentcrm_object_call($subscriber, 'flushCache');
    }
}

if (! function_exists('webseo_find_fluentcrm_model')) {
    /**
     * @param object|mixed $query
     * @return mixed
     */
    function webseo_find_fluentcrm_model(string $modelClass, string $field, string $value)
    {
        $query = webseo_fluentcrm_static_call($modelClass, 'where', [$field, $value]);

        if (! is_object($query)) {
            return null;
        }

        $result = webseo_fluentcrm_object_call($query, 'first');

        if (is_object($result)) {
            return $result;
        }

        return null;
    }
}

if (! function_exists('webseo_fluentcrm_static_call')) {
    function webseo_fluentcrm_static_call(string $class, string $method, array $arguments = [])
    {
        if (! class_exists($class)) {
            return null;
        }

        try {
            return $class::$method(...$arguments);
        } catch (\Throwable $throwable) {
            return null;
        }
    }
}

if (! function_exists('webseo_fluentcrm_object_call')) {
    function webseo_fluentcrm_object_call($instance, string $method, array $arguments = [])
    {
        if (! is_object($instance)) {
            return null;
        }

        try {
            return $instance->$method(...$arguments);
        } catch (\Throwable $throwable) {
            return null;
        }
    }
}

if (! function_exists('webseo_find_fluentcrm_record_via_db')) {
    function webseo_find_fluentcrm_record_via_db(string $table, string $field, string $value)
    {
        $allowedFields = ['slug', 'title'];

        if (! in_array($field, $allowedFields, true) || $value === '') {
            return null;
        }

        $tableName = webseo_get_fluentcrm_table_name($table);

        if (! $tableName) {
            return null;
        }

        global $wpdb;

        if (! isset($wpdb)) {
            return null;
        }

        $query = $wpdb->prepare(
            "SELECT * FROM {$tableName} WHERE {$field} = %s LIMIT 1",
            $value
        );

        if (! $query) {
            return null;
        }

        return $wpdb->get_row($query);
    }
}

if (! function_exists('webseo_get_fluentcrm_table_name')) {
    function webseo_get_fluentcrm_table_name(string $table): ?string
    {
        global $wpdb;

        if (! isset($wpdb) || ! $table) {
            return null;
        }

        static $checked = [];

        if (! preg_match('/^[A-Za-z0-9_]+$/', $table)) {
            return null;
        }

        $tableName = $wpdb->prefix . ltrim($table, '_');

        if (array_key_exists($tableName, $checked)) {
            return $checked[$tableName];
        }

        $like = method_exists($wpdb, 'esc_like') ? $wpdb->esc_like($tableName) : $tableName;
        $prepared = $wpdb->prepare('SHOW TABLES LIKE %s', $like);

        if (! $prepared) {
            $checked[$tableName] = null;

            return null;
        }

        $exists = $wpdb->get_var($prepared);

        if ($exists === $tableName) {
            $checked[$tableName] = $tableName;

            return $tableName;
        }

        $checked[$tableName] = null;

        return null;
    }
}

if (! function_exists('webseo_maybe_send_contact_notification')) {
    /**
     * @param array{full_name?: string, company_name?: string, use_case?: string, description?: string, newsletter?: string} $contactData
     */
    function webseo_maybe_send_contact_notification(string $email, array $contactData): void
    {
        if ($contactData['full_name'] === '' || $contactData['description'] === '') {
            return;
        }

        $adminEmail = get_option('admin_email');
        $subject = sprintf(__('New contact form submission from %s', 'webmakerr'), $contactData['full_name']);

        $messageBody  = sprintf("%s %s\n", __('Name:', 'webmakerr'), $contactData['full_name']);
        $messageBody .= sprintf("%s %s\n", __('Company:', 'webmakerr'), $contactData['company_name'] ?? '');
        $messageBody .= sprintf("%s %s\n", __('Email:', 'webmakerr'), $email);
        $messageBody .= sprintf("%s %s\n", __('Use case:', 'webmakerr'), $contactData['use_case'] ?? '');
        $messageBody .= sprintf("%s %s\n\n", __('Newsletter signup:', 'webmakerr'), $contactData['newsletter'] ?? '');
        $messageBody .= sprintf("%s\n%s", __('Description:', 'webmakerr'), $contactData['description'] ?? '');

        wp_mail(
            $adminEmail,
            $subject,
            $messageBody,
            ['Reply-To' => $email]
        );
    }
}
