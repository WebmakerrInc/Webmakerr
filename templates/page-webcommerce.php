<?php get_header(); ?>
<?php
/**
 * Template Name: WebCommerce Page
 */

if (! defined('ABSPATH')) {
    exit;
}

$download_url = home_url('/download-webcommerce');
$feature_cards = array(
    array(
        'title' => __('One-Click Setup', 'webmakerr'),
        'description' => __('Install, activate, and launch your store instantly with guided onboarding flows.', 'webmakerr'),
    ),
    array(
        'title' => __('Sell Anything', 'webmakerr'),
        'description' => __('Offer physical inventory, digital downloads, or license keys from a single catalog.', 'webmakerr'),
    ),
    array(
        'title' => __('License Key System', 'webmakerr'),
        'description' => __('Issue and validate secure license keys without extra extensions or manual work.', 'webmakerr'),
    ),
    array(
        'title' => __('Optimized Checkout', 'webmakerr'),
        'description' => __('Delight shoppers with a conversion-focused checkout experience that looks great on any device.', 'webmakerr'),
    ),
    array(
        'title' => __('Theme Compatible', 'webmakerr'),
        'description' => __('Integrates seamlessly with any WordPress theme while respecting your brand design.', 'webmakerr'),
    ),
    array(
        'title' => __('Built for Webmakerr', 'webmakerr'),
        'description' => __('Leverage deep optimizations, Tailwind tokens, and polished components from the Webmakerr theme.', 'webmakerr'),
    ),
    array(
        'title' => __('Developer Friendly', 'webmakerr'),
        'description' => __('Extend, customize, and integrate with REST hooks, filters, and modern tooling support.', 'webmakerr'),
    ),
);

$benefits = array(
    array(
        'title' => __('Performance engineered for scale', 'webmakerr'),
        'description' => __('Lightweight queries, optimized caching, and headless-ready endpoints keep stores fast even during peak demand.', 'webmakerr'),
    ),
    array(
        'title' => __('Secure payments and licensing', 'webmakerr'),
        'description' => __('Pair trusted payment gateways with built-in license validation to protect every transaction.', 'webmakerr'),
    ),
    array(
        'title' => __('Marketing-ready storefronts', 'webmakerr'),
        'description' => __('Launch promotional landing pages, upsell flows, and content campaigns with flexible Gutenberg blocks.', 'webmakerr'),
    ),
);
?>

