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

add_action(
    'after_setup_theme',
    static function (): void {
        $GLOBALS['content_width'] = (int) apply_filters('webmakerr_content_width', 1200);
    },
    0
);

add_action(
    'widgets_init',
    static function (): void {
        register_sidebar([
            'name'          => __('Footer', 'webmakerr'),
            'id'            => 'footer-1',
            'description'   => __('Add widgets here to appear in your site footer.', 'webmakerr'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ]);
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
            ->add('primary', 'Primary Menu')
            ->add('footer', 'Footer Menu')
        )
        ->themeSupport(static fn ($manager) => $manager->add([
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
        ]));
}

// Bootstrap the theme framework early so hooks registered within the Theme
// class run during the same after_setup_theme cycle.
webmakerr();

add_action(
    'wp_enqueue_scripts',
    static function (): void {
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
);

if (! function_exists('webmakerr_primary_menu_fallback')) {
    function webmakerr_primary_menu_fallback(array $args): void
    {
        $menu_items = wp_list_pages([
            'echo'     => false,
            'title_li' => '',
        ]);

        $menu_items = $menu_items ? trim($menu_items) : '';
        $item_class = isset($args['li_class']) ? trim((string) $args['li_class']) : '';

        if ($menu_items !== '' && $item_class !== '') {
            $menu_items = preg_replace_callback(
                '/<li([^>]*)class="([^"]*)"([^>]*)>/',
                static function (array $matches) use ($item_class): string {
                    $classes = trim($matches[2].' '.$item_class);

                    return '<li'.$matches[1].'class="'.esc_attr($classes).'"'.$matches[3].'>';
                },
                $menu_items
            );
        }

        $menu_class = isset($args['menu_class']) ? trim((string) $args['menu_class']) : '';
        $menu_id = $args['menu_id'] ?? 'primary-menu';
        $link_before = $args['link_before'] ?? '';
        $link_after = $args['link_after'] ?? '';

        $home_item = sprintf(
            '<li%1$s><a href="%2$s">%3$s</a></li>',
            $item_class !== '' ? ' class="'.esc_attr($item_class).'"' : '',
            esc_url(home_url('/')),
            $link_before.esc_html__('Home', 'webmakerr').$link_after
        );

        echo '<ul';

        if ($menu_class !== '') {
            echo ' class="'.esc_attr($menu_class).'"';
        }

        if (! empty($menu_id)) {
            echo ' id="'.esc_attr($menu_id).'"';
        }

        echo '>';
        echo $home_item;
        echo $menu_items; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output from wp_list_pages().
        echo '</ul>';
    }
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

