<?php
/**
 * Callout Section
 *
 * @package webenvo
 */

?>
<?php if ( get_theme_mod( 'webenvo-callout-overlay', 'enable' ) === 'enable' ) { ?>
	<style>
		.callout-to-action::before {
			content: "";
			display: block;
			height: 100%;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			z-index: 0;
			background-color: <?php echo esc_html( get_theme_mod( 'webenvo-callout-overlay-color', 'rgba(15,13,29,0.65)' ) ); ?>
		}
	</style>
<?php } ?>
<?php
if ( get_theme_mod( 'webenvo-callout-show', 1 ) === 1 ) {
	$callout_title_color    = get_theme_mod( 'webenvo-callout-title-color' );
	$callout_subtitle_color = get_theme_mod( 'webenvo-callout-description-color' );
	$callout_btntxt_color   = get_theme_mod( 'webenvo-callout-btntxt-color' );

	?>
<!-- Callout Section -->
<section id="callout-section" class="callout-to-action" style="background: url(<?php echo esc_url_raw( get_theme_mod( 'webenvo-callout-image', ENVO_COMPANION_PLUGIN_URL . 'inc/webenvo/img/callout/callout-bg.jpg' ) ); ?> ) center center fixed;">
	<div class="container sr-callout">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
				<div class="callout-inner-txt">
					<h2 class="title" style="color:<?php echo esc_html( $callout_title_color ); ?>"><?php echo esc_html( get_theme_mod( 'webenvo-callout-title', 'UNLEASHING THE POWER OF DISRUPTIVE IDEAS' ) ); ?></h2>
					<p class="subtitle" style="color:<?php echo esc_html( $callout_subtitle_color ); ?>"><?php echo esc_html( get_theme_mod( 'webenvo-callout-subtitle', 'At Envo, we are dedicated to building a sustainable future for our planet. Our commitment to environmental responsibility drives every aspect of our business.' ) ); ?></p>
				</div>
				<div class="m-top-40 sr-btntxt">
					<a href="<?php echo esc_html( get_theme_mod( 'webenvo-callout-btnlink' ) ); ?>" target="_blank" class="thm-btn" style="color:<?php echo esc_html( $callout_btntxt_color ); ?>"><?php echo esc_html( get_theme_mod( 'webenvo-callout-btn-text', 'Purchase Now' ) ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>
<!-- /Callout Section -->

<div class="clearfix"></div>
