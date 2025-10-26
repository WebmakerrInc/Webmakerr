<?php

use Webmakerr\Framework\Assets\ViteCompiler;
use Webmakerr\Framework\Features\MenuOptions;
use Webmakerr\Framework\Theme;

if (! defined('WEBMAKERR_LICENSE_DATA_URL')) {
    define('WEBMAKERR_LICENSE_DATA_URL', 'https://webmakerr.com/api/licenses.json');
}

if (! defined('WEBMAKERR_LICENSE_DATA_PATH')) {
    $defaultLicensePath = trailingslashit(get_template_directory()).'theme-core/licenses.json';
    define('WEBMAKERR_LICENSE_DATA_PATH', is_readable($defaultLicensePath) ? $defaultLicensePath : '');
}

if (! function_exists('webmakerr_parse_license_datetime')) {
    function webmakerr_parse_license_datetime($date): ?\DateTimeImmutable
    {
        if (! is_string($date) || $date === '') {
            return null;
        }

        try {
            return new \DateTimeImmutable($date, new \DateTimeZone('UTC'));
        } catch (\Exception $exception) {
            return null;
        }
    }
}

if (! function_exists('webmakerr_calculate_license_expiry_details')) {
    function webmakerr_calculate_license_expiry_details(string $status, ?\DateTimeImmutable $expiresAt, ?string $licenseType = null): array
    {
        $now = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        $isExpired = $status === 'expired';
        $daysRemaining = null;
        $normalizedType = is_string($licenseType) ? strtolower(trim($licenseType)) : null;

        if ($status === 'active' && $normalizedType === 'lifetime') {
            return [
                'message'        => __('✅ License active – lifetime access', 'webmakerr'),
                'is_expired'     => false,
                'days_remaining' => null,
            ];
        }

        if ($expiresAt instanceof \DateTimeImmutable) {
            if ($status === 'active') {
                if ($expiresAt <= $now) {
                    $isExpired = true;
                    $daysRemaining = 0;
                } else {
                    $daysRemaining = max(0, (int) $now->diff($expiresAt)->format('%a'));
                }
            } elseif ($isExpired) {
                $daysRemaining = 0;
            }
        }

        $message = '';

        if ($expiresAt instanceof \DateTimeImmutable) {
            if ($isExpired) {
                $message = sprintf(
                    /* translators: %s: License expiry date */
                    __('❌ License expired on %s', 'webmakerr'),
                    wp_date(get_option('date_format', 'F j, Y'), $expiresAt->getTimestamp())
                );
            } elseif ($status === 'active') {
                if ($daysRemaining === 0) {
                    $message = sprintf(
                        __('✅ License active – expires in %s', 'webmakerr'),
                        __('less than 1 day', 'webmakerr')
                    );
                } elseif ($daysRemaining === 1) {
                    $message = sprintf(
                        __('✅ License active – expires in %s', 'webmakerr'),
                        __('1 day', 'webmakerr')
                    );
                } else {
                    $message = sprintf(
                        __('✅ License active – expires in %s', 'webmakerr'),
                        sprintf(
                            /* translators: %d: Number of days until license expiry */
                            _n('%d day', '%d days', $daysRemaining, 'webmakerr'),
                            $daysRemaining
                        )
                    );
                }
            }
        }

        return [
            'message'        => $message,
            'is_expired'     => $isExpired,
            'days_remaining' => $daysRemaining,
        ];
    }
}

if (! function_exists('webmakerr_normalize_license_type')) {
    function webmakerr_normalize_license_type($licenseType): string
    {
        $normalized = is_string($licenseType) ? strtolower(trim($licenseType)) : '';

        if (in_array($normalized, ['1month', '1year', 'lifetime'], true)) {
            return $normalized;
        }

        return '1year';
    }
}

if (! function_exists('webmakerr_resolve_license_duration')) {
    function webmakerr_resolve_license_duration(string $licenseType): ?\DateInterval
    {
        return match ($licenseType) {
            '1month'   => new \DateInterval('P30D'),
            '1year'    => new \DateInterval('P365D'),
            default    => null,
        };
    }
}

