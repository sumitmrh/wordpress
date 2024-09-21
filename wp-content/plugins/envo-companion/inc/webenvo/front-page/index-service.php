<?php
/**
 * Service Section
 *
 * @package webenvo
 */

?>

<!-- Service Section -->
<?php
if ( get_theme_mod( 'webenvo-services-show', 1 ) === 1 ) {
	$services_size        = get_theme_mod( 'webenvo-services-size', 'container-full' );
	$services_title_color = get_theme_mod( 'webenvo-services-title-color' );
	$services_desc_color  = get_theme_mod( 'webenvo-services-description-color' );
	$services_background_opacity = get_theme_mod( 'webenvo-services-background-opacity' );
	?>
		<section id="service-section" class="service theme-dark ">
		<div class="service-shape" style="background:url(<?php echo esc_url_raw( get_theme_mod( 'webenvo-services-image', get_template_directory_uri() . '/assets/images/service-shape.png' ) ); ?>) no-repeat;opacity:<?php echo esc_html( $services_background_opacity ); ?>%"></div>
			<div class="<?php echo esc_attr( $services_size ); ?> sr-services">
				<div class="row">
					<div class="col-md-12">
						<div class="section-header">
							<h2 class="section-title" style="color:<?php echo esc_attr( $services_title_color ); ?>;"><?php echo esc_html( get_theme_mod( 'webenvo-services-title', 'TAILORED SOLUTIONS FOR EVERY NEED' ) ); ?></h2>
							<p class="section-subtitle" style="color:<?php echo esc_attr( $services_desc_color ); ?>;"><?php echo esc_html( get_theme_mod( 'webenvo-services-subtitle', 'We offers an array of customized solutions designed to meet your unique requirements.' ) ); ?></p>
							<div class="divider-line"></div>
						</div>
					</div>
				</div>

				<div class="row">
				<?php
				$service_grid          = get_theme_mod( 'webenvo-services-grid', 'col-lg-4' );
				$service_title_color   = get_theme_mod( 'webenvo-service-title-color' );
				$service_details_color = get_theme_mod( 'webenvo-service-details-color' );
				$service_link_color    = get_theme_mod( 'webenvo-service-link-color' );
				$service_icon_color    = get_theme_mod( 'webenvo-service-icon-color' );
				$fpservices_callout    = get_theme_mod( 'webenvo-services-repeater', SERVICES_DEFAULTS );
				if ( ! empty( $fpservices_callout ) ) {
					$fpservices_callout_decoded = json_decode( $fpservices_callout );
					foreach ( $fpservices_callout_decoded as $fpservice_item ) {
						$fpservicechoice   = $fpservice_item->choice;
						$fpservicesubtitle = $fpservice_item->subtitle;
						$fpservicetitle    = $fpservice_item->title;
						$fpservicebtn      = $fpservice_item->btntitle;
						$fpservicelink     = $fpservice_item->link;
						if ( property_exists( $fpservice_item, 'icon_value' ) ) {
							$fpserviceicon = $fpservice_item->icon_value;
						}

						if ( property_exists( $fpservice_item, 'image_url' ) ) {
							$fpserviceimage = $fpservice_item->image_url;
						}
						?>
					<div class="<?php echo esc_attr( $service_grid ); ?> col-sm-6 col-xs-12 service-box wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
						<article class="post">
							<div class="entry-header">
								<h2 class="entry-title">
									<a href="#" style="color:<?php echo esc_attr( $service_title_color ); ?>;"> <?php echo esc_html( $fpservicetitle ); ?></a>
								</h2>
							</div>
							<div class="entry-content">
								<p style="color:<?php echo esc_attr( $service_details_color ); ?>;"><?php echo esc_html( $fpservicesubtitle ); ?></p>
								<?php if ( ! empty( $fpservicebtn ) ) { ?>
								<p style="color:<?php echo esc_attr( $service_link_color ); ?>;"><a href="<?php echo esc_html( $fpservicelink ); ?>" class="more-link"><?php echo esc_html( $fpservicebtn ); ?></a></p>
								<?php } ?>
							</div>
							<?php if ( $fpservicechoice === 'customizer_repeater_icon' ) { ?>
								<div class="service-icon" style="color:<?php echo esc_attr( $service_icon_color ); ?>;"><i class="<?php echo esc_attr( $fpserviceicon ); ?>"></i></div>
							<?php } elseif ( $fpservicechoice === 'customizer_repeater_image' ) { ?>
								<div class="service-img"><img src="<?php echo esc_url( $fpserviceimage ); ?>" alt=""></div>
							<?php } ?>
						</article>
					</div>
									<?php
					}
				}
				?>
				</div>

			</div>
		</section>
<?php } ?>
		<!-- /Service Section -->

		<div class="clearfix"></div>