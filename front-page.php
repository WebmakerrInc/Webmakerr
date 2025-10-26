<?php
/**
 * Template for the front page.
 *
 * @package Webmakerr
 */

get_header();
?>

<main id="primary" class="flex flex-col gap-24 lg:gap-32">
        <section class="relative overflow-hidden bg-slate-900 py-24 text-white">
                <div class="absolute inset-0 opacity-50" aria-hidden="true">
                        <div class="h-full w-full bg-gradient-to-br from-cyan-500 via-slate-900 to-purple-600"></div>
                </div>
                <div class="relative z-10 mx-auto flex max-w-6xl flex-col gap-8 px-6 text-center lg:px-8">
                        <p class="text-sm font-semibold uppercase tracking-widest text-cyan-200">
                                <?php echo esc_html__('Welcome to Webmakerr', 'webmakerr'); ?>
                        </p>
                        <h1 class="text-4xl font-bold leading-tight sm:text-5xl lg:text-6xl">
                                <?php echo esc_html__('Build a modern website in minutes.', 'webmakerr'); ?>
                        </h1>
                        <p class="mx-auto max-w-3xl text-lg text-slate-200 lg:text-xl">
                                <?php echo esc_html__('Webmakerr provides a polished, performance-first foundation that looks great on every device—no demo imports required.', 'webmakerr'); ?>
                        </p>
                        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                                <a class="inline-flex items-center rounded-full bg-cyan-500 px-8 py-3 text-base font-semibold text-slate-900 transition hover:bg-cyan-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-300" href="<?php echo esc_url('#features'); ?>">
                                        <?php echo esc_html__('Explore Features', 'webmakerr'); ?>
                                </a>
                                <?php
                                $posts_page_id = (int) get_option('page_for_posts');
                                $posts_page_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
                                ?>
                                <a class="inline-flex items-center px-8 py-3 text-base font-semibold text-white transition hover:text-cyan-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-300" href="<?php echo esc_url($posts_page_url); ?>">
                                        <?php echo esc_html__('Read the blog', 'webmakerr'); ?>
                                </a>
                        </div>
                </div>
        </section>

        <section id="features" class="mx-auto max-w-6xl px-6 lg:px-8">
                <div class="mb-12 flex flex-col gap-4 text-center">
                        <h2 class="text-3xl font-semibold text-slate-900 sm:text-4xl">
                                <?php echo esc_html__('Designed for creators', 'webmakerr'); ?>
                        </h2>
                        <p class="mx-auto max-w-2xl text-base text-slate-600">
                                <?php echo esc_html__('Everything you need to publish content, showcase your work, and grow your brand with zero setup friction.', 'webmakerr'); ?>
                        </p>
                </div>

                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <?php
                        $features = array(
                                array(
                                        'title'       => __('Lightning-fast setup', 'webmakerr'),
                                        'description' => __('Launch instantly with a clean layout, modern typography, and accessibility-ready defaults.', 'webmakerr'),
                                ),
                                array(
                                        'title'       => __('Responsive by default', 'webmakerr'),
                                        'description' => __('Tailwind-powered spacing and components scale beautifully across phones, tablets, and desktops.', 'webmakerr'),
                                ),
                                array(
                                        'title'       => __('Block editor friendly', 'webmakerr'),
                                        'description' => __('Craft pages visually. Every section supports core blocks without extra plugins or imports.', 'webmakerr'),
                                ),
                                array(
                                        'title'       => __('Performance focused', 'webmakerr'),
                                        'description' => __('Lean templates and optimized assets keep your homepage loading in a flash.', 'webmakerr'),
                                ),
                                array(
                                        'title'       => __('Customizable palette', 'webmakerr'),
                                        'description' => __('Adjust colors, fonts, and layouts through the Customizer or theme.json with minimal effort.', 'webmakerr'),
                                ),
                                array(
                                        'title'       => __('Translation ready', 'webmakerr'),
                                        'description' => __('All strings are localization-friendly so your brand can speak to any audience.', 'webmakerr'),
                                ),
                        );

                        foreach ($features as $feature) :
                                ?>
                                <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                                        <h3 class="text-xl font-semibold text-slate-900">
                                                <?php echo esc_html($feature['title']); ?>
                                        </h3>
                                        <p class="text-sm leading-relaxed text-slate-600">
                                                <?php echo esc_html($feature['description']); ?>
                                        </p>
                                </div>
                        <?php endforeach; ?>
                </div>
        </section>

        <section class="bg-slate-50 py-24">
                <div class="mx-auto flex max-w-6xl flex-col gap-12 px-6 lg:px-8">
                        <div class="flex flex-col gap-4 text-center">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-4xl">
                                        <?php echo esc_html__('Latest insights', 'webmakerr'); ?>
                                </h2>
                                <p class="mx-auto max-w-2xl text-base text-slate-600">
                                        <?php echo esc_html__('Stay up to date with recent articles, tutorials, and announcements from your team.', 'webmakerr'); ?>
                                </p>
                        </div>

                        <?php
                        $recent_posts = new WP_Query(
                                array(
                                        'post_type'           => 'post',
                                        'posts_per_page'      => 3,
                                        'ignore_sticky_posts' => true,
                                )
                        );

                        if ($recent_posts->have_posts()) :
                                ?>
                                <div class="grid gap-8 md:grid-cols-3">
                                        <?php
                                        while ($recent_posts->have_posts()) :
                                                $recent_posts->the_post();
                                                ?>
                                                <article <?php post_class('flex flex-col gap-4 rounded-2xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md'); ?>>
                                                        <div class="flex flex-col gap-2">
                                                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-xs font-semibold uppercase tracking-widest text-cyan-600">
                                                                        <?php echo esc_html(get_the_date()); ?>
                                                                </time>
                                                                <h3 class="text-xl font-semibold text-slate-900">
                                                                        <a class="transition hover:text-cyan-600" href="<?php the_permalink(); ?>">
                                                                                <?php the_title(); ?>
                                                                        </a>
                                                                </h3>
                                                        </div>
                                                        <div class="prose prose-slate max-w-none text-sm text-slate-600">
                                                                <?php the_excerpt(); ?>
                                                        </div>
                                                        <div class="mt-auto">
                                                                <a class="inline-flex items-center text-sm font-semibold text-cyan-600 transition hover:text-cyan-500" href="<?php the_permalink(); ?>">
                                                                        <?php echo esc_html__('Read more', 'webmakerr'); ?>
                                                                </a>
                                                        </div>
                                                </article>
                                        <?php endwhile; ?>
                                </div>
                        <?php else : ?>
                                <p class="text-center text-sm text-slate-600">
                                        <?php echo esc_html__('No posts yet. Publish your first article to see it here.', 'webmakerr'); ?>
                                </p>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                </div>
        </section>
</main>

<?php
get_footer();
