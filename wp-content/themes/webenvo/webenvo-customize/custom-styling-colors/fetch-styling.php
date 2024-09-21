<?php
/** Fetch styling colors.
 *
 * @package webenvo
 */

function webenvo_get_styling_css() {
	ob_start();
	$webenvo_primary_color = get_theme_mod( 'webenvo-styling-primary-color' );
	if ( ! empty( $webenvo_primary_color ) ) {
		?>
	:root,::after,::before {
		--thm-primary: <?php echo esc_html( $webenvo_primary_color ); ?>;
	}
		<?php
	}
	$webenvo_dark_color = get_theme_mod( 'webenvo-styling-dark-color' );
	if ( ! empty( $webenvo_dark_color ) ) {
		?>
	:root,::after,::before {
		--thm-black: <?php echo esc_html( $webenvo_dark_color ); ?>;
	}
		<?php
	}
	$webenvo_links_color = get_theme_mod( 'webenvo-styling-links-color' );
	if ( ! empty( $webenvo_links_color ) ) {
		?>
	:root,::after,::before {
		--thm-gray: <?php echo esc_html( $webenvo_links_color ); ?>;
	}
		<?php
	}
	$webenvo_text_color = get_theme_mod( 'webenvo-styling-text-color' );
	if ( ! empty( $webenvo_text_color ) ) {
		?>
	:root,::after,::before {
		--thm-text: <?php echo esc_html( $webenvo_text_color ); ?>;
	}
		<?php
	}
	$webenvo_base_color = get_theme_mod( 'webenvo-styling-base-color' );
	if ( ! empty( $webenvo_base_color ) ) {
		?>
	:root,::after,::before {
		--thm-base: <?php echo esc_html( $webenvo_base_color ); ?>;
	}
		<?php
	}
	$webenvo_light_color = get_theme_mod( 'webenvo-styling-light-color' );
	if ( ! empty( $webenvo_light_color ) ) {
		?>
	:root,::after,::before {
		--thm-light: <?php echo esc_html( $webenvo_light_color ); ?>;
	}
		<?php
	}
	$webenvo_title_overlay = get_theme_mod( 'webenvo_title_overlay' );
	if ( ! empty( $webenvo_title_overlay ) ) {
		?>
	.page-title-module:before {
		background-color: <?php echo esc_html( $webenvo_title_overlay ); ?>;
	}
		<?php
	}
	$webenvo_color_style_css = ob_get_clean();
	return $webenvo_color_style_css;
}
?>
