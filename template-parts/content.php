<article id="post-<?php the_ID(); ?>" <?php post_class('rounded-xl border border-border bg-white p-24 shadow-subtle'); ?>>
    <div class="flex flex-col gap-24 lg:flex-row lg:items-start">
        <dl class="flex flex-col gap-16 text-sm text-muted-text lg:w-1/3">
            <dt class="sr-only"><?php esc_html_e('Published', 'webmakerr'); ?></dt>
            <dd>
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished" class="font-medium text-muted-text">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
            </dd>
            <dt class="sr-only"><?php esc_html_e('Author', 'webmakerr'); ?></dt>
            <dd class="flex items-center gap-16">
                <div class="flex-none overflow-hidden rounded-lg bg-light">
                    <?php
                        echo get_avatar(get_the_author_meta('ID'), 48, '', esc_attr(sprintf(esc_html__('Avatar for %s', 'webmakerr'), wp_strip_all_tags(get_the_author()))), [
                            'class' => 'size-48 object-cover',
                        ]);
                    ?>
                </div>
                <div class="font-medium text-text"><?php echo esc_html(get_the_author()); ?></div>
            </dd>
        </dl>

        <div class="flex-1 space-y-16">
            <h2 class="text-dark">
                <a href="<?php echo esc_url(get_permalink()); ?>" class="text-dark transition hover:opacity-90">
                    <?php echo esc_html(get_the_title()); ?>
                </a>
            </h2>
            <div class="text-muted-text">
                <?php the_excerpt(); ?>
            </div>
            <a class="btn-primary !no-underline" aria-label="<?php echo esc_attr(sprintf(esc_html__('Read more: %s', 'webmakerr'), wp_strip_all_tags(get_the_title()))); ?>" href="<?php echo esc_url(get_permalink()); ?>">
                <?php esc_html_e('Read more', 'webmakerr'); ?>
            </a>
        </div>
    </div>
</article>
