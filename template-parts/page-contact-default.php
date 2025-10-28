<?php
/**
 * Default marketing layout for the contact page when no custom content exists.
 *
 * @package Webmakerr
 */
?>
<div class="grid gap-16 lg:grid-cols-[minmax(0,_1.1fr)_minmax(0,_1fr)] lg:gap-24">
    <section class="flex flex-col gap-10 text-left">
        <div class="flex flex-col gap-6">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-primary"><?php esc_html_e('Contact', 'webmakerr'); ?></p>
            <h1 class="text-4xl font-medium tracking-tight text-zinc-950 sm:text-5xl"><?php esc_html_e('Get in touch', 'webmakerr'); ?></h1>
            <p class="max-w-xl text-base leading-7 text-zinc-600 sm:text-lg"><?php esc_html_e('Ready to build with Webmakerr? Tell us a bit about your team and how we can help streamline your next launch.', 'webmakerr'); ?></p>
        </div>

        <ul class="flex list-disc flex-col gap-3 pl-5 text-sm font-semibold text-zinc-900">
            <li>
                <a class="inline-flex items-center text-zinc-950 transition hover:text-primary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline" href="<?php echo esc_url('mailto:hello@example.com'); ?>">
                    <?php esc_html_e('Email us directly at hello@example.com', 'webmakerr'); ?>
                </a>
            </li>
            <li>
                <a class="inline-flex items-center text-zinc-950 transition hover:text-primary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline" href="<?php echo esc_url(home_url('/pricing')); ?>">
                    <?php esc_html_e('View pricing and plans', 'webmakerr'); ?>
                </a>
            </li>
            <li>
                <a class="inline-flex items-center text-zinc-950 transition hover:text-primary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark !no-underline" href="<?php echo esc_url(home_url('/support')); ?>">
                    <?php esc_html_e('Visit our support center', 'webmakerr'); ?>
                </a>
            </li>
        </ul>

        <div class="rounded-3xl border border-zinc-200 bg-zinc-50 p-6 shadow-sm sm:p-8">
            <figure class="flex flex-col gap-6">
                <blockquote class="text-lg font-medium text-zinc-900 sm:text-xl">
                    “<?php esc_html_e('Webmakerr gave our team the momentum to launch in weeks instead of months. The layout is minimal, accessible, and lightning fast.', 'webmakerr'); ?>”
                </blockquote>
                <figcaption class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-zinc-200"></div>
                    <div>
                        <p class="text-sm font-semibold text-zinc-900"><?php esc_html_e('Amelia Carter', 'webmakerr'); ?></p>
                        <p class="text-sm text-zinc-600"><?php esc_html_e('Head of Product, Northwind', 'webmakerr'); ?></p>
                    </div>
                </figcaption>
            </figure>
            <div class="mt-8 flex flex-wrap items-center gap-6 text-xs font-semibold uppercase tracking-[0.3em] text-zinc-500">
                <span class="rounded-full border border-zinc-200 px-4 py-2 text-[11px] text-zinc-700"><?php esc_html_e('Northwind', 'webmakerr'); ?></span>
                <span class="rounded-full border border-zinc-200 px-4 py-2 text-[11px] text-zinc-700"><?php esc_html_e('Globex', 'webmakerr'); ?></span>
                <span class="rounded-full border border-zinc-200 px-4 py-2 text-[11px] text-zinc-700"><?php esc_html_e('Acme', 'webmakerr'); ?></span>
            </div>
        </div>
    </section>

    <section>
        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm sm:p-8 lg:p-10">
            <h2 class="text-2xl font-semibold text-zinc-950 sm:text-3xl"><?php esc_html_e('Work with our team', 'webmakerr'); ?></h2>
            <p class="mt-3 text-sm leading-6 text-zinc-600"><?php esc_html_e('We partner with agencies and product teams to build fast, accessible websites. Choose the contact method that works best for your workflow.', 'webmakerr'); ?></p>

            <div class="mt-8 space-y-6">
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-zinc-500"><?php esc_html_e('Email', 'webmakerr'); ?></h3>
                    <p class="mt-2 text-sm text-zinc-600"><?php esc_html_e('Send a message to hello@example.com and a member of our team will reply within two business days.', 'webmakerr'); ?></p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-zinc-500"><?php esc_html_e('Support portal', 'webmakerr'); ?></h3>
                    <p class="mt-2 text-sm text-zinc-600"><?php esc_html_e('Track ongoing projects and ask technical questions inside the customer portal.', 'webmakerr'); ?></p>
                    <a class="mt-3 inline-flex items-center text-sm font-semibold text-dark transition hover:text-primary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark" href="<?php echo esc_url(home_url('/support')); ?>">
                        <?php esc_html_e('Open support center', 'webmakerr'); ?>
                    </a>
                </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-zinc-500"><?php esc_html_e('Contact form plugin', 'webmakerr'); ?></h3>
                    <p class="mt-2 text-sm text-zinc-600"><?php esc_html_e('Prefer forms? Install your favorite contact form plugin and embed it here using a block or shortcode.', 'webmakerr'); ?></p>
                    <p class="mt-2 text-sm text-zinc-600"><?php esc_html_e('This template keeps things presentation-only so you can choose the tools that fit your site.', 'webmakerr'); ?></p>
                </div>
            </div>
        </div>
    </section>
</div>
