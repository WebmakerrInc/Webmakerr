<?php
/**
 * Template for the front page.
 *
 * @package Webmakerr
 */

get_header();
?>

<div class="flex flex-col gap-24 lg:gap-32">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            $post_content = get_post_field('post_content', get_the_ID());

            if (trim((string) $post_content) !== '') {
                get_template_part('template-parts/content', 'front-page');
            } else {
                get_template_part('template-parts/front-page', 'default');
            }
            ?>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="container mx-auto px-6 lg:px-8">
            <?php get_template_part('template-parts/content', 'none'); ?>
        </div>
    <?php endif; ?>

    <?php get_template_part('template-parts/front-page', 'recent-posts'); ?>
</div>

<?php
get_footer();
