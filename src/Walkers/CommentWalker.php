<?php

namespace Webmakerr\Walkers;

class CommentWalker extends \Walker_Comment
{
    protected function html5_comment($comment, $depth, $args)
    {
                $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

                if ( $commenter['comment_author_email'] ) {
                        $moderation_note = __( 'Your comment is awaiting moderation.', 'webmakerr' );
                } else {
                        $moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'webmakerr' );
                }
                ?>
                <<?php echo tag_escape( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
                        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body flex gap-16">

                                <footer class="comment-meta flex">
                    <dd class="flex items-start gap-16">
                        <div class="flex-none overflow-hidden rounded-lg border border-border bg-light shadow-subtle">
                            <?php
                                if ( 0 !== $args['avatar_size'] ) {
                                    echo get_avatar( $comment, 48, '', '', [
                                        'class' => 'size-48 object-cover',
                                    ]);
                                }
                            ?>
                        </div>
                    </dd>
                    <!-- .comment-author -->
				</footer><!-- .comment-meta -->

                <div class="w-full grow">
                    <div class="comment-metadata flex items-center gap-16">
                        <div class="font-medium text-text">
                            <?php
                            $comment_author = get_comment_author_link( $comment );

                            if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
                                $comment_author = get_comment_author( $comment );
                            }

                            echo wp_kses_post( $comment_author );
                            ?>
                        </div>

                                                <div class="flex gap-16 text-sm text-muted-text">
                            <?php
                            printf(
                                '<a href="%s"><time datetime="%s">%s</time></a>',
                                esc_url( get_comment_link( $comment, $args ) ),
                                esc_attr( get_comment_time( 'c' ) ),
                                sprintf(
                                    /* translators: 1: Comment date, 2: Comment time. */
                                    esc_html__( '%1$s at %2$s', 'webmakerr' ),
                                    esc_html( get_comment_date( '', $comment ) ),
                                    esc_html( get_comment_time() )
                                )
                            );
                            edit_comment_link( esc_html__( 'Edit', 'webmakerr' ), ' <span class="edit-link">', '</span>' );
                            ?>
                        </div>
                                        </div><!-- .comment-metadata -->

                                        <?php if ( '0' === $comment->comment_approved ) : ?>
                                        <em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
                                        <?php endif; ?>

                    <div class="comment-content mt-16 text-muted-text">
                        <?php comment_text(); ?>
                    </div><!-- .comment-content -->

                    <?php
                    if ( '1' === $comment->comment_approved || $show_pending_links ) {
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'div-comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="reply">',
                                    'after'     => '</div>',
                                )
                            )
                        );
                    }
                    ?>
                </div>
			</article><!-- .comment-body -->
		<?php
	}
}
