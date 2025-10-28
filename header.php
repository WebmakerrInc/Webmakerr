<?php
/**
 * Theme header template.
 *
 * @package Webmakerr
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-white text-zinc-900 antialiased'); ?>>
<?php
wp_body_open();
?>
    <a class="skip-link screen-reader-text" href="#content">
        <?php esc_html_e('Skip to content', 'webmakerr'); ?>
    </a>
<?php
do_action('webmakerr_site_before');

$contact_page = get_page_by_path('contact');
$contact_url = $contact_page instanceof WP_Post ? get_permalink($contact_page) : home_url('/');
$contact_url = apply_filters('webmakerr_contact_link', $contact_url);
$has_primary_menu = has_nav_menu('primary');
$has_fallback_pages = ! $has_primary_menu && ! empty(get_posts([
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'numberposts'    => 1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]));
$show_primary_toggle = $has_primary_menu || $has_fallback_pages || current_user_can('edit_theme_options');
?>

<div id="page" class="min-h-screen flex flex-col">
    <?php do_action('webmakerr_header'); ?>

    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto py-4 flex items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <?php if (has_custom_logo()): ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else: ?>
                    <div class="flex items-center gap-2">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="!no-underline lowercase font-medium text-lg">
                            <?php echo esc_html(get_bloginfo('name')); ?>
                        </a>
                        <?php if ($description = get_bloginfo('description')): ?>
                            <span class="text-sm font-light text-dark/80">|</span>
                            <span class="text-sm font-light text-dark/80"><?php echo esc_html($description); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex items-center gap-4">
                <?php if ($show_primary_toggle): ?>
                    <button
                        type="button"
                        aria-label="<?php esc_attr_e('Toggle navigation', 'webmakerr'); ?>"
                        aria-controls="primary-navigation"
                        aria-expanded="false"
                        id="primary-menu-toggle"
                        class="inline-flex size-10 items-center justify-center rounded-full border border-light bg-white text-zinc-900 shadow-sm transition hover:bg-zinc-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark md:hidden"
                    >
                        <span class="sr-only"><?php esc_html_e('Toggle navigation', 'webmakerr'); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                <?php endif; ?>

                <a
                    class="inline-flex items-center justify-center rounded-full bg-dark px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-dark/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline md:hidden"
                    href="<?php echo esc_url($contact_url); ?>"
                    aria-label="<?php esc_attr_e('Contact Us', 'webmakerr'); ?>"
                >
                    <?php esc_html_e('Contact Us', 'webmakerr'); ?>
                </a>

                <div
                    id="primary-navigation"
                    class="fixed inset-x-4 top-24 z-50 flex flex-col gap-6 rounded-2xl border border-light bg-white p-6 shadow-lg transition-[transform,opacity] duration-200 md:static md:z-auto md:flex md:flex-row md:items-center md:gap-6 md:rounded-none md:border-none md:bg-transparent md:p-0 md:shadow-none"
                    data-open="false"
                    aria-hidden="true"
                >
                    <nav class="flex flex-col gap-3 text-base md:flex md:flex-row md:items-center md:gap-0">
                        <?php if (current_user_can('edit_theme_options') && !$has_primary_menu): ?>
                            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="text-sm text-zinc-600"><?php esc_html_e('Edit Menus', 'webmakerr'); ?></a>
                        <?php else: ?>
                            <?php
                            wp_nav_menu([
                                'container_id'    => 'primary-menu',
                                'container_class' => '',
                                'menu_class'      => 'flex flex-col gap-3 text-base [&_a]:!no-underline md:flex md:flex-row md:items-center md:gap-0 md:-mx-4',
                                'theme_location'  => 'primary',
                                'li_class'        => 'py-1 md:py-0 md:mx-4',
                                'fallback_cb'     => 'webmakerr_primary_menu_fallback',
                            ]);
                            ?>
                        <?php endif; ?>
                    </nav>

                    <div class="w-full md:w-auto"><?php get_search_form(); ?></div>

                    <a
                        class="hidden md:inline-flex md:w-auto justify-center rounded-full bg-dark px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-dark/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline"
                        href="<?php echo esc_url($contact_url); ?>"
                        aria-label="<?php esc_attr_e('Contact Us', 'webmakerr'); ?>"
                    >
                        <?php esc_html_e('Contact Us', 'webmakerr'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php if ($show_primary_toggle): ?>
            <div
                id="primary-navigation-overlay"
                class="fixed inset-0 z-40 bg-zinc-950/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-200 md:hidden"
                data-open="false"
                aria-hidden="true"
            ></div>
        <?php endif; ?>
    </header>

    <div id="content" class="site-content grow">
        <?php if (is_front_page() && is_home()): ?>
            <?php $documentation_url = apply_filters('webmakerr_documentation_link', ''); ?>
            <section class="container mx-auto py-12">
                <div class="max-w-(--breakpoint-md)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 md:w-10 mb-4" viewBox="0 0 64 64" aria-hidden="true" focusable="false">
                        <defs>
                            <linearGradient id="heroGradient" x1="0%" x2="100%" y1="0%" y2="100%">
                                <stop offset="0%" stop-color="#0f172a" />
                                <stop offset="100%" stop-color="#3b82f6" />
                            </linearGradient>
                        </defs>
                        <circle cx="20" cy="20" r="12" fill="url(#heroGradient)" opacity="0.85" />
                        <circle cx="44" cy="24" r="10" fill="#0f172a" opacity="0.55" />
                        <circle cx="32" cy="44" r="14" fill="#3b82f6" opacity="0.3" />
                    </svg>
                        <div class="[&_a]:text-primary">
                        <h1 class="leading-tight text-3xl md:text-5xl font-medium tracking-tight text-balance text-zinc-950">
                            <?php esc_html_e('Rapidly build your next WordPress theme with Tailwind CSS', 'webmakerr'); ?>
                        </h1>
                        <p class="my-6 text-lg md:text-xl text-zinc-600 leading-8">
                            <?php
                            printf(
                                wp_kses(
                                    /* translators: 1: Opening link to Webmakerr, 2: Closing link, 3: Opening link to Tailwind CSS, 4: Closing link, 5: Opening link to WordPress, 6: Closing link. */
                                    __('%1$sWebmakerr%2$s is a %3$sTailwind CSS%4$s flavoured %5$sWordPress%6$s boilerplate theme. It\'s your go-to starting point for building custom WordPress themes with modern tools and practices.', 'webmakerr'),
                                    [
                                        'a' => [
                                            'href' => [],
                                        ],
                                    ]
                                ),
                                sprintf('<a href="%s">', esc_url('https://webmakerr.com/')),
                                '</a>',
                                sprintf('<a href="%s">', esc_url('https://tailwindcss.com')),
                                '</a>',
                                sprintf('<a href="%s">', esc_url('https://wordpress.org')),
                                '</a>'
                            );
                            ?>
                        </p>
                        </div>
                        <?php if (! empty($documentation_url)) : ?>
                            <div>
                                <a href="<?php echo esc_url($documentation_url); ?>" class="inline-flex rounded-full px-4 py-1.5 text-sm font-semibold transition bg-dark text-white hover:bg-dark/90 !no-underline">
                                    <?php esc_html_e('Documentation', 'webmakerr'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php do_action('webmakerr_content_start'); ?>
        <main id="primary" class="site-main grow">
