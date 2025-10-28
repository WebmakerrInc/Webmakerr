<?php
/**
 * Template for the front page.
 *
 * @package Webmakerr
 */

get_header();
?>

<div class="flex flex-col gap-24 lg:gap-32">
  <section class="border-b border-zinc-200 bg-gradient-to-b from-sky-50 via-white to-white">
    <div class="container mx-auto px-6 py-20 sm:py-24 lg:px-8">
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

  <section id="features" class="container mx-auto px-6 lg:px-8">
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
      $features = array(
        array(
          'title'       => __('Lightning-fast setup', 'webmakerr'),
          'description' => __('Launch instantly with a clean layout, modern typography, and accessibility-ready defaults.', 'webmakerr'),
        ),
        array(
          'title'       => __('Responsive by default', 'webmakerr'),
          'description' => __('Tailwind-powered spacing and components scale beautifully across phones, tablets, and desktops.', 'webmakerr'),
        ),
        array(
          'title'       => __('Block editor friendly', 'webmakerr'),
          'description' => __('Craft pages visually. Every section supports core blocks without extra plugins or imports.', 'webmakerr'),
        ),
        array(
          'title'       => __('Performance focused', 'webmakerr'),
          'description' => __('Lean templates and optimized assets keep your homepage loading in a flash.', 'webmakerr'),
        ),
        array(
          'title'       => __('Customizable palette', 'webmakerr'),
          'description' => __('Adjust colors, fonts, and layouts through the Customizer or theme.json with minimal effort.', 'webmakerr'),
        ),
        array(
          'title'       => __('Translation ready', 'webmakerr'),
          'description' => __('All strings are localization-friendly so your brand can speak to any audience.', 'webmakerr'),
        ),
      );

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

  <section class="bg-light py-24">
    <div class="container mx-auto flex flex-col gap-12 px-6 lg:px-8">
      <div class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
          <?php echo esc_html__('Latest insights', 'webmakerr'); ?>
        </h2>
        <p class="text-base leading-7 text-zinc-600 sm:text-lg">
          <?php echo esc_html__('Stay up to date with recent articles, tutorials, and announcements from your team.', 'webmakerr'); ?>
        </p>
      </div>

      <?php
      $recent_posts = new WP_Query(
        array(
          'post_type'           => 'post',
          'posts_per_page'      => 3,
          'ignore_sticky_posts' => true,
        )
      );

      if ($recent_posts->have_posts()) :
        ?>
        <div class="grid gap-8 md:grid-cols-3">
          <?php
          while ($recent_posts->have_posts()) :
            $recent_posts->the_post();
            ?>
            <article <?php post_class('flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg'); ?>>
              <div class="flex flex-col gap-2">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">
                  <?php echo esc_html(get_the_date()); ?>
                </time>
                <h3 class="text-xl font-semibold text-zinc-950">
                  <a class="transition hover:text-primary !no-underline" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>
              </div>
              <div class="text-sm leading-6 text-zinc-600 [&_a]:text-primary">
                <?php the_excerpt(); ?>
              </div>
              <div class="mt-auto">
                <a class="inline-flex rounded-full bg-dark px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-dark/90 !no-underline" href="<?php the_permalink(); ?>">
                  <?php echo esc_html__('Read more', 'webmakerr'); ?>
                </a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <p class="text-center text-sm text-zinc-600">
          <?php echo esc_html__('No posts yet. Publish your first article to see it here.', 'webmakerr'); ?>
        </p>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  </section>
</div>

<?php
get_footer();