<main id="primary" class="flex flex-col bg-white">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('flex flex-col'); ?>>
      <section class="relative overflow-hidden border-b border-zinc-200 bg-gradient-to-b from-white via-white to-light">
        <div class="container mx-auto rounded-[5px] border border-white/40 bg-white/80 px-6 pb-20 pt-24 shadow-sm backdrop-blur sm:pb-24 sm:pt-28 lg:px-8 lg:pt-32">
          <div class="grid items-center gap-16 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="flex flex-col gap-6">
              <span class="inline-flex w-fit items-center gap-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.26em] text-primary">
                <?php esc_html_e('WebCommerce Plugin', 'webmakerr'); ?>
              </span>
              <h1 class="text-4xl font-medium tracking-tight text-zinc-950 [text-wrap:balance] sm:text-5xl lg:text-6xl">
                <?php esc_html_e('A Complete eCommerce Engine for Any WordPress Theme', 'webmakerr'); ?>
              </h1>
              <p class="max-w-2xl text-base leading-7 text-zinc-600 sm:text-lg">
                <?php esc_html_e('Sell products, digital downloads, or license keys — fast, secure, and fully optimized for the Webmakerr experience.', 'webmakerr'); ?>
              </p>
              <div class="flex flex-col gap-4 sm:flex-row">
                <a class="inline-flex items-center justify-center rounded bg-dark px-5 py-3 text-sm font-semibold text-white transition hover:bg-dark/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline" href="<?php echo esc_url($download_url); ?>">
                  <?php esc_html_e('Download WebCommerce Free', 'webmakerr'); ?>
                </a>
                <p class="text-sm text-zinc-500 sm:self-center">
                  <?php esc_html_e('Turn any WordPress install into a high-converting store in minutes.', 'webmakerr'); ?>
                </p>
              </div>
              <dl class="grid gap-6 pt-4 sm:grid-cols-3">
                <div class="rounded-[5px] border border-zinc-200 bg-white/80 p-4 shadow-sm shadow-primary/5">
                  <dt class="text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Setup time', 'webmakerr'); ?></dt>
                  <dd class="mt-2 text-2xl font-semibold text-zinc-950 sm:text-3xl"><?php esc_html_e('Under 5 minutes', 'webmakerr'); ?></dd>
                </div>
                <div class="rounded-[5px] border border-zinc-200 bg-white/80 p-4 shadow-sm shadow-primary/5">
                  <dt class="text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Selling models', 'webmakerr'); ?></dt>
                  <dd class="mt-2 text-2xl font-semibold text-zinc-950 sm:text-3xl"><?php esc_html_e('Physical · Digital · Licenses', 'webmakerr'); ?></dd>
                </div>
                <div class="rounded-[5px] border border-zinc-200 bg-white/80 p-4 shadow-sm shadow-primary/5">
                  <dt class="text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Webmakerr optimized', 'webmakerr'); ?></dt>
                  <dd class="mt-2 text-2xl font-semibold text-zinc-950 sm:text-3xl"><?php esc_html_e('Tailwind-native', 'webmakerr'); ?></dd>
                </div>
              </dl>
            </div>

            <div class="relative isolate">
              <div class="absolute -left-24 -top-20 h-64 w-64 rounded-full bg-primary/10 blur-3xl sm:h-72 sm:w-72"></div>
              <div class="relative flex flex-col gap-6 rounded-[5px] border border-zinc-200 bg-white/95 p-8 shadow-xl shadow-primary/5 backdrop-blur">
                <div class="rounded-[5px] border border-zinc-200 bg-light p-6">
                  <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary"><?php esc_html_e('Launch ready', 'webmakerr'); ?></p>
                  <p class="mt-2 text-base font-medium text-zinc-950"><?php esc_html_e('Connect products, licenses, and checkout in a single streamlined workflow.', 'webmakerr'); ?></p>
                </div>
                <ul class="grid gap-3 text-sm text-zinc-600">
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white p-4">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary">◆</span>
                    <?php esc_html_e('Automated onboarding wizard', 'webmakerr'); ?>
                  </li>
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white p-4">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary">◆</span>
                    <?php esc_html_e('Prebuilt checkout and account pages', 'webmakerr'); ?>
                  </li>
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white p-4">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary">◆</span>
                    <?php esc_html_e('Global styles synced with Webmakerr tokens', 'webmakerr'); ?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="bg-white py-20">
        <div class="container mx-auto grid gap-12 rounded-[5px] border border-zinc-200 bg-light/60 px-6 py-12 shadow-sm lg:grid-cols-[0.9fr_1.1fr] lg:items-start lg:px-8">
          <div class="rounded-[5px] border border-zinc-200 bg-light p-8 shadow-sm">
            <h2 class="text-3xl font-semibold tracking-tight text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Everything you need to sell, fulfill, and grow', 'webmakerr'); ?>
            </h2>
            <p class="mt-4 text-base text-zinc-600">
              <?php esc_html_e('WebCommerce brings enterprise-grade commerce workflows to WordPress without the heavy plugins. Built on Tailwind utilities, every element stays sharp across devices.', 'webmakerr'); ?>
            </p>
            <p class="mt-4 text-base text-zinc-600">
              <?php esc_html_e('Manage catalogs, automate licensing, and launch promotional pages with the same toolkit the Webmakerr theme uses under the hood.', 'webmakerr'); ?>
            </p>
          </div>
          <div class="grid gap-6 sm:grid-cols-2">
            <?php foreach ($feature_cards as $card) : ?>
              <div class="flex flex-col gap-3 rounded-[5px] border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <h3 class="text-lg font-semibold text-zinc-950"><?php echo esc_html($card['title']); ?></h3>
                <p class="text-sm text-zinc-600"><?php echo esc_html($card['description']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="border-y border-zinc-200 bg-light py-20">
        <div class="container mx-auto flex flex-col gap-12 rounded-[5px] border border-zinc-200 bg-white/80 px-6 py-12 shadow-sm lg:flex-row lg:items-start lg:px-8">
          <div class="max-w-xl rounded-[5px] border border-zinc-200 bg-white p-8 shadow-sm">
            <h2 class="text-3xl font-semibold tracking-tight text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Built for modern commerce teams', 'webmakerr'); ?>
            </h2>
            <p class="mt-4 text-base text-zinc-600">
              <?php esc_html_e('From product managers to developers, WebCommerce removes the friction that slows down launches. Every workflow respects your brand, performance budgets, and marketing needs.', 'webmakerr'); ?>
            </p>
          </div>
          <div class="grid flex-1 gap-6">
            <?php foreach ($benefits as $benefit) : ?>
              <div class="rounded-[5px] border border-zinc-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-zinc-950"><?php echo esc_html($benefit['title']); ?></h3>
                <p class="mt-2 text-sm text-zinc-600"><?php echo esc_html($benefit['description']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="bg-white py-20">
        <div class="container mx-auto rounded-[5px] border border-primary/20 bg-primary/5 px-6 py-12 shadow-sm lg:px-8">
          <div class="rounded-[5px] border border-primary/30 bg-white/80 p-10 text-center shadow-sm">
            <h2 class="text-3xl font-semibold tracking-tight text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Start Selling with WebCommerce', 'webmakerr'); ?>
            </h2>
            <p class="mt-4 text-base text-zinc-600 sm:mx-auto sm:max-w-2xl">
              <?php esc_html_e('Download the free plugin today and turn your WordPress site into a full eCommerce platform — beautifully optimized with Webmakerr.', 'webmakerr'); ?>
            </p>
            <div class="mt-8 flex justify-center">
              <a class="inline-flex items-center justify-center rounded-[5px] bg-dark px-6 py-3 text-sm font-semibold text-white transition hover:bg-dark/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline" href="<?php echo esc_url($download_url); ?>">
                <?php esc_html_e('Download Free Plugin', 'webmakerr'); ?>
              </a>
            </div>
          </div>
        </div>
      </section>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
