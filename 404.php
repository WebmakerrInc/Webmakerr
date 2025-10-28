<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Webmakerr
 */
get_header();
?>

<div class="container mx-auto py-16 lg:py-24">
    <section class="md:flex min-h-[60vh] items-center justify-center">
        <div class="w-full md:w-1/2 flex items-center justify-center">
            <div class="max-w-sm m-8 text-center md:text-left">
                <div class="text-5xl md:text-15xl text-dark border-light border-b">404</div>
                <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>
                <p class="text-dark/90 text-2xl md:text-3xl font-light leading-relaxed mb-8"><?php esc_html_e('Sorry, the page you are looking for could not be found.', 'webmakerr'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex rounded-full px-4 py-1.5 text-sm font-semibold transition bg-dark text-white hover:bg-dark/90 !no-underline">
                    <?php esc_html_e('Go Home', 'webmakerr'); ?>
                </a>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
