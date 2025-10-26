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

        if ($depth === 0) {
            $classes[] = 'space-y-4';
        }

        $classes[] = 'list-none';

        return array_values(array_unique(array_filter($classes)));
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

        $classes[] = 'space-y-3';
        $classes[] = 'list-none';
        $classes[] = 'pl-0';

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

        $baseClasses = 'transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white';

        if ($depth === 0) {
            $linkClasses = 'block text-xs font-semibold uppercase tracking-[0.16em] text-slate-200 hover:text-white';
        } else {
            $linkClasses = 'block text-sm text-slate-400 hover:text-slate-50';
        }

        $atts['class'] = trim(($atts['class'] ?? '').' '.$linkClasses.' '.$baseClasses);

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
