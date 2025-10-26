<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
        <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body class="bg-light text-text antialiased">
        <div class="flex min-h-screen items-center justify-center">
                <div class="container flex flex-col items-center gap-24 text-center">
                        <h1 class="text-dark">404</h1>
                        <p class="max-w-xl text-dark"><?php esc_html_e( 'Sorry, the page you are looking for could not be found.', 'webmakerr' ); ?></p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary !no-underline">
                                <?php esc_html_e( 'Go Home', 'webmakerr' ); ?>
                        </a>
                </div>
        </div>

    <?php wp_footer(); ?>
</body>
</html>
