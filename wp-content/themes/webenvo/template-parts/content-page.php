<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package webenvo
 */

?>
<!-- Page Content -->
	<article id="page-<?php the_ID(); ?>" <?php post_class( 'page shadow-lg p-4 mt-2 bg-white rounded' ); ?>>
			<?php
			if ( has_post_thumbnail() ) {
				?>
				<figure class="post-thumbnail"> 
					<?php the_post_thumbnail(); ?>
				</figure>
				<?php
			}
			?>
		<div class="full-content">
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages(
					array(
						'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'webenvo' ) . '">',
						'after'    => '</nav>',
						/* translators: %: Page number. */
						'pagelink' => esc_html__( 'Page %', 'webenvo' ),
					)
				);
				?>
			</div>
		</div>
		<!--Comment Section-->
	</article>
	<?php
			comments_template();
	?>
	<!-- End Page Content -->
