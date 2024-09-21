<?php
/**
 * Page Title Module.
 *
 * @package webenvo
 */

if ( ! is_home() || ! is_front_page() ) {
	?>
	<section class="page-title-module" style="background: url(<?php echo esc_url_raw( get_theme_mod( 'webenvo-title-image' ) ); ?>)">
		<div class="container">
			<div class="row">
				<div class="container col-md-12 col-sm-12 col-xs-12 content-center">
					<div class="page-title text-center">
							<h1 class="text-white"><?php single_post_title(); ?></h1>
					</div>
					<!-- <ul class="page-breadcrumb text-center">
						<li><a href="#">Home</a></li>
						<li class="active">Blog Right Sidebar</li>
					</ul> -->
				</div>
			</div>
		</div>
	</section>
<?php } ?>
