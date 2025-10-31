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

<main id="primary" class="bg-white">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('flex flex-col'); ?>>
      <section class="relative overflow-hidden bg-gradient-to-br from-[#0b2855] via-[#1a3d91] to-[#1f56c1] py-24 text-white">
        <div class="absolute -left-12 top-20 h-44 w-44 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -right-16 bottom-8 h-52 w-52 rounded-full bg-primary/30 blur-3xl"></div>
        <div class="relative mx-auto grid w-full max-w-7xl grid-cols-1 items-center gap-12 px-6 md:grid-cols-2 md:px-8">
          <div class="flex flex-col gap-6">
            <span class="inline-flex max-w-max items-center rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white/70">
              <?php esc_html_e('Future-ready learning', 'webmakerr'); ?>
            </span>
            <h1 class="font-serif text-4xl font-semibold tracking-tight text-white [text-wrap:balance] sm:text-5xl lg:text-6xl">
              <?php esc_html_e('Gain essential AI skills to enhance your career', 'webmakerr'); ?>
            </h1>
            <p class="max-w-xl text-base leading-7 text-white/90 sm:text-lg">
              <?php esc_html_e('Build job-ready skills by learning from leading universities and companies.', 'webmakerr'); ?>
            </p>
            <div class="flex flex-col gap-3 sm:flex-row">
              <a class="btn btn-primary inline-flex w-full items-center justify-center rounded-[5px] border border-transparent bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/60 sm:w-auto !no-underline" href="<?php echo esc_url(home_url('/programs')); ?>">
                <?php esc_html_e('Explore programs', 'webmakerr'); ?>
              </a>
              <a class="btn btn-white inline-flex w-full items-center justify-center rounded-[5px] border border-white/40 bg-white px-6 py-3 text-sm font-semibold text-[#0b2855] shadow-sm transition hover:bg-white/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/60 sm:w-auto !no-underline" href="<?php echo esc_url(home_url('/business')); ?>">
                <?php esc_html_e('Try Webmakerr for Business', 'webmakerr'); ?>
              </a>
            </div>
          </div>
          <div class="flex items-center justify-center">
            <div class="w-full max-w-md">
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
      </section>

      <?php
      $feature_highlights = array(
          array(
              'title' => __('Launch a new career', 'webmakerr'),
              'description' => __('Follow guided learning paths that transition you into AI-focused roles.', 'webmakerr'),
              'icon' => 'launch-career.svg',
          ),
          array(
              'title' => __('Gain in-demand skills', 'webmakerr'),
              'description' => __('Master practical workflows with curriculum curated by industry leaders.', 'webmakerr'),
              'icon' => 'in-demand-skills.svg',
          ),
          array(
              'title' => __('Earn a degree', 'webmakerr'),
              'description' => __('Pursue accredited programs designed with top universities and companies.', 'webmakerr'),
              'icon' => 'earn-degree.svg',
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
              'description' => __('Design prompts, automate creative tasks, and deliver responsible AI solutions.', 'webmakerr'),
              'tags' => array(__('Beginner', 'webmakerr'), __('6 weeks', 'webmakerr'), __('Hands-on labs', 'webmakerr')),
              'thumbnail' => 'course-generative-ai.svg',
          ),
          array(
              'title' => __('Data Analytics with Python', 'webmakerr'),
              'description' => __('Build analytics dashboards, automate reporting, and communicate insights.', 'webmakerr'),
              'tags' => array(__('Intermediate', 'webmakerr'), __('Self-paced', 'webmakerr')),
              'thumbnail' => 'course-data-analytics.svg',
          ),
          array(
              'title' => __('AI Strategy for Leaders', 'webmakerr'),
              'description' => __('Create adoption roadmaps, manage change, and measure AI program impact.', 'webmakerr'),
              'tags' => array(__('Leadership', 'webmakerr'), __('Certificate', 'webmakerr')),
              'thumbnail' => 'course-leadership-ai.svg',
          ),
          array(
              'title' => __('Python Automation Projects', 'webmakerr'),
              'description' => __('Ship production-ready automations with reusable components and templates.', 'webmakerr'),
              'tags' => array(__('Project-based', 'webmakerr'), __('Career track', 'webmakerr')),
              'thumbnail' => 'course-python-automation.svg',
          ),
          array(
              'title' => __('Ethics & Governance in AI', 'webmakerr'),
              'description' => __('Ensure transparency, mitigate bias, and align teams with global standards.', 'webmakerr'),
              'tags' => array(__('Advanced', 'webmakerr'), __('Policy focus', 'webmakerr')),
              'thumbnail' => 'course-ai-ethics.svg',
          ),
          array(
              'title' => __('UX Strategy for Intelligent Products', 'webmakerr'),
              'description' => __('Design human-centered experiences that integrate machine intelligence.', 'webmakerr'),
              'tags' => array(__('Design', 'webmakerr'), __('Portfolio ready', 'webmakerr')),
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

      <section class="py-20">
        <div class="mx-auto w-full max-w-7xl px-6 md:px-8">
          <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <?php foreach ($feature_highlights as $feature) : ?>
              <article class="flex h-full flex-col gap-5 rounded-[6px] border border-zinc-200 bg-white p-8 shadow-sm">
                <span class="inline-flex h-14 w-14 items-center justify-center rounded-[5px] bg-primary/10 text-primary">
                  <?php
                  $icon_path = get_template_directory() . '/assets/svg/home/icons/' . $feature['icon'];
                  if (file_exists($icon_path)) {
                      // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                      echo file_get_contents($icon_path);
                  }
                  ?>
                </span>
                <div class="flex flex-col gap-3">
                  <h2 class="font-serif text-xl font-semibold text-gray-900">
                    <?php echo esc_html($feature['title']); ?>
                  </h2>
                  <p class="text-sm leading-6 text-gray-600">
                    <?php echo esc_html($feature['description']); ?>
                  </p>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="border-y border-gray-200 bg-white py-20">
        <div class="mx-auto flex w-full max-w-7xl flex-col gap-12 px-6 md:px-8">
          <div class="flex flex-col gap-3 text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">
              <?php esc_html_e('Learn from leading universities and companies', 'webmakerr'); ?>
            </p>
            <p class="font-serif text-2xl font-semibold text-gray-900 sm:text-3xl">
              <?php esc_html_e('Trusted by teams building the future of work', 'webmakerr'); ?>
            </p>
          </div>
          <div class="-mx-4 flex items-center gap-6 overflow-x-auto px-4 py-2">
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

      <section class="py-20">
        <div class="mx-auto w-full max-w-7xl px-6 md:px-8">
          <header class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
            <h2 class="font-serif text-3xl font-semibold text-gray-900 sm:text-4xl">
              <?php esc_html_e('Trending courses', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-gray-600">
              <?php esc_html_e('Stay ahead with programs updated alongside the fastest-moving AI innovations.', 'webmakerr'); ?>
            </p>
          </header>
          <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
            <?php foreach ($trending_courses as $course) : ?>
              <article class="flex h-full flex-col overflow-hidden rounded-[6px] border border-zinc-200 bg-white shadow-sm">
                <div class="aspect-[5/3] w-full bg-gray-100">
                  <?php
                  $thumbnail_path = get_template_directory() . '/assets/svg/home/courses/' . $course['thumbnail'];
                  if (file_exists($thumbnail_path)) {
                      // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                      echo file_get_contents($thumbnail_path);
                  }
                  ?>
                </div>
                <div class="flex flex-1 flex-col gap-4 p-6">
                  <div class="flex flex-col gap-3">
                    <h3 class="font-serif text-xl font-semibold text-gray-900">
                      <?php echo esc_html($course['title']); ?>
                    </h3>
                    <p class="text-sm leading-6 text-gray-600">
                      <?php echo esc_html($course['description']); ?>
                    </p>
                  </div>
                  <?php if (! empty($course['tags'])) : ?>
                    <div class="flex flex-wrap gap-2">
                      <?php foreach ($course['tags'] as $tag) : ?>
                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700">
                          <?php echo esc_html($tag); ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  <div class="mt-auto pt-4">
                    <a class="btn btn-primary inline-flex w-full items-center justify-center rounded-[5px] border border-transparent bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40 !no-underline" href="<?php echo esc_url(home_url('/courses')); ?>">
                      <?php esc_html_e('Start learning', 'webmakerr'); ?>
                    </a>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="bg-zinc-50 py-20">
        <div class="mx-auto w-full max-w-7xl px-6 md:px-8">
          <header class="flex flex-col gap-4 text-center">
            <h2 class="font-serif text-3xl font-semibold text-gray-900 sm:text-4xl">
              <?php esc_html_e('Explore Categories', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-gray-600">
              <?php esc_html_e('Browse curated topics to tailor the learning journey for your goals.', 'webmakerr'); ?>
            </p>
          </header>
          <div class="mt-8 flex flex-wrap justify-center gap-3">
            <button type="button" class="btn btn-primary inline-flex items-center rounded-full border border-transparent bg-primary px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40">
              <?php esc_html_e('All programs', 'webmakerr'); ?>
            </button>
            <button type="button" class="btn btn-white inline-flex items-center rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-400 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30">
              <?php esc_html_e('Popular', 'webmakerr'); ?>
            </button>
            <button type="button" class="btn btn-white inline-flex items-center rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-400 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30">
              <?php esc_html_e('University partners', 'webmakerr'); ?>
            </button>
            <button type="button" class="btn btn-white inline-flex items-center rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-400 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30">
              <?php esc_html_e('Career tracks', 'webmakerr'); ?>
            </button>
          </div>
          <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
            <?php foreach ($categories as $category) : ?>
              <article class="flex h-full flex-col gap-5 rounded-[6px] border border-zinc-200 bg-white p-6 text-left shadow-sm">
                <div class="w-full">
                  <?php
                  $category_path = get_template_directory() . '/assets/svg/home/categories/' . $category['image'];
                  if (file_exists($category_path)) {
                      // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                      echo file_get_contents($category_path);
                  }
                  ?>
                </div>
                <div class="flex flex-col gap-3">
                  <h3 class="font-serif text-xl font-semibold text-gray-900">
                    <?php echo esc_html($category['title']); ?>
                  </h3>
                  <p class="text-sm leading-6 text-gray-600">
                    <?php echo esc_html($category['description']); ?>
                  </p>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="py-20">
        <div class="mx-auto w-full max-w-7xl px-6 md:px-8">
          <header class="mx-auto flex max-w-3xl flex-col gap-4 text-center">
            <h2 class="font-serif text-3xl font-semibold text-gray-900 sm:text-4xl">
              <?php esc_html_e('Explore Careers', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-gray-600">
              <?php esc_html_e('Map your next role with curated skills, projects, and hiring insights.', 'webmakerr'); ?>
            </p>
          </header>
          <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-4">
            <?php foreach ($career_paths as $career) : ?>
              <article class="flex h-full flex-col gap-5 rounded-[6px] border border-zinc-200 bg-white p-6 shadow-sm">
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
                  <h3 class="font-serif text-xl font-semibold text-gray-900">
                    <?php echo esc_html($career['title']); ?>
                  </h3>
                  <p class="text-sm leading-6 text-gray-600">
                    <?php echo esc_html($career['description']); ?>
                  </p>
                </div>
                <div class="mt-auto pt-2">
                  <a class="btn btn-primary inline-flex items-center justify-center rounded-[5px] border border-transparent bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40 !no-underline" href="<?php echo esc_url(home_url('/careers')); ?>">
                    <?php esc_html_e('View path', 'webmakerr'); ?>
                  </a>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="bg-[#18184d] py-20 text-white">
        <div class="mx-auto flex w-full max-w-5xl flex-col items-center gap-8 px-6 text-center md:px-8">
          <h2 class="font-serif text-3xl font-semibold text-white sm:text-4xl">
            <?php esc_html_e('What brings you to Webmakerr today?', 'webmakerr'); ?>
          </h2>
          <div class="flex flex-col items-center gap-4 sm:flex-row">
            <a class="btn btn-white inline-flex items-center justify-center rounded-[5px] border border-transparent bg-white px-6 py-3 text-sm font-semibold text-[#0b2855] shadow-sm transition hover:bg-white/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/60 !no-underline" href="<?php echo esc_url(home_url('/learn')); ?>">
              <?php esc_html_e('I want to learn new skills', 'webmakerr'); ?>
            </a>
            <a class="btn btn-white inline-flex items-center justify-center rounded-[5px] border border-transparent bg-white px-6 py-3 text-sm font-semibold text-[#0b2855] shadow-sm transition hover:bg-white/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/60 !no-underline" href="<?php echo esc_url(home_url('/business-solutions')); ?>">
              <?php esc_html_e("I'm exploring for my business", 'webmakerr'); ?>
            </a>
          </div>
        </div>
      </section>

      <?php if (trim(get_the_content())) : ?>
        <section class="py-20">
          <div class="mx-auto w-full max-w-4xl px-6 md:px-8 prose prose-lg prose-headings:font-serif prose-headings:text-gray-900 prose-p:text-gray-600">
            <?php the_content(); ?>
          </div>
        </section>
      <?php endif; ?>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
