<article id="post-<?php the_ID(); ?>" <?php post_class('mx-auto flex max-w-4xl flex-col gap-32'); ?>>
    <header class="flex flex-col items-center text-center gap-16">
        <?php if(! is_page()): ?>
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished" class="text-sm font-medium text-muted-text"><?php echo esc_html(get_the_date()); ?></time>
        <?php endif; ?>

        <h1 class="text-dark">
            <?php echo esc_html(get_the_title()); ?>
        </h1>

        <?php if(! is_page()): ?>
            <p class="text-sm font-medium text-muted-text"><?php printf(esc_html__('by %s', 'webmakerr'), esc_html(get_the_author())); ?></p>
        <?php endif; ?>
    </header>

    <?php if(has_post_thumbnail()): ?>
        <div class="overflow-hidden rounded-xl border border-border bg-light shadow-subtle">
            <?php the_post_thumbnail('large', ['class' => 'aspect-[16/10] w-full object-cover']); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content space-y-24">
        <?php the_content(); ?>
    </div>
</article>
