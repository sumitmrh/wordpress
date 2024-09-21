<?php
/**
 * Woocommerce page template.
 *
 * @package webenvo
 */

get_header();
?>
<!--Shop Title-->
<section class="page-title-module" style="background: url(<?php echo esc_url_raw( get_theme_mod( 'webenvo-title-image' ) ); ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 content-center">
					<div class="page-title text-center">
							<h1 class="text-white"><?php woocommerce_page_title(); ?></h1>
					</div>
				</div>
			</div>
		</div>
	</section>
<!--/ Shop Title-->
			<div id="shop" class="container-full"><!-- Shop Container -->
				<div class="row v-center">
					<div class="wow fadeInLeft animated" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInLeft;">
						<!-- Woocommerce Content -->
						<div class="woocommerce p-4 mt-5 mb-5 bg-white rounded">
						<?php woocommerce_content(); ?>
						</div>
							<!-- End woocommerce Content -->
					</div>
				</div>
			</div><!-- shop container End -->
<?php get_footer(); ?>
