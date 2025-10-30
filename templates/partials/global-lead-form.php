<?php
/**
 * Global lead capture popup component.
 *
 * @package Webmakerr
 */

if (! defined('ABSPATH')) {
    exit;
}

$dialogId = 'global-lead-form-heading';
$descriptionId = 'global-lead-form-description';
?>
<div
    id="global-lead-modal"
    class="fixed inset-0 z-[999] hidden flex items-center justify-center px-4 py-6 sm:px-6 lg:px-8"
    data-lead-modal
    aria-hidden="true"
>
    <div
        class="fixed inset-0 bg-neutral-950/60 opacity-0 transition-opacity duration-200 ease-out pointer-events-none"
        data-lead-overlay
    ></div>
    <div
        class="relative mx-auto w-full max-w-lg transform overflow-hidden rounded-[5px] bg-white shadow-xl shadow-neutral-900/10 opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out pointer-events-none focus:outline-none"
        role="dialog"
        aria-modal="true"
        aria-labelledby="<?php echo esc_attr($dialogId); ?>"
        aria-describedby="<?php echo esc_attr($descriptionId); ?>"
        data-lead-dialog
        tabindex="-1"
    >
        <button
            type="button"
            class="absolute right-4 top-4 inline-flex h-9 w-9 items-center justify-center rounded-full bg-neutral-100 text-neutral-500 transition hover:bg-neutral-200 hover:text-neutral-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
            data-lead-close
            aria-label="<?php esc_attr_e('Close popup', 'webmakerr'); ?>"
        >
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M5 5l10 10M15 5 5 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>

        <div class="px-6 py-8 sm:px-8">
            <header class="flex flex-col gap-3 text-center">
                <h2 id="<?php echo esc_attr($dialogId); ?>" class="text-2xl font-semibold text-neutral-900 sm:text-3xl">
                    <?php esc_html_e('Get started with Webmakerr', 'webmakerr'); ?>
                </h2>
                <p id="<?php echo esc_attr($descriptionId); ?>" class="text-sm text-neutral-600">
                    <?php esc_html_e('Join thousands of teams launching fast, conversion-ready WordPress experiences.', 'webmakerr'); ?>
                </p>
            </header>

            <form class="mt-6 flex flex-col gap-4" method="post" data-webseo-lead-form>
                <div class="flex flex-col items-start gap-2 text-left">
                    <label class="text-xs font-semibold uppercase tracking-[0.2em] text-neutral-500" for="global-lead-email">
                        <?php esc_html_e('Business email', 'webmakerr'); ?>
                    </label>
                    <input
                        id="global-lead-email"
                        class="w-full rounded-[5px] border border-neutral-200 bg-white px-3 py-2 text-sm text-neutral-900 shadow-sm transition focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20"
                        type="email"
                        name="email"
                        required
                        autocomplete="email"
                    />
                </div>
                <input type="hidden" name="source" value="" data-lead-source-field />
                <input type="hidden" name="webseo_lead_nonce" value="<?php echo esc_attr(wp_create_nonce('webseo_lead_nonce')); ?>" />

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-[5px] bg-dark px-5 py-2 text-sm font-semibold text-white transition hover:bg-dark/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark"
                    data-webseo-lead-submit
                    data-webseo-loading-text="<?php esc_attr_e('Sending…', 'webmakerr'); ?>"
                >
                    <?php esc_html_e('Get Started Free', 'webmakerr'); ?>
                </button>
                <p class="webseo-lead-message hidden text-sm" data-webseo-lead-message aria-live="polite"></p>
            </form>
            <p class="mt-4 text-center text-xs text-neutral-500">
                <?php esc_html_e('No spam — we’ll send onboarding resources and the latest templates.', 'webmakerr'); ?>
            </p>
        </div>
    </div>
</div>
