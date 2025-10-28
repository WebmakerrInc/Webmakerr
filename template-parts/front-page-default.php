<?php
/**
 * Default marketing layout for the front page when no custom content exists.
 *
 * @package Webmakerr
 */
?>
<section class="border-b border-zinc-200 bg-gradient-to-b from-sky-50 via-white to-white">
    <div class="site-width py-20 sm:py-24">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-primary">
                <?php echo esc_html__('Welcome to Webmakerr', 'webmakerr'); ?>
            </p>
            <h1 class="mt-4 text-4xl font-medium tracking-tight [text-wrap:balance] text-zinc-950 sm:text-5xl">
                <?php echo esc_html__('Build a modern website in minutes.', 'webmakerr'); ?>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-base leading-8 text-zinc-600 sm:text-lg">
                <?php echo esc_html__('Webmakerr provides a polished, performance-first foundation that looks great on every device—no demo imports required.', 'webmakerr'); ?>
            </p>
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a class="inline-flex rounded-full bg-dark px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-dark/90 !no-underline" href="<?php echo esc_url('#features'); ?>">
                    <?php echo esc_html__('Explore Features', 'webmakerr'); ?>
                </a>
                <?php
                $posts_page_id = (int) get_option('page_for_posts');
                $posts_page_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
                ?>
                <a class="inline-flex rounded-full border border-zinc-200 px-4 py-1.5 text-sm font-semibold text-zinc-950 transition hover:border-zinc-300 hover:text-zinc-950 !no-underline" href="<?php echo esc_url($posts_page_url); ?>">
                    <?php echo esc_html__('Read the blog', 'webmakerr'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="features" class="site-width py-16 sm:py-20">
    <div class="mx-auto mb-12 flex max-w-3xl flex-col gap-4 text-center">
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
            <?php echo esc_html__('Designed for creators', 'webmakerr'); ?>
        </h2>
        <p class="text-base leading-7 text-zinc-600 sm:text-lg">
            <?php echo esc_html__('Everything you need to publish content, showcase your work, and grow your brand with zero setup friction.', 'webmakerr'); ?>
        </p>
    </div>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <?php
        $features = [
            [
                'title'       => __('Lightning-fast setup', 'webmakerr'),
                'description' => __('Launch instantly with a clean layout, modern typography, and accessibility-ready defaults.', 'webmakerr'),
            ],
            [
                'title'       => __('Responsive by default', 'webmakerr'),
                'description' => __('Tailwind-powered spacing and components scale beautifully across phones, tablets, and desktops.', 'webmakerr'),
            ],
            [
                'title'       => __('Block editor friendly', 'webmakerr'),
                'description' => __('Craft pages visually. Every section supports core blocks without extra plugins or imports.', 'webmakerr'),
            ],
            [
                'title'       => __('Performance focused', 'webmakerr'),
                'description' => __('Lean templates and optimized assets keep your homepage loading in a flash.', 'webmakerr'),
            ],
            [
                'title'       => __('Customizable palette', 'webmakerr'),
                'description' => __('Adjust colors, fonts, and layouts through the Customizer or theme.json with minimal effort.', 'webmakerr'),
            ],
            [
                'title'       => __('Translation ready', 'webmakerr'),
                'description' => __('All strings are localization-friendly so your brand can speak to any audience.', 'webmakerr'),
            ],
        ];

        foreach ($features as $feature) :
            ?>
            <div class="flex flex-col gap-3 rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <h3 class="text-xl font-semibold text-zinc-950">
                    <?php echo esc_html($feature['title']); ?>
                </h3>
                <p class="text-sm leading-6 text-zinc-600">
                    <?php echo esc_html($feature['description']); ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