if (! function_exists('webmakerr_get_license_revocation_message')) {
    function webmakerr_get_license_revocation_message(): string
    {
        return __('Your license is no longer valid. It may have been removed or revoked.', 'webmakerr');
    }
}

if (! function_exists('webmakerr_fetch_license_dataset')) {
    function webmakerr_fetch_license_dataset(string $transientKey, string $cacheOptionKey, ?string &$fallbackMessage = null, ?string &$errorMessage = null): ?array
    {
        $fallbackMessage = null;
        $errorMessage = null;

        $licenses = get_transient($transientKey);

        if (is_array($licenses)) {
            return $licenses;
        }

        $licenses = null;
        $response = null;

        if (defined('WEBMAKERR_LICENSE_DATA_PATH') && WEBMAKERR_LICENSE_DATA_PATH !== '') {
            $fileContents = file_get_contents(WEBMAKERR_LICENSE_DATA_PATH);

            if ($fileContents !== false) {
                $decoded = json_decode($fileContents, true);

                if (is_array($decoded)) {
                    $licenses = $decoded;
                }
            }
        }

        if ($licenses === null) {
            $response = wp_remote_get(WEBMAKERR_LICENSE_DATA_URL);

            if (! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
                $body = wp_remote_retrieve_body($response);
                $decoded = json_decode($body, true);

                if (is_array($decoded)) {
                    $licenses = $decoded;
                }
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

                return null;
            }
        }

        if (is_array($licenses)) {
            set_transient($transientKey, $licenses, 12 * HOUR_IN_SECONDS);
            update_option($cacheOptionKey, $licenses);
        }

        return $licenses;
    }
}

if (! function_exists('webmakerr_revoke_license_locally')) {
    function webmakerr_revoke_license_locally(): void
    {
        $status = 'revoked';

        update_option('webmakerr_theme_license_status', $status);
        update_option('webmakerr_license_status', $status);
        update_option('webmakerr_theme_license_activation_date', '');
        update_option('webmakerr_theme_license_issued_at', '');
        update_option('webmakerr_theme_license_expires_at', '');
        update_option('webmakerr_theme_license_type', '');
    }
}

if (! function_exists('webmakerr_sync_license_state_with_remote')) {
    function webmakerr_sync_license_state_with_remote(): void
    {
        $storedKey = get_option('webmakerr_theme_license_key', '');

        if ($storedKey === '') {
            return;
        }

        $currentStatus = get_option('webmakerr_theme_license_status', 'inactive');

        if ($currentStatus === 'revoked') {
            return;
        }

        $transientKey = 'webmakerr_license_data';
        $cacheOptionKey = 'webmakerr_license_data_cache';
        $fallbackMessage = null;
        $errorMessage = null;
        $licenses = webmakerr_fetch_license_dataset($transientKey, $cacheOptionKey, $fallbackMessage, $errorMessage);

        if (! is_array($licenses)) {
            return;
        }

        foreach ($licenses as $license) {
            if (! isset($license['key'])) {
                continue;
            }

            if (hash_equals($license['key'], $storedKey)) {
                return;
            }
        }

        webmakerr_revoke_license_locally();
    }
}

