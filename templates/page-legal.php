<?php
/**
 * Template Name: Legal Hub
 * Description: Centralized legal policies and guidelines inspired by Fiverr's legal portal.
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
      <section class="bg-[#18184d]">
        <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-6 py-24 md:grid-cols-2">
          <div class="space-y-6 text-white">
            <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white/70">
              <?php esc_html_e('Legal Resources', 'webmakerr'); ?>
            </span>
            <h1 class="text-4xl font-medium tracking-tight [text-wrap:balance] sm:text-5xl lg:text-6xl">
              <?php esc_html_e("Webmakerr's Legal Hub", 'webmakerr'); ?>
            </h1>
            <p class="max-w-xl text-base leading-7 text-white/90 sm:text-lg">
              <?php esc_html_e('All the essential policies you should know — simple, clear, and transparent.', 'webmakerr'); ?>
            </p>
          </div>
          <div class="flex justify-center">
            <img
              class="w-full max-w-md"
              src="<?php echo esc_url(get_template_directory_uri() . '/assets/svg/legal-hero.svg'); ?>"
              alt="<?php esc_attr_e('Illustration representing Webmakerr legal resources', 'webmakerr'); ?>"
              loading="lazy"
            />
          </div>
        </div>
      </section>

      <?php
      $policy_cards = array(
          array(
              'title' => __('Terms of Service', 'webmakerr'),
              'description' => __('Understand responsibilities, deliverables, and protections for every engagement.', 'webmakerr'),
              'link' => home_url('/legal/terms-of-service'),
              'icon' => 'policy-terms.svg',
          ),
          array(
              'title' => __('Privacy Policy', 'webmakerr'),
              'description' => __('See how we collect, use, and protect your data across the Webmakerr ecosystem.', 'webmakerr'),
              'link' => home_url('/legal/privacy-policy'),
              'icon' => 'policy-privacy.svg',
          ),
          array(
              'title' => __('Payments & Billing', 'webmakerr'),
              'description' => __('Learn about payment schedules, invoices, refunds, and secure transaction handling.', 'webmakerr'),
              'link' => home_url('/legal/payments-and-billing'),
              'icon' => 'policy-payments.svg',
          ),
          array(
              'title' => __('Compliance & Safety', 'webmakerr'),
              'description' => __('Review our commitment to compliance, accessibility, and a safe creative space.', 'webmakerr'),
              'link' => home_url('/legal/compliance-and-safety'),
              'icon' => 'policy-compliance.svg',
          ),
      );
      ?>

      <section class="py-20 sm:py-24">
        <div class="container mx-auto px-6">
          <header class="mx-auto flex max-w-3xl flex-col gap-3 text-center">
            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-indigo-300">
              <?php esc_html_e('How Webmakerr Works', 'webmakerr'); ?>
            </span>
            <h2 class="text-3xl font-semibold text-zinc-950 sm:text-4xl">
              <?php esc_html_e('Policies and Guidelines for the Webmakerr Community', 'webmakerr'); ?>
            </h2>
            <p class="text-base leading-7 text-zinc-600 sm:text-lg">
              <?php esc_html_e('Explore every policy in one place so you can collaborate confidently.', 'webmakerr'); ?>
            </p>
          </header>

          <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($policy_cards as $card) : ?>
              <a
                class="group flex h-full flex-col gap-5 rounded-2xl border border-indigo-100 bg-gray-50/90 p-6 shadow-sm transition-transform duration-200 hover:-translate-y-1 hover:shadow-md"
                href="<?php echo esc_url($card['link']); ?>"
              >
                <span class="inline-flex h-16 w-16 items-center justify-center">
                  <img
                    class="h-16 w-16"
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/svg/' . $card['icon']); ?>"
                    alt="<?php echo esc_attr($card['title']); ?>"
                    loading="lazy"
                  />
                </span>
                <div class="flex flex-col gap-3">
                  <h3 class="text-lg font-semibold text-zinc-950">
                    <?php echo esc_html($card['title']); ?>
                  </h3>
                  <p class="text-sm leading-6 text-zinc-600">
                    <?php echo esc_html($card['description']); ?>
                  </p>
                  <span class="inline-flex items-center text-sm font-semibold text-indigo-600 transition group-hover:text-indigo-700">
                    <?php esc_html_e('Read more', 'webmakerr'); ?>
                    <svg class="ml-2 h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path d="M3 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M9 4L13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <?php
      $policy_categories = array(
          array(
              'title' => __('Legal Terms & Agreements', 'webmakerr'),
              'description' => __('Detailed clauses that cover licensing, deliverables, and dispute resolution for every project.', 'webmakerr'),
              'link' => home_url('/legal/terms'),
              'image' => 'category-legal.svg',
          ),
          array(
              'title' => __('Privacy & Data Protection', 'webmakerr'),
              'description' => __('See how Webmakerr safeguards personal information and respects global privacy regulations.', 'webmakerr'),
              'link' => home_url('/legal/privacy'),
              'image' => 'category-privacy.svg',
          ),
          array(
              'title' => __('Community Standards', 'webmakerr'),
              'description' => __('Guidelines that support respectful collaboration, inclusive workplaces, and trusted partnerships.', 'webmakerr'),
              'link' => home_url('/legal/community'),
              'image' => 'category-community.svg',
          ),
          array(
              'title' => __('ESG & Sustainability', 'webmakerr'),
              'description' => __('Learn about our commitments to ethical sourcing, sustainable operations, and social impact.', 'webmakerr'),
              'link' => home_url('/legal/esg'),
              'image' => 'category-esg.svg',
          ),
      );
      ?>

      <section class="bg-white">
        <?php foreach ($policy_categories as $index => $category) :
            $is_even = $index % 2 === 0;
            $media_classes = $is_even ? 'md:order-1' : 'md:order-2';
            $text_classes = $is_even ? 'md:order-2 md:items-start' : 'md:order-1 md:items-end';
            $text_alignment = $is_even ? 'md:text-left' : 'md:text-right';
            ?>
          <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-6 py-16 md:grid-cols-2">
            <div class="flex justify-center <?php echo esc_attr($media_classes); ?>">
              <img
                class="w-full max-w-xl"
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/svg/' . $category['image']); ?>"
                alt="<?php echo esc_attr($category['title']); ?>"
                loading="lazy"
              />
            </div>
            <div class="flex flex-col gap-6 <?php echo esc_attr($text_classes . ' ' . $text_alignment); ?>">
              <h3 class="text-3xl font-semibold text-zinc-950">
                <?php echo esc_html($category['title']); ?>
              </h3>
              <p class="max-w-xl text-base leading-7 text-zinc-600 sm:text-lg">
                <?php echo esc_html($category['description']); ?>
              </p>
              <a class="inline-flex items-center text-sm font-semibold text-indigo-600 transition hover:text-indigo-700"
                href="<?php echo esc_url($category['link']); ?>">
                <?php esc_html_e('Explore documentation', 'webmakerr'); ?>
                <svg class="ml-2 h-4 w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path d="M3 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M9 4L13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </section>

      <section class="bg-[#18184d]">
        <div class="container mx-auto flex flex-col items-center gap-6 px-6 py-20 text-center text-white">
          <h2 class="text-3xl font-semibold tracking-tight [text-wrap:balance] sm:text-4xl">
            <?php esc_html_e('Need more information? Contact Webmakerr Support.', 'webmakerr'); ?>
          </h2>
          <p class="max-w-2xl text-base leading-7 text-white/80 sm:text-lg">
            <?php esc_html_e('Our support specialists are ready to help with compliance questions, partnership agreements, and anything in between.', 'webmakerr'); ?>
          </p>
          <a
            class="btn btn-primary inline-flex items-center justify-center rounded-[5px] border border-transparent bg-white px-6 py-3 text-sm font-semibold text-[#18184d] shadow-sm transition hover:bg-zinc-100 hover:text-[#18184d] !no-underline"
            href="<?php echo esc_url(home_url('/contact')); ?>"
          >
            <?php esc_html_e('Contact Support', 'webmakerr'); ?>
          </a>
        </div>
      </section>
    </article>
  <?php endwhile; ?>
</main>

<?php
get_footer();
