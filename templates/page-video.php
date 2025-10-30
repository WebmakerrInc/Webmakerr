<?php
/**
 * Template Name: Video Production
 * Description: High-converting video services landing page inspired by Loftfilm.de.
 *
 * @package Webmakerr
 */

if (! defined('ABSPATH')) {
    exit;
}

$script_handle = 'webmakerr-build-assets-app-js';
$inline_bootstrap = <<<JS
(function() {
    if (window.__webmakerrVideoLandingInitialized) {
        return;
    }
    window.__webmakerrVideoLandingInitialized = true;

    var init = function() {
        var leadButtons = document.querySelectorAll('[data-lead-popup-trigger]');
        var promo = document.getElementById('promo-popup');
        var promoContent = document.getElementById('promoContent');

        if (leadButtons.length && promo) {
            try {
                var storage = window.localStorage;
                if (storage) {
                    storage.removeItem('promoDismissed');
                }
            } catch (error) {
                /* noop */
            }

            var openPromo = function(event) {
                if (event) {
                    event.preventDefault();
                }

                try {
                    var sessionStore = window.sessionStorage;
                    if (sessionStore) {
                        sessionStore.setItem('promoShownSession', 'true');
                    }
                } catch (error) {
                    /* noop */
                }

                promo.classList.remove('hidden');
                promo.setAttribute('aria-hidden', 'false');
                promo.classList.add('opacity-0');

                if (promoContent) {
                    promoContent.classList.add('translate-y-4', 'scale-95', 'opacity-0');
                }

                window.requestAnimationFrame(function() {
                    promo.classList.remove('opacity-0');
                    if (promoContent) {
                        promoContent.classList.remove('translate-y-4', 'scale-95', 'opacity-0');
                    }
                });
            };

            leadButtons.forEach(function(button) {
                button.addEventListener('click', openPromo);
            });
        }

        var animated = document.querySelectorAll('[data-animate]');
        if (animated.length) {
            animated.forEach(function(element) {
                var delay = element.getAttribute('data-animate-delay');
                if (delay) {
                    element.style.transitionDelay = delay + 'ms';
                }
            });

            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    observer.unobserve(entry.target);
                });
            }, { threshold: 0.2 });

            animated.forEach(function(element) {
                observer.observe(element);
            });
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
JS;

if (wp_script_is($script_handle, 'enqueued') || wp_script_is($script_handle, 'registered')) {
    wp_add_inline_script($script_handle, $inline_bootstrap);
} else {
    wp_register_script($script_handle, false, [], null, true);
    wp_add_inline_script($script_handle, $inline_bootstrap);
    wp_enqueue_script($script_handle);
}

if (! function_exists('webmakerr_video_template_icon')) {
    function webmakerr_video_template_icon(string $icon): string
    {
        switch ($icon) {
            case 'strategy':
                $path = 'M3.75 6.75l3.5-2.25L10.75 6.75M3.75 17.25l3.5-2.25L10.75 17.25M3.75 12l3.5-2.25L10.75 12M13.25 6.75h6m-6 5.25h6m-6 5.25h6';
                break;
            case 'script':
                $path = 'M4.5 3h11.25a1.5 1.5 0 0 1 1.5 1.5V15l-4.5-3-4.5 3V4.5A1.5 1.5 0 0 1 11.25 3zM4.5 3v15';
                break;
            case 'production':
                $path = 'M4 6.75h16m-16 0a2 2 0 0 0-2 2V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8.75a2 2 0 0 0-2-2m-16 0L6.5 3h11L20 6.75M8 12h8';
                break;
            default:
                $path = 'M12 6v12m6-6H6';
                break;
        }

        return '<svg class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="' . esc_attr($path) . '" /></svg>';
    }
}

get_header();
?>