if (! function_exists('webmakerr_store_license_dataset')) {
    function webmakerr_store_license_dataset(array $licenses, string $transientKey, string $cacheOptionKey): void
    {
        set_transient($transientKey, $licenses, 12 * HOUR_IN_SECONDS);
        update_option($cacheOptionKey, $licenses);

        if (! defined('WEBMAKERR_LICENSE_DATA_PATH')) {
            return;
        }

        $path = WEBMAKERR_LICENSE_DATA_PATH;

        if ($path === '') {
            return;
        }

        $directory = dirname($path);
        $pathWritable = false;

        if (function_exists('wp_is_writable')) {
            $pathWritable = (file_exists($path) && wp_is_writable($path))
                || (! file_exists($path) && wp_is_writable($directory));
        } else {
            $pathWritable = (file_exists($path) && is_writable($path))
                || (! file_exists($path) && is_writable($directory));
        }

        if (! $pathWritable) {
            return;
        }

        $encoded = wp_json_encode($licenses, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        if ($encoded === false) {
            return;
        }

        file_put_contents($path, $encoded."\n");
    }
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

add_action(
    'init',
    static function (): void {
        $status = get_option('webmakerr_theme_license_status', 'inactive');

        if ($status !== 'active') {
            return;
        }

        $licenseType = webmakerr_normalize_license_type(get_option('webmakerr_theme_license_type', ''));

        if ($licenseType === 'lifetime') {
            return;
        }

        $expiresAt = webmakerr_parse_license_datetime(get_option('webmakerr_theme_license_expires_at', ''));

        if (! $expiresAt instanceof \DateTimeImmutable) {
            return;
        }

        $now = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));

        if ($expiresAt <= $now) {
            update_option('webmakerr_theme_license_status', 'expired');
        }
    }
);

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
        $storedActivationDate = get_option('webmakerr_theme_license_activation_date', '');
        if ($storedActivationDate === '') {
            $storedActivationDate = get_option('webmakerr_theme_license_issued_at', '');
        }
        $storedLicenseType = webmakerr_normalize_license_type(get_option('webmakerr_theme_license_type', ''));
        $storedExpiresAt = get_option('webmakerr_theme_license_expires_at', '');
        $expiresAt = webmakerr_parse_license_datetime($storedExpiresAt);
        $expiryDetails = webmakerr_calculate_license_expiry_details($savedStatus, $expiresAt, $storedLicenseType);

        if ($expiryDetails['is_expired'] && $savedStatus !== 'expired') {
            $savedStatus = 'expired';
            update_option('webmakerr_theme_license_status', 'expired');
            $expiryDetails = webmakerr_calculate_license_expiry_details($savedStatus, $expiresAt, $storedLicenseType);
        }

        $statuses = [
            'active'   => __('Active', 'webmakerr'),
            'revoked'  => __('Revoked', 'webmakerr'),
            'invalid'  => __('Invalid', 'webmakerr'),
            'inactive' => __('Inactive', 'webmakerr'),
            'expired'  => __('Expired', 'webmakerr'),
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

                <div
                    id="webmakerr-license-expiry"
                    class="webmakerr-license-expiry<?php echo $expiryDetails['message'] === '' ? '' : ($expiryDetails['is_expired'] ? ' is-expired' : ' is-active'); ?>"
                    <?php echo $expiryDetails['message'] === '' ? ' hidden' : ''; ?>
                    data-activation-date="<?php echo esc_attr($storedActivationDate); ?>"
                    data-expires-at="<?php echo esc_attr($storedExpiresAt); ?>"
                    data-license-type="<?php echo esc_attr($storedLicenseType); ?>"
                >
                    <?php echo esc_html($expiryDetails['message']); ?>
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

        $savedStatus = get_option('webmakerr_theme_license_status', 'inactive');
        $storedActivationDate = get_option('webmakerr_theme_license_activation_date', '');
        if ($storedActivationDate === '') {
            $storedActivationDate = get_option('webmakerr_theme_license_issued_at', '');
        }
        $storedLicenseType = webmakerr_normalize_license_type(get_option('webmakerr_theme_license_type', ''));
        $storedExpiresAt = get_option('webmakerr_theme_license_expires_at', '');
        $expiresAt = webmakerr_parse_license_datetime($storedExpiresAt);
        $expiryDetails = webmakerr_calculate_license_expiry_details($savedStatus, $expiresAt, $storedLicenseType);

        if ($expiryDetails['is_expired'] && $savedStatus !== 'expired') {
            $savedStatus = 'expired';
            update_option('webmakerr_theme_license_status', 'expired');
            $expiryDetails = webmakerr_calculate_license_expiry_details($savedStatus, $expiresAt, $storedLicenseType);
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
                    'error'   => __('❌ Invalid, Expired, or Revoked License Key.', 'webmakerr'),
                ],
                'labels'     => [
                    'active'   => __('Active', 'webmakerr'),
                    'revoked'  => __('Revoked', 'webmakerr'),
                    'invalid'  => __('Invalid', 'webmakerr'),
                    'inactive' => __('Inactive', 'webmakerr'),
                    'expired'  => __('Expired', 'webmakerr'),
                ],
                'expirationMessages' => [
                    'active'         => __('✅ License active – expires in %s', 'webmakerr'),
                    'expired'        => __('❌ License expired on %s', 'webmakerr'),
                    'lessThanDay'    => __('less than 1 day', 'webmakerr'),
                    'singleDay'      => __('1 day', 'webmakerr'),
                    'multipleDays'   => __('%d days', 'webmakerr'),
                    'lifetime'       => __('✅ License active – lifetime access', 'webmakerr'),
                ],
                'licenseMessages' => [
                    'lifetime' => __('✅ License active – lifetime access', 'webmakerr'),
                ],
                'storedStatus' => $savedStatus,
                'expiration'   => [
                    'activation_date' => $storedActivationDate,
                    'expires_at'     => $storedExpiresAt,
                    'days_remaining' => $expiryDetails['days_remaining'],
                    'message'        => $expiryDetails['message'],
                    'license_type'   => $storedLicenseType,
                ],
            ]
        );
    }
);

