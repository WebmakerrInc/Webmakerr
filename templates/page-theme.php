<?php
/**
 * Template Name: Theme Overview
 * Description: Highlights the core theme features with a hero section and flexible content area.
 *
 * @package Webmakerr
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="primary" class="bg-white py-16 sm:py-20 lg:py-24">
  <div class="mx-auto w-full max-w-5xl px-4 sm:px-6 lg:px-8">
    <?php while (have_posts()) : the_post(); ?>
      <article <?php post_class('flex flex-col gap-10 text-left'); ?>>
        <header class="flex flex-col gap-4">
          <p class="text-sm font-semibold uppercase tracking-[0.3em] text-primary"><?php esc_html_e('Theme', 'webmakerr'); ?></p>
          <?php the_title('<h1 class="text-4xl font-medium tracking-tight text-zinc-950 sm:text-5xl">', '</h1>'); ?>
          <p class="max-w-2xl text-base leading-7 text-zinc-600 sm:text-lg"><?php echo esc_html(get_post_meta(get_the_ID(), '_webmakerr_theme_intro', true)); ?></p>
        </header>

        <div class="prose max-w-none text-zinc-700 sm:prose-lg">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<?php
get_footer();
