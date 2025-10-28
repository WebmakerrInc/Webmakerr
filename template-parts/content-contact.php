<?php
/**
 * Template part for displaying the editable Contact page content.
 *
 * @package Webmakerr
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('flex flex-col gap-12'); ?>>
    <header class="mx-auto max-w-3xl text-center">
        <h1 class="screen-reader-text"><?php echo esc_html(get_the_title()); ?></h1>

        <?php if (has_excerpt()) : ?>
            <div class="mx-auto mt-6 max-w-2xl text-base leading-8 text-zinc-600 sm:text-lg">
                <?php echo wp_kses_post(wpautop(get_the_excerpt())); ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-content mx-auto w-full max-w-none text-base leading-7 text-zinc-600 sm:text-lg [&_a]:text-primary [&_a]:underline [&_a:hover]:text-primary/80">
        <?php the_content(); ?>

        <?php
        wp_link_pages([
            'before'      => '<nav class="post-pagination mt-12" aria-label="' . esc_attr__('Page navigation', 'webmakerr') . '"><span class="post-pagination__title">' . esc_html__('Pages:', 'webmakerr') . '</span>',
            'after'       => '</nav>',
            'link_before' => '<span class="post-pagination__item">',
            'link_after'  => '</span>',
        ]);
        ?>
    </div>
</article>