add_action('admin_init', 'webmakerr_sync_license_state_with_remote');

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
        $fallbackMessage = null;
        $errorMessage = null;
        $licenses = webmakerr_fetch_license_dataset($transientKey, $cacheOptionKey, $fallbackMessage, $errorMessage);

        if (! is_array($licenses)) {
            $responseMessage = $errorMessage ?? __('License data is unavailable.', 'webmakerr');

            return new WP_REST_Response(
                [
                    'valid'   => false,
                    'status'  => 'unavailable',
                    'message' => $responseMessage,
                ],
                500
            );
        }

        $status = 'invalid';
        $matchedLicense = null;
        $matchedLicenseIndex = null;

        foreach ($licenses as $index => $license) {
            if (! isset($license['key'])) {
                continue;
            }

            if (hash_equals($license['key'], $licenseKey)) {
                $matchedLicense = $license;
                $matchedLicenseIndex = $index;
                break;
            }
        }

        $activationDateIso = null;
        $expiresAtIso = null;
        $daysRemaining = null;
        $licenseType = null;
        $licenseMessage = '';
        $licensesUpdated = false;

        if ($matchedLicense !== null) {
            $status = $matchedLicense['status'] ?? 'invalid';
            $licenseType = webmakerr_normalize_license_type($matchedLicense['license_type'] ?? null);

            if (($matchedLicense['license_type'] ?? null) !== $licenseType) {
                $matchedLicense['license_type'] = $licenseType;
                $licensesUpdated = true;
            }

            $activationDateIso = isset($matchedLicense['activation_date']) && is_string($matchedLicense['activation_date'])
                ? $matchedLicense['activation_date']
                : null;

            if ($activationDateIso === null && isset($matchedLicense['issued_at']) && is_string($matchedLicense['issued_at'])) {
                $activationDateIso = $matchedLicense['issued_at'];
                $matchedLicense['activation_date'] = $activationDateIso;
                $licensesUpdated = true;
            }

            $activationDate = webmakerr_parse_license_datetime($activationDateIso);

            $expiresAtIso = isset($matchedLicense['expires_at']) && is_string($matchedLicense['expires_at'])
                ? $matchedLicense['expires_at']
                : null;
            $expiresAt = webmakerr_parse_license_datetime($expiresAtIso);

            $now = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));

            if ($status === 'pending') {
                $status = 'active';
                $matchedLicense['status'] = 'active';
                $activationDate = $now;
                $activationDateIso = $activationDate->format(DATE_ATOM);
                $matchedLicense['activation_date'] = $activationDateIso;

                $duration = webmakerr_resolve_license_duration($licenseType);

                if ($duration !== null) {
                    $expiresAt = $activationDate->add($duration);
                    $expiresAtIso = $expiresAt->format(DATE_ATOM);
                    $matchedLicense['expires_at'] = $expiresAtIso;
                } else {
                    $expiresAt = null;
                    $expiresAtIso = null;
                    unset($matchedLicense['expires_at']);
                }

                $licensesUpdated = true;
            } elseif ($status === 'active') {
                if ($licenseType === 'lifetime') {
                    $expiresAt = null;
                    $expiresAtIso = null;

                    if (isset($matchedLicense['expires_at'])) {
                        unset($matchedLicense['expires_at']);
                        $licensesUpdated = true;
                    }
                } elseif ($expiresAt instanceof \DateTimeImmutable) {
                    if ($expiresAt <= $now) {
                        $status = 'expired';
                        $matchedLicense['status'] = 'expired';
                        $licensesUpdated = true;
                    }
                } elseif ($activationDate instanceof \DateTimeImmutable) {
                    $duration = webmakerr_resolve_license_duration($licenseType);

                    if ($duration !== null) {
                        $expiresAt = $activationDate->add($duration);
                        $expiresAtIso = $expiresAt->format(DATE_ATOM);
                        $matchedLicense['expires_at'] = $expiresAtIso;
                        $licensesUpdated = true;
                    }
                }
            }

            if ($licenseType === 'lifetime') {
                $expiresAt = null;
                $expiresAtIso = null;
            }

            $expiryDetails = webmakerr_calculate_license_expiry_details($status, $expiresAt, $licenseType);

            if ($expiryDetails['is_expired'] && $status !== 'expired') {
                $status = 'expired';
                $matchedLicense['status'] = 'expired';
                $licensesUpdated = true;
            }

            $daysRemaining = $expiryDetails['days_remaining'];
            $licenseMessage = $expiryDetails['message'];

            if ($licensesUpdated && $matchedLicenseIndex !== null) {
                $licenses[$matchedLicenseIndex] = $matchedLicense;
                webmakerr_store_license_dataset($licenses, $transientKey, $cacheOptionKey);
            }
        } else {
            $storedLicenseKey = get_option('webmakerr_theme_license_key', '');

            if ($storedLicenseKey !== '' && hash_equals($storedLicenseKey, $licenseKey)) {
                webmakerr_revoke_license_locally();
                $status = 'revoked';
                $licenseType = null;
                $activationDateIso = null;
                $expiresAtIso = null;
                $daysRemaining = null;
                $licenseMessage = webmakerr_get_license_revocation_message();
            }
        }

        $isValid = $status === 'active';

        if ($isValid) {
            update_option('webmakerr_theme_license_key', $licenseKey);
        }

        update_option('webmakerr_theme_license_status', $status);
        update_option('webmakerr_license_status', $status);
        update_option('webmakerr_theme_license_activation_date', $activationDateIso ?? '');
        update_option('webmakerr_theme_license_issued_at', $activationDateIso ?? '');
        update_option('webmakerr_theme_license_expires_at', $expiresAtIso ?? '');
        update_option('webmakerr_theme_license_type', $licenseType ?? '');

        $responseData = [
            'valid'  => $isValid,
            'status' => $status,
            'activation_date' => $activationDateIso,
            'expires_at' => $expiresAtIso,
            'days_remaining' => $daysRemaining,
            'license_type' => $licenseType,
            'license_message' => $licenseMessage,
        ];

        if ($status === 'revoked') {
            $responseData['message'] = webmakerr_get_license_revocation_message();
        } elseif ($fallbackMessage !== null) {
            $responseData['message'] = $fallbackMessage;
        }

        return new WP_REST_Response($responseData);
    }
}

if (! function_exists('webmakerr_render_license_expired_admin_notice')) {
    function webmakerr_render_license_expired_admin_notice(): void
    {
        if (is_network_admin()) {
            if (! current_user_can('manage_network_options')) {
                return;
            }
        } elseif (! current_user_can('manage_options')) {
            return;
        }

        $status = get_option('webmakerr_theme_license_status', 'inactive');

        if ($status === 'revoked') {
            $message = webmakerr_get_license_revocation_message();
            printf('<div class="notice notice-error"><p>%s</p></div>', esc_html($message));

            return;
        }

        if ($status !== 'expired') {
            return;
        }

        $message = __('Your Webmakerr license has expired. Please renew to continue receiving updates and support.', 'webmakerr');

        printf('<div class="notice notice-error"><p>%s</p></div>', esc_html($message));
    }
}

add_action('admin_notices', 'webmakerr_render_license_expired_admin_notice');
add_action('network_admin_notices', 'webmakerr_render_license_expired_admin_notice');
