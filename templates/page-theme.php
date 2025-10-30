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

<main id="primary" class="flex flex-col bg-white">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $intro            = trim((string) get_post_meta(get_the_ID(), '_webmakerr_theme_intro', true));
    $intro_default    = __('A modern, composable WordPress starter theme built with Tailwind CSS and optimized for fast iteration.', 'webmakerr');
    $primary_cta_url  = get_post_meta(get_the_ID(), '_webmakerr_theme_cta_primary_url', true) ?: home_url('/contact');
    $primary_cta_text = get_post_meta(get_the_ID(), '_webmakerr_theme_cta_primary_label', true) ?: __('Start building', 'webmakerr');
    $secondary_cta_url  = get_post_meta(get_the_ID(), '_webmakerr_theme_cta_secondary_url', true) ?: home_url('/docs');
    $secondary_cta_text = get_post_meta(get_the_ID(), '_webmakerr_theme_cta_secondary_label', true) ?: __('View documentation', 'webmakerr');

    $feature_cards = array(
      array(
        'title'       => __('Composable building blocks', 'webmakerr'),
        'description' => __('Mix flexible page sections, global patterns, and reusable utilities to match any design direction.', 'webmakerr'),
      ),
      array(
        'title'       => __('Production-grade performance', 'webmakerr'),
        'description' => __('Lean templates, modern asset bundling, and smart caching keep page speeds lightning fast.', 'webmakerr'),
      ),
      array(
        'title'       => __('Crafted for content teams', 'webmakerr'),
        'description' => __('Empower editors with block-friendly layouts, polished typography, and intuitive controls.', 'webmakerr'),
      ),
      array(
        'title'       => __('Design tokens included', 'webmakerr'),
        'description' => __('Leverage a shared color palette, spacing scale, and typographic rhythm across every experience.', 'webmakerr'),
      ),
      array(
        'title'       => __('Built-in accessibility', 'webmakerr'),
        'description' => __('Semantic HTML, focus states, and color contrast baked into every component out of the box.', 'webmakerr'),
      ),
      array(
        'title'       => __('Developer tooling', 'webmakerr'),
        'description' => __('Tailwind, Vite, and lint-ready configs give your team the workflow they expect from modern stacks.', 'webmakerr'),
      ),
    );

    $integration_groups = array(
      array(
        'title'       => __('Commerce ready', 'webmakerr'),
        'description' => __('Plug into your preferred commerce platform with starter snippets for carts, checkout, and product merchandising.', 'webmakerr'),
        'items'       => array('WooCommerce', 'Shopify Storefront API', 'Snipcart', 'Paddle'),
      ),
      array(
        'title'       => __('Marketing stack', 'webmakerr'),
        'description' => __('Drop in analytics, CRM, and personalization tools with helper hooks that keep markup clean.', 'webmakerr'),
        'items'       => array('Google Analytics', 'Segment', 'HubSpot', 'Mailchimp'),
      ),
      array(
        'title'       => __('Content workflow', 'webmakerr'),
        'description' => __('Connect editorial pipelines and automation with integrations that support collaborative publishing.', 'webmakerr'),
        'items'       => array('Notion', 'Airtable', 'Zapier', 'Make'),
      ),
    );

    $testimonial_quotes = array(
      array(
        'quote'  => __('“Webmakerr let us launch a polished marketing site in a single sprint. The Tailwind workflow felt instantly familiar.”', 'webmakerr'),
        'author' => __('Isabella Nguyen', 'webmakerr'),
        'role'   => __('Head of Product Design, Driftline', 'webmakerr'),
      ),
      array(
        'quote'  => __('“Everything is componentized. We can build and iterate quickly without touching fragile legacy templates.”', 'webmakerr'),
        'author' => __('Miguel Hernandez', 'webmakerr'),
        'role'   => __('Engineering Manager, Skyline Labs', 'webmakerr'),
      ),
      array(
        'quote'  => __('“From accessibility to performance budgets, the guardrails are already there. Our marketing team loves it.”', 'webmakerr'),
        'author' => __('Priya Patel', 'webmakerr'),
        'role'   => __('Director of Marketing, Ember & Oak', 'webmakerr'),
      ),
    );
    ?>

    <article <?php post_class('flex flex-col'); ?>>
      <section class="relative overflow-hidden border-b border-zinc-200 bg-gradient-to-b from-white via-white to-light">
        <div class="container mx-auto px-6 pt-20 pb-24 sm:pb-28 lg:px-8 lg:pt-24 lg:pb-32">
          <div class="grid items-center gap-16 lg:grid-cols-[1.15fr_0.85fr]">
            <div class="flex flex-col gap-6">
              <span class="inline-flex w-fit items-center gap-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.26em] text-primary">
                <?php esc_html_e('Webmakerr Theme', 'webmakerr'); ?>
              </span>
              <?php the_title('<h1 class="text-4xl font-medium tracking-tight [text-wrap:balance] text-zinc-950 sm:text-5xl lg:text-6xl">', '</h1>'); ?>
              <p class="max-w-2xl text-base leading-7 text-zinc-600 sm:text-lg">
                <?php echo esc_html($intro ?: $intro_default); ?>
              </p>
              <div class="flex flex-col gap-4 sm:flex-row">
                <a class="inline-flex items-center justify-center rounded bg-dark px-5 py-2 text-sm font-semibold text-white transition hover:bg-dark/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline" href="<?php echo esc_url($primary_cta_url); ?>">
                  <?php echo esc_html($primary_cta_text); ?>
                </a>
                <a class="inline-flex items-center justify-center rounded border border-zinc-200 px-5 py-2 text-sm font-semibold text-zinc-950 transition hover:border-zinc-300 hover:text-zinc-950 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline" href="<?php echo esc_url($secondary_cta_url); ?>">
                  <?php echo esc_html($secondary_cta_text); ?>
                </a>
              </div>
              <dl class="grid gap-6 pt-4 sm:grid-cols-3">
                <div>
                  <dt class="text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Launch faster', 'webmakerr'); ?></dt>
                  <dd class="mt-2 text-2xl font-semibold text-zinc-950 sm:text-3xl"><?php esc_html_e('2x', 'webmakerr'); ?></dd>
                </div>
                <div>
                  <dt class="text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Design tokens', 'webmakerr'); ?></dt>
                  <dd class="mt-2 text-2xl font-semibold text-zinc-950 sm:text-3xl"><?php esc_html_e('50+', 'webmakerr'); ?></dd>
                </div>
                <div>
                  <dt class="text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Core blocks', 'webmakerr'); ?></dt>
                  <dd class="mt-2 text-2xl font-semibold text-zinc-950 sm:text-3xl"><?php esc_html_e('100%', 'webmakerr'); ?></dd>
                </div>
              </dl>
            </div>

            <div class="relative isolate">
              <div class="absolute -left-24 -top-20 h-64 w-64 rounded-full bg-primary/10 blur-3xl sm:h-72 sm:w-72"></div>
              <div class="relative overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-xl shadow-primary/5">
                <div class="flex flex-col gap-6 border-b border-zinc-200 bg-light/70 px-8 py-6">
                  <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary"><?php esc_html_e('Component preview', 'webmakerr'); ?></p>
                    <p class="mt-2 text-base font-medium text-zinc-950"><?php esc_html_e('Build dynamic marketing pages in minutes.', 'webmakerr'); ?></p>
                  </div>
                  <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded border border-zinc-200 bg-white p-4">
                      <p class="text-sm font-semibold text-zinc-950"><?php esc_html_e('Hero layouts', 'webmakerr'); ?></p>
                      <p class="mt-2 text-xs text-zinc-600"><?php esc_html_e('Balance copy, imagery, and CTAs with responsive defaults.', 'webmakerr'); ?></p>
                    </div>
                    <div class="rounded border border-zinc-200 bg-white p-4">
                      <p class="text-sm font-semibold text-zinc-950"><?php esc_html_e('Feature grids', 'webmakerr'); ?></p>
                      <p class="mt-2 text-xs text-zinc-600"><?php esc_html_e('Highlight benefits with icon-ready content zones.', 'webmakerr'); ?></p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-col gap-4 px-8 py-6">
                  <p class="text-sm font-semibold text-zinc-950"><?php esc_html_e('Included utilities', 'webmakerr'); ?></p>
                  <ul class="grid gap-2 text-xs text-zinc-600 sm:grid-cols-2">
                    <li class="flex items-center gap-2"><span class="flex h-6 w-6 items-center justify-center rounded bg-primary/10 text-primary">◆</span><?php esc_html_e('Typography presets', 'webmakerr'); ?></li>
                    <li class="flex items-center gap-2"><span class="flex h-6 w-6 items-center justify-center rounded bg-primary/10 text-primary">◆</span><?php esc_html_e('Color system tokens', 'webmakerr'); ?></li>
                    <li class="flex items-center gap-2"><span class="flex h-6 w-6 items-center justify-center rounded bg-primary/10 text-primary">◆</span><?php esc_html_e('Grid helpers', 'webmakerr'); ?></li>
                    <li class="flex items-center gap-2"><span class="flex h-6 w-6 items-center justify-center rounded bg-primary/10 text-primary">◆</span><?php esc_html_e('Button states', 'webmakerr'); ?></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="border-b border-zinc-200 bg-white py-16">
        <div class="container mx-auto flex flex-col items-center gap-8 px-6 text-center lg:px-8">
          <p class="text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Teams shipping with Webmakerr', 'webmakerr'); ?></p>
          <div class="grid w-full max-w-4xl grid-cols-2 items-center justify-center gap-6 sm:grid-cols-3 lg:grid-cols-6">
            <?php
            $logos = array('Alpine', 'Cloudline', 'Nordic Labs', 'Studio Fable', 'Gradient', 'Summit Co.');
            foreach ($logos as $logo) :
              ?>
              <div class="flex items-center justify-center rounded border border-dashed border-zinc-200 px-4 py-3 text-sm font-semibold uppercase tracking-[0.26em] text-zinc-400">
                <?php echo esc_html($logo); ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section id="features" class="bg-light py-24">
        <div class="container mx-auto flex flex-col gap-12 px-6 lg:px-8">
          <div class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl"><?php esc_html_e('Everything you need to launch fast', 'webmakerr'); ?></h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg"><?php esc_html_e('Recreate polished landing pages, documentation hubs, and marketing experiences without rebuilding your stack.', 'webmakerr'); ?></p>
          </div>

          <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($feature_cards as $feature) : ?>
              <div class="flex h-full flex-col gap-3 rounded border border-zinc-200 bg-white p-6 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <h3 class="text-xl font-semibold text-zinc-950"><?php echo esc_html($feature['title']); ?></h3>
                <p class="text-sm leading-6 text-zinc-600"><?php echo esc_html($feature['description']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="border-y border-zinc-200 bg-white py-24">
        <div class="container mx-auto grid gap-16 px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
          <div class="flex flex-col gap-6">
            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.26em] text-primary"><?php esc_html_e('Integrations', 'webmakerr'); ?></span>
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl"><?php esc_html_e('Connect your preferred stack', 'webmakerr'); ?></h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg"><?php esc_html_e('Webmakerr slots into your existing tools with helper hooks, REST endpoints, and composable templates that make integrations feel native.', 'webmakerr'); ?></p>
            <ul class="mt-2 grid gap-2 text-sm text-zinc-600">
              <li class="flex items-center gap-2"><span class="flex h-5 w-5 items-center justify-center rounded bg-primary/10 text-primary">✓</span><?php esc_html_e('Pre-built connection patterns for marketing and commerce workflows.', 'webmakerr'); ?></li>
              <li class="flex items-center gap-2"><span class="flex h-5 w-5 items-center justify-center rounded bg-primary/10 text-primary">✓</span><?php esc_html_e('Clean separation of data, presentation, and logic.', 'webmakerr'); ?></li>
              <li class="flex items-center gap-2"><span class="flex h-5 w-5 items-center justify-center rounded bg-primary/10 text-primary">✓</span><?php esc_html_e('Drop-in snippets with helpful documentation and TypeScript examples.', 'webmakerr'); ?></li>
            </ul>
          </div>

          <div class="grid gap-8">
            <?php foreach ($integration_groups as $group) : ?>
              <div class="flex flex-col gap-5 rounded border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-2">
                  <h3 class="text-lg font-semibold text-zinc-950"><?php echo esc_html($group['title']); ?></h3>
                  <p class="text-sm leading-6 text-zinc-600"><?php echo esc_html($group['description']); ?></p>
                </div>
                <ul class="grid gap-3 text-sm font-semibold text-zinc-950 sm:grid-cols-2">
                  <?php foreach ($group['items'] as $item) : ?>
                    <li class="flex items-center justify-between rounded border border-dashed border-zinc-200 px-4 py-2 text-left text-sm font-semibold text-zinc-700">
                      <span><?php echo esc_html($item); ?></span>
                      <span aria-hidden="true">→</span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="bg-light py-24">
        <div class="container mx-auto flex flex-col gap-12 px-6 lg:px-8">
          <div class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl"><?php esc_html_e('Loved by modern product teams', 'webmakerr'); ?></h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg"><?php esc_html_e('From early-stage startups to established brands, Webmakerr helps teams move from idea to launch without compromising on quality.', 'webmakerr'); ?></p>
          </div>

          <div class="grid gap-8 lg:grid-cols-3">
            <?php foreach ($testimonial_quotes as $testimonial) : ?>
              <figure class="flex h-full flex-col gap-6 rounded border border-zinc-200 bg-white p-6 text-left shadow-sm">
                <blockquote class="text-base leading-7 text-zinc-700 sm:text-lg">
                  <?php echo esc_html($testimonial['quote']); ?>
                </blockquote>
                <figcaption class="flex flex-col gap-1">
                  <span class="text-sm font-semibold text-zinc-950"><?php echo esc_html($testimonial['author']); ?></span>
                  <span class="text-xs uppercase tracking-[0.26em] text-zinc-500"><?php echo esc_html($testimonial['role']); ?></span>
                </figcaption>
              </figure>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="border-t border-zinc-200 bg-white py-24">
        <div class="container mx-auto grid gap-12 px-6 lg:grid-cols-[1.2fr_0.8fr] lg:px-8">
          <div class="flex flex-col gap-4">
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl"><?php esc_html_e('Built to grow with your roadmap', 'webmakerr'); ?></h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg"><?php esc_html_e('Use the included templates as-is or tailor them to your brand. The Webmakerr theme stays maintainable thanks to a light footprint and thoughtful defaults.', 'webmakerr'); ?></p>
            <p class="text-sm text-zinc-500"><?php esc_html_e('Need advanced customizations? Extend layouts with your own Tailwind components, override blocks, or wire up data sources without breaking core functionality.', 'webmakerr'); ?></p>
          </div>
          <div class="rounded-2xl border border-zinc-200 bg-light/80 p-8 shadow-inner">
            <h3 class="text-lg font-semibold text-zinc-950"><?php esc_html_e('What’s inside', 'webmakerr'); ?></h3>
            <ul class="mt-4 grid gap-3 text-sm text-zinc-700">
              <li class="flex items-start gap-3"><span class="mt-1 flex h-5 w-5 items-center justify-center rounded bg-primary/10 text-primary">✓</span><?php esc_html_e('Responsive page templates for home, pricing, and product storytelling.', 'webmakerr'); ?></li>
              <li class="flex items-start gap-3"><span class="mt-1 flex h-5 w-5 items-center justify-center rounded bg-primary/10 text-primary">✓</span><?php esc_html_e('Global typography and color tokens synchronized with theme.json.', 'webmakerr'); ?></li>
              <li class="flex items-start gap-3"><span class="mt-1 flex h-5 w-5 items-center justify-center rounded bg-primary/10 text-primary">✓</span><?php esc_html_e('Utility classes for layouts, cards, media objects, and interactive elements.', 'webmakerr'); ?></li>
              <li class="flex items-start gap-3"><span class="mt-1 flex h-5 w-5 items-center justify-center rounded bg-primary/10 text-primary">✓</span><?php esc_html_e('Robust documentation and developer notes right in the codebase.', 'webmakerr'); ?></li>
            </ul>
          </div>
        </div>
      </section>

      <section class="border-t border-zinc-200 bg-white py-24">
        <div class="container mx-auto max-w-4xl px-6 lg:px-8">
          <div class="prose max-w-none text-zinc-700 sm:prose-lg">
            <?php the_content(); ?>
          </div>
        </div>
      </section>

      <section class="relative overflow-hidden bg-gradient-to-r from-primary/90 via-dark to-dark py-24">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.08),_transparent_60%)]"></div>
        <div class="container relative mx-auto flex flex-col items-center gap-6 px-6 text-center text-white lg:px-8">
          <span class="text-xs font-semibold uppercase tracking-[0.26em] text-white/70"><?php esc_html_e('Ready to launch?', 'webmakerr'); ?></span>
          <h2 class="text-3xl font-semibold text-white sm:text-4xl"><?php esc_html_e('Create a standout experience with Webmakerr today', 'webmakerr'); ?></h2>
          <p class="max-w-2xl text-base leading-7 text-white/80 sm:text-lg"><?php esc_html_e('Spin up a high-impact marketing site, customize it to your brand, and keep iterating without slowing down your team.', 'webmakerr'); ?></p>
          <div class="flex flex-col gap-4 sm:flex-row">
            <a class="inline-flex items-center justify-center rounded bg-white px-5 py-2 text-sm font-semibold text-dark transition hover:bg-white/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white !no-underline" href="<?php echo esc_url($primary_cta_url); ?>">
              <?php echo esc_html($primary_cta_text); ?>
            </a>
            <a class="inline-flex items-center justify-center rounded border border-white/40 px-5 py-2 text-sm font-semibold text-white transition hover:border-white/60 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white !no-underline" href="<?php echo esc_url($secondary_cta_url); ?>">
              <?php esc_html_e('Tour the components', 'webmakerr'); ?>
            </a>
          </div>
        </div>
      </section>
    </article>
  <?php endwhile; ?>
</main>

<?php
get_footer();
