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
<?php do_action('webmakerr_site_before'); ?>

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
                <div class="flex items-center gap-3 md:hidden">
                    <?php if (has_nav_menu('primary')): ?>
                        <button type="button" aria-label="Toggle navigation" id="primary-menu-toggle">
                            <svg xmlns="https://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    <?php endif; ?>

                    <a
                        class="inline-flex items-center justify-center rounded bg-dark px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-dark/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline md:hidden"
                        href="<?php echo esc_url(home_url('/contact')); ?>"
                        aria-label="<?php esc_attr_e('Contact Us', 'webmakerr'); ?>"
                    >
                        <?php esc_html_e('Contact Us', 'webmakerr'); ?>
                    </a>
                </div>

                <div id="primary-navigation" class="hidden flex flex-col gap-6 items-stretch border border-light rounded p-4 md:flex md:flex-row md:items-center md:border-none md:bg-transparent md:p-0">
                    <nav>
                        <div class="relative md:mx-4 group/solutions">
                            <button
                                type="button"
                                class="flex items-center gap-2 text-sm font-medium text-dark transition-colors hover:text-dark/80 focus:outline-none focus-visible:ring-2 focus-visible:ring-dark focus-visible:ring-offset-2 focus-visible:ring-offset-white"
                                aria-haspopup="true"
                            >
                                <?php esc_html_e('Solutions', 'webmakerr'); ?>
                                <svg class="h-3.5 w-3.5 transition-transform group-hover/solutions:rotate-180 group-focus-within/solutions:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <div class="hidden mt-4 w-full rounded-lg border border-light bg-white p-4 shadow-lg md:absolute md:left-1/2 md:mt-6 md:w-[720px] md:max-w-[min(80vw,720px)] md:-translate-x-1/2 md:p-6 md:shadow-xl md:z-50 group-hover/solutions:block group-focus-within/solutions:block">
                                <section class="flex flex-col gap-6 md:flex-row md:gap-8">
                                    <div class="flex-1 space-y-3">
                                        <div class="flex items-center justify-between">
                                            <div class="uppercase tracking-wide text-[0.7rem] font-semibold text-zinc-500">
                                                <?php esc_html_e('By team size', 'webmakerr'); ?>
                                            </div>
                                        </div>

                                        <div class="space-y-2">
                                            <a href="#" class="flex items-start gap-3 rounded border border-light bg-white px-3 py-3 transition hover:border-dark/10 hover:bg-zinc-50">
                                                <span class="flex h-8 w-8 items-center justify-center rounded bg-zinc-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A3 3 0 017 17h10a3 3 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </span>
                                                <span>
                                                    <span class="block text-sm font-semibold text-dark"><?php esc_html_e('For Individuals', 'webmakerr'); ?></span>
                                                    <span class="block text-xs text-zinc-500"><?php esc_html_e('Personal scheduling made simple', 'webmakerr'); ?></span>
                                                </span>
                                            </a>

                                            <a href="#" class="flex items-start gap-3 rounded border border-blue-500/40 bg-blue-50 px-3 py-3 transition hover:border-blue-500/60">
                                                <span class="flex h-8 w-8 items-center justify-center rounded bg-zinc-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5-2.236M2 20h5v-2a3 3 0 00-5-2.236M9 12a3 3 0 106 0 3 3 0 00-6 0z" />
                                                    </svg>
                                                </span>
                                                <span>
                                                    <span class="block text-sm font-semibold text-dark"><?php esc_html_e('For Teams', 'webmakerr'); ?></span>
                                                    <span class="block text-xs text-zinc-500"><?php esc_html_e('Collaborative scheduling for groups', 'webmakerr'); ?></span>
                                                </span>
                                            </a>

                                            <a href="#" class="flex items-start gap-3 rounded border border-light bg-white px-3 py-3 transition hover:border-dark/10 hover:bg-zinc-50">
                                                <span class="flex h-8 w-8 items-center justify-center rounded bg-zinc-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />
                                                    </svg>
                                                </span>
                                                <span>
                                                    <span class="block text-sm font-semibold text-dark"><?php esc_html_e('For Enterprises', 'webmakerr'); ?></span>
                                                    <span class="block text-xs text-zinc-500"><?php esc_html_e('Enterprise-level scheduling solutions', 'webmakerr'); ?></span>
                                                </span>
                                            </a>

                                            <a href="#" class="flex items-start gap-3 rounded border border-light bg-white px-3 py-3 transition hover:border-dark/10 hover:bg-zinc-50">
                                                <span class="flex h-8 w-8 items-center justify-center rounded bg-zinc-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197 3.197a4 4 0 01-5.656-5.656l3.197-3.197m4.242 0a4 4 0 015.656 5.656l-3.197 3.197" />
                                                    </svg>
                                                </span>
                                                <span>
                                                    <span class="block text-sm font-semibold text-dark"><?php esc_html_e('For Developers', 'webmakerr'); ?></span>
                                                    <span class="block text-xs text-zinc-500"><?php esc_html_e('Powerful features and integrations', 'webmakerr'); ?></span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <div class="uppercase tracking-wide text-[0.7rem] font-semibold text-zinc-500">
                                            <?php esc_html_e('By use case', 'webmakerr'); ?>
                                        </div>

                                        <div class="mt-3 grid grid-cols-2 gap-2">
                                            <?php
                                            $use_cases = [
                                                __('Recruiting', 'webmakerr'),
                                                __('Support', 'webmakerr'),
                                                __('Sales', 'webmakerr'),
                                                __('Healthcare', 'webmakerr'),
                                                __('HR', 'webmakerr'),
                                                __('Telehealth', 'webmakerr'),
                                                __('Education', 'webmakerr'),
                                                __('Marketing', 'webmakerr'),
                                            ];

                                            foreach ($use_cases as $use_case):
                                                ?>
                                                <a href="#" class="rounded border border-light bg-white px-3 py-2 text-sm font-medium text-dark transition hover:border-dark/10 hover:bg-zinc-50">
                                                    <?php echo esc_html($use_case); ?>
                                                </a>
                                                <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>

                                    <div class="flex w-full flex-col justify-between overflow-hidden rounded-lg bg-gradient-to-br from-black via-zinc-900 to-zinc-950 p-6 text-white md:max-w-[220px]">
                                        <span class="self-start rounded-full bg-white/20 px-3 py-1 text-xs font-semibold tracking-wide text-white/90">
                                            <?php esc_html_e('Try Webmakerr', 'webmakerr'); ?>
                                        </span>
                                        <div class="mt-8">
                                            <h3 class="text-2xl font-semibold">Webmakerr</h3>
                                            <p class="mt-2 text-sm text-white/80">
                                                <?php esc_html_e('Supercharged scheduling with AI-powered calls', 'webmakerr'); ?>
                                            </p>
                                        </div>
                                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="mt-8 inline-flex items-center justify-center rounded-md bg-white px-3 py-2 text-xs font-semibold text-dark transition hover:bg-white/90">
                                            <?php esc_html_e('Contact Sales', 'webmakerr'); ?>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <?php if (current_user_can('administrator') && !has_nav_menu('primary')): ?>
                            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="text-sm text-zinc-600"><?php esc_html_e('Edit Menus', 'webmakerr'); ?></a>
                        <?php else: ?>
                            <?php
                            wp_nav_menu([
                                'container_id'    => 'primary-menu',
                                'container_class' => '',
                                'menu_class'      => 'md:flex md:-mx-4 [&_a]:!no-underline',
                                'theme_location'  => 'primary',
                                'li_class'        => 'md:mx-4',
                                'fallback_cb'     => false,
                            ]);
                            ?>
                        <?php endif; ?>
                    </nav>

                    <div class="inline-block mt-4 md:mt-0"><?php get_search_form(); ?></div>

                    <a
                        class="hidden md:inline-flex md:w-auto justify-center rounded bg-dark px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-dark/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline"
                        href="<?php echo esc_url(home_url('/contact')); ?>"
                        aria-label="<?php esc_attr_e('Contact Us', 'webmakerr'); ?>"
                    >
                        <?php esc_html_e('Contact Us', 'webmakerr'); ?>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content grow">
        <?php do_action('webmakerr_content_start'); ?>
        <main>
