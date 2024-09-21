<?php
/**
 *
 * Footer File.
 *
 * @package Aveantex
 */

?>
		<!-- Footer Section -->
		<footer id="footer" class="footer theme-dark">
			<div class="footer-shape"></div>
			<!-- Footer Widgets -->
			<div class="container site-footer">
				<div class="row">
					<div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
						<?php get_sidebar( 'webenvo_footer_widget_1' ); ?>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp animated" data-wow-delay="200ms" style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
						<?php get_sidebar( 'webenvo_footer_widget_2' ); ?>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp animated" data-wow-delay="400ms" style="visibility: visible; animation-delay: 400ms; animation-name: fadeInUp;">
					<?php get_sidebar( 'webenvo_footer_widget_3' ); ?>
					</div>

				</div>
			</div>
			<!-- /Footer Widgets -->
			<?php get_template_part( 'theme-menu/inc/footer-menus-widgets' ); ?>


			<!-- Footer Copyrights -->
			<div class="footer-copyrights">
				<div class="container">
					<div class="row">

						<div class="col-xl-12 col-lg-12 col-md-12 ">

							<ul class="social-icons text-center sr-social-icons">
								<?php
								$webenvo_topbar_social_callout = get_theme_mod( 'webenvo-topbar-social-repeater', TOPBAR_DEFAULTS );
									/*This returns a json so we have to decode it*/
								$webenvo_topbar_social_decoded = json_decode( $webenvo_topbar_social_callout );
								foreach ( $webenvo_topbar_social_decoded as $webenvo_topbar_member ) {
									if ( ! empty( $webenvo_topbar_member->social_repeater ) ) {
										$webenvo_topbar_social_repeater = json_decode( html_entity_decode( $webenvo_topbar_member->social_repeater ) );
										foreach ( $webenvo_topbar_social_repeater as $webenvo_iconsdata ) {
											$webenvo_icons_link = $webenvo_iconsdata->link;
											$webenvo_icons_data = $webenvo_iconsdata->icon;
											?>
											<li> 
												<a href="<?php echo esc_url( $webenvo_icons_link ); ?>" target="_blank" class="<?php echo esc_html( $webenvo_icons_data ); ?>"></a>
											</li>
											<?php
										}
									}
								}
								?>
							</ul>
							<div class="site-info sr-copyright text-center">
								<?php echo wp_kses_post( get_theme_mod( 'webenvo_copyright', 'Copyright © Webenvo 2023 | Powered by WordPress.' ) ); ?>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /Footer Copyrights -->

		</footer>
		<!-- End of Footer Section -->

	</div> <!-- Theme Container Wrapper End -->
	<?php if ( get_theme_mod( 'webenvo-scrolltop-show' ) === 1 ) { ?>
		<!-- Scroll To Top -->
			<a href="#" class="page-scroll-up" style="display: inline;"><i class="fa fa-chevron-up"></i></a>
		<!-- /Scroll To Top -->
	<?php } ?>

<?php wp_footer(); ?> 
</body>
</html>
