<?php

use Webmakerr\Framework\Assets\ViteCompiler;
use Webmakerr\Framework\Features\MenuOptions;
use Webmakerr\Framework\Theme;

if (! defined('WEBMAKERR_LICENSE_DATA_URL')) {
    define('WEBMAKERR_LICENSE_DATA_URL', 'https://webmakerr.com/api/licenses.json');
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
                'methods'             => 'GET',
                'callback'            => 'webmakerr_rest_check_license',
                'permission_callback' => static function (): bool {
                    return current_user_can('manage_options');
                },
                'args'                => [
                    'key' => [
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

if (! function_exists('webmakerr_rest_check_license')) {
    function webmakerr_rest_check_license(\WP_REST_Request $request): \WP_REST_Response
    {
        $licenseKey = $request->get_param('key');
        $transientKey = 'webmakerr_license_data';
        $cacheOptionKey = 'webmakerr_license_data_cache';
        $licenses = get_transient($transientKey);
        $fallbackMessage = null;
        $response = null;

        if (! is_array($licenses)) {
            $licenses = null;
            $response = wp_remote_get(WEBMAKERR_LICENSE_DATA_URL);

            if (! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
                $body = wp_remote_retrieve_body($response);
                $decoded = json_decode($body, true);

                if (is_array($decoded)) {
                    $licenses = $decoded;
                    set_transient($transientKey, $licenses, 12 * HOUR_IN_SECONDS);
                    update_option($cacheOptionKey, $licenses);
                }
            }

            if ($licenses === null) {
                $cachedLicenses = get_option($cacheOptionKey);

                if (is_array($cachedLicenses)) {
                    $licenses = $cachedLicenses;
                    $fallbackMessage = __('Unable to validate license right now. Using last cached result.', 'webmakerr');
                } else {
                    $errorMessage = __('License data is unavailable.', 'webmakerr');

                    if ($response !== null && is_wp_error($response)) {
                        $errorMessage = __('Unable to validate license right now.', 'webmakerr');
                    }

                    return new WP_REST_Response(
                        [
                            'valid'  => false,
                            'status' => 'unavailable',
                            'message' => $errorMessage,
                        ],
                        500
                    );
                }
            }
        }

        $status = 'invalid';

        foreach ($licenses as $license) {
            if (! isset($license['key'])) {
                continue;
            }

            if (hash_equals($license['key'], $licenseKey)) {
                $status = $license['status'] ?? 'invalid';
                break;
            }
        }

        $isValid = $status === 'active';

        if ($isValid) {
            update_option('webmakerr_theme_license_key', $licenseKey);
        }

        update_option('webmakerr_theme_license_status', $status);

        $responseData = [
            'valid'  => $isValid,
            'status' => $status,
        ];

        if ($fallbackMessage !== null) {
            $responseData['message'] = $fallbackMessage;
        }

        return new WP_REST_Response($responseData);
    }
}
