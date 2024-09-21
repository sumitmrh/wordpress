<?php
/**
 * Custom testimonial Section.
 *
 * @package webenvo
 */


/** Section for "testimonial". */
	$wp_customize->add_section(
		'webenvo-testimonial-section',
		array(
			'title'       => __( 'Testimonial settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-testimonial-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display testimonials and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display testimonial */
	$wp_customize->add_setting(
		'webenvo-testimonial-show',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-testimonial-show-control',
			array(
				'label'    => esc_html__( 'Show Testimonial on Frontpage', 'webenvo' ),
				'section'  => 'webenvo-testimonial-section',
				'settings' => 'webenvo-testimonial-show',
			)
		)
	);
	/** Selective refresh callout */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo-testimonial-show',
			array(
				'selector' => '.sr-testimonial',
			)
		);
	}
	/** Check testimonial Show Enabled Active callback. */
	function webenvo_if_testimonial_show_control_enabled( $control ) {
		if ( 1 === $control->manager->get_setting( 'webenvo-testimonial-show' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	// heading control.
	$wp_customize->add_setting(
		'webenvo-testimonial-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-testimonial-notice-control',
			array(
				'label'           => __( 'Testimonial settings ', 'webenvo' ),
				'settings'        => 'webenvo-testimonial-notice',
				'section'         => 'webenvo-testimonial-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Testimonial section Title  */
	$wp_customize->add_setting(
		'webenvo-testimonial-title-tag',
		array(
			'default'           => esc_html__( 'Satisfied Clientele!', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-testimonial-title-tag-control',
			array(
				'label'           => __( 'Testimonial Title Tag', 'webenvo' ),
				'section'         => 'webenvo-testimonial-section',
				'settings'        => 'webenvo-testimonial-title-tag',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Testimonial section Subtitle  */
	$wp_customize->add_setting(
		'webenvo-testimonial-title',
		array(
			'default'           => esc_html__( 'VALUED CUSTOMERS WHO LOVED OUR WORK', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-testimonial-title-control',
			array(
				'label'           => __( 'Testimonial Title', 'webenvo' ),
				'section'         => 'webenvo-testimonial-section',
				'settings'        => 'webenvo-testimonial-title',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
				},
			)
		)
	);

	/** Repeater Defaults. */
	$wp_customize->add_setting(
		'webenvo-testimonial-repeater',
		array(
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'default'           => TESTIMONIAL_DEFAULTS,
		)
	);
	/** Repeater Control */
	$wp_customize->add_control(
		new Webenvo_Customizer_Repeater(
			$wp_customize,
			'webenvo-testimonial-repeater-control',
			array(
				'label'                                 => esc_html__( 'Manage Testimonials', 'webenvo' ),
				'settings'                              => 'webenvo-testimonial-repeater',
				'section'                               => 'webenvo-testimonial-section',
				'add_field_label'                       => esc_html__( 'Add Testimonial', 'webenvo' ),
				'item_name'                             => esc_html__( 'Review', 'webenvo' ),
				'priority'                              => 10,
				'customizer_repeater_image_control'     => true,
				'customizer_repeater_icon_control'      => false,
				'customizer_repeater_title_control'     => true,
				'customizer_repeater_subtitle_control'  => true,
				'customizer_repeater_btntitle_control'  => true,
				'customizer_repeater_text_control'      => false,
				'customizer_repeater_text2_control'     => false,
				'customizer_repeater_link_control'      => false,
				'customizer_repeater_link2_control'     => false,
				'customizer_repeater_shortcode_control' => true,
				'customizer_repeater_repeater_control'  => false,
				'customizer_repeater_color_control'     => false,
				'customizer_repeater_color2_control'    => false,
				'active_callback'                       => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-testimonial-upgrade-control',
			array(
				'settings' => 'webenvo-testimonial-repeater',
				'section'  => 'webenvo-testimonial-section',
			)
		)
	);
	/**
	 * Filter to modify input type in repeater control
	 * You can filter by control id and input name.
	 *
	 * @param string $string Input label.
	 * @param string $id Input id.
	 * @param string $control Control name.
	 * @modified 1.1.41
	 *
	 * @return string
	 */
	function webenvo_repeater_input_types( $string, $id, $control ) {
		if ( $id === 'webenvo-testimonial-repeater-control' ) { // here is the id of the control you want to change.
			if ( $control === 'customizer_repeater_subtitle_control' ) { // Here is the input you want to change.
				return 'textarea';
			}
		}
		return $string;
	}
	add_filter( 'customizer_repeater_input_types_filter', 'webenvo_repeater_input_types', 10, 3 );

	// Testimonial Colors Controls heading control.
	$wp_customize->add_setting(
		'webenvo-testimonial-colors-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-testimonial-colors-notice-control',
			array(
				'label'           => __( 'Testimonial Colors ', 'webenvo' ),
				'settings'        => 'webenvo-testimonial-colors-notice',
				'section'         => 'webenvo-testimonial-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-testimonial-colors-upgrade-control',
			array(
				'settings' => 'webenvo-testimonial-colors-notice',
				'section'  => 'webenvo-testimonial-section',
			)
		)
	);
	// Testimonial Title text Color.
	$wp_customize->add_setting(
		'webenvo-testimonial-title-color',
		array(
			// 'default'           => '#000000',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-testimonial-title-color-control',
			array(
				'label'           => __( 'Testimonial Title text Color', 'webenvo' ),
				'settings'        => 'webenvo-testimonial-title-color',
				'section'         => 'webenvo-testimonial-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
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
	// Testimonial Title-tag text Color.
	$wp_customize->add_setting(
		'webenvo-testimonial-description-color',
		array(
			// 'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-testimonial-description-color-control',
			array(
				'label'           => __( 'Testimonial Title-tag text Color', 'webenvo' ),
				'settings'        => 'webenvo-testimonial-description-color',
				'section'         => 'webenvo-testimonial-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
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
	// Testimonial Review title Color.
	$wp_customize->add_setting(
		'webenvo-testimonial-review-title-color',
		array(
			// 'default'           => '#000000',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-testimonial-review-title-color-control',
			array(
				'label'           => __( 'Review Title Color', 'webenvo' ),
				'settings'        => 'webenvo-testimonial-review-title-color',
				'section'         => 'webenvo-testimonial-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
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
	// Testimonial Review text Color.
	$wp_customize->add_setting(
		'webenvo-testimonial-review-color',
		array(
			// 'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-testimonial-review-color-control',
			array(
				'label'           => __( 'Review text Color', 'webenvo' ),
				'settings'        => 'webenvo-testimonial-review-color',
				'section'         => 'webenvo-testimonial-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
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
	// Testimonial Client Name Color.
	$wp_customize->add_setting(
		'webenvo-testimonial-client-color',
		array(
			// 'default'           => '#3c72fc',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-testimonial-client-color-control',
			array(
				'label'           => __( 'Client Name Color', 'webenvo' ),
				'settings'        => 'webenvo-testimonial-client-color',
				'section'         => 'webenvo-testimonial-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
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
	// Testimonial Client Designation  Color.
	$wp_customize->add_setting(
		'webenvo-testimonial-client-desig-color',
		array(
			// 'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-testimonial-client-desig-color-control',
			array(
				'label'           => __( 'Client Designation Color', 'webenvo' ),
				'settings'        => 'webenvo-testimonial-client-desig-color',
				'section'         => 'webenvo-testimonial-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_testimonial_show_control_enabled( $control ) );
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
