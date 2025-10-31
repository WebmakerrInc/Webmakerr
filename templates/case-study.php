<?php
/**
 * Template Name: Case Study
 */

if (! defined('ABSPATH')) {
    exit;
}

$popup_settings      = webmakerr_get_template_popup_settings(__FILE__);
$popup_enabled       = (bool) ($popup_settings['enabled'] ?? false);
$strategy_call_url   = home_url('/contact');
$strategy_call_link  = webmakerr_get_popup_link_attributes($strategy_call_url, $popup_enabled);

get_header();
?>

<main id="primary" class="bg-white">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('flex flex-col gap-24 pb-24'); ?>>
      <section class="relative overflow-hidden border-b border-zinc-200 bg-gradient-to-br from-white via-white to-primary/5">
        <div class="absolute inset-y-0 left-0 hidden w-1/3 bg-gradient-to-r from-primary/10 via-transparent to-transparent lg:block"></div>
        <div class="container mx-auto grid gap-12 px-6 py-20 lg:grid-cols-[1.1fr_0.9fr] lg:px-8 lg:py-24">
          <div class="relative z-10 flex flex-col gap-6">
            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.26em] text-primary" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
              <?php esc_html_e('Case Study', 'webmakerr'); ?>
            </span>
            <h1 class="text-4xl font-semibold text-zinc-950 sm:text-5xl" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">
              <?php esc_html_e('Launchfuel SaaS Growth Transformation', 'webmakerr'); ?>
            </h1>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
              <?php esc_html_e('Rearchitecting the marketing site, funnel experience, and positioning to create a unified growth engine.', 'webmakerr'); ?>
            </p>
            <div class="grid gap-6 sm:grid-cols-2" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
              <div class="rounded-[5px] border border-primary/20 bg-white px-5 py-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-primary"><?php esc_html_e('Industry', 'webmakerr'); ?></p>
                <p class="mt-2 text-base font-medium text-zinc-950"><?php esc_html_e('B2B SaaS', 'webmakerr'); ?></p>
              </div>
              <div class="rounded-[5px] border border-primary/20 bg-white px-5 py-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-primary"><?php esc_html_e('Services', 'webmakerr'); ?></p>
                <p class="mt-2 text-base font-medium text-zinc-950"><?php esc_html_e('Website Redesign, Funnel Build, CRO', 'webmakerr'); ?></p>
              </div>
            </div>
          </div>
          <div class="relative z-10 flex items-center justify-center">
            <div class="aspect-[4/3] w-full rounded-[5px] border border-zinc-200 bg-gradient-to-br from-primary/10 via-white to-white p-6 shadow-lg">
              <div class="flex h-full flex-col justify-between rounded-[5px] border border-dashed border-primary/40 bg-white/60 p-6">
                <div>
                  <p class="text-sm font-semibold uppercase tracking-[0.26em] text-primary" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
                    <?php esc_html_e('Snapshot', 'webmakerr'); ?>
                  </p>
                  <h2 class="mt-4 text-2xl font-semibold text-zinc-950" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">
                    <?php esc_html_e('218% Demo Growth in Six Weeks', 'webmakerr'); ?>
                  </h2>
                </div>
                <p class="text-sm leading-6 text-zinc-600" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
                  <?php esc_html_e('A redesigned demand engine that combines high-velocity experimentation with narrative-driven messaging to accelerate acquisition.', 'webmakerr'); ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="container mx-auto grid gap-10 px-6 lg:grid-cols-[0.45fr_0.55fr] lg:items-center lg:px-8">
        <div class="flex items-center justify-center">
          <div class="flex h-full w-full max-w-xs flex-col items-center justify-center gap-4 rounded-[5px] border border-zinc-200 bg-white p-8 text-center shadow-sm" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary">
              <span class="text-xl font-semibold" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">LF</span>
            </div>
            <p class="text-base font-medium text-zinc-950"><?php esc_html_e('Launchfuel', 'webmakerr'); ?></p>
            <p class="text-sm leading-6 text-zinc-600"><?php esc_html_e('Venture-backed SaaS platform for marketing automation teams.', 'webmakerr'); ?></p>
          </div>
        </div>
        <div class="flex flex-col gap-4" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
          <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">
            <?php esc_html_e('About the Client', 'webmakerr'); ?>
          </h2>
          <p class="text-base leading-7 text-zinc-600 sm:text-lg">
            <?php esc_html_e('Launchfuel equips distributed marketing teams with an automation layer that helps them orchestrate campaigns faster. Rapid growth exposed cracks in their messaging, sales collateral, and product-story alignment.', 'webmakerr'); ?>
          </p>
          <p class="text-base leading-7 text-zinc-600 sm:text-lg">
            <?php esc_html_e('They came to Webmakerr for a conversion-first rebuild: unifying brand narrative, rebuilding the funnel, and delivering a scalable system their team could own.', 'webmakerr'); ?>
          </p>
        </div>
      </section>

      <section class="container mx-auto flex flex-col gap-6 px-6 lg:px-8" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">
          <?php esc_html_e('The Challenge', 'webmakerr'); ?>
        </h2>
        <p class="max-w-3xl text-base leading-7 text-zinc-600 sm:text-lg">
          <?php esc_html_e('A dated site structure forced buyers through disconnected pages, while inconsistent copy undercut Launchfuel’s category leadership. Product tours were buried, demo requests were low intent, and teams struggled to track performance.', 'webmakerr'); ?>
        </p>
      </section>

      <section class="container mx-auto flex flex-col gap-6 px-6 lg:px-8" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">
          <?php esc_html_e('The Solution', 'webmakerr'); ?>
        </h2>
        <ol class="max-w-4xl list-decimal space-y-4 pl-6 text-base leading-7 text-zinc-600 sm:text-lg">
          <li><?php esc_html_e('Architected a modular site map anchored in the buyer journey with clear conversion milestones.', 'webmakerr'); ?></li>
          <li><?php esc_html_e('Developed narrative-driven copy and Playfair-led headings to reinforce premium positioning.', 'webmakerr'); ?></li>
          <li><?php esc_html_e('Implemented rapid CRO testing: hero variants, pricing experiments, and retargeting pages.', 'webmakerr'); ?></li>
          <li><?php esc_html_e('Integrated CRM automations, analytics dashboards, and lead-scoring workflows.', 'webmakerr'); ?></li>
        </ol>
      </section>

      <section class="container mx-auto flex flex-col gap-8 px-6 lg:px-8" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">
          <?php esc_html_e('The Results', 'webmakerr'); ?>
        </h2>
        <div class="grid gap-6 sm:grid-cols-3">
          <div class="rounded-[5px] border border-zinc-200 bg-white p-6 text-center shadow-sm">
            <p class="text-3xl font-semibold text-[#1877F2]">218%</p>
            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Increase in Qualified Demos', 'webmakerr'); ?></p>
          </div>
          <div class="rounded-[5px] border border-zinc-200 bg-white p-6 text-center shadow-sm">
            <p class="text-3xl font-semibold text-[#1877F2]">3.8x</p>
            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Pipeline ROI', 'webmakerr'); ?></p>
          </div>
          <div class="rounded-[5px] border border-zinc-200 bg-white p-6 text-center shadow-sm">
            <p class="text-3xl font-semibold text-[#1877F2]">42%</p>
            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Growth in Paid Conversions', 'webmakerr'); ?></p>
          </div>
        </div>
      </section>

      <section class="container mx-auto flex flex-col gap-8 px-6 lg:px-8" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">
          <?php esc_html_e('Visual Proof', 'webmakerr'); ?>
        </h2>
        <div class="grid gap-6 md:grid-cols-2">
          <figure class="flex h-full flex-col gap-4 rounded-[5px] border border-zinc-200 bg-white p-6 shadow-sm">
            <figcaption class="text-sm font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('Before', 'webmakerr'); ?></figcaption>
            <div class="flex flex-1 items-center justify-center rounded-[5px] border border-dashed border-zinc-300 bg-zinc-50">
              <span class="text-sm font-medium text-zinc-400"><?php esc_html_e('Legacy site screenshot placeholder', 'webmakerr'); ?></span>
            </div>
          </figure>
          <figure class="flex h-full flex-col gap-4 rounded-[5px] border border-zinc-200 bg-white p-6 shadow-sm">
            <figcaption class="text-sm font-semibold uppercase tracking-[0.26em] text-zinc-500"><?php esc_html_e('After', 'webmakerr'); ?></figcaption>
            <div class="flex flex-1 items-center justify-center rounded-[5px] border border-dashed border-primary/40 bg-primary/5">
              <span class="text-sm font-medium text-primary"><?php esc_html_e('High-converting redesign placeholder', 'webmakerr'); ?></span>
            </div>
          </figure>
        </div>
      </section>

      <section class="container mx-auto px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[5px] border border-zinc-900/20 bg-zinc-950 px-8 py-16 text-center text-white shadow-lg sm:px-12" style="font-family: 'Roboto', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.08),_transparent_60%)]"></div>
          <div class="relative mx-auto flex max-w-3xl flex-col gap-6">
            <span class="text-xs font-semibold uppercase tracking-[0.26em] text-white/70"><?php esc_html_e('Want results like this?', 'webmakerr'); ?></span>
            <h2 class="text-3xl font-semibold sm:text-4xl" style="font-family: 'Playfair Display', ui-serif, Georgia, 'Times New Roman', Times, serif;">
              <?php esc_html_e('Book your free call and get a tailored growth roadmap.', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-white/80 sm:text-lg">
              <?php esc_html_e('We’ll audit your funnel, uncover the conversion gaps, and map your next launch so you can scale with confidence.', 'webmakerr'); ?>
            </p>
            <div class="flex justify-center">
              <a class="btn btn-primary inline-flex items-center justify-center rounded border border-transparent bg-white px-5 py-2 text-sm font-semibold text-zinc-950 shadow-sm transition hover:bg-white/90 !no-underline" href="<?php echo esc_url($strategy_call_link['href']); ?>"<?php echo $strategy_call_link['attributes']; ?>>
                <?php esc_html_e('Book Free Call', 'webmakerr'); ?>
              </a>
            </div>
            <p class="text-xs font-medium uppercase tracking-[0.26em] text-white/60"><?php esc_html_e('Spots fill quickly — secure your time in under 60 seconds.', 'webmakerr'); ?></p>
          </div>
        </div>
      </section>
    </article>
  <?php endwhile; ?>
</main>

<?php
webmakerr_render_template_popup($popup_settings);
get_footer();
