<?php

declare(strict_types=1);

namespace Webmakerr\PluginCompatibility;

use function add_action;
use function add_filter;
use function defined;
use function is_array;

final class FluentCart
{
    /**
     * Bootstrap the compatibility hooks once plugins are loaded.
     */
    public static function bootstrap(): void
    {
        add_action('plugins_loaded', static function (): void {
            if (! self::pluginLoaded()) {
                return;
            }

            self::registerOptionGuards();
        });
    }

    /**
     * Register option filters that guarantee the plugin always
     * receives an array while reading configuration data.
     */
    private static function registerOptionGuards(): void
    {
        foreach (self::optionNames() as $option) {
            add_filter('option_'.$option, static function ($value) {
                if (is_array($value)) {
                    return $value;
                }

                if ($value === null || $value === false || $value === '') {
                    return [];
                }

                return [];
            });
        }
    }

    /**
     * Get the option names Fluent Cart stores configuration inside.
     *
     * @return string[]
     */
    private static function optionNames(): array
    {
        return [
            'fluent_cart_pro_app_config',
            'fluent_cart_pro_configs',
            'fluent_cart_app_config',
            'fluent_cart_configs',
            'fluentcart_app_config',
            'fluentcart_configs',
        ];
    }

    private static function pluginLoaded(): bool
    {
        return defined('FLUENT_CART_PRO_DIR') || defined('FLUENT_CART_DIR');
    }
}

FluentCart::bootstrap();
