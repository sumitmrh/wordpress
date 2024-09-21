<?php
/**
 * The template file for displaying the comments and comment form for the
 * Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

if ( $comments ) {
	?>
	<article id="comments" class="comment-section">

		<?php
		$comments_number = absint( get_comments_number() );
		?>
		<div class="comment-title">
			<h3>
				<?php
				if ( ! have_comments() ) {
					_e( 'Leave a comment', 'webenvo' );
				} elseif ( 1 === $comments_number ) {
					/* translators: %s: Post title. */
					printf( _x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'webenvo' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: Number of comments, 2: Post title. */
						_nx(
							'%1$s reply on &ldquo;%2$s&rdquo;',
							'%1$s replies on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'webenvo'
						),
						esc_attr( number_format_i18n( $comments_number ) ),
						get_the_title()
					);
				}

				?>
			</h3>

		</div><!-- .comments-title -->
		<?php
		// Listing Comments Start Self Creates a Div with Classes.
		// Walker is inside menu classes.
		wp_list_comments(
			array(
				'walker'      => new Webenvo_Walker_Comment(),
				// 'callback'      => 'bootstrap_comment_callback',
				'avatar_size' => 120,
				'style'       => 'div',
				'format'      => 'html5',
			)
		);

			$comment_pagination = paginate_comments_links(
				array(
					'echo'      => false,
					'end_size'  => 0,
					'mid_size'  => 0,
					'next_text' => __( 'Newer Comments', 'webenvo' ) . ' <span aria-hidden="true">&rarr;</span>',
					'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __( 'Older Comments', 'webenvo' ),
				)
			);

		if ( $comment_pagination ) {
			$pagination_classes = '';

			// If we're only showing the "Next" link, add a class indicating so.
			if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
				$pagination_classes = ' only-next';
			}

			?>

			<nav class="comments-pagination pagination<?php echo $pagination_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>" aria-label="<?php // esc_attr_e( 'Comments', 'webenvo' ); ?>">
				<?php echo wp_kses_post( $comment_pagination ); ?>
			</nav>
				<?php
		}
		?>

		<!-- </div>.comments-inner -->

	</article><!-- comments -->

	<?php
}
?>
<?php
if ( comments_open() || pings_open() ) {

	if ( $comments ) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

	comment_form(
		array(
			'class_container'     => 'comment-form-section',
			'class_form'          => 'form-inline',
			'title_reply_to'      => 'Type a Reply to %s',
			'title_reply_before'  => '<div class="comment-title"><h3 id="reply-title">',
			'title_reply_after'   => '</h3></div>',
			'id_submit'            => 'comment-form-submit',
			'name_submit'         => 'Submit Comment',
			'class_submit'        => 'thm-btn',
			// 'submit_button'       => '<a name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" >Submit Comment</a>',
			'cancel_reply_before' => '<div class="cancel-reply">',
			'cancel_reply_after'  => '</div>',

		)
	);

} elseif ( is_single() ) {

	if ( $comments ) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

	?>

	<div class="comment-respond" id="respond">

		<p class="comments-closed"><?php _e( 'Comments are closed for this post.', 'webenvo' ); ?></p>

	</div><!-- #respond -->

	<?php
}
