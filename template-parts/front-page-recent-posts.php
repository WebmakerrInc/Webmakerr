<?php
/**
 * Template part for displaying recent posts on the front page.
 *
 * @package Webmakerr
 */

$recent_posts = new WP_Query([
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
]);
?>
<section class="bg-light py-24">
    <div class="site-width flex flex-col gap-12">
        <div class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
                <?php echo esc_html__('Latest insights', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg">
                <?php echo esc_html__('Stay up to date with recent articles, tutorials, and announcements from your team.', 'webmakerr'); ?>
            </p>
        </div>

        <?php if ($recent_posts->have_posts()) : ?>
            <div class="grid gap-8 md:grid-cols-3">
                <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <article <?php post_class('flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg'); ?>>
                        <div class="flex flex-col gap-2">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">
                                <?php echo esc_html(get_the_date()); ?>
                            </time>
                            <h3 class="text-xl font-semibold text-zinc-950">
                                <a class="transition hover:text-primary !no-underline" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                        </div>
                        <div class="text-sm leading-6 text-zinc-600 [&_a]:text-primary">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="mt-auto">
                            <a class="inline-flex rounded-full bg-dark px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-dark/90 !no-underline" href="<?php the_permalink(); ?>">
                                <?php echo esc_html__('Read more', 'webmakerr'); ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-center text-sm text-zinc-600">
                <?php echo esc_html__('No posts yet. Publish your first article to see it here.', 'webmakerr'); ?>
            </p>
        <?php endif; ?>
    </div>
</section>
<?php
wp_reset_postdata();
