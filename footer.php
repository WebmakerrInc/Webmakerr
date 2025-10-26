<?php
/**
 * Theme footer template.
 *
 * @package Webmakerr
 */

use Webmakerr\Walkers\FooterMenuWalker;
?>
        </main>

        <?php do_action('webmakerr_content_end'); ?>
    </div>

    <?php do_action('webmakerr_content_after'); ?>

    <footer
        id="colophon"
        class="mt-16 border-t border-neutral-200 bg-white text-neutral-900"
        role="contentinfo"
    >
        <div class="mx-auto w-full max-w-6xl px-6 py-16 lg:px-8 lg:py-20">
            <?php do_action('webmakerr_footer'); ?>

            <div class="flex flex-col gap-12 lg:flex-row lg:items-start lg:justify-between">
                <div class="max-w-md space-y-6">
                    <div class="flex flex-col gap-4 text-neutral-600">
                        <?php if (has_custom_logo()) : ?>
                            <div class="flex items-center gap-4">
                                <div class="footer-logo flex items-center">
                                    <?php the_custom_logo(); ?>
                                </div>
                                <?php if (display_header_text()) : ?>
                                    <a
                                        class="text-base font-semibold text-neutral-900 no-underline transition hover:opacity-70"
                                        href="<?php echo esc_url(home_url('/')); ?>"
                                        rel="home"
                                    >
                                        <?php echo esc_html(get_bloginfo('name')); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <a
                                class="text-lg font-semibold text-neutral-900 no-underline transition hover:opacity-70"
                                href="<?php echo esc_url(home_url('/')); ?>"
                                rel="home"
                            >
                                <?php echo esc_html(get_bloginfo('name')); ?>
                            </a>
                        <?php endif; ?>

                        <?php if (get_bloginfo('description')) : ?>
                            <p class="text-sm leading-relaxed text-neutral-500">
                                <?php echo esc_html(get_bloginfo('description')); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <?php
                    $cta_label = get_theme_mod('footer_primary_link_label');
                    $cta_url   = get_theme_mod('footer_primary_link_url');
                    $cta_target = get_theme_mod('footer_primary_link_target', '_self');
                    $cta_rel = get_theme_mod('footer_primary_link_rel');

                    if (! $cta_rel && '_self' !== $cta_target) {
                        $cta_rel = 'noopener';
                    }

                    if ($cta_label && $cta_url) :
                        ?>
                        <div>
                            <a
                                class="inline-flex items-center gap-2 text-sm font-medium text-neutral-900 no-underline transition-colors duration-200 hover:opacity-70"
                                href="<?php echo esc_url($cta_url); ?>"
                                target="<?php echo esc_attr($cta_target); ?>"
                                <?php echo $cta_rel ? 'rel="'.esc_attr($cta_rel).'"' : ''; ?>
                            >
                                <span><?php echo esc_html($cta_label); ?></span>
                                <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M3.75 12.25L12.25 3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.5 3.75H12.25V11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php
                    $contact_label = get_theme_mod('footer_contact_label');
                    $contact_email = get_theme_mod('footer_contact_email', get_bloginfo('admin_email'));

                    if ($contact_label && $contact_email) :
                        ?>
                        <div>
                            <a
                                class="inline-flex items-center gap-2 text-sm text-neutral-600 no-underline transition hover:text-neutral-900"
                                href="mailto:<?php echo esc_attr($contact_email); ?>"
                            >
                                <span class="font-medium text-neutral-900">
                                    <?php echo esc_html($contact_label); ?>
                                </span>
                                <span class="text-neutral-500">
                                    <?php echo esc_html($contact_email); ?>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (has_nav_menu('footer')) : ?>
                    <nav aria-label="<?php esc_attr_e('Footer', 'webmakerr'); ?>" class="w-full lg:max-w-3xl">
                        <?php
                        echo wp_nav_menu([
                            'theme_location' => 'footer',
                            'container'      => '',
                            'menu_class'     => 'grid gap-0 md:grid-cols-2 md:gap-10 lg:grid-cols-3',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s" role="list">%3$s</ul>',
                            'depth'          => 2,
                            'fallback_cb'    => '__return_empty_string',
                            'walker'         => new FooterMenuWalker(),
                        ]);
                        ?>
                    </nav>
                <?php endif; ?>
            </div>

            <div class="mt-16 flex flex-col gap-4 border-t border-neutral-200 pt-6 text-sm text-neutral-500 md:flex-row md:items-center md:justify-between">
                <p class="text-center md:text-left">
                    &copy; <?php echo esc_html(date_i18n('Y')); ?>
                    <span class="font-medium text-neutral-900">
                        <?php echo esc_html(get_bloginfo('name')); ?>
                    </span>
                </p>

                <?php
                $footer_note = get_theme_mod('footer_additional_note');

                if ($footer_note) :
                    ?>
                    <p class="text-center text-neutral-500 md:text-right">
                        <?php echo wp_kses_post($footer_note); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
