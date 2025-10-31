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
            'check-circle' => '<path d="M9 11l3 3l6-6"></path><circle cx="12" cy="12" r="10"></circle>',
            'review'       => '<path d="M12 20h9"></path><path d="M12 4h9"></path><path d="M12 12h9"></path><path d="M3 5c0-.6.4-1 1-1h4c.6 0 1 .4 1 1v4c0 .6-.4 1-1 1H4c-.6 0-1-.4-1-1z"></path><path d="M3 13c0-.6.4-1 1-1h4c.6 0 1 .4 1 1v4c0 .6-.4 1-1 1H4c-.6 0-1-.4-1-1z"></path>',
            'calendar'     => '<path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path>',
            'sparkles'     => '<path d="M12 3v4"></path><path d="M12 17v4"></path><path d="M3 12h4"></path><path d="M17 12h4"></path><path d="M18.36 5.64 16 8"></path><path d="M8 16 5.64 18.36"></path><path d="m5.64 5.64 2.36 2.36"></path><path d="M16 16l2.36 2.36"></path><circle cx="12" cy="12" r="2"></circle>'
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

$appointment_url   = home_url('/book-a-call');
$appointment_link  = webmakerr_get_popup_link_attributes($appointment_url, $popup_enabled);
?>

<main id="primary" class="bg-white py-16 sm:py-20 lg:py-24">
  <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
    <?php while (have_posts()) : the_post(); ?>
      <article <?php post_class('flex flex-col gap-16'); ?>>
        <section class="relative overflow-hidden rounded-[5px] border border-zinc-200 bg-gradient-to-br from-white via-white to-primary/5 px-6 py-14 sm:px-10 sm:py-16 lg:px-16">
          <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-primary/10 blur-3xl"></div>
          <div class="absolute -bottom-32 -right-10 h-72 w-72 rounded-full bg-dark/5 blur-3xl"></div>
          <div class="relative grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <header class="flex flex-col gap-6">
              <span class="inline-flex w-fit items-center gap-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.26em] text-primary">
                <?php esc_html_e('We appreciate your trust', 'webmakerr'); ?>
              </span>
              <div class="flex flex-col gap-5">
                <div class="flex items-center gap-3">
                  <span class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                  echo thankslead_render_icon('check-circle', 'h-7 w-7'); ?></span>
                  <h1 class="text-4xl font-medium tracking-tight [text-wrap:balance] text-zinc-950 sm:text-5xl">
                    <?php esc_html_e("Thank You! We've Received Your Request.", 'webmakerr'); ?>
                  </h1>
                </div>
                <p class="max-w-2xl text-base leading-7 text-zinc-600 sm:text-lg">
                  <?php esc_html_e('Our team is already reviewing your submission. Expect a tailored response soon, along with resources that help you prepare for your appointment.', 'webmakerr'); ?>
                </p>
              </div>
              <div class="rounded-[5px] border border-zinc-200 bg-white/80 p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-zinc-950">
                  <?php esc_html_e('Next up: book a quick conversation so we can plan your next move.', 'webmakerr'); ?>
                </h2>
                <p class="mt-3 text-sm text-zinc-600">
                  <?php esc_html_e('Pick a time that works for you and we’ll come prepared with recommendations tailored to your goals.', 'webmakerr'); ?>
                </p>
              </div>
            </header>
            <div class="relative isolate rounded-[5px] border border-white/60 bg-white/80 p-6 shadow-xl shadow-primary/10 backdrop-blur">
              <div class="absolute -left-10 -top-12 h-40 w-40 rounded-full bg-primary/10 blur-3xl"></div>
              <div class="absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-dark/5 blur-3xl"></div>
              <div class="relative flex flex-col gap-4">
                <div class="rounded-[5px] border border-zinc-200 bg-white/80 p-6 shadow-sm">
                  <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">
                    <?php esc_html_e('Thank you for reaching out', 'webmakerr'); ?>
                  </p>
                  <p class="mt-2 text-sm text-zinc-600">
                    <?php esc_html_e('We work with every lead personally to ensure you have a clear path to results before we begin.', 'webmakerr'); ?>
                  </p>
                </div>
                <ul class="grid gap-3 text-sm text-zinc-600">
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white px-4 py-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo thankslead_render_icon('review'); ?></span>
                    <span><?php esc_html_e('A strategist reviews your goals to craft the best action plan.', 'webmakerr'); ?></span>
                  </li>
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white px-4 py-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo thankslead_render_icon('calendar'); ?></span>
                    <span><?php esc_html_e('You’ll receive an email with available times to meet live.', 'webmakerr'); ?></span>
                  </li>
                  <li class="flex items-center gap-3 rounded-[5px] border border-zinc-200 bg-white px-4 py-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary"><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo thankslead_render_icon('sparkles'); ?></span>
                    <span><?php esc_html_e('Together we map out the simple steps to launch your next big win.', 'webmakerr'); ?></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>

        <section class="rounded-[5px] border border-zinc-200 bg-white p-8 shadow-sm sm:p-10">
          <header class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php esc_html_e('What Happens Next', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg">
              <?php esc_html_e('We keep the process simple so you know exactly how we move from introduction to results.', 'webmakerr'); ?>
            </p>
          </header>
          <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php
            $steps = array(
                array(
                    'icon'        => 'review',
                    'title'       => __('We Review', 'webmakerr'),
                    'description' => __('Our team examines your submission and clarifies objectives within one business day.', 'webmakerr'),
                ),
                array(
                    'icon'        => 'calendar',
                    'title'       => __('You Book', 'webmakerr'),
                    'description' => __('Choose a meeting slot that fits your schedule and invite stakeholders to join.', 'webmakerr'),
                ),
                array(
                    'icon'        => 'sparkles',
                    'title'       => __('We Deliver', 'webmakerr'),
                    'description' => __('Meet with our experts to confirm next steps, resources, and launch timeline.', 'webmakerr'),
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

        <section class="rounded-[5px] border border-zinc-200 bg-gradient-to-br from-primary/5 via-white to-white p-10 text-center shadow-sm sm:p-12">
          <div class="mx-auto flex max-w-2xl flex-col items-center gap-6">
            <header class="flex flex-col gap-4">
              <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
                <?php esc_html_e('Book Your Free Appointment', 'webmakerr'); ?>
              </h2>
              <p class="text-base leading-7 text-zinc-600 sm:text-lg">
                <?php esc_html_e('Schedule a free consultation to review your goals, align on priorities, and plan the right solution.', 'webmakerr'); ?>
              </p>
            </header>
            <div class="flex flex-col items-center justify-center gap-3 sm:flex-row">
              <a class="btn btn-primary inline-flex items-center justify-center rounded-[5px] px-5 py-2 text-sm font-semibold !no-underline" href="<?php echo esc_url($appointment_link['href']); ?>"<?php echo $appointment_link['attributes']; ?>>
                <?php esc_html_e('Schedule My Free Call', 'webmakerr'); ?>
              </a>
              <span class="text-sm text-zinc-500">
                <?php esc_html_e('No pressure, no obligations — just expert guidance for your next step.', 'webmakerr'); ?>
              </span>
            </div>
          </div>
        </section>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<?php
webmakerr_render_template_popup($popup_settings);

get_footer();
?>