<main id="primary" class="flex flex-col gap-24 bg-white pb-24 pt-16 sm:gap-28 sm:pt-20 lg:gap-32 lg:pt-24">
  <div class="mx-auto w-full max-w-6xl px-6 lg:px-8">
    <?php while (have_posts()) : the_post();
        $post_id = get_the_ID();

        $hero_headline = get_post_meta($post_id, '_webmakerr_video_hero_headline', true);
        $hero_headline = $hero_headline ? wp_kses_post($hero_headline) : __('We Create Films That Tell Your Brand’s Story.', 'webmakerr');

        $hero_subheadline = get_post_meta($post_id, '_webmakerr_video_hero_subheadline', true);
        $hero_subheadline = $hero_subheadline ? wp_kses_post($hero_subheadline) : __('From concept to final cut, our studio crafts cinematic experiences that convert viewers into loyal customers.', 'webmakerr');

        $hero_primary_label = get_post_meta($post_id, '_webmakerr_video_hero_primary_label', true);
        $hero_primary_label = $hero_primary_label ? sanitize_text_field($hero_primary_label) : __('Book Your Free Strategy Call', 'webmakerr');

        $hero_secondary_label = get_post_meta($post_id, '_webmakerr_video_hero_secondary_label', true);
        $hero_secondary_label = $hero_secondary_label ? sanitize_text_field($hero_secondary_label) : __('See Our Work', 'webmakerr');

        $hero_secondary_target = get_post_meta($post_id, '_webmakerr_video_hero_secondary_target', true);
        $hero_secondary_target = $hero_secondary_target ? esc_url($hero_secondary_target) : '#portfolio';

        $hero_video_id = (int) get_post_meta($post_id, '_webmakerr_video_hero_video', true);
        $hero_video_src = $hero_video_id ? wp_get_attachment_url($hero_video_id) : '';

        $hero_poster_id = (int) get_post_meta($post_id, '_webmakerr_video_hero_poster', true);
        $hero_poster_src = $hero_poster_id ? wp_get_attachment_image_src($hero_poster_id, 'full') : false;
        $hero_poster_url = $hero_poster_src ? $hero_poster_src[0] : '';

        $about_heading = get_post_meta($post_id, '_webmakerr_video_about_heading', true);
        $about_heading = $about_heading ? sanitize_text_field($about_heading) : __('Video that launches products, sparks emotion, and builds trust.', 'webmakerr');

        $about_highlights = get_post_meta($post_id, '_webmakerr_video_about_highlights', true);
        $about_highlights = is_array($about_highlights) ? $about_highlights : [
            [
                'title' => __('Story-driven scripting', 'webmakerr'),
                'copy'  => __('We uncover your hook, craft persuasive messaging, and map a shot list designed to convert.', 'webmakerr'),
            ],
            [
                'title' => __('Full-service production', 'webmakerr'),
                'copy'  => __('Directors, cinematographers, and editors manage every detail so you stay focused on launch day.', 'webmakerr'),
            ],
            [
                'title' => __('Distribution ready assets', 'webmakerr'),
                'copy'  => __('Deliverables are optimized for web, paid media, and event screens—no extra edits required.', 'webmakerr'),
            ],
        ];

        $process_steps = get_post_meta($post_id, '_webmakerr_video_process_steps', true);
        $process_steps = is_array($process_steps) ? $process_steps : [
            [
                'title' => __('Strategy Workshop', 'webmakerr'),
                'copy'  => __('We clarify goals, audience, and key messaging in a focused kickoff session.', 'webmakerr'),
                'icon'  => 'strategy',
            ],
            [
                'title' => __('Script & Storyboards', 'webmakerr'),
                'copy'  => __('Our creative team develops scripts, shot lists, and mood boards that align with your brand.', 'webmakerr'),
                'icon'  => 'script',
            ],
            [
                'title' => __('Production & Post', 'webmakerr'),
                'copy'  => __('We capture cinematic footage, mix audio, and deliver polished edits with lightning-fast revisions.', 'webmakerr'),
                'icon'  => 'production',
            ],
        ];

        $portfolio_items = get_post_meta($post_id, '_webmakerr_video_portfolio', true);
        $portfolio_items = is_array($portfolio_items) ? $portfolio_items : [
            [
                'title'    => __('Product Launch Film', 'webmakerr'),
                'category' => __('SaaS', 'webmakerr'),
                'image'    => 0,
            ],
            [
                'title'    => __('Brand Anthem', 'webmakerr'),
                'category' => __('Lifestyle', 'webmakerr'),
                'image'    => 0,
            ],
            [
                'title'    => __('Event Recap', 'webmakerr'),
                'category' => __('Enterprise', 'webmakerr'),
                'image'    => 0,
            ],
            [
                'title'    => __('Customer Story', 'webmakerr'),
                'category' => __('Ecommerce', 'webmakerr'),
                'image'    => 0,
            ],
        ];

        $testimonials = get_post_meta($post_id, '_webmakerr_video_testimonials', true);
        $testimonials = is_array($testimonials) ? $testimonials : [
            [
                'quote'  => __('“The Webmakerr film team translated our complex product into a story our customers instantly understood. Conversions grew 32% in the first week.”', 'webmakerr'),
                'author' => __('Jordan Blake', 'webmakerr'),
                'role'   => __('VP of Marketing, SignalCore', 'webmakerr'),
            ],
            [
                'quote'  => __('“Every deliverable was on-brand and ready for paid campaigns. The crew handled everything from casting to color grade flawlessly.”', 'webmakerr'),
                'author' => __('Priya Desai', 'webmakerr'),
                'role'   => __('Head of Growth, Nova Commerce', 'webmakerr'),
            ],
        ];

        $client_logos = get_post_meta($post_id, '_webmakerr_video_client_logos', true);
        $client_logos = is_array($client_logos) ? $client_logos : [
            [
                'name'  => __('SignalCore', 'webmakerr'),
                'image' => 0,
            ],
            [
                'name'  => __('Nova Commerce', 'webmakerr'),
                'image' => 0,
            ],
            [
                'name'  => __('Brightscale', 'webmakerr'),
                'image' => 0,
            ],
            [
                'name'  => __('Fabrik Labs', 'webmakerr'),
                'image' => 0,
            ],
            [
                'name'  => __('Northwind Retail', 'webmakerr'),
                'image' => 0,
            ],
            [
                'name'  => __('Lumenrise', 'webmakerr'),
                'image' => 0,
            ],
        ];

        $cta_heading = get_post_meta($post_id, '_webmakerr_video_cta_heading', true);
        $cta_heading = $cta_heading ? sanitize_text_field($cta_heading) : __('Ready to capture your next big moment?', 'webmakerr');

        $cta_copy = get_post_meta($post_id, '_webmakerr_video_cta_copy', true);
        $cta_copy = $cta_copy ? wp_kses_post($cta_copy) : __('Let’s plan a content engine that blends cinematic craft with measurable growth. Schedule a discovery call and we’ll build your launch roadmap together.', 'webmakerr');

        $cta_button = get_post_meta($post_id, '_webmakerr_video_cta_button', true);
        $cta_button = $cta_button ? sanitize_text_field($cta_button) : __('Start Your Project', 'webmakerr');
        ?>

    <article <?php post_class('flex flex-col gap-24 sm:gap-28 lg:gap-32'); ?>>
      <section class="relative overflow-hidden rounded-[5px] border border-zinc-200 bg-zinc-900 text-white shadow-[0_40px_80px_-40px_rgba(15,23,42,0.6)]">
        <div class="absolute inset-0">
          <?php if ($hero_video_src) : ?>
            <video class="h-full w-full object-cover" autoplay loop muted playsinline <?php echo $hero_poster_url ? 'poster="' . esc_url($hero_poster_url) . '"' : ''; ?>>
              <source src="<?php echo esc_url($hero_video_src); ?>" type="<?php echo esc_attr(wp_check_filetype($hero_video_src)['type'] ?? 'video/mp4'); ?>" />
            </video>
          <?php elseif ($hero_poster_url) : ?>
            <img class="h-full w-full object-cover" src="<?php echo esc_url($hero_poster_url); ?>" alt="" />
          <?php elseif (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('full', ['class' => 'h-full w-full object-cover']); ?>
          <?php else : ?>
            <div class="h-full w-full bg-gradient-to-br from-primary/40 via-zinc-900 to-zinc-950"></div>
          <?php endif; ?>
          <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/80 via-zinc-900/60 to-zinc-900/40"></div>
        </div>

        <div class="relative z-10 flex flex-col gap-8 px-8 py-24 sm:px-12 sm:py-28 lg:flex-row lg:items-end lg:justify-between lg:gap-14 lg:py-32">
          <div class="max-w-3xl space-y-6 text-left opacity-0 translate-y-8 transition-all duration-700" data-animate>
            <p class="inline-flex items-center gap-2 rounded-[5px] bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white">
              <?php esc_html_e('Video Production Studio', 'webmakerr'); ?>
            </p>
            <h1 class="text-4xl font-medium leading-tight tracking-tight text-balance sm:text-5xl lg:text-6xl">
              <?php echo wp_kses_post($hero_headline); ?>
            </h1>
            <p class="text-base leading-7 text-white/80 sm:text-lg">
              <?php echo wp_kses_post($hero_subheadline); ?>
            </p>
            <div class="flex flex-col gap-3 pt-2 sm:flex-row">
              <a
                class="inline-flex items-center justify-center rounded-[5px] bg-primary px-5 py-2 text-sm font-semibold text-white shadow transition hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                href="#lead-capture"
                data-lead-popup-trigger
              >
                <?php echo esc_html($hero_primary_label); ?>
              </a>
              <a
                class="inline-flex items-center justify-center rounded-[5px] border border-white/30 px-5 py-2 text-sm font-semibold text-white transition hover:border-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                href="<?php echo esc_url($hero_secondary_target); ?>"
              >
                <?php echo esc_html($hero_secondary_label); ?>
              </a>
            </div>
          </div>

          <div class="grid gap-4 rounded-[5px] border border-white/10 bg-white/5 p-6 backdrop-blur opacity-0 translate-y-8 transition-all duration-700" data-animate data-animate-delay="150">
            <div class="flex items-center gap-3">
              <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.536-9.536a.75.75 0 10-1.072-1.05L9 10.879 7.536 9.414a.75.75 0 10-1.061 1.061l2 2a.75.75 0 001.06 0l3-3z" clip-rule="evenodd" /></svg>
              </span>
              <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/70"><?php esc_html_e('Trusted By', 'webmakerr'); ?></p>
                <p class="text-base font-medium text-white"><?php esc_html_e('200+ product teams', 'webmakerr'); ?></p>
              </div>
            </div>
            <div class="h-[1px] w-full bg-white/10"></div>
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/70"><?php esc_html_e('Turnaround', 'webmakerr'); ?></p>
              <p class="mt-1 text-base font-medium text-white"><?php esc_html_e('Average delivery in 21 days', 'webmakerr'); ?></p>
            </div>
          </div>
        </div>
      </section>

      <section id="about" class="grid gap-12 lg:grid-cols-[minmax(0,_1.15fr)_minmax(0,_0.85fr)]" aria-labelledby="about-heading">
        <div class="flex flex-col justify-center gap-6 opacity-0 translate-y-8 transition-all duration-700" data-animate>
          <h2 id="about-heading" class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
            <?php echo esc_html($about_heading); ?>
          </h2>
          <div class="prose prose-zinc max-w-none text-zinc-600 sm:prose-lg">
            <?php
            $content = get_the_content();
            if ($content) {
                the_content();
            } else {
                echo wp_kses_post('<p>' . __('Partner with an in-house crew obsessed with narrative craft, performance data, and post-production polish. We plug directly into your marketing roadmap, then deliver videos engineered to convert across campaigns.', 'webmakerr') . '</p>');
            }
            ?>
          </div>
        </div>

        <div class="grid gap-4 opacity-0 translate-y-8 transition-all duration-700" data-animate data-animate-delay="120">
          <?php foreach ($about_highlights as $highlight_index => $highlight) :
              $title = isset($highlight['title']) ? sanitize_text_field($highlight['title']) : '';
              $copy  = isset($highlight['copy']) ? wp_kses_post($highlight['copy']) : '';
              ?>
            <div class="rounded-[5px] border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
              <h3 class="text-xl font-semibold text-zinc-950"><?php echo esc_html($title); ?></h3>
              <?php if ($copy) : ?>
                <p class="mt-2 text-sm leading-6 text-zinc-600"><?php echo $copy; ?></p>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <section id="process" class="flex flex-col gap-12" aria-labelledby="process-heading">
        <div class="max-w-3xl opacity-0 translate-y-8 transition-all duration-700" data-animate>
          <h2 id="process-heading" class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
            <?php esc_html_e('How we bring your story to life', 'webmakerr'); ?>
          </h2>
          <p class="mt-4 text-base leading-7 text-zinc-600 sm:text-lg">
            <?php esc_html_e('A collaborative playbook that keeps your stakeholders aligned from kickoff to final delivery.', 'webmakerr'); ?>
          </p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
          <?php foreach ($process_steps as $index => $step) :
              $title = isset($step['title']) ? sanitize_text_field($step['title']) : '';
              $copy  = isset($step['copy']) ? wp_kses_post($step['copy']) : '';
              $icon  = isset($step['icon']) ? sanitize_key($step['icon']) : '';
              ?>
            <div class="flex h-full flex-col gap-4 rounded-[5px] border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg opacity-0 translate-y-8 duration-700" data-animate data-animate-delay="<?php echo esc_attr($index * 120); ?>">
              <span class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                <?php echo wp_kses(webmakerr_video_template_icon($icon), ['svg' => ['class' => true, 'viewbox' => true, 'viewBox' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true, 'aria-hidden' => true], 'path' => ['d' => true]]); ?>
              </span>
              <h3 class="text-lg font-semibold text-zinc-950">
                <?php echo esc_html($title); ?>
              </h3>
              <?php if ($copy) : ?>
                <p class="text-sm leading-6 text-zinc-600"><?php echo $copy; ?></p>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <section id="portfolio" class="flex flex-col gap-12" aria-labelledby="portfolio-heading">
        <div class="flex flex-col gap-4 opacity-0 translate-y-8 transition-all duration-700" data-animate>
          <h2 id="portfolio-heading" class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
            <?php esc_html_e('Recent productions', 'webmakerr'); ?>
          </h2>
          <p class="text-base leading-7 text-zinc-600 sm:text-lg">
            <?php esc_html_e('Launch films, testimonials, and social-first edits designed for every stage of your funnel.', 'webmakerr'); ?>
          </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
          <?php foreach ($portfolio_items as $index => $item) :
              $title    = isset($item['title']) ? sanitize_text_field($item['title']) : '';
              $category = isset($item['category']) ? sanitize_text_field($item['category']) : '';
              $image_id = isset($item['image']) ? (int) $item['image'] : 0;
              ?>
            <div class="group flex h-full flex-col gap-4 rounded-[5px] border border-zinc-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg opacity-0 translate-y-8 duration-700" data-animate data-animate-delay="<?php echo esc_attr($index * 100); ?>">
              <div class="relative aspect-[4/3] w-full overflow-hidden rounded-[5px] bg-zinc-100">
                <?php
                if ($image_id) {
                    echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'h-full w-full object-cover transition duration-700 group-hover:scale-105']);
                } else {
                    echo '<div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-white to-primary/20"></div>';
                }
                ?>
              </div>
              <div class="flex flex-col gap-1 px-1 pb-2">
                <?php if ($category) : ?>
                  <span class="text-xs font-semibold uppercase tracking-[0.28em] text-primary/80"><?php echo esc_html($category); ?></span>
                <?php endif; ?>
                <h3 class="text-lg font-semibold text-zinc-950">
                  <?php echo esc_html($title); ?>
                </h3>
              </div>
              <div class="mt-auto px-1">
                <a class="inline-flex items-center gap-2 text-sm font-semibold text-primary transition hover:text-primary/80" href="#lead-capture" data-lead-popup-trigger>
                  <?php esc_html_e('Request case study', 'webmakerr'); ?>
                  <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10.293 4.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <section class="flex flex-col gap-12" aria-labelledby="testimonials-heading">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,_1.1fr)_minmax(0,_0.9fr)]">
          <div class="flex flex-col gap-4 opacity-0 translate-y-8 transition-all duration-700" data-animate>
            <h2 id="testimonials-heading" class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Loved by ambitious brands', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg">
              <?php esc_html_e('Teams rely on us for strategic storytelling, on-location agility, and post-production that turns heads.', 'webmakerr'); ?>
            </p>

            <div class="grid gap-4 sm:grid-cols-2">
              <?php foreach ($client_logos as $logo_index => $logo) :
                  $logo_id = isset($logo['image']) ? (int) $logo['image'] : 0;
                  $logo_name = isset($logo['name']) ? sanitize_text_field($logo['name']) : '';
                  ?>
                <div class="flex h-20 items-center justify-center rounded-[5px] border border-zinc-200 bg-zinc-50 px-6 shadow-sm opacity-0 translate-y-8 transition-all duration-700" data-animate data-animate-delay="<?php echo esc_attr($logo_index * 60); ?>">
                  <?php
                  if ($logo_id) {
                      echo wp_get_attachment_image($logo_id, 'medium', false, ['class' => 'max-h-10 w-auto object-contain']);
                  } elseif ($logo_name) {
                      echo '<span class="text-sm font-semibold tracking-[0.26em] text-zinc-500">' . esc_html($logo_name) . '</span>';
                  } else {
                      echo '<span class="text-sm font-semibold tracking-[0.26em] text-zinc-400">' . esc_html__('Your Logo', 'webmakerr') . '</span>';
                  }
                  ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="flex flex-col gap-6">
            <?php foreach ($testimonials as $testimonial_index => $testimonial) :
                $quote = isset($testimonial['quote']) ? wp_kses_post($testimonial['quote']) : '';
                $author = isset($testimonial['author']) ? sanitize_text_field($testimonial['author']) : '';
                $role = isset($testimonial['role']) ? sanitize_text_field($testimonial['role']) : '';
                ?>
              <blockquote class="flex h-full flex-col justify-between gap-4 rounded-[5px] border border-zinc-200 bg-white p-6 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg opacity-0 translate-y-8 duration-700" data-animate data-animate-delay="<?php echo esc_attr(200 + $testimonial_index * 140); ?>">
                <p class="text-base leading-7 text-zinc-700 sm:text-lg"><?php echo $quote; ?></p>
                <footer class="pt-4">
                  <p class="text-sm font-semibold text-zinc-950"><?php echo esc_html($author); ?></p>
                  <?php if ($role) : ?>
                    <p class="text-xs uppercase tracking-[0.26em] text-zinc-500"><?php echo esc_html($role); ?></p>
                  <?php endif; ?>
                </footer>
              </blockquote>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="overflow-hidden rounded-[5px] border border-primary/20 bg-gradient-to-br from-primary/10 via-white to-primary/10 p-10 shadow-[0_40px_80px_-40px_rgba(14,116,144,0.45)] opacity-0 translate-y-8 transition-all duration-700" aria-labelledby="cta-heading" data-animate>
        <div class="grid gap-8 lg:grid-cols-[minmax(0,_1.1fr)_minmax(0,_0.9fr)] lg:items-center">
          <div class="space-y-5">
            <h2 id="cta-heading" class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php echo esc_html($cta_heading); ?>
            </h2>
            <p class="text-base leading-7 text-zinc-700 sm:text-lg">
              <?php echo wp_kses_post($cta_copy); ?>
            </p>
            <div class="flex flex-wrap gap-3">
              <a class="inline-flex items-center justify-center rounded-[5px] bg-primary px-6 py-2 text-sm font-semibold text-white shadow transition hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="#lead-capture" data-lead-popup-trigger>
                <?php echo esc_html($cta_button); ?>
              </a>
              <a class="inline-flex items-center justify-center rounded-[5px] border border-primary/30 px-6 py-2 text-sm font-semibold text-primary transition hover:border-primary/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="#process">
                <?php esc_html_e('Explore our workflow', 'webmakerr'); ?>
              </a>
            </div>
          </div>

          <div class="relative flex items-center justify-center">
            <div class="pointer-events-none absolute inset-0 rounded-[5px] bg-gradient-to-br from-primary/20 via-transparent to-primary/10 blur-3xl"></div>
            <div class="relative flex flex-col items-start gap-4 rounded-[5px] border border-primary/20 bg-white/90 p-6 shadow-lg backdrop-blur">
              <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary">
                  <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v7a2 2 0 01-2 2h-4l-4 4v-4H4a2 2 0 01-2-2V5z" /></svg>
                </span>
                <div>
                  <p class="text-xs font-semibold uppercase tracking-[0.28em] text-primary/80"><?php esc_html_e('Need a custom quote?', 'webmakerr'); ?></p>
                  <p class="text-sm font-medium text-zinc-950"><?php esc_html_e('We respond within one business day.', 'webmakerr'); ?></p>
                </div>
              </div>
              <ul class="space-y-2 text-sm text-zinc-600">
                <li class="flex items-start gap-2">
                  <span class="mt-1 h-1.5 w-1.5 rounded-full bg-primary"></span>
                  <span><?php esc_html_e('Full-funnel video strategy workshop', 'webmakerr'); ?></span>
                </li>
                <li class="flex items-start gap-2">
                  <span class="mt-1 h-1.5 w-1.5 rounded-full bg-primary"></span>
                  <span><?php esc_html_e('On-location or remote production crews', 'webmakerr'); ?></span>
                </li>
                <li class="flex items-start gap-2">
                  <span class="mt-1 h-1.5 w-1.5 rounded-full bg-primary"></span>
                  <span><?php esc_html_e('Delivery packages for paid, social, and web', 'webmakerr'); ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
    </article>

    <?php endwhile; ?>
  </div>
</main>

<?php
get_footer();
