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

    <footer id="colophon" class="mt-48 border-t border-border/60 bg-light/80 backdrop-blur" role="contentinfo">
        <div class="container py-32">
            <?php do_action('webmakerr_footer'); ?>
            <div class="space-y-16 text-center text-sm text-muted-text">
                <p class="text-text">
                    &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>
                    <a
                        class="font-medium text-dark transition hover:opacity-90"
                        href="<?php echo esc_url( home_url( '/' ) ); ?>"
                        rel="home"
                    >
                        <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                    </a>.
                    <?php esc_html_e( 'All rights reserved.', 'webmakerr' ); ?>
                </p>
                <p>
                    <a
                        class="font-medium text-muted-text transition hover:text-dark"
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
