<?php
/**
 * Template for the front page.
 *
 * @package Webmakerr
 */

if (! defined('ABSPATH')) {
    exit;
}

$popup_settings = webmakerr_get_template_popup_settings(__FILE__);
$popup_enabled  = (bool) ($popup_settings['enabled'] ?? false);

if (! function_exists('webmakerr_frontpage_icon')) {
    /**
     * Render service icons for the homepage.
     */
    function webmakerr_frontpage_icon(string $icon, string $class = 'h-12 w-12 text-primary')
    {
        $icons = array(
            'website' => '<path d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5V18.5A2.5 2.5 0 0 1 17.5 21h-11A2.5 2.5 0 0 1 4 18.5zm2.5-.5A.5.5 0 0 0 6 5.5v2.75h12V5.5a.5.5 0 0 0-.5-.5zM6 10.25v8.25a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-8.25z"></path><path d="M9 14h6"></path><path d="M9 17h3.5"></path>',
            'funnel'  => '<path d="M5 4h14l-5.5 7.5v5.25a1.75 1.75 0 0 1-2.48 1.58l-1.54-.74A1.75 1.75 0 0 1 8.5 15.96v-4.46z"></path>',
            'plugin'  => '<path d="M13 3v3.5h2A2.5 2.5 0 0 1 17.5 9v1.5H21v3h-3.5V15A2.5 2.5 0 0 1 15 17.5h-2V21h-3v-3.5H8A2.5 2.5 0 0 1 5.5 15v-1.5H2v-3h3.5V9A2.5 2.5 0 0 1 8 6.5h2V3z"></path>',
            'landing' => '<rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="M3 11h18"></path><path d="M9 8h6"></path><path d="M9 16h4"></path>',
            'shield'  => '<path d="M12 3.25 5 6v6c0 4.28 2.86 7.42 7 8.75 4.14-1.33 7-4.47 7-8.75V6z"></path><path d="M9.5 12.25 11.25 14l3.25-3.5"></path>',
            'growth'  => '<path d="M4 17h16"></path><path d="M7 13.5 11.5 9l2.5 2.5L17 8"></path><path d="M18 8h-3V5"></path><path d="M6 17V11"></path><path d="M10 17v-5"></path><path d="M14 17v-3"></path>',
            'handshake' => '<path d="m12.5 9.5 2-2.5a2.5 2.5 0 0 1 3.5-.38l1.88 1.51a2.5 2.5 0 0 1 .37 3.52l-3.25 3.9a2.5 2.5 0 0 1-3.56.27l-.82-.74"></path><path d="M11.5 14.5 9 17a2.5 2.5 0 0 1-3.56-.27L2.13 13a2.5 2.5 0 0 1 .37-3.52l2.13-1.72a2.5 2.5 0 0 1 3.5.29l2.37 2.7"></path><path d="M16 12.5H8.5"></path>',
            'quote'   => '<path d="M10.5 7A3.5 3.5 0 0 1 7 10.5V13a2 2 0 0 1-2 2H4v-2a5 5 0 0 1 5-5z"></path><path d="M20.5 7A3.5 3.5 0 0 1 17 10.5V13a2 2 0 0 1-2 2h-1v-2a5 5 0 0 1 5-5z"></path>',
        );

        if (! isset($icons[$icon])) {
            return '';
        }

        return sprintf(
            '<svg class="%1$s" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%2$s</svg>',
            esc_attr($class),
            $icons[$icon]
        );
    }
}

