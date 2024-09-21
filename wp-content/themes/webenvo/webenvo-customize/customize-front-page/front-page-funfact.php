<?php
/**
 * Custom funfact Section.
 *
 * @package webenvo
 */


/** Section for "funfact". */
	$wp_customize->add_section(
		'webenvo-funfact-section',
		array(
			'title'       => __( 'Funfact settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-funfact-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display funfacts and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display funfact */
	$wp_customize->add_setting(
		'webenvo-funfact-show',
		array(
			'default'           => 0,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-funfact-show-control',
			array(
				'label'    => esc_html__( 'Show Funfact on Frontpage', 'webenvo' ),
				'section'  => 'webenvo-funfact-section',
				'settings' => 'webenvo-funfact-show',
			)
		)
	);
	/** Selective refresh funfact */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo-funfact-show',
			array(
				'selector' => '.sr-funfact',
			)
		);
	}
	/** Check funfact Show Enabled Active callback. */
	function webenvo_if_funfact_show_control_enabled( $control ) {
		if ( 1 === $control->manager->get_setting( 'webenvo-funfact-show' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	// heading control.
	$wp_customize->add_setting(
		'webenvo-funfact-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-funfact-notice-control',
			array(
				'label'           => __( 'Funfact settings ', 'webenvo' ),
				'settings'        => 'webenvo-funfact-notice',
				'section'         => 'webenvo-funfact-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_funfact_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Funfact Repeater Defaults. */
	$wp_customize->add_setting(
		'webenvo-funfact-repeater',
		array(
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'default'           => FUNFACT_DEFAULTS,
		)
	);
	/** Repeater Control */
	$wp_customize->add_control(
		new Webenvo_Customizer_Repeater(
			$wp_customize,
			'webenvo-funfact-repeater-control',
			array(
				'label'                                 => esc_html__( 'Manage Funfacts', 'webenvo' ),
				'settings'                              => 'webenvo-funfact-repeater',
				'section'                               => 'webenvo-funfact-section',
				'add_field_label'                       => esc_html__( 'Add Funfact', 'webenvo' ),
				'item_name'                             => esc_html__( 'Funfact', 'webenvo' ),
				'priority'                              => 10,
				'customizer_repeater_image_control'     => false,
				'customizer_repeater_icon_control'      => true,
				'customizer_repeater_title_control'     => true,
				'customizer_repeater_subtitle_control'  => true,
				'customizer_repeater_btntitle_control'  => false,
				'customizer_repeater_text_control'      => false,
				'customizer_repeater_text2_control'     => false,
				'customizer_repeater_link_control'      => false,
				'customizer_repeater_link2_control'     => false,
				'customizer_repeater_shortcode_control' => false,
				'customizer_repeater_repeater_control'  => false,
				'customizer_repeater_color_control'     => false,
				'customizer_repeater_color2_control'    => false,
				'active_callback'                       => function( $control ) {
					return ( webenvo_if_funfact_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-funfact-upgrade-control',
			array(
				'settings' => 'webenvo-funfact-repeater',
				'section'  => 'webenvo-funfact-section',
			)
		)
	);
	// Funfact Colors Controls heading control.
	$wp_customize->add_setting(
		'webenvo-funfact-colors-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-funfact-colors-notice-control',
			array(
				'label'           => __( 'Funfact Colors ', 'webenvo' ),
				'settings'        => 'webenvo-funfact-colors-notice',
				'section'         => 'webenvo-funfact-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_funfact_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-funfact-grid-upgrade-control',
			array(
				'settings' => 'webenvo-funfact-colors-notice',
				'section'  => 'webenvo-funfact-section',
			)
		)
	);
	// Funfact Title text Color.
	$wp_customize->add_setting(
		'webenvo-funfact-title-color',
		array(
			// 'default'           => '#fffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-funfact-title-color-control',
			array(
				'label'           => __( 'Funfact Title Color', 'webenvo' ),
				'settings'        => 'webenvo-funfact-title-color',
				'section'         => 'webenvo-funfact-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_funfact_show_control_enabled( $control ) );
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
	// Funfact description text Color.
	$wp_customize->add_setting(
		'webenvo-funfact-numbers-color',
		array(
			// 'default'           => '#fffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-funfact-numbers-color-control',
			array(
				'label'           => __( 'Funfact Numbers Color', 'webenvo' ),
				'settings'        => 'webenvo-funfact-numbers-color',
				'section'         => 'webenvo-funfact-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_funfact_show_control_enabled( $control ) );
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
	// Grid Column Layout.
	$wp_customize->add_setting(
		'webenvo-funfact-grid',
		array(
			'default'           => 'col-lg-3',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Image_Radio_Button_Custom_Control(
			$wp_customize,
			'webenvo-funfact-grid-control',
			array(
				'label'           => __( 'Funfact Grid Column Layout', 'webenvo' ),
				'description'     => esc_html__( 'Select grid layout and number of Funfact inline display in section.', 'webenvo' ),
				'section'         => 'webenvo-funfact-section',
				'settings'        => 'webenvo-funfact-grid',
				'choices'         => array(
					'col-lg-6' => array(  // Required.
						'image' => trailingslashit( get_template_directory_uri() ) . 'webenvo-customizer-custom-control/images/column-2.png', // Required.
						'name'  => __( '2-column', 'webenvo' ), // Required.
					),
					'col-lg-4' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'webenvo-customizer-custom-control/images/column-3.png',
						'name'  => __( '3-column', 'webenvo' ),
					),
					'col-lg-3' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'webenvo-customizer-custom-control/images/column-4.png',
						'name'  => __( '4-column', 'webenvo' ),
					),
				),
				'active_callback' => function( $control ) {
					return ( webenvo_if_funfact_show_control_enabled( $control ) );
				},
			)
		)
	);
