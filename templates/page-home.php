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

      $trending_courses = array(
          array(
              'title' => __('Generative AI Foundations', 'webmakerr'),
              'description' => __('Design prompts, automate creative work, and deliver responsible AI solutions.', 'webmakerr'),
              'tags' => array(__('Beginner', 'webmakerr'), __('6 weeks', 'webmakerr'), __('Hands-on labs', 'webmakerr')),
              'badge' => __('Professional Certificate', 'webmakerr'),
              'provider' => __('Aurora Institute', 'webmakerr'),
              'thumbnail' => 'course-generative-ai.svg',
          ),
          array(
              'title' => __('Data Analytics with Python', 'webmakerr'),
              'description' => __('Build dashboards, automate reporting, and communicate insights effectively.', 'webmakerr'),
              'tags' => array(__('Intermediate', 'webmakerr'), __('Self-paced', 'webmakerr')),
              'badge' => __('Specialization', 'webmakerr'),
              'provider' => __('Northwind University', 'webmakerr'),
              'thumbnail' => 'course-data-analytics.svg',
          ),
          array(
              'title' => __('AI Strategy for Leaders', 'webmakerr'),
              'description' => __('Create adoption roadmaps, manage change, and measure program impact.', 'webmakerr'),
              'tags' => array(__('Leadership', 'webmakerr'), __('Certificate', 'webmakerr')),
              'badge' => __('Guided Project', 'webmakerr'),
              'provider' => __('Summit Labs', 'webmakerr'),
              'thumbnail' => 'course-leadership-ai.svg',
          ),
          array(
              'title' => __('Python Automation Projects', 'webmakerr'),
              'description' => __('Ship production-ready automations with reusable templates.', 'webmakerr'),
              'tags' => array(__('Project-based', 'webmakerr'), __('Career track', 'webmakerr')),
              'badge' => __('Professional Certificate', 'webmakerr'),
              'provider' => __('Orbit Partners', 'webmakerr'),
              'thumbnail' => 'course-python-automation.svg',
          ),
          array(
              'title' => __('Ethics & Governance in AI', 'webmakerr'),
              'description' => __('Ensure transparency, mitigate bias, and align teams with global standards.', 'webmakerr'),
              'tags' => array(__('Advanced', 'webmakerr'), __('Policy focus', 'webmakerr')),
              'badge' => __('Specialization', 'webmakerr'),
              'provider' => __('Lumen College', 'webmakerr'),
              'thumbnail' => 'course-ai-ethics.svg',
          ),
          array(
              'title' => __('UX Strategy for Intelligent Products', 'webmakerr'),
              'description' => __('Design human-centered experiences that integrate machine intelligence.', 'webmakerr'),
              'tags' => array(__('Design', 'webmakerr'), __('Portfolio ready', 'webmakerr')),
              'badge' => __('Course', 'webmakerr'),
              'provider' => __('Webmakerr Studio', 'webmakerr'),
              'thumbnail' => 'course-ux-strategy.svg',
          ),
      );

      $categories = array(
          array(
              'title' => __('Data Science', 'webmakerr'),
              'description' => __('Analytics, visualization, and machine learning specializations.', 'webmakerr'),
              'image' => 'category-data-science.svg',
          ),
          array(
              'title' => __('Business', 'webmakerr'),
              'description' => __('Strategy, operations, and leadership for AI-enabled teams.', 'webmakerr'),
              'image' => 'category-business.svg',
          ),
          array(
              'title' => __('Computer Science', 'webmakerr'),
              'description' => __('Software engineering, cloud infrastructure, and automation.', 'webmakerr'),
              'image' => 'category-computer-science.svg',
          ),
          array(
              'title' => __('Personal Development', 'webmakerr'),
              'description' => __('Creativity, communication, and growth skills for every career.', 'webmakerr'),
              'image' => 'category-personal-development.svg',
          ),
          array(
              'title' => __('AI for Everyone', 'webmakerr'),
              'description' => __('Non-technical primers that demystify AI concepts for teams.', 'webmakerr'),
              'image' => 'category-ai-everyone.svg',
          ),
      );

      $spotlight_programs = array(
          array(
              'title' => __('Hot new releases', 'webmakerr'),
              'description' => __('Be first to explore programs refreshed for 2024 AI roadmaps.', 'webmakerr'),
              'image' => 'course-generative-ai.svg',
              'url' => home_url('/new-releases'),
              'cta' => __('See the updates', 'webmakerr'),
          ),
          array(
              'title' => __('Skill up for in-demand jobs', 'webmakerr'),
              'description' => __('Learn the career-ready skills employers want in data and AI.', 'webmakerr'),
              'image' => 'course-python-automation.svg',
              'url' => home_url('/job-skills'),
              'cta' => __('Browse roles', 'webmakerr'),
          ),
          array(
              'title' => __('Build a learning plan', 'webmakerr'),
              'description' => __('Answer a few questions and get a tailored learning playlist.', 'webmakerr'),
              'image' => 'course-data-analytics.svg',
              'url' => home_url('/learning-plan'),
              'cta' => __('Start now', 'webmakerr'),
          ),
      );

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
        <div class="mx-auto grid w-full max-w-6xl gap-10 px-4 sm:px-6 lg:px-8 xl:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]">
          <div class="flex flex-col gap-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
              <div>
                <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
                  <?php esc_html_e('Trending courses', 'webmakerr'); ?>
                </h2>
                <p class="mt-2 max-w-2xl text-base leading-7 text-zinc-600">
                  <?php esc_html_e('Stay ahead with programs updated alongside the fastest-moving AI innovations.', 'webmakerr'); ?>
                </p>
              </div>
              <a class="inline-flex items-center gap-2 text-sm font-semibold text-primary transition hover:text-primary/80 !no-underline" href="<?php echo esc_url(home_url('/courses')); ?>">
                <?php esc_html_e('View all', 'webmakerr'); ?>
                <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.5 3.5L10.5 8L5.5 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </a>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
              <?php foreach ($trending_courses as $course) : ?>
                <article class="flex h-full flex-col overflow-hidden rounded-[6px] border border-zinc-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                  <div class="relative aspect-[5/3] w-full overflow-hidden bg-zinc-100">
                    <?php
                    $thumbnail_path = get_template_directory() . '/assets/svg/home/courses/' . $course['thumbnail'];
                    if (file_exists($thumbnail_path)) {
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo file_get_contents($thumbnail_path);
                    }
                    ?>
                  </div>
                  <div class="flex flex-1 flex-col gap-5 p-6">
                    <div class="flex flex-col gap-2">
                      <span class="inline-flex items-center rounded-full bg-primary/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.16em] text-primary">
                        <?php echo esc_html($course['badge']); ?>
                      </span>
                      <h3 class="text-xl font-semibold text-zinc-950">
                        <?php echo esc_html($course['title']); ?>
                      </h3>
                      <p class="text-sm leading-6 text-zinc-600">
                        <?php echo esc_html($course['description']); ?>
                      </p>
                    </div>
                    <div class="flex items-center gap-2 text-sm font-medium text-zinc-500">
                      <span class="h-2 w-2 rounded-full bg-primary/40"></span>
                      <?php echo esc_html($course['provider']); ?>
                    </div>
                    <?php if (! empty($course['tags'])) : ?>
                      <div class="flex flex-wrap gap-2">
                        <?php foreach ($course['tags'] as $tag) : ?>
                          <span class="inline-flex items-center rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-primary">
                            <?php echo esc_html($tag); ?>
                          </span>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                    <div class="mt-auto pt-4">
                      <a class="inline-flex w-full items-center justify-center rounded-[5px] border border-transparent bg-primary px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-white !no-underline" href="<?php echo esc_url(home_url('/courses')); ?>">
                        <?php esc_html_e('Start learning', 'webmakerr'); ?>
                      </a>
                    </div>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
          </div>
          <aside class="flex flex-col gap-8">
            <div class="rounded-[6px] border border-zinc-200 bg-white p-6 shadow-sm">
              <h3 class="text-2xl font-semibold text-zinc-950">
                <?php esc_html_e('Explore categories', 'webmakerr'); ?>
              </h3>
              <p class="mt-3 text-sm leading-6 text-zinc-600">
                <?php esc_html_e('Browse curated topics to tailor the learning journey for your goals.', 'webmakerr'); ?>
              </p>
              <div class="mt-6 flex flex-wrap gap-2">
                <button type="button" class="inline-flex items-center rounded-full bg-primary px-4 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-white shadow-sm transition hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                  <?php esc_html_e('All programs', 'webmakerr'); ?>
                </button>
                <button type="button" class="inline-flex items-center rounded-full border border-zinc-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-primary transition hover:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40">
                  <?php esc_html_e('Popular', 'webmakerr'); ?>
                </button>
                <button type="button" class="inline-flex items-center rounded-full border border-zinc-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-primary transition hover:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40">
                  <?php esc_html_e('Career tracks', 'webmakerr'); ?>
                </button>
              </div>
              <div class="mt-8 grid grid-cols-1 gap-4">
                <?php foreach ($categories as $category) : ?>
                  <div class="group flex items-center gap-4 rounded-[6px] border border-transparent bg-zinc-50 p-4 transition hover:border-primary/20 hover:bg-white">
                    <div class="flex h-14 w-14 items-center justify-center rounded-[5px] bg-white shadow-sm">
                      <?php
                      $category_path = get_template_directory() . '/assets/svg/home/categories/' . $category['image'];
                      if (file_exists($category_path)) {
                          // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                          echo file_get_contents($category_path);
                      }
                      ?>
                    </div>
                    <div class="flex flex-col">
                      <span class="text-lg font-semibold text-zinc-950">
                        <?php echo esc_html($category['title']); ?>
                      </span>
                      <p class="text-sm text-zinc-600">
                        <?php echo esc_html($category['description']); ?>
                      </p>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="flex flex-col gap-4">
              <?php foreach ($spotlight_programs as $program) : ?>
                <a class="group flex flex-col overflow-hidden rounded-[6px] border border-zinc-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg !no-underline" href="<?php echo esc_url($program['url']); ?>">
                  <div class="relative h-40 overflow-hidden bg-zinc-100">
                    <?php
                    $program_image = get_template_directory() . '/assets/svg/home/courses/' . $program['image'];
                    if (file_exists($program_image)) {
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo file_get_contents($program_image);
                    }
                    ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/70 to-transparent"></div>
                    <span class="absolute left-6 top-6 inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-primary">
                      <?php esc_html_e('Spotlight', 'webmakerr'); ?>
                    </span>
                  </div>
                  <div class="flex flex-col gap-3 p-6">
                    <h4 class="text-xl font-semibold text-zinc-950">
                      <?php echo esc_html($program['title']); ?>
                    </h4>
                    <p class="text-sm leading-6 text-zinc-600">
                      <?php echo esc_html($program['description']); ?>
                    </p>
                    <span class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-primary transition group-hover:text-primary/80">
                      <?php echo esc_html($program['cta']); ?>
                      <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 3.5L10.5 8L5.5 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </span>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          </aside>
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
