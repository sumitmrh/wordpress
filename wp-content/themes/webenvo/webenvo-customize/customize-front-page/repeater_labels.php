<?php
/**
 * Modify Customizer Repeater Labels.
 *
 * @package webenvo
 */

/**
 * Filter to modify input label in repeater control
 * You can filter by control id and input name.
 *
 * @param string $string Input label.
 * @param string $id Input id.
 * @param string $control Control name.
 * @modified 1.1.41
 *
 * @return string
 */
function webenvo_repeater_labels( $string, $id, $control ) {
	// for Slider Repeater.
	if ( $id === 'webenvo-slider-repeater-control' ) {
		if ( $control === 'customizer_repeater_title_control' ) {
			return esc_html__( 'Slide Title tag', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return esc_html__( 'Slide title', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_text_control' ) {
			return esc_html__( 'Slide description', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_btntitle_control' ) {
			return esc_html__( 'Button Text', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_link_control' ) {
			return esc_html__( 'Button link', 'webenvo' );
		}
	}
	// For Services Repeater
	if ( $id === 'webenvo-services-repeater-control' ) {
		if ( $control === 'customizer_repeater_icon_control' ) {
			return esc_html__( 'Service Icon', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_title_control' ) {
			return esc_html__( 'Service title', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return esc_html__( 'Service description', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_btntitle_control' ) {
			return esc_html__( 'Service Link Text', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_link_control' ) {
			return esc_html__( 'Service link', 'webenvo' );
		}
	}
	// For Portfolio Repeater.
	if ( $id === 'webenvo-portfolio-repeater-control' ) {
		if ( $control === 'customizer_repeater_image_control' ) {
			return esc_html__( 'Project Image', 'webenvo' );
		} // This will not change because its using direct Html to display.
		if ( $control === 'customizer_repeater_title_control' ) {
			return esc_html__( 'Project tag', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return esc_html__( 'Project title', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_link_control' ) {
			return esc_html__( 'Hyperlink', 'webenvo' );
		}
	}
	// For Teams Customizer Repeater.
	if ( $id === 'webenvo-team-repeater-control' ) {
		if ( $control === 'customizer_repeater_title_control' ) {
			return esc_html__( 'Members Position', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return esc_html__( 'Members Name', 'webenvo' );
		}
	}
	// For Testimonial Customizer Repeater.
	if ( $id === 'webenvo-testimonial-repeater-control' ) {
		if ( $control === 'customizer_repeater_title_control' ) {
			return esc_html__( 'Review Title', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return esc_html__( 'Review Text', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_btntitle_control' ) {
			return esc_html__( 'Client Name', 'webenvo' );
		}
		if ( $control === 'customizer_repeater_shortcode_control' ) {
			return esc_html__( 'Client Designation', 'webenvo' );
		}
	}
	// For Funfact Customizer Repeater.
	if ( $id === 'webenvo-funfact-repeater-control' ) {
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return esc_html__( 'Numbers', 'webenvo' );
		}
	}
	return $string;
}
	add_filter( 'repeater_input_labels_filter', 'webenvo_repeater_labels', 10, 3 );
