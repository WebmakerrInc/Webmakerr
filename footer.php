<?php
/**
 * Theme footer template.
 *
 * @package Webmakerr
 */
?>
        </main>

        <?php do_action('webmakerr_content_end'); ?>
    </div>

    <?php do_action('webmakerr_content_after'); ?>

    <footer id="colophon" class="bg-light/50 mt-12" role="contentinfo">
        <div class="container mx-auto py-12">
            <?php do_action('webmakerr_footer'); ?>
            <div class="text-center text-sm text-zinc-500 space-y-2">
                <p class="text-zinc-600">
                    &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>
                    <a
                        class="font-medium text-zinc-700 hover:text-zinc-900 transition"
                        href="<?php echo esc_url( home_url( '/' ) ); ?>"
                        rel="home"
                    >
                        <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                    </a>.
                    <?php esc_html_e( 'All rights reserved.', 'webmakerr' ); ?>
                </p>
                <p>
                    <a
                        class="text-zinc-500 hover:text-zinc-700 transition"
                        href="<?php echo esc_url( 'https://webmakerr.com' ); ?>"
                        target="_blank"
                        rel="noopener"
                    >
                        <?php esc_html_e( 'Built with ❤ by Webmakerr', 'webmakerr' ); ?>
                    </a>
                </p>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