if (! function_exists('webmakerr_frontpage_logo')) {
    /**
     * Render trust badge logos.
     */
    function webmakerr_frontpage_logo(string $logo, string $class = 'h-8 text-zinc-400')
    {
        $logos = array(
            'growthlab'  => '<path d="M4 16V8l4-2 4 2v8l-4 2z"></path><path d="M12 6.5 16 4l4 2.5V16l-4 2.5-4-2.5"></path>',
            'launchpad'  => '<path d="M12 4a4 4 0 0 1 4 4v4a4 4 0 0 1-8 0V8a4 4 0 0 1 4-4z"></path><path d="M8 14.5 6 19l6-2 6 2-2-4.5"></path>',
            'convertix'  => '<path d="m4 5 6 6-6 6"></path><path d="m20 5-6 6 6 6"></path><path d="M9 5h6"></path><path d="M9 17h6"></path>',
            'scale'      => '<path d="M4 7h16"></path><path d="M6 7v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7"></path><path d="M9 3h6"></path>',
            'brightwave' => '<path d="M4 15c1.5-3 4.5-5 8-5s6.5 2 8 5"></path><path d="M8 11a4 4 0 1 1 8 0"></path><path d="M12 7V3"></path>',
        );

        if (! isset($logos[$logo])) {
            return '';
        }

        return sprintf(
            '<svg class="%1$s" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%2$s</svg>',
            esc_attr($class),
            $logos[$logo]
        );
    }
}

get_header();

$strategy_call_url  = home_url('/contact');
$portfolio_url      = home_url('/portfolio');
$case_study_url     = home_url('/case-study');
$toolkit_url        = home_url('/conversion-toolkit');

$strategy_call_link = webmakerr_get_popup_link_attributes($strategy_call_url, $popup_enabled);
$toolkit_link       = webmakerr_get_popup_link_attributes($toolkit_url, $popup_enabled);
?>

