<?php
/**
 * Index Page
 *
 * @package webenvo
 */

get_header();
?>
	<!--Page Title-->
	<?php get_template_part( 'template-parts/title', 'module' ); ?>
	<!--/ Page Title-->
	<!-- Blog & Sidebar Section index.php -->
	<section id="index-section" class="site-content index-section">
		<?php $blog_container_class = get_theme_mod( 'webenvo-blogs-land-size', 'container' ); ?>
		<div class="<?php echo esc_attr( $blog_container_class ); ?>" >
			<div class="row">

				<!--Blog Posts index-->
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="blog row">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content', get_post_type() );
							endwhile;
								// post pagination.

							$posts_pagination = get_the_posts_pagination(
								array(
									'mid_size'  => 1,
									'prev_text' => '<<',
									'next_text' => '>>',
								)
							);
							echo $posts_pagination; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped during generation.
						else :
							get_template_part( 'template-parts/content-none', get_post_type() );
						endif;
						wp_reset_postdata();
						?>

					</div>
				</div>
				<!--/Blog Posts-->

			</div>
		</div>
	</section>
	<!-- End of Blog & Sidebar Section -->
	<?php
	get_template_part( 'template-parts/footer-menus-widgets' );
	get_footer();
	?>
