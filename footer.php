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
        class="relative isolate mt-16 bg-slate-950 text-slate-100"
        role="contentinfo"
    >
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top,_rgba(79,70,229,0.2),_transparent_55%)]"></div>
        <div class="mx-auto w-full max-w-6xl px-6 py-16 lg:px-8 lg:py-20">
            <?php do_action('webmakerr_footer'); ?>

            <div class="flex flex-col gap-12 lg:grid lg:grid-cols-[minmax(0,1fr)_minmax(0,1.1fr)]">
                <div class="max-w-xl space-y-8">
                    <div class="flex flex-col gap-4">
                        <?php if (has_custom_logo()) : ?>
                            <div class="flex items-center gap-4">
                                <?php the_custom_logo(); ?>
                                <?php if (display_header_text()) : ?>
                                    <a
                                        class="text-lg font-semibold tracking-tight text-slate-100"
                                        href="<?php echo esc_url(home_url('/')); ?>"
                                        rel="home"
                                    >
                                        <?php echo esc_html(get_bloginfo('name')); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <a
                                class="text-xl font-semibold tracking-tight text-slate-100"
                                href="<?php echo esc_url(home_url('/')); ?>"
                                rel="home"
                            >
                                <?php echo esc_html(get_bloginfo('name')); ?>
                            </a>
                        <?php endif; ?>

                        <?php if (get_bloginfo('description')) : ?>
                            <p class="text-base leading-relaxed text-slate-300">
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
                                class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-purple-500/30 transition hover:shadow-purple-500/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                                href="<?php echo esc_url($cta_url); ?>"
                                target="<?php echo esc_attr($cta_target); ?>"
                                <?php echo $cta_rel ? 'rel="'.esc_attr($cta_rel).'"' : ''; ?>
                            >
                                <?php echo esc_html($cta_label); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php
                    $contact_label = get_theme_mod('footer_contact_label');
                    $contact_email = get_theme_mod('footer_contact_email', get_bloginfo('admin_email'));

                    if ($contact_label && $contact_email) :
                        ?>
                        <div class="text-sm text-slate-400">
                            <a
                                class="inline-flex items-center gap-2 text-slate-300 transition hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                                href="mailto:<?php echo esc_attr($contact_email); ?>"
                            >
                                <span class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">
                                    <?php echo esc_html($contact_label); ?>
                                </span>
                                <span class="text-sm font-medium text-slate-100">
                                    <?php echo esc_html($contact_email); ?>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (has_nav_menu('footer')) : ?>
                    <nav aria-label="<?php esc_attr_e('Footer', 'webmakerr'); ?>">
                        <?php
                        echo wp_nav_menu([
                            'theme_location' => 'footer',
                            'container'      => '',
                            'menu_class'     => 'grid list-none gap-10 sm:grid-cols-2 lg:grid-cols-3',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s" role="list">%3$s</ul>',
                            'depth'          => 2,
                            'fallback_cb'    => '__return_empty_string',
                            'echo'           => false,
                        ]);
                        ?>
                    </nav>
                <?php endif; ?>
            </div>

            <div class="mt-16 flex flex-col gap-6 border-t border-white/10 pt-8 text-sm text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-center sm:text-left">
                    &copy; <?php echo esc_html(date_i18n('Y')); ?>
                    <span class="font-medium text-slate-200">
                        <?php echo esc_html(get_bloginfo('name')); ?>
                    </span>
                </p>

                <?php
                $footer_note = get_theme_mod('footer_additional_note');

                if ($footer_note) :
                    ?>
                    <p class="text-center sm:text-right text-slate-400">
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
