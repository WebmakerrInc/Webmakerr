<?php
/**
 * Template Name: Thank You Lead Page
 */

if (! defined('ABSPATH')) {
    exit;
}

$popup_settings = webmakerr_get_template_popup_settings(__FILE__);
$popup_enabled  = (bool) ($popup_settings['enabled'] ?? false);

if (! function_exists('thankslead_render_icon')) {
    function thankslead_render_icon($name, $class = 'w-6 h-6')
    {
        $icons = array(
            'check-circle'   => '<path d="M9 11l3 3l6-6"></path><circle cx="12" cy="12" r="10"></circle>',
            'review'         => '<path d="M12 20h9"></path><path d="M12 4h9"></path><path d="M12 12h9"></path><path d="M3 5c0-.6.4-1 1-1h4c.6 0 1 .4 1 1v4c0 .6-.4 1-1 1H4c-.6 0-1-.4-1-1z"></path><path d="M3 13c0-.6.4-1 1-1h4c.6 0 1 .4 1 1v4c0 .6-.4 1-1 1H4c-.6 0-1-.4-1-1z"></path>',
            'calendar'       => '<path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path>',
            'sparkles'       => '<path d="M12 3v4"></path><path d="M12 17v4"></path><path d="M3 12h4"></path><path d="M17 12h4"></path><path d="M18.36 5.64 16 8"></path><path d="M8 16 5.64 18.36"></path><path d="m5.64 5.64 2.36 2.36"></path><path d="M16 16l2.36 2.36"></path><circle cx="12" cy="12" r="2"></circle>',
            'download'       => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="3" y2="15"></line>',
            'phone-call'     => '<path d="M15.05 5A5 5 0 0 1 19 8.95"></path><path d="M15.05 1A9 9 0 0 1 23 8.95"></path><path d="M22 16.92v3a2 2 0 0 1-2.18 2a19.79 19.79 0 0 1-8.63-3.07a19.5 19.5 0 0 1-6-6a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.21 2H7.1a2 2 0 0 1 2 1.72c.12.89.37 1.76.71 2.59a2 2 0 0 1-.45 2.11L8.09 9a16 16 0 0 0 6 6l.55-.28a2 2 0 0 1 2.11-.45a13 13 0 0 0 2.59.7A2 2 0 0 1 22 16.92z"></path>',
            'target'         => '<circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle><path d="M22 2l-5.6 5.6"></path><path d="M16 2h6v6"></path>',
            'handshake'      => '<path d="M11 12.5 7 9H2v6h3l7.5 7"></path><path d="m7 9 5 5c.96.96 2.56.73 3.21-.48L17 9"></path><path d="m2 9 3-6h4l4 4"></path><path d="M22 15v-6h-5l-1.09-1.09"></path><path d="m18 19-3-3"></path><path d="m22 9-3-6h-4l-2.11 2.11"></path>',
        );

        if (! isset($icons[$name])) {
            return '';
        }

        return sprintf(
            '<svg class="%1$s" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%2$s</svg>',
            esc_attr($class),
            $icons[$name]
        );
    }
}

get_header();

$appointment_url  = home_url('/book-free-call');
$appointment_link = webmakerr_get_popup_link_attributes($appointment_url, $popup_enabled);
?>

