<?php
/**
 * Template for the front page.
 *
 * @package Webmakerr
 */

get_header();
?>

<main id="primary" class="flex flex-col gap-48">
        <section class="bg-dark py-64 text-white">
                <div class="container flex flex-col items-center gap-24 text-center">
                        <p class="text-sm font-medium uppercase tracking-[0.3em] text-secondary">
                                <?php echo esc_html__('Welcome to Webmakerr', 'webmakerr'); ?>
                        </p>
                        <h1 class="max-w-3xl text-white">
                                <?php echo esc_html__('Build a modern website in minutes.', 'webmakerr'); ?>
                        </h1>
                        <p class="max-w-2xl text-muted-text/90">
                                <?php echo esc_html__('Webmakerr provides a polished, performance-first foundation that looks great on every device—no demo imports required.', 'webmakerr'); ?>
                        </p>
                        <div class="flex flex-col items-center justify-center gap-16 sm:flex-row">
                                <a class="btn-primary" href="<?php echo esc_url('#features'); ?>">
                                        <?php echo esc_html__('Explore Features', 'webmakerr'); ?>
                                </a>
                                <?php
                                $posts_page_id = (int) get_option('page_for_posts');
                                $posts_page_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
                                ?>
                                <a class="btn-secondary" href="<?php echo esc_url($posts_page_url); ?>">
                                        <?php echo esc_html__('Read the blog', 'webmakerr'); ?>
                                </a>
                        </div>
                </div>
        </section>

        <section id="features" class="container">
                <div class="flex flex-col items-center gap-16 text-center">
                        <h2 class="text-dark">
                                <?php echo esc_html__('Designed for creators', 'webmakerr'); ?>
                        </h2>
                        <p class="max-w-2xl text-muted-text">
                                <?php echo esc_html__('Everything you need to publish content, showcase your work, and grow your brand with zero setup friction.', 'webmakerr'); ?>
                        </p>
                </div>

                <div class="mt-32 grid gap-24 sm:grid-cols-2 lg:grid-cols-3">
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
                                <div class="flex flex-col gap-16 rounded-xl border border-border bg-white p-24 shadow-subtle transition-transform hover:-translate-y-1">
                                        <h3 class="text-dark">
                                                <?php echo esc_html($feature['title']); ?>
                                        </h3>
                                        <p class="text-sm leading-relaxed text-muted-text">
                                                <?php echo esc_html($feature['description']); ?>
                                        </p>
                                </div>
                        <?php endforeach; ?>
                </div>
        </section>

        <section class="bg-light py-64">
                <div class="container flex flex-col gap-32">
                        <div class="flex flex-col items-center gap-16 text-center">
                                <h2 class="text-dark">
                                        <?php echo esc_html__('Latest insights', 'webmakerr'); ?>
                                </h2>
                                <p class="max-w-2xl text-muted-text">
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
                                <div class="grid gap-24 md:grid-cols-3">
                                        <?php
                                        while ($recent_posts->have_posts()) :
                                                $recent_posts->the_post();
                                                ?>
                                                <article <?php post_class('flex h-full flex-col gap-16 rounded-xl border border-border bg-white p-24 shadow-subtle transition-transform hover:-translate-y-1'); ?>>
                                                        <div class="flex flex-col gap-16">
                                                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-xs font-medium uppercase tracking-[0.3em] text-secondary">
                                                                        <?php echo esc_html(get_the_date()); ?>
                                                                </time>
                                                                <h3 class="text-dark">
                                                                        <a class="text-dark transition hover:opacity-90" href="<?php the_permalink(); ?>">
                                                                                <?php the_title(); ?>
                                                                        </a>
                                                                </h3>
                                                        </div>
                                                        <div class="text-sm text-muted-text">
                                                                <?php the_excerpt(); ?>
                                                        </div>
                                                        <div class="mt-auto">
                                                                <a class="inline-flex items-center text-sm font-medium text-primary transition hover:opacity-90" href="<?php the_permalink(); ?>">
                                                                        <?php echo esc_html__('Read more', 'webmakerr'); ?>
                                                                </a>
                                                        </div>
                                                </article>
                                        <?php endwhile; ?>
                                </div>
                        <?php else : ?>
                                <p class="text-center text-sm text-muted-text">
                                        <?php echo esc_html__('No posts yet. Publish your first article to see it here.', 'webmakerr'); ?>
                                </p>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                </div>
        </section>
</main>

<?php
get_footer();
