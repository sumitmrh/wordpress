<?php
/**
 *  Single Template
 *
 *  @package webenvo
 */

get_header();
?>
<!--Page Title-->
<?php get_template_part( 'template-parts/title', 'module' ); ?>

<!-- Single Blog single.php Section -->
<section id="section" class="site-content p-0">
	<?php $blog_single_size = get_theme_mod( 'webenvo-blog-single-size', 'container' ); ?>
	<div class="<?php echo esc_attr( $blog_single_size ); ?>" style="margin-top:18px;">
		<div class="row">
			<?php $single_sidebar_position = get_theme_mod( 'webenvo-blog-single-sidebar', 'sidebarright' ); ?>
			<!--Sidebar Left-->
			<?php if ( $single_sidebar_position === 'sidebarleft' ) { ?>
				<div class="col-md-4 col-sm-4 col-xs-12 pt-4">
					<div class="sidebar space-left">
						<?php get_sidebar( 'webenvo_blogwidget' ); ?>
					</div>
				</div>
			<?php } ?>
			<!--/Sidebar Left-->
			<!-- Classes for sidebar None -->
			<?php
			if ( $single_sidebar_position === 'sidebarnone' ) {
				$single_classes = 'col-md-12 col-sm-12 col-xs-12 pt-4';
			} else {
				$single_classes = 'col-md-8 col-sm-8 col-xs-12 pt-4';
			}
			?>
			<!--Single Blog Posts-->
			<div class="<?php echo esc_attr( $single_classes ); ?>">
				<div class="blog">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content-single', get_post_type() );
						?>
						<?php
							endwhile;
						endif;
				?>
				</div> <!-- Blog -->
			</div> <!-- End Row -->
			<!--Sidebar Right-->
			<?php if ( $single_sidebar_position === 'sidebarright' ) { ?>
			<div class="col-md-4 col-sm-4 col-xs-12 pt-4">
				<div class="sidebar space-left">
					<?php get_sidebar( 'webenvo_blogwidget' ); ?>
				</div>
			</div>
			<?php } ?>
			<!--/Sidebar Right-->
		</div>
	</div>
</section>
<!--  Single Blog single.php Section -->
<?php
get_footer();
