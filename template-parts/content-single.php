<article id="post-<?php the_ID(); ?>" <?php post_class('flex flex-col'); ?>>
    <section>
        <div class="site-width py-16 sm:py-24">
            <div class="mx-auto max-w-3xl text-center">
                <?php if (!is_page()): ?>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished" class="text-xs font-semibold uppercase tracking-[0.3em] text-primary"><?php echo esc_html(get_the_date()); ?></time>
                <?php endif; ?>

                <?php if (is_page()): ?>
                    <h1 class="screen-reader-text"><?php echo esc_html(get_the_title()); ?></h1>
                <?php else: ?>
                    <h1 class="mt-4 text-4xl font-medium tracking-tight [text-wrap:balance] text-zinc-950 sm:text-5xl"><?php echo esc_html(get_the_title()); ?></h1>
                <?php endif; ?>

                <?php if (!is_page()): ?>
                    <p class="mt-4 text-sm font-semibold text-zinc-950"><?php printf(esc_html__('by %s', 'webmakerr'), esc_html(get_the_author())); ?></p>
                <?php endif; ?>

                <?php
                $excerpt = get_the_excerpt();

                if (!empty($excerpt)):
                    ?>
                    <div class="mx-auto mt-6 max-w-2xl text-base leading-8 text-zinc-600 sm:text-lg">
                        <?php echo wp_kses_post(wpautop($excerpt)); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if (has_post_thumbnail()): ?>
        <div class="site-width -mt-12">
            <figure class="mx-auto max-w-4xl overflow-hidden rounded-4xl border border-zinc-200 bg-white shadow-sm">
                <?php the_post_thumbnail('large', ['class' => 'aspect-[16/10] w-full object-cover']); ?>
            </figure>
        </div>
    <?php endif; ?>

    <section class="site-width pb-24 pt-16">
        <?php
        $entry_classes = [
            'entry-content',
            'mx-auto',
            'text-base',
            'leading-7',
            'text-zinc-600',
            'sm:text-lg',
            '[&_a]:text-primary',
            '[&_a]:underline',
            '[&_a:hover]:text-primary/80',
            '[&_blockquote]:border-l-4',
            '[&_blockquote]:border-primary',
            '[&_blockquote]:pl-4',
            '[&_blockquote]:text-zinc-950',
            '[&_h2]:mt-12',
            '[&_h2]:text-3xl',
            '[&_h2]:font-semibold',
            '[&_h2]:text-zinc-950',
            '[&_h3]:mt-10',
            '[&_h3]:text-2xl',
            '[&_h3]:font-semibold',
            '[&_h3]:text-zinc-950',
            '[&_.wp-block-button__link]:inline-flex',
            '[&_.wp-block-button__link]:items-center',
            '[&_.wp-block-button__link]:justify-center',
            '[&_.wp-block-button__link]:rounded-full',
            '[&_.wp-block-button__link]:bg-dark',
            '[&_.wp-block-button__link]:px-4',
            '[&_.wp-block-button__link]:py-1.5',
            '[&_.wp-block-button__link]:text-sm',
            '[&_.wp-block-button__link]:font-semibold',
            '[&_.wp-block-button__link]:text-white',
            '[&_.wp-block-button__link:hover]:bg-dark/90',
            '[&_.wp-block-quote]:border-l-4',
            '[&_.wp-block-quote]:border-primary',
            '[&_.wp-block-quote]:pl-4',
        ];

        if (is_page()) {
            $entry_classes[] = 'max-w-none';
        } else {
            $entry_classes[] = 'max-w-3xl';
        }
        ?>
        <div class="<?php echo esc_attr(implode(' ', $entry_classes)); ?>">
            <?php the_content(); ?>

            <?php
            wp_link_pages([
                'before'      => '<nav class="post-pagination mt-12" aria-label="' . esc_attr__('Post pages', 'webmakerr') . '"><span class="post-pagination__title">' . esc_html__('Pages:', 'webmakerr') . '</span>',
                'after'       => '</nav>',
                'link_before' => '<span class="post-pagination__item">',
                'link_after'  => '</span>',
            ]);
            ?>
        </div>
    </section>
</article>
