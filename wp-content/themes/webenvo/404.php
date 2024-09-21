<?php
/**
 * Index Page
 *
 * @package webenvo
 */

// For section padding adjustments.
if ( ! is_home() || ! is_front_page() ) {
	$section_padding = 'padding: 0px 0 50px;';
} else {
	$section_padding = '';
}
get_header();
?>
<!--Page Title-->
<?php get_template_part( 'template-parts/title', 'module' ); ?>


<!-- 404 page Section -->
<section id="section" class="contact">
	<div class="container">
		<div class="row">
			<div id="notfound">
				<div class="notfound">
					<div class="notfound-404">
						<h1>4<span>0</span>4
						</h1>
					</div>
					<h2><?php echo esc_html__( 'Oops ! - Page not found', 'webenvo' ); ?></h2>
					<p class="mb-4"><?php echo esc_html__( 'The page you are looking for might have been removed had its name changed or is temporarily unavailable.', 'webenvo' ); ?></p>
					<a href="<?php echo esc_html( home_url() ); ?>" class="thm-btn"><?php echo esc_html__( 'Back To Homepage', 'webenvo' ); ?></a>
				</div>
			</div>

		</div>
	</div>
</section>
<!--/404 page Section -->
<!-- Footer Menu -->
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
