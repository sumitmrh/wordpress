<?php
/**
 * Customizer sections order main file
 *
 * @package customizer-controls
 */

define( 'SECTIONS_ORDER_VERSION', '1.0.0' );

/**
 * Function to enqueue sections order main script.
 */
function webenvo_sections_order_script() {
	wp_enqueue_script( 'customizer-sections-order-script', get_template_directory_uri() . '/webenvo-native-customizer-control/customizer-sections-order/js/customizer-sections-order.js', array( 'jquery', 'jquery-ui-sortable' ), SECTIONS_ORDER_VERSION, true );
	$control_settings = array(
		'sections_container' => '#accordion-panel-webenvo-fpsections-panel > ul, #sub-accordion-panel-webenvo-fpsections-panel', // Edit this
		'blocked_items'      => '#accordion-section-blocked_section1, #accordion-section-blocked_section2, #accordion-section-blocked_section3', // Edit this
		'saved_data_input'   => '#customize-control-webenvo_sections_order input', // Edit this
	);
	wp_localize_script( 'customizer-sections-order-script', 'control_settings', $control_settings );
	wp_enqueue_style( 'customizer-sections-order-style', get_template_directory_uri() . '/webenvo-native-customizer-control/customizer-sections-order/css/customizer-sections-order-style.css', array( 'dashicons' ), SECTIONS_ORDER_VERSION );
}
add_action( 'customize_controls_enqueue_scripts', 'webenvo_sections_order_script' );


/**
 * Register input for sections order.
 *
 * @param object $wp_customize Customizer object.
 */
function webenvo_sections_order_register_control( $wp_customize ) {

	$wp_customize->add_setting(
		'webenvo_sections_order',
		array(
			'sanitize_callback' => 'webenvo_sanitize_sections_order',
		)
	);

	$wp_customize->add_control(
		'webenvo_sections_order',
		array( // Edit this
			'section'  => 'webenvo-topbar-section', // Edit this
			'type'     => 'hidden',
			'priority' => 80,
		)
	);

}
add_action( 'customize_register', 'webenvo_sections_order_register_control' );


/**
 * Function for returning section priority
 *
 * @param int    $value Default priority.
 * @param string $key Section id.
 *
 * @return int
 */
function webenvo_sections_order_section_priority( $value, $key = '' ) {
	$orders = get_theme_mod( 'webenvo_sections_order' );
	if ( ! empty( $orders ) ) {
		$json = json_decode( $orders );
		if ( isset( $json->$key ) ) {
			return $json->$key;
		}
	}

	return $value;
}
add_filter( 'webenvo_section_priority', 'webenvo_sections_order_section_priority', 10, 2 );


/**
 * Function to refresh customize preview when changing sections order
 */
function webenvo_sections_order_refresh_positions() {
	$section_order         = get_theme_mod( 'webenvo_sections_order' ); // Edit this
	$section_order_decoded = json_decode( $section_order, true );
	if ( ! empty( $section_order_decoded ) ) {
		remove_all_actions( 'theme_sections' );
		foreach ( $section_order_decoded as $k => $priority ) {
			if ( function_exists( $k ) ) {
				add_action( 'theme_sections', $k, $priority );
			}
		}
	}
}
add_action( 'customize_preview_init', 'webenvo_sections_order_refresh_positions', 1 );

/**
 * Function to sanitize sections order control
 *
 * @param string $input Sections order in json format.
 */
function webenvo_sanitize_sections_order( $input ) {

	$json = json_decode( $input, true );
	foreach ( $json as $section => $priority ) {
		if ( ! is_string( $section ) || ! is_int( $priority ) ) {
			return false;
		}
	}
	$filter_empty = array_filter( $json, 'webenvo_check_not_empty' );
	return json_encode( $filter_empty );
}

/**
 * Function to filter json empty elements.
 *
 * @param int $val Element of json decoded.
 *
 * @return bool
 */
function webenvo_check_not_empty( $val ) {
	return ! empty( $val );
}
