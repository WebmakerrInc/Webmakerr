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
<body <?php body_class('bg-light text-text antialiased'); ?>>
<?php do_action('webmakerr_site_before'); ?>

<div id="page" class="min-h-screen flex flex-col">
    <?php do_action('webmakerr_header'); ?>

    <header class="sticky top-0 z-50 border-b border-border/60 bg-light/90 shadow-subtle backdrop-blur">
        <div class="container flex items-center justify-between gap-24 py-16">
            <div class="flex items-center gap-16">
                <?php if (has_custom_logo()): ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else: ?>
                    <div class="flex items-center gap-16">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-lg font-medium lowercase text-dark transition hover:opacity-90">
                            <?php echo esc_html(get_bloginfo('name')); ?>
                        </a>
                        <?php if ($description = get_bloginfo('description')): ?>
                            <span class="text-sm font-medium text-muted-text/70">|</span>
                            <span class="text-sm font-medium text-muted-text/70"><?php echo esc_html($description); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex items-center gap-24">
                <?php if (has_nav_menu('primary')): ?>
                    <div class="md:hidden">
                        <button type="button" aria-label="Toggle navigation" id="primary-menu-toggle" class="inline-flex size-48 items-center justify-center rounded-lg border border-border bg-light text-dark">
                            <svg xmlns="https://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>

                <div id="primary-navigation" class="hidden items-center gap-24 rounded-xl border border-border bg-light/95 p-16 shadow-subtle md:flex md:border-none md:bg-transparent md:p-0 md:shadow-none">
                    <nav>
                        <?php if (current_user_can('administrator') && !has_nav_menu('primary')): ?>
                            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="text-sm font-medium text-muted-text transition hover:text-dark"><?php esc_html_e('Edit Menus', 'webmakerr'); ?></a>
                        <?php else: ?>
                            <?php
                            wp_nav_menu([
                                'container_id'    => 'primary-menu',
                                'container_class' => '',
                                'menu_class'      => 'md:flex md:gap-24 [&_a]:text-sm [&_a]:font-medium [&_a]:text-muted-text [&_a]:transition hover:[&_a]:text-dark [&_a]:!no-underline',
                                'theme_location'  => 'primary',
                                'li_class'        => '',
                                'fallback_cb'     => false,
                            ]);
                            ?>
                        <?php endif; ?>
                    </nav>

                    <div class="mt-16 inline-block md:mt-0"><?php get_search_form(); ?></div>
                </div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content grow">
        <?php if (is_front_page()): ?>
            <section class="border-b border-border/60 bg-light py-48">
                <div class="container">
                    <svg xmlns="https://www.w3.org/2000/svg" class="mb-16 h-48 w-48 text-primary md:h-64 md:w-64" viewBox="0 0 117.91 117.91">
                        <path d="M56.39 16.75h14.07l-1.98 12h1.2c1.06-1.54 2.54-3.33 4.43-5.35 1.89-2.02 4.39-3.8 7.47-5.33 3.08-1.53 6.92-2.29 11.52-2.29 5.98 0 11.04 1.51 15.21 4.53 4.16 3.02 7.12 7.37 8.87 13.06.28.92.52 1.87.72 2.85V11.79C117.9 5.28 112.62 0 106.11 0H27.89L25.1 16.75h15.24l-1.88 11.57H23.17l-6.78 40.72c-.45 2.8-.37 4.89.24 6.29.61 1.4 1.55 2.35 2.82 2.84 1.27.5 2.69.75 4.26.75 1.16 0 2.17-.08 3.04-.24.87-.16 1.56-.29 2.07-.39l.72 11.9c-.93.32-2.21.65-3.83.99-1.62.34-3.59.52-5.9.55-3.79.06-7.2-.61-10.24-2.02-3.04-1.41-5.31-3.6-6.82-6.55-1.51-2.96-1.9-6.67-1.16-11.13L8.8 28.32H0v77.81c0 6.51 5.28 11.79 11.79 11.79h27.65L56.39 16.75ZM10.72 16.75 13.49 0H11.8C5.28 0 0 5.28 0 11.79v4.95h10.72Z"/>
                        <path d="M117.84 53.9c-1.32 8-3.79 14.85-7.42 20.55-3.63 5.7-8.02 10.09-13.18 13.16-5.16 3.07-10.72 4.6-16.7 4.6-4.5 0-8.05-.76-10.65-2.27-2.6-1.51-4.53-3.28-5.78-5.3s-2.19-3.82-2.8-5.4h-.92l-6.45 38.66h52.18c6.51 0 11.79-5.28 11.79-11.79V53.42c-.02.16-.05.31-.07.47Z"/>
                        <path d="M98.23 31.4c-2.51-2.25-5.93-3.37-10.27-3.37s-7.9 1.08-11.16 3.23-5.94 5.16-8.05 9.01c-2.1 3.86-3.57 8.35-4.41 13.49-.84 5.2-.84 9.77 0 13.69s2.51 6.98 5.04 9.18c2.52 2.2 5.86 3.3 10 3.3s8.08-1.15 11.33-3.45c3.24-2.3 5.94-5.42 8.07-9.37 2.14-3.95 3.64-8.4 4.51-13.35.77-4.88.75-9.27-.07-13.16-.82-3.89-2.48-6.96-4.99-9.2Z"/>
                    </svg>
                    <div class="space-y-24">
                        <h1 class="max-w-3xl text-balance font-semibold text-dark">
                            Rapidly build your next WordPress theme with Tailwind CSS
                        </h1>
                        <p class="max-w-2xl text-muted-text">
                            <a href="https://webmakerr.com/">Webmakerr</a> is a <a href="https://tailwindcss.com">Tailwind CSS</a> flavoured <a href="https://wordpress.org">WordPress</a>
                            boilerplate theme. It's your go-to starting point for building custom WordPress themes with modern tools and practices.
                        </p>
                    </div>
                    <div>
                        <a href="https://webmakerr.com/" class="btn-primary !no-underline">
                            Documentation
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php do_action('webmakerr_content_start'); ?>
        <main>
