<?php
/**
 * Comments template.
 *
 * @package Webmakerr
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area my-10 sm:my-20 mx-auto max-w-3xl">
    <?php if (have_comments()): ?>
        <h2 class="comments-title text-3xl font-medium text-zinc-900 mb-8">
            <?php
            printf(
                esc_html(_nx(
                    'One comment',
                    '%1$s comments',
                    get_comments_number(),
                    'comments title',
                    'webmakerr'
                )),
                esc_html(number_format_i18n(get_comments_number()))
            );
            ?>
        </h2>

        <ol class="comment-list [&_.children]:ml-20 [&_.children_>_li]:mt-8 mb-12">
            <?php
            wp_list_comments([
                'format'      => 'html5',
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 56,
                'walker'      => new \Webmakerr\Walkers\CommentWalker(),
            ]);
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <nav class="comment-navigation flex justify-between" id="comment-nav-above" aria-label="<?php esc_attr_e('Comment navigation', 'webmakerr'); ?>">
                <div class="nav-previous">
                    <?php previous_comments_link(esc_html__('Older Comments &larr;', 'webmakerr')); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(esc_html__('Newer Comments &rarr;', 'webmakerr')); ?>
                </div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="no-comments text-zinc-600"><?php esc_html_e('Comments are closed.', 'webmakerr'); ?></p>
    <?php endif; ?>

    <?php
        $commenter = wp_get_current_commenter();

        $req = get_option('require_name_email');
        $aria_req = ($req ? ' aria-required="true"' : '');

        comment_form([
            'fields' => apply_filters('comment_form_default_fields', [
                'author' =>
                    '<p class="comment-form-author">'
                    . '<label class="screen-reader-text" for="author">' . esc_html__('Your name', 'webmakerr') . '</label>'
                    . '<input id="author" class="bg-light w-full px-4 py-3 mb-4 rounded-xl text-sm" placeholder="' . esc_attr__('Your name*', 'webmakerr') . '" name="author" type="text" value="' . esc_attr($commenter['comment_author'])
                    . '" size="30"' . $aria_req . ' /></p>',

                'email' =>
                    '<p class="comment-form-email">'
                    . '<label class="screen-reader-text" for="email">' . esc_html__('Your email address', 'webmakerr') . '</label>'
                    . '<input id="email" class="bg-light w-full px-4 py-3 mb-4 rounded-xl text-sm" placeholder="' . esc_attr__('Your email address*', 'webmakerr') . '" name="email" type="email" value="' . esc_attr($commenter['comment_author_email'])
                    . '" size="30"' . $aria_req . ' /></p>',

                'url' =>
                    '<p class="comment-form-url">'
                    . '<label class="screen-reader-text" for="url">' . esc_html__('Your website URL', 'webmakerr') . '</label>'
                    . '<input id="url" class="bg-light w-full px-4 py-3 mb-4 rounded-xl text-sm" placeholder="' . esc_attr__('Your website URL', 'webmakerr') . '" name="url" type="url" value="' . esc_attr($commenter['comment_author_url'])
                    . '" size="30" /></p>'
            ]),
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-2xl font-bold mb-2">',
            'class_submit'      => 'bg-dark rounded-full px-4 py-1.5 text-sm font-semibold text-light my-4',
            'comment_field'     => '<p class="comment-form-comment">'
                . '<label class="screen-reader-text" for="comment">' . esc_html__('Your comment', 'webmakerr') . '</label>'
                . '<textarea id="comment" name="comment" class="bg-light w-full px-4 py-3 my-2 rounded-xl text-sm" aria-required="true" placeholder="' . esc_attr__('Your comment', 'webmakerr') . '"></textarea>'
                . '</p>',
            'logged_in_as'      => '<p class="logged-in-as mb-4">',
        ]);
    ?>
</div>
