<?php
/**
 * Landing Page block pattern.
 *
 * @package Webmakerr
 */

if (! defined('ABSPATH')) {
    exit;
}

return [
    'title'      => __('Landing Page', 'webmakerr'),
    'description'=> __('A minimalist landing page layout with hero, features, and call to action sections.', 'webmakerr'),
    'categories' => ['webmakerr-pages'],
    'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"120px","bottom":"120px","right":"80px","left":"80px"}}},"backgroundColor":"light"} -->
<div class="wp-block-group alignfull has-light-background-color has-background" style="padding-top:120px;padding-right:80px;padding-bottom:120px;padding-left:80px"><!-- wp:group {"layout":{"type":"constrained","wideSize":"960px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"48px"}}},"fontSize":"5xl","textColor":"dark"} -->
<h1 class="wp-block-heading has-text-align-center has-dark-color has-text-color has-5-xl-font-size" style="margin-bottom:48px">' . esc_html__('Shape remarkable digital experiences.', 'webmakerr') . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"80px"}}},"fontSize":"lg","textColor":"dark"} -->
<p class="has-text-align-center has-dark-color has-text-color has-lg-font-size" style="margin-bottom:80px">' . esc_html__('Our minimalist WordPress theme brings focus to your story with purposeful layouts and timeless typography.', 'webmakerr') . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary","textColor":"light","style":{"typography":{"fontSize":"1rem"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}}} -->
<div class="wp-block-button has-custom-font-size" style="font-size:1rem"><a class="wp-block-button__link has-light-color has-primary-background-color has-text-color has-background wp-element-button" style="padding-top:16px;padding-right:32px;padding-bottom:16px;padding-left:32px">' . esc_html__('Start your project', 'webmakerr') . '</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"typography":{"fontSize":"1rem"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}}} -->
<div class="wp-block-button has-custom-font-size is-style-outline" style="font-size:1rem"><a class="wp-block-button__link wp-element-button" style="padding-top:16px;padding-right:32px;padding-bottom:16px;padding-left:32px">' . esc_html__('View case studies', 'webmakerr') . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","right":"48px","left":"48px"}},"border":{"bottom":{"color":"var:preset|color|light","width":"1px"}}},"layout":{"type":"constrained","wideSize":"1080px"}} -->
<div class="wp-block-group alignfull" style="border-bottom-color:var(--wp--preset--color--light);border-bottom-width:1px;padding-top:96px;padding-right:48px;padding-bottom:96px;padding-left:48px"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"48px","left":"48px"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"fontSize":"2xl","textColor":"dark"} -->
<h2 class="wp-block-heading has-dark-color has-text-color has-2-xl-font-size">' . esc_html__('Design with clarity', 'webmakerr') . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"dark","fontSize":"base"} -->
<p class="has-dark-color has-text-color has-base-font-size">' . esc_html__('Curate your content inside a balanced layout that adapts effortlessly across devices.', 'webmakerr') . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"fontSize":"2xl","textColor":"dark"} -->
<h2 class="wp-block-heading has-dark-color has-text-color has-2-xl-font-size">' . esc_html__('Craft meaningful journeys', 'webmakerr') . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"dark","fontSize":"base"} -->
<p class="has-dark-color has-text-color has-base-font-size">' . esc_html__('Guide visitors with thoughtful hierarchies and purposeful calls to action.', 'webmakerr') . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"fontSize":"2xl","textColor":"dark"} -->
<h2 class="wp-block-heading has-dark-color has-text-color has-2-xl-font-size">' . esc_html__('Launch swiftly', 'webmakerr') . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"dark","fontSize":"base"} -->
<p class="has-dark-color has-text-color has-base-font-size">' . esc_html__('Pair this pattern with reusable blocks and templates to publish polished pages fast.', 'webmakerr') . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"112px","bottom":"112px","right":"80px","left":"80px"}}},"layout":{"type":"constrained","wideSize":"960px"}} -->
<div class="wp-block-group alignfull" style="padding-top:112px;padding-right:80px;padding-bottom:112px;padding-left:80px"><!-- wp:group {"style":{"spacing":{"blockGap":"40px"}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","fontSize":"3xl","textColor":"dark"} -->
<h2 class="wp-block-heading has-text-align-center has-dark-color has-text-color has-3-xl-font-size">' . esc_html__('Elevate your next launch', 'webmakerr') . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"dark","fontSize":"base"} -->
<p class="has-text-align-center has-dark-color has-text-color has-base-font-size">' . esc_html__('Leverage this refined layout as a starting point for campaigns, product unveilings, or studio showcases.', 'webmakerr') . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"dark","textColor":"light","style":{"typography":{"fontSize":"1rem"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}}} -->
<div class="wp-block-button has-custom-font-size" style="font-size:1rem"><a class="wp-block-button__link has-light-color has-dark-background-color has-text-color has-background wp-element-button" style="padding-top:16px;padding-right:32px;padding-bottom:16px;padding-left:32px">' . esc_html__('Book a discovery call', 'webmakerr') . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
];
