<?php
/**
 * Custom callout Section.
 *
 * @package webenvo
 */

/** Section for "callout". */
	$wp_customize->add_section(
		'webenvo-callout-section',
		array(
			'title'       => __( 'Callout settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-callout-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display callout and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display callout */
	$wp_customize->add_setting(
		'webenvo-callout-show',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-callout-show-control',
			array(
				'label'    => esc_html__( 'Show callout on Frontpage', 'webenvo' ),
				'section'  => 'webenvo-callout-section',
				'settings' => 'webenvo-callout-show',
			)
		)
	);
	/** Selective refresh callout */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo-callout-show',
			array(
				'selector' => '.sr-callout',
			)
		);
	}
	/** Check callout Show Enabled Active callback. */
	function webenvo_if_callout_show_control_enabled( $control ) {
		if ( 1 === $control->manager->get_setting( 'webenvo-callout-show' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	// heading control.
	$wp_customize->add_setting(
		'webenvo-callout-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-callout-notice-control',
			array(
				'label'           => __( 'Callout settings ', 'webenvo' ),
				'settings'        => 'webenvo-callout-notice',
				'section'         => 'webenvo-callout-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Callout Image Control.
	$wp_customize->add_setting(
		'webenvo-callout-image',
		array(
			'default'           => ENVO_COMPANION_PLUGIN_URL. 'inc/webenvo/img/callout/callout-bg.jpg',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'webenvo-callout-image_control',
			array(
				'label'           => __( 'Callout Background Image', 'webenvo' ),
				'description'     => esc_html__( 'Choose Image for Callout Background. Best fit : 1920px X 1080px', 'webenvo' ),
				'section'         => 'webenvo-callout-section',
				'settings'        => 'webenvo-callout-image',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
				},
				'button_labels'   => array( // Optional.
					'select'       => __( 'Select Image', 'webenvo' ),
					'change'       => __( 'Change Image', 'webenvo' ),
					'remove'       => __( 'Remove', 'webenvo' ),
					'default'      => __( 'Default', 'webenvo' ),
					'placeholder'  => __( 'No image selected', 'webenvo' ),
					'frame_title'  => __( 'Select Image', 'webenvo' ),
					'frame_button' => __( 'Choose Image', 'webenvo' ),
				),
			)
		)
	);
	/** Callout section Title  */
	$wp_customize->add_setting(
		'webenvo-callout-title',
		array(
			'default'           => esc_html__( 'UNLEASHING THE POWER OF DISRUPTIVE IDEAS', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-callout-title-control',
			array(
				'label'           => __( 'Callout Title', 'webenvo' ),
				'section'         => 'webenvo-callout-section',
				'settings'        => 'webenvo-callout-title',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Callout section Subtitle. */
	$wp_customize->add_setting(
		'webenvo-callout-subtitle',
		array(
			'default'           => esc_html__( 'At Webenvo, we are dedicated to building a sustainable future for our planet. Our commitment to environmental responsibility drives every aspect of our business.', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-callout-subtitle-control',
			array(
				'label'           => __( 'Callout Subtitle', 'webenvo' ),
				'section'         => 'webenvo-callout-section',
				'settings'        => 'webenvo-callout-subtitle',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Callout Button Text Control.  */
	$wp_customize->add_setting(
		'webenvo-callout-btn-text',
		array(
			'default'           => esc_html__( 'Purchase Now', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-callout-btn-text-control',
			array(
				'label'           => __( 'Callout Button Text', 'webenvo' ),
				'section'         => 'webenvo-callout-section',
				'settings'        => 'webenvo-callout-btn-text',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Callout Button URL.
	$wp_customize->add_setting(
		'webenvo-callout-btnlink',
		array(
			'default'           => '',
			'sanitize_callback' => array( $this, 'sanitize_custom_url' ),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-callout-btnlink-control',
			array(
				'label'           => 'Callout Button link',
				'section'         => 'webenvo-callout-section',
				'settings'        => 'webenvo-callout-btnlink',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
				},
				'input_attrs'     => array(
					'placeholder' => 'https://',
				),
			)
		)
	);
	// Callout overlay Control.
	$wp_customize->add_setting(
		'webenvo-callout-overlay',
		array(
			'default'           => 'enable',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Text_Radio_Button_Custom_Control(
			$wp_customize,
			'webenvo-callout-overlay-control',
			array(
				'label'           => __( 'Callout Overlay', 'webenvo' ),
				'description'     => esc_html__( 'Toggle Overlay on Callout Image.', 'webenvo' ),
				'settings'        => 'webenvo-callout-overlay',
				'section'         => 'webenvo-callout-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
				},
				'choices'         => array(
					'enable'  => __( 'Enable', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					'disable' => __( 'Disable', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
				),
			)
		)
	);
	// Colors heading control.
	$wp_customize->add_setting(
		'webenvo-callout-color-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-callout-color-notice-control',
			array(
				'label'           => __( 'Callout Color Settings ', 'webenvo' ),
				'settings'        => 'webenvo-callout-color-notice',
				'section'         => 'webenvo-callout-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-callout-colors-upgrade-control',
			array(
				'settings' => 'webenvo-callout-color-notice',
				'section'  => 'webenvo-callout-section',
			)
		)
	);
	// Callout Overlay Color.
	$wp_customize->add_setting(
		'webenvo-callout-overlay-color',
		array(
			'default'           => 'rgba(15,13,29,0.65)',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-callout-overlay-color-control',
			array(
				'label'           => __( 'Callout Overlay Color', 'webenvo' ),
				// 'description' => esc_html__( 'Sample color control with Alpha channel', 'webenvo' ),
				'settings'        => 'webenvo-callout-overlay-color',
				'section'         => 'webenvo-callout-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
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
	// Callout Title text Color.
	$wp_customize->add_setting(
		'webenvo-callout-title-color',
		array(
			// 'default'           => '#ffffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-callout-title-color-control',
			array(
				'label'           => __( 'Callout Title text Color', 'webenvo' ),
				'settings'        => 'webenvo-callout-title-color',
				'section'         => 'webenvo-callout-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
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
	// Callout description text Color.
	$wp_customize->add_setting(
		'webenvo-callout-description-color',
		array(
			// 'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-callout-description-color-control',
			array(
				'label'           => __( 'Callout Subtitle text Color', 'webenvo' ),
				'settings'        => 'webenvo-callout-description-color',
				'section'         => 'webenvo-callout-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
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
	// Callout Button text Color.
	$wp_customize->add_setting(
		'webenvo-callout-btntxt-color',
		array(
			// 'default'           => '#ffffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-callout-btntxt-color-control',
			array(
				'label'           => __( 'Button text Color', 'webenvo' ),
				'settings'        => 'webenvo-callout-btntxt-color',
				'section'         => 'webenvo-callout-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_callout_show_control_enabled( $control ) );
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