<main id="primary" class="flex flex-col gap-24 bg-white lg:gap-32">
  <?php while (have_posts()) : the_post(); ?>
    <section class="relative overflow-hidden border-b border-zinc-200 bg-gradient-to-b from-zinc-50 via-white to-white">
      <div class="absolute inset-x-0 -top-32 hidden h-72 w-full justify-center sm:flex" aria-hidden="true">
        <svg class="h-full w-full max-w-5xl text-primary/10" viewBox="0 0 960 400" fill="none">
          <path d="M120 320c80-128 240-256 360-256s280 128 360 256" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-dasharray="12 16" />
          <path d="M120 288c80-96 240-192 360-192s280 96 360 192" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-dasharray="6 12" />
        </svg>
      </div>
      <div class="container relative mx-auto px-6 py-20 sm:py-24 lg:px-8">
        <div class="mx-auto flex max-w-4xl flex-col items-center text-center">
          <span class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-primary">
            <?php esc_html_e('Growth-Focused Web Studio', 'webmakerr'); ?>
          </span>
          <h1 class="mt-6 text-4xl font-medium tracking-tight [text-wrap:balance] text-zinc-950 sm:text-5xl">
            <?php esc_html_e('We Design Websites and Funnels That Grow Your Business.', 'webmakerr'); ?>
          </h1>
          <p class="mt-6 max-w-3xl text-base leading-7 text-zinc-600 sm:text-lg">
            <?php esc_html_e('From complete redesigns to custom marketing funnels — we turn your website into a 24/7 sales system.', 'webmakerr'); ?>
          </p>
          <div class="mt-10 flex flex-col items-center gap-3 sm:flex-row sm:gap-4">
            <a class="btn btn-primary inline-flex w-full items-center justify-center rounded-[5px] bg-black px-6 py-3 text-sm font-semibold text-white transition hover:bg-black/90 !no-underline sm:w-auto" href="<?php echo esc_url($strategy_call_link['href']); ?>"<?php echo $strategy_call_link['attributes']; ?>>
              <?php esc_html_e('Book Free Strategy Call', 'webmakerr'); ?>
            </a>
            <a class="btn inline-flex w-full items-center justify-center rounded-[5px] border border-zinc-300 px-6 py-3 text-sm font-semibold text-zinc-900 transition hover:border-zinc-400 hover:text-zinc-950 !no-underline sm:w-auto" href="<?php echo esc_url($portfolio_url); ?>">
              <?php esc_html_e('See Our Work', 'webmakerr'); ?>
            </a>
          </div>
          <p class="mt-5 text-xs font-medium uppercase tracking-[0.32em] text-zinc-500">
            <?php esc_html_e('Trusted by global creators, marketers, and scale-ready teams', 'webmakerr'); ?>
          </p>
        </div>
      </div>
    </section>

    <section class="border-b border-zinc-200 bg-white/80 py-10">
      <div class="container mx-auto flex flex-col items-center gap-6 px-6 text-center lg:px-8">
        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-zinc-500">
          <?php esc_html_e('Trusted by creators, marketers, and growing businesses.', 'webmakerr'); ?>
        </p>
        <div class="grid w-full max-w-5xl grid-cols-2 items-center gap-6 sm:grid-cols-3 lg:grid-cols-5">
          <?php
          $logos = array('growthlab', 'launchpad', 'convertix', 'scale', 'brightwave');
          foreach ($logos as $logo) :
              ?>
            <div class="flex items-center justify-center rounded-[5px] border border-zinc-200 bg-white/80 px-4 py-3">
              <?php
              // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
              echo webmakerr_frontpage_logo($logo);
              ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="container mx-auto px-6 lg:px-8">
      <div class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
        <span class="text-xs font-semibold uppercase tracking-[0.32em] text-primary">
          <?php esc_html_e('What We Deliver', 'webmakerr'); ?>
        </span>
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
          <?php esc_html_e('Full-Service Website and Funnel Execution', 'webmakerr'); ?>
        </h2>
        <p class="text-base leading-7 text-zinc-600 sm:text-lg">
          <?php esc_html_e('High-impact teams choose Webmakerr to plan, design, and launch conversion-optimized digital experiences.', 'webmakerr'); ?>
        </p>
      </div>

      <div class="mt-14 grid gap-8 sm:grid-cols-2 xl:grid-cols-4">
        <?php
        $services = array(
            array(
                'icon'        => 'website',
                'title'       => __('Website Redesign & Optimization', 'webmakerr'),
                'description' => __('Rebuild your flagship pages with premium UI, intuitive UX, and measurable conversion gains.', 'webmakerr'),
                'url'         => home_url('/services/website-redesign'),
            ),
            array(
                'icon'        => 'funnel',
                'title'       => __('Custom Funnel Development', 'webmakerr'),
                'description' => __('Strategize and implement end-to-end funnels that guide prospects from first click to sale.', 'webmakerr'),
                'url'         => home_url('/services/funnel-development'),
            ),
            array(
                'icon'        => 'plugin',
                'title'       => __('Plugin Customization & Integration', 'webmakerr'),
                'description' => __('Extend your stack with bespoke plugin workflows, automation, and seamless platform syncs.', 'webmakerr'),
                'url'         => home_url('/services/plugin-customization'),
            ),
            array(
                'icon'        => 'landing',
                'title'       => __('Conversion-Focused Landing Pages', 'webmakerr'),
                'description' => __('Launch data-backed campaign pages engineered to convert qualified traffic at every stage.', 'webmakerr'),
                'url'         => home_url('/services/conversion-landing-pages'),
            ),
        );

        foreach ($services as $service) :
            ?>
          <article class="flex h-full flex-col gap-6 rounded-[5px] border border-zinc-200 bg-white p-8 text-left shadow-sm transition hover:-translate-y-1 hover:border-primary/40 hover:shadow-lg">
            <span class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-primary/10">
              <?php
              // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
              echo webmakerr_frontpage_icon($service['icon'], 'h-8 w-8 text-primary');
              ?>
            </span>
            <div class="flex flex-col gap-3">
              <h3 class="text-xl font-semibold text-zinc-950">
                <?php echo esc_html($service['title']); ?>
              </h3>
              <p class="text-sm leading-6 text-zinc-600">
                <?php echo esc_html($service['description']); ?>
              </p>
            </div>
            <a class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-primary transition hover:text-primary/80" href="<?php echo esc_url($service['url']); ?>">
              <?php esc_html_e('Learn More', 'webmakerr'); ?>
              <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 3.5 11.5 8 6 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </a>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="bg-light py-24">
      <div class="container mx-auto grid items-center gap-12 px-6 lg:grid-cols-[1fr_0.85fr] lg:px-8">
        <div class="flex flex-col gap-5">
          <span class="text-xs font-semibold uppercase tracking-[0.32em] text-primary">
            <?php esc_html_e('Featured Conversion Win', 'webmakerr'); ?>
          </span>
          <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
            <?php esc_html_e('See How We Increased Conversions by 218%.', 'webmakerr'); ?>
          </h2>
          <p class="text-base leading-7 text-zinc-600 sm:text-lg">
            <?php esc_html_e('A fast-growing SaaS brand partnered with Webmakerr to rebuild their marketing site, align messaging, and overhaul their funnel. The result: a 218% lift in qualified demos within six weeks.', 'webmakerr'); ?>
          </p>
          <a class="btn inline-flex w-full items-center justify-center rounded-[5px] border border-zinc-300 px-6 py-3 text-sm font-semibold text-zinc-900 transition hover:border-zinc-400 hover:text-zinc-950 !no-underline sm:w-auto" href="<?php echo esc_url($case_study_url); ?>">
            <?php esc_html_e('View Case Study', 'webmakerr'); ?>
          </a>
        </div>
        <div class="relative overflow-hidden rounded-[5px] border border-zinc-200 bg-white p-8 shadow-lg shadow-primary/10">
          <div class="absolute -right-16 -top-16 h-32 w-32 rounded-full bg-primary/10 blur-2xl"></div>
          <div class="absolute -bottom-20 -left-12 h-40 w-40 rounded-full bg-dark/5 blur-3xl"></div>
          <div class="relative flex flex-col gap-6">
            <div class="flex flex-col gap-2 rounded-[5px] border border-zinc-200 bg-zinc-50 p-5">
              <p class="text-xs font-semibold uppercase tracking-[0.26em] text-primary">
                <?php esc_html_e('Key Metrics', 'webmakerr'); ?>
              </p>
              <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-[5px] border border-white bg-white p-4 shadow-sm">
                  <p class="text-2xl font-semibold text-zinc-950">218%</p>
                  <p class="text-xs uppercase tracking-[0.28em] text-zinc-500">
                    <?php esc_html_e('Demo Growth', 'webmakerr'); ?>
                  </p>
                </div>
                <div class="rounded-[5px] border border-white bg-white p-4 shadow-sm">
                  <p class="text-2xl font-semibold text-zinc-950">3.8x</p>
                  <p class="text-xs uppercase tracking-[0.28em] text-zinc-500">
                    <?php esc_html_e('Pipeline ROI', 'webmakerr'); ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="rounded-[5px] border border-zinc-200 bg-white/80 p-5">
              <p class="text-sm leading-6 text-zinc-600">
                <?php esc_html_e('“Webmakerr rebuilt our funnel from the ground up. The clarity, speed, and performance of the new site keep our pipeline full.”', 'webmakerr'); ?>
              </p>
              <p class="mt-4 text-xs font-semibold uppercase tracking-[0.28em] text-zinc-500">
                <?php esc_html_e('Maya Ellis — VP Marketing, Launchfuel', 'webmakerr'); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container mx-auto px-6 lg:px-8">
      <div class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
        <span class="text-xs font-semibold uppercase tracking-[0.32em] text-primary">
          <?php esc_html_e('Why Webmakerr', 'webmakerr'); ?>
        </span>
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
          <?php esc_html_e('Strategy-Led Design for Serious Growth', 'webmakerr'); ?>
        </h2>
        <p class="text-base leading-7 text-zinc-600 sm:text-lg">
          <?php esc_html_e('Every build is engineered to accelerate conversions, increase retention, and unlock new revenue channels.', 'webmakerr'); ?>
        </p>
      </div>
      <div class="mt-14 grid gap-8 lg:grid-cols-3">
        <?php
        $pillars = array(
            array(
                'icon'  => 'shield',
                'title' => __('Strategy First — Every design starts with data.', 'webmakerr'),
                'copy'  => __('We audit your analytics, customer journeys, and messaging before crafting a single layout.', 'webmakerr'),
            ),
            array(
                'icon'  => 'growth',
                'title' => __('Conversion Engineered — Built for measurable growth.', 'webmakerr'),
                'copy'  => __('Modular funnels, rapid experimentation, and CRO best practices baked into every launch.', 'webmakerr'),
            ),
            array(
                'icon'  => 'handshake',
                'title' => __('Partnership Driven — Growth beyond launch.', 'webmakerr'),
                'copy'  => __('We stay aligned with your team post-launch to optimize campaigns and keep momentum high.', 'webmakerr'),
            ),
        );

        foreach ($pillars as $pillar) :
            ?>
          <div class="flex h-full flex-col gap-5 rounded-[5px] border border-zinc-200 bg-white p-8 text-center shadow-sm">
            <span class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-full bg-primary/10">
              <?php
              // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
              echo webmakerr_frontpage_icon($pillar['icon'], 'h-9 w-9 text-primary');
              ?>
            </span>
            <h3 class="text-lg font-semibold text-zinc-950">
              <?php echo esc_html($pillar['title']); ?>
            </h3>
            <p class="text-sm leading-6 text-zinc-600">
              <?php echo esc_html($pillar['copy']); ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="container mx-auto px-6 lg:px-8">
      <div class="relative overflow-hidden rounded-[5px] border border-zinc-900/20 bg-zinc-950 px-8 py-16 text-center text-white shadow-lg sm:px-12">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.08),_transparent_60%)]"></div>
        <div class="relative mx-auto flex max-w-3xl flex-col gap-6">
          <span class="text-xs font-semibold uppercase tracking-[0.32em] text-white/70">
            <?php esc_html_e('Primary Call to Action', 'webmakerr'); ?>
          </span>
          <h2 class="text-3xl font-semibold sm:text-4xl">
            <?php esc_html_e('Ready to Turn Clicks Into Customers?', 'webmakerr'); ?>
          </h2>
          <p class="text-base leading-7 text-white/80 sm:text-lg">
            <?php esc_html_e('Book your free strategy call and get a personalized growth plan for your business.', 'webmakerr'); ?>
          </p>
          <div class="flex justify-center">
            <a class="btn btn-primary inline-flex items-center justify-center rounded-[5px] bg-black px-8 py-3 text-sm font-semibold text-white transition hover:bg-black/90 !no-underline" href="<?php echo esc_url($strategy_call_link['href']); ?>"<?php echo $strategy_call_link['attributes']; ?>>
              <?php esc_html_e('Book Free Call', 'webmakerr'); ?>
            </a>
          </div>
          <p class="text-xs font-medium uppercase tracking-[0.28em] text-white/60">
            <?php esc_html_e('Spots fill quickly — secure your time in under 60 seconds.', 'webmakerr'); ?>
          </p>
        </div>
      </div>
    </section>

    <section class="container mx-auto px-6 lg:px-8">
      <div class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
        <span class="text-xs font-semibold uppercase tracking-[0.32em] text-primary">
          <?php esc_html_e('Client Wins', 'webmakerr'); ?>
        </span>
        <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
          <?php esc_html_e('Testimonials from Growth Partners', 'webmakerr'); ?>
        </h2>
        <p class="text-base leading-7 text-zinc-600 sm:text-lg">
          <?php esc_html_e('Real teams using Webmakerr to launch high-performing websites and funnels that keep leads flowing.', 'webmakerr'); ?>
        </p>
      </div>
      <div class="mt-14 grid gap-8 md:grid-cols-3">
        <?php
        $testimonials = array(
            array(
                'quote' => __('“Within four weeks, our new funnel drove 137% more booked calls. The Webmakerr team obsessed over every metric.”', 'webmakerr'),
                'name'  => __('Jordan Blake', 'webmakerr'),
                'role'  => __('Founder, GrowthLab Media', 'webmakerr'),
            ),
            array(
                'quote' => __('“They rebuilt our WooCommerce experience and integrated our CRM automations seamlessly. Revenue is up 62%.”', 'webmakerr'),
                'name'  => __('Elena Ruiz', 'webmakerr'),
                'role'  => __('CMO, Brightwave Living', 'webmakerr'),
            ),
            array(
                'quote' => __('“It felt like having a partner inside our team—proactive, strategic, and focused on measurable outcomes.”', 'webmakerr'),
                'name'  => __('Marcus Lee', 'webmakerr'),
                'role'  => __('Head of Demand Gen, Convertix', 'webmakerr'),
            ),
        );

        foreach ($testimonials as $testimonial) :
            ?>
          <figure class="flex h-full flex-col gap-6 rounded-[5px] border border-zinc-200 bg-white p-8 shadow-sm">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-primary/10">
              <?php
              // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
              echo webmakerr_frontpage_icon('quote', 'h-5 w-5 text-primary');
              ?>
            </span>
            <blockquote class="text-sm leading-6 text-zinc-600">
              <?php echo esc_html($testimonial['quote']); ?>
            </blockquote>
            <figcaption class="text-left">
              <p class="text-sm font-semibold text-zinc-950">
                <?php echo esc_html($testimonial['name']); ?>
              </p>
              <p class="text-xs uppercase tracking-[0.28em] text-zinc-500">
                <?php echo esc_html($testimonial['role']); ?>
              </p>
            </figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="bg-light py-24">
      <div class="container mx-auto grid gap-12 px-6 text-center lg:grid-cols-[1.1fr_0.9fr] lg:px-8 lg:text-left">
        <div class="flex flex-col gap-5">
          <span class="text-xs font-semibold uppercase tracking-[0.32em] text-primary">
            <?php esc_html_e('Free Growth Resource', 'webmakerr'); ?>
          </span>
          <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
            <?php esc_html_e('Download Our Website Conversion Toolkit.', 'webmakerr'); ?>
          </h2>
          <p class="text-base leading-7 text-zinc-600 sm:text-lg">
            <?php esc_html_e('Get the exact checklists, templates, and CRO frameworks we use to optimize high-performing sites.', 'webmakerr'); ?>
          </p>
          <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-start">
            <a class="btn btn-primary inline-flex w-full items-center justify-center rounded-[5px] bg-black px-6 py-3 text-sm font-semibold text-white transition hover:bg-black/90 !no-underline sm:w-auto" href="<?php echo esc_url($toolkit_link['href']); ?>"<?php echo $toolkit_link['attributes']; ?>>
              <?php esc_html_e('Get Free Guide', 'webmakerr'); ?>
            </a>
            <p class="text-xs uppercase tracking-[0.28em] text-zinc-500">
              <?php esc_html_e('Instant access • No spam ever', 'webmakerr'); ?>
            </p>
          </div>
        </div>
        <div class="relative overflow-hidden rounded-[5px] border border-zinc-200 bg-white p-8 shadow-lg shadow-primary/10">
          <div class="absolute -left-12 -top-16 h-32 w-32 rounded-full bg-primary/10 blur-3xl"></div>
          <div class="absolute -bottom-16 -right-16 h-36 w-36 rounded-full bg-dark/5 blur-3xl"></div>
          <div class="relative flex flex-col gap-4 text-left">
            <h3 class="text-sm font-semibold uppercase tracking-[0.26em] text-primary">
              <?php esc_html_e('What’s Inside', 'webmakerr'); ?>
            </h3>
            <ul class="grid gap-3 text-sm leading-6 text-zinc-600">
              <li class="flex items-start gap-3">
                <span class="mt-1 flex h-6 w-6 items-center justify-center rounded-full bg-primary/10 text-primary">
                  <svg class="h-3.5 w-3.5" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 7 5.5 9.5 11 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
                <span><?php esc_html_e('Launch-ready funnel blueprints for webinars, product launches, and SaaS demos.', 'webmakerr'); ?></span>
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 flex h-6 w-6 items-center justify-center rounded-full bg-primary/10 text-primary">
                  <svg class="h-3.5 w-3.5" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 7 5.5 9.5 11 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
                <span><?php esc_html_e('Optimization scorecard to quickly diagnose high-impact improvements.', 'webmakerr'); ?></span>
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 flex h-6 w-6 items-center justify-center rounded-full bg-primary/10 text-primary">
                  <svg class="h-3.5 w-3.5" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 7 5.5 9.5 11 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
                <span><?php esc_html_e('Copywriting formulas to align messaging with buyer intent.', 'webmakerr'); ?></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
</main>

<?php
webmakerr_render_template_popup($popup_settings);
get_footer();
