<?php
/**
 *
 * Topbar File.
 *
 * @package webenvo
 */

?>
<!-- Topbar Start -->
<div class="header-top">
	<div class="container-fluid header-top-info ">
		<div class="row">
			<div class="topheader_bg">
				<div class="top_header_add sr-topbar">
					<ul>
						<?php
						$webenvo_topbar_email = get_theme_mod( 'webenvo-topbar-email', 'example@corpo.com' );
						$webenvo_topbar_tel   = get_theme_mod( 'webenvo-topbar-tel', '+00123456789' );
						?>
						<?php if ( ! empty( $webenvo_topbar_email ) ) { ?>
						<li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo esc_html( $webenvo_topbar_email ); ?> </a>
						</li>
							<?php
						}
						if ( ! empty( $webenvo_topbar_tel ) ) {
							?>
						<li><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $webenvo_topbar_tel ); ?></li>
						<?php } ?>
					</ul>
				</div>

				<!-- Social Icon and button -->
				<div class="social_links_wrapper sr-social-icons">
					<?php if ( get_theme_mod( 'webenvo-topbar-social-show', 1 ) === 1 ) { ?>
						<!-- Social Icons Start -->
						<ul class="social-icons square spin-icon text-end">
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
					<?php }; ?>
				</div>
				<!-- Button -->
				<?php
				if ( get_theme_mod( 'webenvo-topbar-button-show', 1 ) === 1 ) {
					$webenvo_topbar_btntxt  = get_theme_mod( 'webenvo-topbar-button-text', 'Get Started' );
					$webenvo_topbar_btnlink = get_theme_mod( 'webenvo-topbar-btnlink' );
					?>
						<div class="header_btn header2_btn float_left">
							<a href="<?php echo esc_attr( $webenvo_topbar_btnlink ); ?>"><?php echo esc_html( $webenvo_topbar_btntxt ); ?></a>
						</div>
					<?php } ?>
			</div>
		</div>
	</div>
</div>
<!-- Topbar End -->
