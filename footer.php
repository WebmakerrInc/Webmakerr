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

    <footer
        id="colophon"
        class="mt-16 border-t border-neutral-200 bg-neutral-50 text-neutral-900"
        role="contentinfo"
    >
        <div class="mx-auto w-full max-w-6xl px-6 py-12 lg:px-8 lg:py-16 space-y-8">
            <?php do_action('webmakerr_footer'); ?>

            <div class="grid gap-8 md:grid-cols-2">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widgets text-sm text-neutral-600">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>

                <?php if (has_nav_menu('footer')) : ?>
                    <nav class="footer-navigation text-sm text-neutral-600" aria-label="<?php esc_attr_e('Footer menu', 'webmakerr'); ?>">
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'footer',
                                'container'      => '',
                                'menu_class'     => 'space-y-2 md:flex md:flex-wrap md:gap-x-6 md:gap-y-2',
                                'depth'          => 1,
                                'fallback_cb'    => false,
                            ]
                        );
                        ?>
                    </nav>
                <?php endif; ?>
            </div>

            <div class="site-info text-center text-xs text-neutral-500 md:flex md:items-center md:justify-between md:text-sm">
                <p>
                    <?php
                    printf(
                        esc_html__('Copyright © %1$s %2$s.', 'webmakerr'),
                        esc_html(date_i18n('Y')),
                        '<span class="font-medium text-neutral-900">' . esc_html(get_bloginfo('name')) . '</span>'
                    );
                    ?>
                </p>

                <?php
                $wordpress_link = '<a class="text-primary transition hover:text-neutral-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-900" href="' . esc_url('https://wordpress.org/') . '">' .
                    esc_html__('WordPress', 'webmakerr') .
                    '</a>';
                $theme_author_link = '<a class="text-primary transition hover:text-neutral-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-900" href="https://webmakerr.com/">' .
                    esc_html__('Webmakerr', 'webmakerr') .
                    '</a>';
                $powered_by = sprintf(
                    __('Proudly powered by %1$s and %2$s.', 'webmakerr'),
                    $wordpress_link,
                    $theme_author_link
                );
                ?>
                <p><?php echo wp_kses($powered_by, ['a' => ['href' => [], 'class' => []]]); ?></p>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
