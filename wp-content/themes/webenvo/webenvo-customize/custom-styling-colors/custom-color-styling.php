<?php
/**
 * Custom Color and Styling.
 *
 * @package webenvo
 */

	/** Section for "Global Colors and styling". */
	$wp_customize->add_section(
		'webenvo-styling-section',
		array(
			'title'       => __( 'Webenvo Global Colors', 'webenvo' ),
			'priority'    => 1,
			'description' => __( 'Global Settings For colors.', 'webenvo' ),
		)
	);
	// heading control.
	$wp_customize->add_setting(
		'webenvo-styling-note',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-styling-note-control',
			array(
				'label'    => __( 'Note: Every Frontpage section also have Individual color settings which overwrites these global colors if choosen, by default They are set to empty.', 'webenvo' ),
				'settings' => 'webenvo-styling-note',
				'section'  => 'webenvo-styling-section',
			)
		)
	);
	// heading control.
	$wp_customize->add_setting(
		'webenvo-styling-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-styling-notice-control',
			array(
				'label'    => __( 'Global Colors and Styling ', 'webenvo' ),
				'settings' => 'webenvo-styling-notice',
				'section'  => 'webenvo-styling-section',
			)
		)
	);
	// Primary Color.
	$wp_customize->add_setting(
		'webenvo-styling-primary-color',
		array(
			// 'default'           => '#008080',
			'default'           => '#008080',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-styling-primary-color-control',
			array(
				'label'       => __( 'Webenvo Primary Color', 'webenvo' ),
				'description' => esc_html__( 'Select Global Theme Color for whole theme', 'webenvo' ),
				'settings'    => 'webenvo-styling-primary-color',
				'section'     => 'webenvo-styling-section',
				'input_attrs' => array(
					'resetalpha' => true,
					'palette'    => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					),
				),
			)
		)
	);
	// Dark Color.
	$wp_customize->add_setting(
		'webenvo-styling-dark-color',
		array(
			// 'default'           => '#0f0d1d',
			'default'           => '#0f0d1d',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-styling-dark-color-control',
			array(
				'label'       => __( 'Webenvo Dark Color', 'webenvo' ),
				'description' => esc_html__( 'Select Global Dark Color for whole theme', 'webenvo' ),
				'settings'    => 'webenvo-styling-dark-color',
				'section'     => 'webenvo-styling-section',
				'input_attrs' => array(
					'resetalpha' => true,
					'palette'    => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					),
				),
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-styling-upgrade-control',
			array(
				'settings' => 'webenvo-styling-dark-color',
				'section'  => 'webenvo-styling-section',
			)
		)
	);
	// Links Color.
	$wp_customize->add_setting(
		'webenvo-styling-links-color',
		array(
			// 'default'           => '#726f84',
			'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-styling-links-color-control',
			array(
				'label'       => __( 'Webenvo Links Color', 'webenvo' ),
				'description' => esc_html__( 'Select Global Links Color for whole theme', 'webenvo' ),
				'settings'    => 'webenvo-styling-links-color',
				'section'     => 'webenvo-styling-section',
				'input_attrs' => array(
					'resetalpha' => true,
					'palette'    => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					),
				),
			)
		)
	);
	// Text Color.
	$wp_customize->add_setting(
		'webenvo-styling-text-color',
		array(
			// 'default'           => '#726f84',
			'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-styling-text-color-control',
			array(
				'label'       => __( 'Webenvo Text Color', 'webenvo' ),
				'description' => esc_html__( 'Select Global Text Color for whole theme', 'webenvo' ),
				'settings'    => 'webenvo-styling-text-color',
				'section'     => 'webenvo-styling-section',
				'input_attrs' => array(
					'resetalpha' => true,
					'palette'    => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					),
				),
			)
		)
	);
	// Base Color.
	$wp_customize->add_setting(
		'webenvo-styling-base-color',
		array(
			'default'           => '#ffffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-styling-base-color-control',
			array(
				'label'       => __( 'Webenvo Theme Base Color', 'webenvo' ),
				'description' => esc_html__( 'Select Global Base Color for whole theme', 'webenvo' ),
				'settings'    => 'webenvo-styling-base-color',
				'section'     => 'webenvo-styling-section',
				'input_attrs' => array(
					'resetalpha' => true,
					'palette'    => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					),
				),
			)
		)
	);
	// Light Color.
	$wp_customize->add_setting(
		'webenvo-styling-light-color',
		array(
			// 'default'           => '#f2f4f8',
			'default'           => '#f2f4f8',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-styling-light-color-control',
			array(
				'label'       => __( 'Webenvo Theme Light Color', 'webenvo' ),
				'description' => esc_html__( 'Select Global Light Color for whole theme', 'webenvo' ),
				'settings'    => 'webenvo-styling-light-color',
				'section'     => 'webenvo-styling-section',
				'input_attrs' => array(
					'resetalpha' => true,
					'palette'    => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					),
				),
			)
		)
	);
