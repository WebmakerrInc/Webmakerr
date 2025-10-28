<?php
/**
 * Template Name: Contact
 * Description: Contact page template that prioritizes editor-managed content.
 *
 * @package Webmakerr
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<div class="bg-white py-16 sm:py-20 lg:py-24">
    <div class="site-width">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $post_content = get_post_field('post_content', get_the_ID());

                if (trim((string) $post_content) !== '') {
                    get_template_part('template-parts/content', 'contact');
                } else {
                    get_template_part('template-parts/page', 'contact-default');
                }
                ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