<main id="primary" class="flex flex-col bg-white">
  <div class="mx-auto w-full max-w-6xl px-4 pb-16 pt-20 sm:px-6 sm:pt-24 lg:px-8 lg:pb-24">
    <?php while (have_posts()) : the_post(); ?>
      <article <?php post_class('flex flex-col gap-16'); ?>>
        <section class="relative overflow-hidden rounded-[5px] border border-zinc-200 bg-gradient-to-br from-white via-white to-primary/5 px-6 py-14 sm:px-10 sm:py-16 lg:px-16">
          <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-primary/10 blur-3xl"></div>
          <div class="absolute -bottom-32 -right-10 h-72 w-72 rounded-full bg-dark/5 blur-3xl"></div>
          <div class="relative grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <header class="flex flex-col gap-6">
              <span class="inline-flex w-fit items-center gap-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.26em] text-primary">
                <?php esc_html_e('Resource requested successfully', 'webmakerr'); ?>
              </span>
              <div class="flex flex-col gap-5">
                <div class="flex items-center gap-3">
                  <span class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                  echo thankslead_render_icon('download', 'h-7 w-7'); ?></span>
                  <h1 class="text-4xl font-medium tracking-tight [text-wrap:balance] text-zinc-950 sm:text-5xl">
                    <?php esc_html_e('Your Free Download Is on the Way!', 'webmakerr'); ?>
                  </h1>
                </div>
                <p class="max-w-2xl text-base leading-7 text-zinc-600 sm:text-lg">
                  <?php esc_html_e('We just delivered your resource to your inbox. While you dive in, let’s map the fastest path to results with a strategy call.', 'webmakerr'); ?>
                </p>
              </div>
              <div class="flex flex-col gap-5 rounded-[5px] border border-zinc-200 bg-white/80 p-6 shadow-sm">
                <div class="flex items-start gap-4">
                  <span class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                  echo thankslead_render_icon('phone-call', 'h-7 w-7'); ?></span>
                  <div class="flex flex-col gap-3">
                    <h2 class="text-xl font-semibold text-zinc-950">
                      <?php esc_html_e('Unlock tailored guidance with a free strategy call.', 'webmakerr'); ?>
                    </h2>
                    <p class="text-sm text-zinc-600">
                      <?php esc_html_e('Connect with a marketing strategist who will review your goals, surface quick wins, and outline a growth roadmap built around your offer.', 'webmakerr'); ?>
                    </p>
                  </div>
                </div>
                <div class="mt-2 flex flex-col items-center text-center">
                  <a class="btn btn-primary inline-flex items-center justify-center rounded-[5px] bg-black px-6 py-3 font-semibold text-white !no-underline" href="<?php echo esc_url($appointment_link['href']); ?>"<?php echo $appointment_link['attributes']; ?>>
                    <?php esc_html_e('Book My Free Call', 'webmakerr'); ?>
                  </a>
                  <p class="mt-2 text-center text-sm text-gray-600">
                    <?php esc_html_e('Spots fill quickly—secure your time in under 60 seconds.', 'webmakerr'); ?>
                  </p>
                </div>
              </div>
            </header>
            <div class="relative isolate overflow-hidden rounded-[5px] border border-white/60 bg-white/80 p-8 shadow-xl shadow-primary/10 backdrop-blur">
              <div class="absolute -left-10 -top-12 h-40 w-40 rounded-full bg-primary/10 blur-3xl"></div>
              <div class="absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-dark/5 blur-3xl"></div>
              <div class="relative flex flex-col gap-6">
                <div class="flex flex-col gap-3 text-left">
                  <span class="inline-flex w-fit items-center gap-2 rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-zinc-500">
                    <?php esc_html_e('Inside your inbox', 'webmakerr'); ?>
                  </span>
                  <p class="text-lg font-medium text-zinc-950">
                    <?php esc_html_e('Download link, pro tips, and a quick-start checklist to implement today.', 'webmakerr'); ?>
                  </p>
                </div>
                <ul class="grid gap-3 text-sm text-zinc-600">
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white px-4 py-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo thankslead_render_icon('review'); ?></span>
                    <span><?php esc_html_e('Personalized insights curated by our growth team.', 'webmakerr'); ?></span>
                  </li>
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white px-4 py-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo thankslead_render_icon('calendar'); ?></span>
                    <span><?php esc_html_e('Exclusive access to priority calendar slots for new clients.', 'webmakerr'); ?></span>
                  </li>
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white px-4 py-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo thankslead_render_icon('sparkles'); ?></span>
                    <span><?php esc_html_e('Action-ready ideas you can implement before we meet.', 'webmakerr'); ?></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>

        <div class="flex justify-center pt-8">
          <a class="btn btn-primary inline-flex items-center justify-center rounded-[5px] bg-black px-6 py-3 font-semibold text-white !no-underline" href="<?php echo esc_url($appointment_link['href']); ?>"<?php echo $appointment_link['attributes']; ?>>
            <?php esc_html_e('Reserve My Free Strategy Call', 'webmakerr'); ?>
          </a>
        </div>

        <section class="rounded-[5px] border border-zinc-200 bg-white p-8 shadow-sm sm:p-10">
          <header class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Here’s What Happens Next', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg">
              <?php esc_html_e('Our concierge onboarding keeps momentum high so you move from download to done in record time.', 'webmakerr'); ?>
            </p>
          </header>
          <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php
            $steps = array(
                array(
                    'icon'        => 'check-circle',
                    'title'       => __('We Confirm Your Goals', 'webmakerr'),
                    'description' => __('A strategist reviews your submission and gathers any missing context within one business day.', 'webmakerr'),
                ),
                array(
                    'icon'        => 'calendar',
                    'title'       => __('You Book the Call', 'webmakerr'),
                    'description' => __('Choose the time that fits best—our priority calendar is reserved for new downloads like yours.', 'webmakerr'),
                ),
                array(
                    'icon'        => 'target',
                    'title'       => __('We Build Your Roadmap', 'webmakerr'),
                    'description' => __('During the session we co-create a 90-day growth plan with clear deliverables and next actions.', 'webmakerr'),
                ),
            );

            foreach ($steps as $step) :
                ?>
                <article class="flex h-full flex-col items-center rounded-[5px] border border-zinc-200 bg-zinc-50 p-6 text-center shadow-sm transition hover:border-primary/40 hover:shadow-md">
                  <div class="flex flex-col items-center">
                    <?php
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo thankslead_render_icon($step['icon']);
                    ?>
                    <h3 class="mt-3 text-xl font-semibold text-zinc-950">
                      <?php echo esc_html($step['title']); ?>
                    </h3>
                  </div>
                  <p class="mt-3 text-sm leading-6 text-zinc-600">
                    <?php echo esc_html($step['description']); ?>
                  </p>
                </article>
                <?php
            endforeach;
            ?>
          </div>
        </section>

        <section class="relative overflow-hidden rounded-[5px] border border-zinc-200 bg-gradient-to-br from-primary/5 via-white to-white p-10 shadow-sm sm:p-12">
          <div class="absolute inset-y-0 left-1/2 hidden w-1/2 -translate-x-1/2 bg-gradient-to-r from-primary/10 via-transparent to-transparent blur-3xl lg:block"></div>
          <div class="relative mx-auto flex max-w-3xl flex-col items-center gap-6 text-center">
            <header class="flex flex-col gap-4">
              <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
                <?php esc_html_e('Book Your Free Call', 'webmakerr'); ?>
              </h2>
              <p class="text-base leading-7 text-zinc-600 sm:text-lg">
                <?php esc_html_e('Let’s discuss how we can help you grow—your complimentary consultation is one click away.', 'webmakerr'); ?>
              </p>
            </header>
            <div class="flex flex-col items-center justify-center gap-3 sm:flex-row">
              <a class="btn btn-primary inline-flex items-center justify-center rounded-[5px] px-5 py-2 text-sm font-semibold !no-underline" href="<?php echo esc_url($appointment_link['href']); ?>"<?php echo $appointment_link['attributes']; ?>>
                <?php esc_html_e('Reserve My Free Strategy Call', 'webmakerr'); ?>
              </a>
              <span class="text-sm text-zinc-500">
                <?php esc_html_e('Limited availability each week—schedule now to lock in your spot.', 'webmakerr'); ?>
              </span>
            </div>
            <div class="flex flex-col items-center gap-3 rounded-[5px] border border-zinc-200 bg-white/80 p-6 text-left shadow-sm sm:flex-row sm:items-center sm:text-center sm:justify-center">
              <span class="flex h-11 w-11 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
              echo thankslead_render_icon('handshake', 'h-6 w-6'); ?></span>
              <p class="text-sm leading-6 text-zinc-600">
                <?php esc_html_e('“The insights from our first call paid for the project in weeks. Their team is the real deal.” — Avery Chen, VP of Growth', 'webmakerr'); ?>
              </p>
            </div>
          </div>
        </section>

        <section class="flex flex-col items-center gap-3 rounded-[5px] border border-zinc-200 bg-white p-6 text-center shadow-sm">
          <p class="text-xs font-semibold uppercase tracking-[0.3em] text-zinc-500">
            <?php esc_html_e('Trusted by professionals worldwide', 'webmakerr'); ?>
          </p>
          <p class="text-sm text-zinc-500">
            <?php esc_html_e('From venture-backed startups to global agencies, leaders count on Webmakerr to ship campaigns faster.', 'webmakerr'); ?>
          </p>
        </section>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<?php
webmakerr_render_template_popup($popup_settings);

get_footer();
?>
