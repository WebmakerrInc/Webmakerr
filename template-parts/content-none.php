<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @package Webmakerr
 */
?>
<section class="py-16 text-center">
    <h2 class="text-2xl font-semibold text-zinc-950"><?php esc_html_e('Nothing Found', 'webmakerr'); ?></h2>
    <p class="mt-4 text-base text-zinc-600">
        <?php if (is_search()): ?>
            <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'webmakerr'); ?>
        <?php else: ?>
            <?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'webmakerr'); ?>
        <?php endif; ?>
    </p>
    <div class="mt-6 max-w-md mx-auto">
        <?php get_search_form(); ?>
    </div>
</section>
