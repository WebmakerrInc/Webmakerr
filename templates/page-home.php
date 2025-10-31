<?php
/**
 * Template Name: Home Page
 * Description: Coursera-inspired AI skills landing page for Webmakerr.
 *
 * @package Webmakerr
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="bg-[#f5f7ff]">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('flex flex-col'); ?>>
      <?php
      $discover_tiles = array(
          array(
              'title' => __('Launch a new career', 'webmakerr'),
              'description' => __('Follow guided learning paths that transition you into AI-focused roles.', 'webmakerr'),
              'icon' => 'launch-career.svg',
              'url' => home_url('/career-launch'),
          ),
          array(
              'title' => __('Gain in-demand skills', 'webmakerr'),
              'description' => __('Master practical workflows curated by industry leaders.', 'webmakerr'),
              'icon' => 'in-demand-skills.svg',
              'url' => home_url('/skill-building'),
          ),
          array(
              'title' => __('Earn a degree', 'webmakerr'),
              'description' => __('Pursue accredited programs with top universities and companies.', 'webmakerr'),
              'icon' => 'earn-degree.svg',
              'url' => home_url('/degrees'),
          ),
      );

      $trusted_brands = array(
          array(
              'name' => __('Aurora Institute', 'webmakerr'),
              'logo' => 'brand-aurora.svg',
          ),
          array(
              'name' => __('Northwind University', 'webmakerr'),
              'logo' => 'brand-northwind.svg',
          ),
          array(
              'name' => __('Summit Labs', 'webmakerr'),
              'logo' => 'brand-summit.svg',
          ),
          array(
              'name' => __('Lumen College', 'webmakerr'),
              'logo' => 'brand-lumen.svg',
          ),
          array(
              'name' => __('Orbit Partners', 'webmakerr'),
              'logo' => 'brand-orbit.svg',
          ),
      );

      $trending_sections = array(
          array(
              'title' => __('Most popular', 'webmakerr'),
              'icon' => 'sparkles',
              'icon_style' => 'bg-white/80 text-[#4338ca]',
              'courses' => array(
                  array(
                      'provider' => __('Google', 'webmakerr'),
                      'provider_initials' => 'G',
                      'provider_style' => 'bg-[#e8f1ff] text-[#1d4ed8]',
                      'title' => __('Google Project Management', 'webmakerr'),
                      'badge' => __('Professional Certificate', 'webmakerr'),
                      'meta' => array(
                          array('icon' => 'users', 'label' => __('1.4M learners', 'webmakerr')),
                          array('icon' => 'clock', 'label' => __('6-month track', 'webmakerr')),
                      ),
                  ),
                  array(
                      'provider' => __('Meta', 'webmakerr'),
                      'provider_initials' => 'M',
                      'provider_style' => 'bg-[#f3f0ff] text-[#6b21a8]',
                      'title' => __('Meta Social Media Marketing', 'webmakerr'),
                      'badge' => __('Professional Certificate', 'webmakerr'),
                      'meta' => array(
                          array('icon' => 'users', 'label' => __('910k learners', 'webmakerr')),
                          array('icon' => 'spark', 'label' => __('Beginner friendly', 'webmakerr')),
                      ),
                  ),
              ),
          ),
          array(
              'title' => __('Weekly spotlight', 'webmakerr'),
              'icon' => 'calendar-star',
              'icon_style' => 'bg-white/80 text-[#c026d3]',
              'courses' => array(
                  array(
                      'provider' => __('DeepLearning.AI', 'webmakerr'),
                      'provider_initials' => 'DL',
                      'provider_style' => 'bg-[#f0f9ff] text-[#0369a1]',
                      'title' => __('Practical Prompt Engineering for Deep Learning', 'webmakerr'),
                      'badge' => __('Specialization', 'webmakerr'),
                      'meta' => array(
                          array('icon' => 'clock', 'label' => __('3-course series', 'webmakerr')),
                          array('icon' => 'spark', 'label' => __('Hands-on projects', 'webmakerr')),
                      ),
                  ),
                  array(
                      'provider' => __('Macquarie University', 'webmakerr'),
                      'provider_initials' => 'MU',
                      'provider_style' => 'bg-[#eefbf0] text-[#047857]',
                      'title' => __('Excel Skills for Business', 'webmakerr'),
                      'badge' => __('Specialization', 'webmakerr'),
                      'meta' => array(
                          array('icon' => 'users', 'label' => __('1.1M learners', 'webmakerr')),
                          array('icon' => 'stack', 'label' => __('4-course path', 'webmakerr')),
                      ),
                  ),
              ),
          ),
          array(
              'title' => __('In-demand AI skills', 'webmakerr'),
              'icon' => 'chip',
              'icon_style' => 'bg-white/80 text-[#0f766e]',
              'courses' => array(
                  array(
                      'provider' => __('OpenAI', 'webmakerr'),
                      'provider_initials' => 'OA',
                      'provider_style' => 'bg-[#f3f4ff] text-[#4338ca]',
                      'title' => __('Prompt Engineering', 'webmakerr'),
                      'badge' => __('Guided Project', 'webmakerr'),
                      'meta' => array(
                          array('icon' => 'spark', 'label' => __('Create effective prompts', 'webmakerr')),
                          array('icon' => 'clock', 'label' => __('Under 2 hours', 'webmakerr')),
                      ),
                  ),
                  array(
                      'provider' => __('Google', 'webmakerr'),
                      'provider_initials' => 'G',
                      'provider_style' => 'bg-[#e8f1ff] text-[#1d4ed8]',
                      'title' => __('Google AI Essentials', 'webmakerr'),
                      'badge' => __('Course', 'webmakerr'),
                      'meta' => array(
                          array('icon' => 'users', 'label' => __('Beginner friendly', 'webmakerr')),
                          array('icon' => 'stack', 'label' => __('Self-paced', 'webmakerr')),
                      ),
                  ),
                  array(
                      'provider' => __('IBM', 'webmakerr'),
                      'provider_initials' => 'IBM',
                      'provider_style' => 'bg-[#ecf4ff] text-[#1d4ed8]',
                      'title' => __('Building AI-powered Workflows', 'webmakerr'),
                      'badge' => __('Professional Certificate', 'webmakerr'),
                      'meta' => array(
                          array('icon' => 'users', 'label' => __('Enterprise ready', 'webmakerr')),
                          array('icon' => 'clock', 'label' => __('4-week sprint', 'webmakerr')),
                      ),
                  ),
              ),
          ),
      );

      if (! function_exists('webmakerr_get_trending_icon_svg')) {
          function webmakerr_get_trending_icon_svg($icon)
          {
              switch ($icon) {
                  case 'sparkles':
                      return '<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2.5l1.3 3.57 3.7.27-2.86 2.2.97 3.63L10 10.91l-3.11 1.26.97-3.63-2.86-2.2 3.7-.27L10 2.5z"/></svg>';
                  case 'calendar-star':
                      return '<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M6.5 2a1 1 0 011 1v1h5V3a1 1 0 112 0v1h1.25A1.25 1.25 0 0117 5.25v10.5A1.25 1.25 0 0115.75 17H4.25A1.25 1.25 0 013 15.75V5.25A1.25 1.25 0 014.25 4H5.5V3a1 1 0 011-1zm8.5 7H5v6.5a.5.5 0 00.5.5h9a.5.5 0 00.5-.5V9zm-4.5-.75l.83 1.58 1.74.22-1.29 1.22.33 1.74L11 12.1l-1.61.91.33-1.74-1.29-1.22 1.74-.22.83-1.58zM15 6.5H5V8h10V6.5z"/></svg>';
                  case 'chip':
                      return '<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M8 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h.25A1.75 1.75 0 0116 4.75V5h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v.25A1.75 1.75 0 0114.25 17H14v1a1 1 0 11-2 0v-1h-2v1a1 1 0 11-2 0v-1h-.25A1.75 1.75 0 015 15.25V15H4a1 1 0 110-2h1v-2H4a1 1 0 110-2h1V7H4a1 1 0 110-2h1v-.25A1.75 1.75 0 016.75 3H7V2a1 1 0 011-1zm5.25 5h-6.5a.75.75 0 00-.75.75v6.5c0 .414.336.75.75.75h6.5a.75.75 0 00.75-.75v-6.5a.75.75 0 00-.75-.75z"/></svg>';
              }

              return '';
          }
      }

      if (! function_exists('webmakerr_get_trending_meta_icon')) {
          function webmakerr_get_trending_meta_icon($icon)
          {
              switch ($icon) {
                  case 'users':
                      return '<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M7 9a3 3 0 110-6 3 3 0 010 6zm6 0a3 3 0 110-6 3 3 0 010 6zM4.5 11A2.5 2.5 0 002 13.5V15a1 1 0 001 1h6v-2.5A2.5 2.5 0 006.5 11h-2zm7.5 1a3 3 0 013 3V16h3a1 1 0 001-1v-1.5A2.5 2.5 0 0015.5 11h-1z"/></svg>';
                  case 'clock':
                      return '<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 4a1 1 0 10-2 0v3.382a1 1 0 00.293.707l2.121 2.121a1 1 0 101.414-1.414L11 9.586V6z"/></svg>';
                  case 'spark':
                      return '<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 3l1.05 2.9 2.95.22-2.27 1.75.8 2.96L10 9.9l-2.53 1.95.8-2.96-2.27-1.75 2.95-.22L10 3z"/></svg>';
                  case 'stack':
                      return '<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2l7.5 4L10 10 2.5 6 10 2zm7.5 7.5L10 13l-7.5-3.5L10 16l7.5-3.5z"/></svg>';
              }

              return '';
          }
      }

      $career_paths = array(
          array(
              'title' => __('Data Analyst', 'webmakerr'),
              'description' => __('Translate complex datasets into actionable insights for stakeholders.', 'webmakerr'),
              'icon' => 'career-data-analyst.svg',
          ),
          array(
              'title' => __('Python Developer', 'webmakerr'),
              'description' => __('Automate workflows, integrate APIs, and deliver scalable AI services.', 'webmakerr'),
              'icon' => 'career-python-developer.svg',
          ),
          array(
              'title' => __('UX Designer', 'webmakerr'),
              'description' => __('Craft intuitive interfaces that guide users through intelligent systems.', 'webmakerr'),
              'icon' => 'career-ux-designer.svg',
          ),
          array(
              'title' => __('Product Manager', 'webmakerr'),
              'description' => __('Lead cross-functional teams to launch AI-driven customer experiences.', 'webmakerr'),
              'icon' => 'career-product-manager.svg',
          ),
          array(
              'title' => __('AI Specialist', 'webmakerr'),
              'description' => __('Architect machine learning pipelines and optimize production models.', 'webmakerr'),
              'icon' => 'career-ai-specialist.svg',
          ),
      );

      $content_highlights = array(
          array(
              'title' => __('Guided Projects', 'webmakerr'),
              'description' => __('Complete bite-sized, hands-on builds you can finish in under two hours.', 'webmakerr'),
              'tag' => __('Hands-on practice', 'webmakerr'),
              'icon' => 'content-guided-projects.svg',
              'url' => home_url('/guided-projects'),
              'background' => 'from-[#eef2ff] via-[#e0f2ff] to-[#f7f9ff]',
          ),
          array(
              'title' => __('Courses', 'webmakerr'),
              'description' => __('Learn from experts with structured lessons, quizzes, and real-world examples.', 'webmakerr'),
              'tag' => __('Most popular', 'webmakerr'),
              'icon' => 'content-courses.svg',
              'url' => home_url('/courses'),
              'background' => 'from-[#fff4de] via-[#ffeacd] to-[#fff9ee]',
          ),
          array(
              'title' => __('Professional Certificates', 'webmakerr'),
              'description' => __('Earn employer-recognized credentials designed with top companies.', 'webmakerr'),
              'tag' => __('Career credentials', 'webmakerr'),
              'icon' => 'content-certificates.svg',
              'url' => home_url('/certificates'),
              'background' => 'from-[#e5f9f3] via-[#d8f3ec] to-[#f0fffb]',
          ),
          array(
              'title' => __('Degrees', 'webmakerr'),
              'description' => __('Pursue flexible, accredited online degrees from leading universities.', 'webmakerr'),
              'tag' => __('Go further', 'webmakerr'),
              'icon' => 'content-degrees.svg',
              'url' => home_url('/degrees'),
              'background' => 'from-[#f5eeff] via-[#ece4ff] to-[#faf7ff]',
          ),
      );
      ?>

      <section class="relative overflow-hidden">
        <div class="relative isolate overflow-hidden bg-gradient-to-br from-[#1f3a83] via-[#1c2f6d] to-[#062364]">
          <div class="absolute -right-28 top-12 h-[420px] w-[420px] rounded-full bg-[radial-gradient(circle_at_top,#ff6bd6,transparent_60%)] opacity-60 blur-3xl"></div>
          <div class="absolute -left-20 bottom-10 h-72 w-72 rounded-full bg-[radial-gradient(circle_at_top,#4fa5ff,transparent_65%)] opacity-70 blur-3xl"></div>
          <div class="absolute right-8 top-8 hidden h-32 w-32 rotate-12 rounded-[36px] border border-white/20 bg-white/10 backdrop-blur-md lg:block">
            <div class="absolute left-6 top-6 h-3 w-3 rounded-full bg-white/80"></div>
            <div class="absolute right-10 top-10 h-5 w-5 rounded-full bg-primary"></div>
            <div class="absolute bottom-8 right-6 h-8 w-8 rounded-full border border-white/60"></div>
          </div>
          <div class="relative mx-auto flex w-full max-w-7xl flex-col gap-16 px-6 pb-32 pt-24 md:flex-row md:items-center md:justify-between md:px-8">
            <div class="max-w-2xl text-white">
              <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-white/80">
                <span class="h-2 w-2 rounded-full bg-[#7fe6ff]"></span>
                <?php esc_html_e('Future-ready learning', 'webmakerr'); ?>
              </span>
              <h1 class="mt-6 font-serif text-4xl font-semibold tracking-tight [text-wrap:balance] sm:text-5xl lg:text-[3.5rem] lg:leading-[1.05]">
                <?php esc_html_e('Gain essential AI skills to enhance your career', 'webmakerr'); ?>
              </h1>
              <p class="mt-4 max-w-xl text-base leading-7 text-white/80 sm:text-lg">
                <?php esc_html_e('Build job-ready expertise with courses and credentials created alongside the world’s leading universities and companies.', 'webmakerr'); ?>
              </p>
              <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a class="inline-flex w-full items-center justify-center rounded-md bg-[#7fe6ff] px-6 py-3 text-sm font-semibold text-[#062364] shadow-lg shadow-[#03133f]/30 transition hover:bg-[#a4f3ff] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-transparent focus-visible:ring-white/70 sm:w-auto !no-underline" href="<?php echo esc_url(home_url('/programs')); ?>">
                  <?php esc_html_e('Explore programs', 'webmakerr'); ?>
                </a>
                <a class="inline-flex w-full items-center justify-center rounded-md border border-white/40 bg-white/10 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/15 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/70 sm:w-auto !no-underline" href="<?php echo esc_url(home_url('/business')); ?>">
                  <?php esc_html_e('Try Webmakerr for Business', 'webmakerr'); ?>
                </a>
              </div>
            </div>
            <div class="relative mx-auto w-full max-w-md">
              <div class="absolute -right-6 -top-6 h-16 w-16 rounded-full bg-white/30 blur-xl"></div>
              <div class="absolute -bottom-10 left-12 h-20 w-20 rounded-full bg-[#ff6bd6]/40 blur-2xl"></div>
              <div class="relative overflow-hidden rounded-3xl border border-white/20 bg-white/5 p-10 shadow-[0_24px_60px_rgba(3,19,63,0.35)] backdrop-blur">
                <?php
                $hero_path = get_template_directory() . '/assets/svg/home/hero-illustration.svg';
                if (file_exists($hero_path)) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo file_get_contents($hero_path);
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="relative z-[1] -mt-16 pb-16 sm:pb-20 lg:pb-24">
        <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <?php foreach ($discover_tiles as $tile) : ?>
            <a class="group flex h-full flex-col gap-5 rounded-[6px] border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg !no-underline" href="<?php echo esc_url($tile['url']); ?>">
              <span class="inline-flex h-12 w-12 items-center justify-center rounded-[5px] bg-primary/10 text-primary">
                <?php
                $icon_path = get_template_directory() . '/assets/svg/home/icons/' . $tile['icon'];
                if (file_exists($icon_path)) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo file_get_contents($icon_path);
                }
                ?>
              </span>
              <div class="flex flex-col gap-2">
                <span class="text-xl font-semibold text-zinc-950">
                  <?php echo esc_html($tile['title']); ?>
                </span>
                <p class="text-sm leading-6 text-zinc-600">
                  <?php echo esc_html($tile['description']); ?>
                </p>
              </div>
              <span class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-primary transition group-hover:text-primary/80">
                <?php esc_html_e('Start exploring', 'webmakerr'); ?>
                <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.5 3.5L10.5 8L5.5 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </span>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="border-y border-zinc-200 bg-zinc-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto flex w-full max-w-6xl flex-col gap-10 px-4 sm:px-6 lg:px-8">
          <div class="flex flex-col items-center gap-3 text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-primary">
              <?php esc_html_e('Learn from leading universities and companies', 'webmakerr'); ?>
            </p>
            <p class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Trusted by teams building the future of work', 'webmakerr'); ?>
            </p>
          </div>
          <div class="-mx-4 flex items-center gap-6 overflow-x-auto px-4 pb-2 sm:mx-0 sm:px-0">
            <?php foreach ($trusted_brands as $brand) : ?>
              <div class="flex min-w-[160px] items-center justify-center rounded-[6px] border border-zinc-200 bg-white px-6 py-4 shadow-sm">
                <span class="sr-only"><?php echo esc_html($brand['name']); ?></span>
                <?php
                $brand_path = get_template_directory() . '/assets/svg/home/brands/' . $brand['logo'];
                if (file_exists($brand_path)) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo file_get_contents($brand_path);
                }
                ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="py-16 sm:py-20 lg:py-24">
        <div class="mx-auto flex w-full max-w-6xl flex-col gap-12 px-4 sm:px-6 lg:px-8">
          <div class="max-w-3xl">
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Trending courses', 'webmakerr'); ?>
            </h2>
            <p class="mt-2 text-base leading-7 text-zinc-600">
              <?php esc_html_e('Stay ahead with programs updated alongside the fastest-moving AI innovations.', 'webmakerr'); ?>
            </p>
          </div>
          <div class="grid gap-6 lg:grid-cols-3">
            <?php foreach ($trending_sections as $section) : ?>
              <div class="flex h-full flex-col gap-6 rounded-2xl border border-[#d9e4ff] bg-[#eef3ff] p-6 shadow-[0_24px_48px_rgba(15,23,42,0.08)]">
                <div class="flex items-center gap-3">
                  <span class="flex h-10 w-10 items-center justify-center rounded-full <?php echo esc_attr($section['icon_style']); ?>">
                    <?php
                    $section_icon = webmakerr_get_trending_icon_svg($section['icon']);
                    if (! empty($section_icon)) {
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo $section_icon;
                    }
                    ?>
                  </span>
                  <span class="text-sm font-semibold text-zinc-900">
                    <?php echo esc_html($section['title']); ?>
                  </span>
                </div>
                <div class="flex flex-col gap-4">
                  <?php foreach ($section['courses'] as $course) : ?>
                    <article class="flex flex-col gap-4 rounded-2xl border border-white/70 bg-white/95 p-5 shadow-[0_18px_36px_rgba(15,23,42,0.12)] backdrop-blur-sm">
                      <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center gap-3">
                          <span class="flex h-11 w-11 items-center justify-center rounded-full text-sm font-semibold <?php echo esc_attr($course['provider_style']); ?>">
                            <?php echo esc_html($course['provider_initials']); ?>
                          </span>
                          <span class="text-sm font-semibold text-zinc-900">
                            <?php echo esc_html($course['provider']); ?>
                          </span>
                        </div>
                        <span class="inline-flex items-center gap-1 rounded-full bg-[#eef2ff] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#3730a3]">
                          <?php echo esc_html($course['badge']); ?>
                        </span>
                      </div>
                      <h3 class="text-lg font-semibold leading-snug text-zinc-950">
                        <?php echo esc_html($course['title']); ?>
                      </h3>
                      <?php if (! empty($course['meta'])) : ?>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs font-medium text-zinc-500">
                          <?php foreach ($course['meta'] as $meta) : ?>
                            <span class="inline-flex items-center gap-1">
                              <?php
                              $meta_icon = webmakerr_get_trending_meta_icon($meta['icon']);
                              if (! empty($meta_icon)) {
                                  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                  echo $meta_icon;
                              }
                              ?>
                              <?php echo esc_html($meta['label']); ?>
                            </span>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                    </article>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="bg-zinc-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
          <div class="flex flex-col gap-10">
            <div class="flex flex-col items-center gap-3 text-center">
              <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
                <?php esc_html_e('Explore careers', 'webmakerr'); ?>
              </h2>
              <p class="max-w-2xl text-base leading-7 text-zinc-600">
                <?php esc_html_e('Map your next role with curated skills, projects, and hiring insights from global employers.', 'webmakerr'); ?>
              </p>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
              <?php foreach ($career_paths as $career) : ?>
                <article class="flex h-full flex-col gap-5 rounded-[6px] border border-zinc-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                  <div class="h-16 w-16">
                    <?php
                    $career_path = get_template_directory() . '/assets/svg/home/careers/' . $career['icon'];
                    if (file_exists($career_path)) {
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo file_get_contents($career_path);
                    }
                    ?>
                  </div>
                  <div class="flex flex-col gap-3">
                    <h3 class="text-xl font-semibold text-zinc-950">
                      <?php echo esc_html($career['title']); ?>
                    </h3>
                    <p class="text-sm leading-6 text-zinc-600">
                      <?php echo esc_html($career['description']); ?>
                    </p>
                  </div>
                  <div class="mt-auto pt-2">
                    <a class="inline-flex items-center gap-2 text-sm font-semibold text-primary transition hover:text-primary/80 !no-underline" href="<?php echo esc_url(home_url('/careers')); ?>">
                      <?php esc_html_e('View path', 'webmakerr'); ?>
                      <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 3.5L10.5 8L5.5 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </a>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </section>

      <section class="py-16 sm:py-20 lg:py-24">
        <div class="mx-auto flex w-full max-w-6xl flex-col gap-10 px-4 sm:px-6 lg:px-8">
          <div class="flex flex-col items-center gap-3 text-center">
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Explore content', 'webmakerr'); ?>
            </h2>
            <p class="max-w-2xl text-base leading-7 text-zinc-600">
              <?php esc_html_e('Find the learning experience that fits your schedule, goals, and level of support.', 'webmakerr'); ?>
            </p>
          </div>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
            <?php foreach ($content_highlights as $content) : ?>
              <a class="group relative flex h-full flex-col gap-6 overflow-hidden rounded-[18px] border border-white/60 bg-gradient-to-br <?php echo esc_attr($content['background']); ?> p-6 shadow-[0_20px_45px_rgba(15,23,42,0.08)] transition hover:-translate-y-1 hover:shadow-[0_24px_55px_rgba(15,23,42,0.12)] !no-underline" href="<?php echo esc_url($content['url']); ?>">
                <div class="absolute -right-12 top-12 h-24 w-24 rounded-full bg-white/20 blur-3xl transition group-hover:bg-white/30"></div>
                <div class="absolute -left-16 -bottom-10 h-28 w-28 rounded-full bg-white/30 blur-3xl transition group-hover:bg-white/40"></div>
                <span class="relative inline-flex w-fit items-center gap-2 rounded-full border border-white/70 bg-white/60 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-zinc-700 shadow-sm">
                  <?php echo esc_html($content['tag']); ?>
                </span>
                <div class="relative flex items-center gap-4">
                  <div class="flex h-14 w-14 items-center justify-center rounded-[12px] bg-white/70 shadow-inner shadow-white/40">
                    <?php
                    $content_icon = get_template_directory() . '/assets/svg/home/content/' . $content['icon'];
                    if (file_exists($content_icon)) {
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo file_get_contents($content_icon);
                    }
                    ?>
                  </div>
                  <div class="flex flex-col gap-2 text-left">
                    <h3 class="text-xl font-semibold text-zinc-900">
                      <?php echo esc_html($content['title']); ?>
                    </h3>
                    <p class="text-sm leading-6 text-zinc-600">
                      <?php echo esc_html($content['description']); ?>
                    </p>
                  </div>
                </div>
                <span class="relative mt-auto inline-flex items-center gap-2 text-sm font-semibold text-primary transition group-hover:text-primary/80">
                  <?php esc_html_e('Browse now', 'webmakerr'); ?>
                  <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 3.5L10.5 8L5.5 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="relative overflow-hidden py-16 sm:py-20 lg:py-24">
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-primary/20 to-transparent"></div>
        <div class="relative mx-auto flex w-full max-w-5xl flex-col items-center gap-8 overflow-hidden rounded-[24px] border border-zinc-200 bg-white px-6 py-14 text-center shadow-lg shadow-primary/10 sm:px-10">
          <div class="absolute -right-14 -top-12 h-32 w-32 rounded-full bg-primary/10 blur-3xl"></div>
          <div class="absolute -left-12 bottom-0 h-36 w-36 rounded-full bg-primary/5 blur-3xl"></div>
          <div class="relative">
            <span class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-primary">
              <?php esc_html_e('Get started today', 'webmakerr'); ?>
            </span>
            <h2 class="mt-6 text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php esc_html_e('What brings you to Webmakerr today?', 'webmakerr'); ?>
            </h2>
            <p class="mt-4 text-base leading-7 text-zinc-600">
              <?php esc_html_e('Choose the path that matches your goals and we’ll surface the right courses, credentials, and support.', 'webmakerr'); ?>
            </p>
          </div>
          <div class="relative flex flex-col gap-4 sm:flex-row">
            <a class="inline-flex items-center justify-center gap-2 rounded-[6px] border border-zinc-200 bg-white px-6 py-3 text-sm font-semibold text-zinc-950 shadow-sm transition hover:border-primary hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40 !no-underline" href="<?php echo esc_url(home_url('/learn')); ?>">
              <?php esc_html_e('I want to learn new skills', 'webmakerr'); ?>
            </a>
            <a class="inline-flex items-center justify-center gap-2 rounded-[6px] border border-transparent bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-white !no-underline" href="<?php echo esc_url(home_url('/business-solutions')); ?>">
              <?php esc_html_e("I'm exploring for my business", 'webmakerr'); ?>
            </a>
          </div>
        </div>
      </section>

      <?php if (trim(get_the_content())) : ?>
        <section class="py-16 sm:py-20 lg:py-24">
          <div class="prose prose-lg mx-auto w-full max-w-4xl px-4 text-zinc-600 prose-headings:text-zinc-950 sm:px-6 lg:px-8">
            <?php the_content(); ?>
          </div>
        </section>
      <?php endif; ?>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
