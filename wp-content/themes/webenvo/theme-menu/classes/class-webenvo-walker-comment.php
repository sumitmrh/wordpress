<?php
/**
 * Custom comment walker for this theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

if ( ! class_exists( 'Webenvo_Walker_Comment' ) ) {
	/**
	 * CUSTOM COMMENT WALKER
	 * A custom walker for comments, based on the walker in Twenty Nineteen.
	 */
	class Webenvo_Walker_Comment extends Walker_Comment {

		/**
		 * Outputs a comment in the HTML5 format.
		 *
		 * @see wp_list_comments()
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author/
		 * @see https://developer.wordpress.org/reference/functions/get_avatar/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
		 * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
		 *
		 * @param WP_Comment $comment Comment to display.
		 * @param int        $depth   Depth of the current comment.
		 * @param array      $args    An array of arguments.
		 */
		protected function html5_comment( $comment, $depth, $args ) {

			$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

			?>
			<!-- Inside Walker -->
			<<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?> <?php comment_class( $this->has_children ? 'parent media comment-box' : 'media comment-box', $comment ); ?>>
				<!-- div id="div-comment-<?php comment_ID(); ?>" class="media comment-box"-->
					<?php
						$comment_author_url = get_comment_author_url( $comment );
						$comment_author     = get_comment_author( $comment );
						$avatar             = get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'comment-img' ) );
					?>
						<a class="pull-left-comment">
							<?php
							if ( 0 !== $args['avatar_size'] ) {
									echo wp_kses_post( $avatar );
							}
							?>
						</a>
						<div class="media-body">
							<div class="comment-detail">
								<h5 class="comment-detail-title">
									<?php
										printf(
											'<span class="fn">%1$s</span><span class="screen-reader-text says">%2$s</span>',
											esc_html( $comment_author ),
											__( 'says:', 'webenvo' )
										);
									?>
								</h5>
								<time class="comment-date">
									<?php
									/* translators: 1: Comment date, 2: Comment time. */
									$comment_timestamp = sprintf( __( '%1$s at %2$s', 'webenvo' ), get_comment_date( '', $comment ), get_comment_time() );

									printf(
										'<a href="%s"><time datetime="%s" title="%s">%s</time></a>',
										esc_url( get_comment_link( $comment, $args ) ),
										get_comment_time( 'c' ),
										esc_attr( $comment_timestamp ),
										esc_html( $comment_timestamp )
									);
									?>
								</time>
								<?php
								if ( '0' === $comment->comment_approved ) {
									?>
										<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'webenvo' ); ?></p>
										<?php
								} else {
									comment_text();
								}
								$comment_reply_link = get_comment_reply_link(
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
								$by_post_author     = webenvo_is_comment_by_post_author( $comment );
				if ( $comment_reply_link ) {
					echo $comment_reply_link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Link is escaped in https://developer.wordpress.org/reference/functions/get_comment_reply_link/
				}
				if ( $by_post_author ) {
					echo '<span class="by-post-author">' . __( 'This Comment is By Post Author', 'webenvo' ) . '</span>';
				}
				?>
								<?php
								if ( get_edit_comment_link() ) {
									printf(
										'<div class="edit-comment"><a class="comment-edit-link edit-thm-comment-btn" href="%s">%s</a></div>',
										esc_url( get_edit_comment_link() ),
										__( 'Edit', 'webenvo' )
									);
								}
								?>
							</div>
			</div>
			<?php
		}
	}
}
