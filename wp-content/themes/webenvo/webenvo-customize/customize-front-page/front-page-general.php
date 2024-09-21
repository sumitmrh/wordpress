<?php
/**
 * Custom general section
 *
 * @package webenvo
 */

/** Section for "General Settings". */
	$wp_customize->add_section(
		'webenvo-general-section',
		array(
			'title'       => __( 'General settings', 'webenvo' ),
			'priority'    => 0,
			'panel'       => 'webenvo-options-panel',
			'description' => __( 'General additional features of Webenvo.', 'webenvo' ),
		)
	);

	/** Setting to display wocommerce Shop/Cart */
		$wp_customize->add_setting(
			'webenvo-woo-cart-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-woo-cart-show-control',
				array(
					'label'       => esc_html__( 'Woocommerce/Cart Icon in Menu', 'webenvo' ),
					'description' => esc_html__( 'Requires a screen refresh after publishing Woocommerce icon on/off.', 'webenvo' ),
					'section'     => 'webenvo-general-section',
					'settings'    => 'webenvo-woo-cart-show',
				)
			)
		);

		/** Setting to display Loading Icon/Page Loader */
		$wp_customize->add_setting(
			'webenvo-loader-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-loader-show-control',
				array(
					'label'    => esc_html__( 'Loading Icon/Page Loader', 'webenvo' ),
					'section'  => 'webenvo-general-section',
					'settings' => 'webenvo-loader-show',
				)
			)
		);

		/** Setting to display Loading Icon/Page Loader */
		$wp_customize->add_setting(
			'webenvo-scrolltop-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-scrolltop-show-control',
				array(
					'label'    => esc_html__( 'Scroll to top Icon', 'webenvo' ),
					'section'  => 'webenvo-general-section',
					'settings' => 'webenvo-scrolltop-show',
				)
			)
		);

