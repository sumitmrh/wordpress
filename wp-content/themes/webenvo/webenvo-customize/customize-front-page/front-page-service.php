<?php
/**
 * Custom Services Section.
 *
 * @package webenvo
 */


/** Section for "Services". */
	$wp_customize->add_section(
		'webenvo-services-section',
		array(
			'title'       => __( 'Services settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-services-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display Services and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display Services */
		$wp_customize->add_setting(
			'webenvo-services-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-services-show-control',
				array(
					'label'    => esc_html__( 'Show Services on Frontpage', 'webenvo' ),
					'section'  => 'webenvo-services-section',
					'settings' => 'webenvo-services-show',
				)
			)
		);
		/** Selective refresh Services */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'webenvo-services-show',
				array(
					'selector' => '.sr-services',
				)
			);
		}
		/** Check Services Show Enabled Active callback. */
		function webenvo_if_services_show_control_enabled( $control ) {
			if ( 1 === $control->manager->get_setting( 'webenvo-services-show' )->value() ) {
				return true;
			} else {
				return false;
			}
		}

		// Services Colors Controls heading control.
		$wp_customize->add_setting(
			'webenvo-services-settings-notice',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Skyrocket_Simple_Notice_Custom_control(
				$wp_customize,
				'webenvo-services-settings-notice-control',
				array(
					'label'           => __( 'Services Settings ', 'webenvo' ),
					'settings'        => 'webenvo-services-settings-notice',
					'section'         => 'webenvo-services-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
					},
				)
			)
		);

		/** Services section Title  */
		$wp_customize->add_setting(
			'webenvo-services-title',
			array(
				'default'           => esc_html__( 'Tailored Solutions for Every Need', 'webenvo' ),
				'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'webenvo-services-title-control',
				array(
					'label'           => __( 'Title', 'webenvo' ),
					'section'         => 'webenvo-services-section',
					'settings'        => 'webenvo-services-title',
					'type'            => 'text',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
					},
				)
			)
		);
		/** Services section Subtitle  */
		$wp_customize->add_setting(
			'webenvo-services-subtitle',
			array(
				'default'           => esc_html__( 'We offers an array of customized solutions designed to meet your unique requirements.', 'webenvo' ),
				'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'webenvo-services-subtitle-control',
				array(
					'label'           => __( 'Subtitle', 'webenvo' ),
					'section'         => 'webenvo-services-section',
					'settings'        => 'webenvo-services-subtitle',
					'type'            => 'text',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
					},
				)
			)
		);

		/** Settings for Images / Title / Description */
		// Carousel Images / Title / Description Fetch by Repeater.
		$wp_customize->add_setting(
			'webenvo-services-repeater',
			array(
				'sanitize_callback' => 'customizer_repeater_sanitize',
				'default'           => SERVICES_DEFAULTS,
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Repeater(
				$wp_customize,
				'webenvo-services-repeater-control',
				array(
					'label'                                => esc_html__( 'Manage Services', 'webenvo' ),
					'settings'                             => 'webenvo-services-repeater',
					'section'                              => 'webenvo-services-section',
					'add_field_label'                      => esc_html__( 'Add Service', 'webenvo' ),
					'item_name'                            => esc_html__( 'Service', 'webenvo' ),
					'priority'                             => 10,
					'customizer_repeater_image_control'    => true,
					'customizer_repeater_icon_control'     => true,
					'customizer_repeater_title_control'    => true,
					'customizer_repeater_btntitle_control' => true,
					'customizer_repeater_subtitle_control' => true,
					'customizer_repeater_text_control'     => false,
					'customizer_repeater_text2_control'    => false,
					'customizer_repeater_link_control'     => true,
					'customizer_repeater_link2_control'    => false,
					'customizer_repeater_shortcode_control' => false,
					'customizer_repeater_repeater_control' => false,
					'customizer_repeater_color_control'    => false,
					'customizer_repeater_color2_control'   => false,
					'active_callback'                      => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Custom Upgrade Control.
		$wp_customize->add_control(
			new Webenvo_Custom_Upgrade_Control(
				$wp_customize,
				'webenvo-services-upgrade-control',
				array(
					'settings' => 'webenvo-services-repeater',
					'section'  => 'webenvo-services-section',
				)
			)
		);
		// Container Size.
		$wp_customize->add_setting(
			'webenvo-services-size',
			array(
				'default'           => 'container-full',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo-services-size-control',
				array(
					'label'           => __( 'Services Section size', 'webenvo' ),
					'description'     => esc_html__( 'Choose container size of services section.', 'webenvo' ),
					'section'         => 'webenvo-services-section',
					'settings'        => 'webenvo-services-size',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
					},
					'choices'         => array(
						'container'       => __( 'Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'container-full'  => __( 'Full Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'container-fluid' => __( 'Fluid', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					),
				)
			)
		);

		// Grid Column Layout.
		$wp_customize->add_setting(
			'webenvo-services-grid',
			array(
				'default'           => 'col-lg-4',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo-services-grid-control',
				array(
					'label'           => __( 'Services Grid Column Layout', 'webenvo' ),
					'description'     => esc_html__( 'Select grid layout and number of services inline display in section.', 'webenvo' ),
					'section'         => 'webenvo-services-section',
					'settings'        => 'webenvo-services-grid',
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
						return ( webenvo_if_services_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Custom Upgrade Control.
		$wp_customize->add_control(
			new Webenvo_Custom_Upgrade_Control(
				$wp_customize,
				'webenvo-services-grid-upgrade-control',
				array(
					'section'  => 'webenvo-services-section',
					'settings' => 'webenvo-services-grid',
				)
			)
		);
		// Services Image Control.
		$wp_customize->add_setting(
			'webenvo-services-image',
			array(
				'default'           => get_template_directory_uri() . '/assets/images/service-shape.png',
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'webenvo-services-image_control',
				array(
					'label'           => __( 'Services Background Image', 'webenvo' ),
					'description'     => esc_html__( 'Choose Image for Services Background. Best fit : Width 1920px', 'webenvo' ),
					'section'         => 'webenvo-services-section',
					'settings'        => 'webenvo-services-image',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
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
		// Services background opacity.
		$wp_customize->add_setting(
			'webenvo-services-background-opacity',
			array(
				'default'           => 30,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Slider_Custom_Control(
				$wp_customize,
				'webenvo-services-background-opacity_control',
				array(
					'label'           => esc_html__( 'Background Image Opacity (%)', 'webenvo' ),
					'section'         => 'webenvo-services-section',
					'settings'        => 'webenvo-services-background-opacity',
					'input_attrs'     => array(
						'min'  => 0, // Required. Minimum value for the slider
						'max'  => 100, // Required. Maximum value for the slider
						'step' => 5, // Required. The size of each interval or step the slider takes between the minimum and maximum values
					),
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Services Colors Controls heading control.
		$wp_customize->add_setting(
			'webenvo-services-colors-notice',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Simple_Notice_Custom_control(
				$wp_customize,
				'webenvo-services-colors-notice-control',
				array(
					'label'           => __( 'Services Colors ', 'webenvo' ),
					'settings'        => 'webenvo-services-colors-notice',
					'section'         => 'webenvo-services-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Custom Upgrade Control.
		$wp_customize->add_control(
			new Webenvo_Custom_Upgrade_Control(
				$wp_customize,
				'webenvo-services-color-upgrade-control',
				array(
					'settings' => 'webenvo-services-colors-notice',
					'section'  => 'webenvo-services-section',
				)
			)
		);
		// Services Title text Color.
		$wp_customize->add_setting(
			'webenvo-services-title-color',
			array(
				// 'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo-services-title-color-control',
				array(
					'label'           => __( 'Services Section Title Color', 'webenvo' ),
					'settings'        => 'webenvo-services-title-color',
					'section'         => 'webenvo-services-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
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
		// Services Description text Color.
		$wp_customize->add_setting(
			'webenvo-services-description-color',
			array(
				// 'default'        => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo-services-description-color-control',
				array(
					'label'           => __( 'Services Section Description Color', 'webenvo' ),
					'settings'        => 'webenvo-services-description-color',
					'section'         => 'webenvo-services-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
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
		// Individual Service Title text Color.
		$wp_customize->add_setting(
			'webenvo-service-title-color',
			array(
				// 'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo-service-title-color-control',
				array(
					'label'           => __( 'Service Title Color', 'webenvo' ),
					'settings'        => 'webenvo-service-title-color',
					'section'         => 'webenvo-services-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
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
		// Services Detail text Color.
		$wp_customize->add_setting(
			'webenvo-service-details-color',
			array(
				// 'default'        => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo-service-details-color-control',
				array(
					'label'           => __( 'Service Detail Color', 'webenvo' ),
					'settings'        => 'webenvo-service-details-color',
					'section'         => 'webenvo-services-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
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
		// Services Link Color.
		$wp_customize->add_setting(
			'webenvo-service-link-color',
			array(
				// 'default'        => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo-service-link-color-control',
				array(
					'label'           => __( 'Service Link Color', 'webenvo' ),
					'settings'        => 'webenvo-service-link-color',
					'section'         => 'webenvo-services-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
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
		// Services Icon Color.
		$wp_customize->add_setting(
			'webenvo-service-icon-color',
			array(
				// 'default'        => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo-service-icon-color-control',
				array(
					'label'           => __( 'Service Icon Color', 'webenvo' ),
					'settings'        => 'webenvo-service-icon-color',
					'section'         => 'webenvo-services-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_services_show_control_enabled( $control ) );
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
