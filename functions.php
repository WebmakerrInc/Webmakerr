<?php

use Webmakerr\Framework\Assets\ViteCompiler;
use Webmakerr\Framework\Features\MenuOptions;
use Webmakerr\Framework\Theme;

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
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
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
        ->menus(static fn ($manager) => $manager->add('primary', __('Primary Menu', 'webmakerr')))
        ->themeSupport(static fn ($manager) => $manager->add([
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
        ]));
}

add_action(
    'after_setup_theme',
    static function (): void {
        webmakerr();
    },
    11
);
