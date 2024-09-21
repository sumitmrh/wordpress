<?php
/**
 * About Section
 *
 * @package webenvo
 */

?>

<!--About Section---->
<?php if ( get_theme_mod( 'webenvo-about-show', 1 ) === 1 ) { ?>
	<section id="about-section" class="about">
		<?php
			$about_container_class  = get_theme_mod( 'webenvo-about-container', 'container' );
			$about_image            = get_theme_mod( 'webenvo-about-image', ENVO_COMPANION_PLUGIN_URL . 'inc/webenvo/img/about.jpg' );
			$webenvo_about_subtitle = get_theme_mod( 'webenvo-about-subtitle', 'Where can we help' );
			$webenvo_about_info     = get_theme_mod( 'webenvo-about-info', '<p>We are dedicated to providing exceptional advisory services and strategic guidance to organizations across various industries. We understand that every client is unique, and we tailor our approach to meet their specific needs and challenges.</p> Our team of highly skilled consultants brings a wealth of expertise and experience to the table. We have a deep understanding of industry trends, emerging technologies, and best practices, enabling us to deliver insightful and innovative solutions.' );
			$webenvo_about_title    = get_theme_mod( 'webenvo-about-title', 'CONSULTANCY EXCELLENCE' );

		?>
		<div class="<?php echo esc_attr( $about_container_class ); ?> sr-about">
			<div class="row v-center">
				<div class="col-xl-6 col-lg-6 col-md-12 col-xs-12 wow fadeInLeft animated" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInLeft;">
					<div class="about-wrap">
						<div class="about-img-holder card-holder double base">
							<div class="card__image">
								<img src="<?php echo esc_url_raw( $about_image ); ?>">
							</div>
						</div>
						<div class="about-img-holder card-holder holder-small double base">
							<div class="card__image">
								<img src="<?php echo esc_url_raw( $about_image ); ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 col-xs-12  wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
					<div class="about-module">
					<?php echo esc_html( '' ); ?>
						<h6 class="subtitle text-grey"><?php echo esc_html( $webenvo_about_subtitle ); ?></h6>
						<h2 class="title"><b><?php echo esc_html( $webenvo_about_title ); ?></b></h2>
						<p><?php echo wp_kses_post( $webenvo_about_info ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>
