<?php
/**
 * Page template file.
 *
 * @package Webmakerr
 */

get_header();
?>

<div class="flex flex-col gap-24 lg:gap-32">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('template-parts/content', 'single'); ?>

            <?php if (comments_open() || get_comments_number()): ?>
                <section class="site-width">
                    <?php comments_template(); ?>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php
get_footer();
