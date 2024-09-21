<?php
/**
 * Custom sponsors Section.
 *
 * @package webenvo
 */

/** Section for Sponsors/Clients". */
	$wp_customize->add_section(
		'webenvo-sponsors-section',
		array(
			'title'       => __( 'Sponsors/Clients settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-sponsors-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display sponsors and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display sponsors */
	$wp_customize->add_setting(
		'webenvo-sponsors-show',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-sponsors-show-control',
			array(
				'label'    => esc_html__( 'Show Sponsors/Clients on Frontpage', 'webenvo' ),
				'section'  => 'webenvo-sponsors-section',
				'settings' => 'webenvo-sponsors-show',
			)
		)
	);
	/** Selective refresh callout */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo-sponsors-show',
			array(
				'selector' => '.sr-sponsor',
			)
		);
	}
	/** Check sponsors Show Enabled Active callback. */
	function webenvo_if_sponsors_show_control_enabled( $control ) {
		if ( 1 === $control->manager->get_setting( 'webenvo-sponsors-show' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	// heading control.
	$wp_customize->add_setting(
		'webenvo-sponsors-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-sponsors-notice-control',
			array(
				'label'           => __( 'Sponsors/Clients Section settings ', 'webenvo' ),
				'settings'        => 'webenvo-sponsors-notice',
				'section'         => 'webenvo-sponsors-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Sponsors section SubTitle  */
	$wp_customize->add_setting(
		'webenvo-sponsors-title-tag',
		array(
			'default'           => esc_html__( 'We Thank You For Your Support', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-sponsors-title-tag-control',
			array(
				'label'           => __( 'Sponsors/Clients Title Tag', 'webenvo' ),
				'section'         => 'webenvo-sponsors-section',
				'settings'        => 'webenvo-sponsors-title-tag',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Sponsors section Title  */
	$wp_customize->add_setting(
		'webenvo-sponsors-title',
		array(
			'default'           => esc_html__( 'ACKNOWLEDGING OUR SPONSORS', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-sponsors-title-control',
			array(
				'label'           => __( 'Sponsors/clients Title', 'webenvo' ),
				'section'         => 'webenvo-sponsors-section',
				'settings'        => 'webenvo-sponsors-title',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
			)
		)
	);
	$wp_customize->add_setting(
		'webenvo-sponsors-repeater',
		array(
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'default'           => SPONSORS_DEFAULT,
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Repeater(
			$wp_customize,
			'webenvo-sponsors-repeater-control',
			array(
				'label'                                 => esc_html__( 'Manage Clients/Sponsors', 'webenvo' ),
				'settings'                              => 'webenvo-sponsors-repeater',
				'section'                               => 'webenvo-sponsors-section',
				'add_field_label'                       => esc_html__( 'Add Client/Sponsor', 'webenvo' ),
				'item_name'                             => esc_html__( 'Client', 'webenvo' ),
				'priority'                              => 10,
				'customizer_repeater_image_control'     => true,
				'customizer_repeater_icon_control'      => false,
				'customizer_repeater_title_control'     => true,
				'customizer_repeater_btntitle_control'  => false,
				'customizer_repeater_subtitle_control'  => false,
				'customizer_repeater_text_control'      => false,
				'customizer_repeater_text2_control'     => false,
				'customizer_repeater_link_control'      => true,
				'customizer_repeater_link2_control'     => false,
				'customizer_repeater_shortcode_control' => false,
				'customizer_repeater_repeater_control'  => false,
				'customizer_repeater_color_control'     => false,
				'customizer_repeater_color2_control'    => false,
				'active_callback'                       => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-sponsors-upgrade-control',
			array(
				'settings' => 'webenvo-sponsors-repeater',
				'section'  => 'webenvo-sponsors-section',
			)
		)
	);
	// Sponsor Slider Controls heading control.
	$wp_customize->add_setting(
		'webenvo-sponsors-controls-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-sponsors-controls-notice-control',
			array(
				'label'           => __( 'Sponsor Slider Controls ', 'webenvo' ),
				'settings'        => 'webenvo-sponsors-controls-notice',
				'section'         => 'webenvo-sponsors-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Sponsor Slider Autoplay Control.
	$wp_customize->add_setting(
		'webenvo-sponsors-autoplay',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-sponsors-autoplay-control',
			array(
				'label'           => __( 'Toggle Slider Autoplay', 'webenvo' ),
				'description'     => esc_html__( 'Toggle slider autoplay on/off.', 'webenvo' ),
				'settings'        => 'webenvo-sponsors-autoplay',
				'section'         => 'webenvo-sponsors-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Sponsors Colors Controls heading control.
	$wp_customize->add_setting(
		'webenvo-sponsors-colors-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-sponsors-colors-notice-control',
			array(
				'label'           => __( 'Sponsors/Clients Colors ', 'webenvo' ),
				'settings'        => 'webenvo-sponsors-colors-notice',
				'section'         => 'webenvo-sponsors-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
			)
		)
	);

	// Sponsors Title text Color.
	$wp_customize->add_setting(
		'webenvo-sponsors-title-color',
		array(
			// 'default'           => '#fffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-sponsors-title-color-control',
			array(
				'label'           => __( 'Sponsors/Clients Title Color', 'webenvo' ),
				'settings'        => 'webenvo-sponsors-title-color',
				'section'         => 'webenvo-sponsors-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
				'input_attrs'     => array(
					'resetalpha' => false,
					'palette'    => array(
						'rgba(99,78,150,1)',
						'rgba(67,78,150,1)',
						'rgba(34,78,150,.7)',
						'rgba(3,78,150,1)',
						'rgba(7,110,230,.9)',
						'rgba(234,78,150,1)',
						'rgba(99,78,150,.5)',
						'rgba(190,120,120,.5)',
					),
				),
			)
		)
	);
	// Sponsors description text Color.
	$wp_customize->add_setting(
		'webenvo-sponsors-description-color',
		array(
			// 'default'           => '#fffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-sponsors-description-color-control',
			array(
				'label'           => __( 'Sponsors/Clients tag Color', 'webenvo' ),
				'settings'        => 'webenvo-sponsors-description-color',
				'section'         => 'webenvo-sponsors-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_sponsors_show_control_enabled( $control ) );
				},
				'input_attrs'     => array(
					'resetalpha' => false,
					'palette'    => array(
						'rgba(99,78,150,1)',
						'rgba(67,78,150,1)',
						'rgba(34,78,150,.7)',
						'rgba(3,78,150,1)',
						'rgba(7,110,230,.9)',
						'rgba(234,78,150,1)',
						'rgba(99,78,150,.5)',
						'rgba(190,120,120,.5)',
					),
				),
			)
		)
	);
