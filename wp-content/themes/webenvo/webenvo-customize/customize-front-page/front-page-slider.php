<?php
/**
 * Custom Slider Section.
 *
 * @package webenvo
 */

		$wp_customize->add_section(
			'webenvo-slider-section',
			array(
				'title'       => 'Slider Settings',
				'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-slider-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
				'panel'       => 'webenvo-fpsections-panel',
				'description' => __( 'Settings to Display Carousel and its Additional features.', 'webenvo' ),
			)
		);

		/** Setting to display Slider */
		$wp_customize->add_setting(
			'webenvo-slider-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-slider-show-control',
				array(
					'label'    => esc_html__( 'Show Slider on Frontpage', 'webenvo' ),
					'section'  => 'webenvo-slider-section',
					'settings' => 'webenvo-slider-show',
				)
			)
		);
		/** Selective refresh */
		// $wp_customize->get_setting( 'webenvo-slider-show' )->transport = 'postMessage';
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'webenvo-slider-show',
				array(
					'selector' => '.sr-slider',
				)
			);
		}
		/** Check Topbar Show Enabled Active callback. */
		function webenvo_if_slider_show_control_enabled( $control ) {
			if ( 1 === $control->manager->get_setting( 'webenvo-slider-show' )->value() ) {
				return true;
			} else {
				return false;
			}
		}
		// heading control.
		$wp_customize->add_setting(
			'webenvo_slider_notice',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Simple_Notice_Custom_control(
				$wp_customize,
				'webenvo_slider_notice_control',
				array(
					'label'           => __( 'Slider Image settings ', 'webenvo' ),
					'settings'        => 'webenvo_slider_notice',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
					},
				)
			)
		);

		/** Settings for Images / Title / Description */
		// Carousel Images / Title / Description Fetch by Repeater.

		$wp_customize->add_setting(
			'webenvo-slider-repeater',
			array(
				'sanitize_callback' => 'customizer_repeater_sanitize',
				'default'           => SLIDER_DEFAULTS,
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Repeater(
				$wp_customize,
				'webenvo-slider-repeater-control',
				array(
					'label'                                => esc_html__( 'Manage Carousel Images', 'webenvo' ),
					'settings'                             => 'webenvo-slider-repeater',
					'section'                              => 'webenvo-slider-section',
					'add_field_label'                      => __( 'Add More Image', 'webenvo' ),
					'item_name'                            => __( 'Set Image Title/Description/Button', 'webenvo' ),
					'priority'                             => 10,
					'customizer_repeater_image_control'    => true,
					'customizer_repeater_icon_control'     => false,
					'customizer_repeater_title_control'    => true,
					'customizer_repeater_btntitle_control' => true,
					'customizer_repeater_subtitle_control' => true,
					'customizer_repeater_text_control'     => true,
					'customizer_repeater_text2_control'    => false,
					'customizer_repeater_link_control'     => true,
					'customizer_repeater_link2_control'    => false,
					'customizer_repeater_shortcode_control' => false,
					'customizer_repeater_repeater_control' => false,
					'customizer_repeater_color_control'    => false,
					'customizer_repeater_color2_control'   => false,
					'active_callback'                      => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Custom Upgrade Control.
		$wp_customize->add_control(
			new Webenvo_Custom_Upgrade_Control(
				$wp_customize,
				'webenvo-slider-upgrade-control',
				array(
					'settings' => 'webenvo-slider-repeater',
					'section'  => 'webenvo-slider-section',
				)
			)
		);
		// heading control.
		$wp_customize->add_setting(
			'webenvo_slider_options_notice',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Simple_Notice_Custom_control(
				$wp_customize,
				'webenvo_slider_options_notice_control',
				array(
					'label'           => __( 'Slider Control settings ', 'webenvo' ),
					'settings'        => 'webenvo_slider_options_notice',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Slider Prev/Next button Control.
		$wp_customize->add_setting(
			'webenvo_slider_prevnext',
			array(
				'default'           => 'true',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo_slider_prevnext_control',
				array(
					'label'           => __( 'Prev/Next Controls', 'webenvo' ),
					'description'     => esc_html__( 'Toggle Show/Hide sliders prev/next controls.', 'webenvo' ),
					'settings'        => 'webenvo_slider_prevnext',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
					},
					'choices'         => array(
						'true'  => __( 'Show', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'false' => __( 'Hide', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					),
				)
			)
		);
		// Slider overlay Control.
		$wp_customize->add_setting(
			'webenvo_slider_overlay',
			array(
				'default'           => 'itembf',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo_slider_overlay_control',
				array(
					'label'           => __( 'Slider Overlay', 'webenvo' ),
					'description'     => esc_html__( 'Toggle Overlay on Slider Image.', 'webenvo' ),
					'settings'        => 'webenvo_slider_overlay',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
					},
					'choices'         => array(
						'itembf' => __( 'Enable', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						''       => __( 'Disable', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					),
				)
			)
		);
		/** Check Topbar Show Enabled Active callback. */
		function webenvo_if_slider_overlay_control_enabled( $control ) {
			if ( 'itembf' === $control->manager->get_setting( 'webenvo_slider_overlay' )->value() ) {
				return true;
			} else {
				return false;
			}
		}
		// Slider Overlay Color.
		$wp_customize->add_setting(
			'webenvo_slider_overlay_color',
			array(
				'default'           => 'rgba(0,0,0,0.2)',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo_slider_overlay_color_control',
				array(
					'label'           => __( 'Slider Overlay Color', 'webenvo' ),
					// 'description' => esc_html__( 'Sample color control with Alpha channel', 'webenvo' ),
					'settings'        => 'webenvo_slider_overlay_color',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) && webenvo_if_slider_overlay_control_enabled( $control ) );
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
		// Slider Autoplay Control.
		$wp_customize->add_setting(
			'webenvo_slider_autoplay',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo_slider_autoplay-control',
				array(
					'label'           => __( 'Toggle Slider Autoplay', 'webenvo' ),
					'description'     => esc_html__( 'Toggle slider autoplay on/off. Also display additional controls', 'webenvo' ),
					'settings'        => 'webenvo_slider_autoplay',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
					},

				)
			)
		);
		/** Check slider autoplay Enabled Active callback. */
		function webenvo_if_slider_autoplay_control_enabled( $control ) {
			if ( 1 === $control->manager->get_setting( 'webenvo_slider_autoplay' )->value() ) {
				return true;
			} else {
				return false;
			}
		}
		// Slider loop Control.
		$wp_customize->add_setting(
			'webenvo_slider_loop',
			array(
				'default'           => 'true',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo_slider_loop_control',
				array(
					'label'           => __( 'Loop Slides', 'webenvo' ),
					'description'     => esc_html__( 'Toggle slider loop of images on/off while autoplay is on. ', 'webenvo' ),
					'settings'        => 'webenvo_slider_loop',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) && webenvo_if_slider_autoplay_control_enabled( $control ) );
					},
					'choices'         => array(
						'true'  => __( 'On', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'false' => __( 'Off', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					),
				)
			)
		);
		// Slider Pause on Hover Control.
		$wp_customize->add_setting(
			'webenvo_slider_pauseonhover',
			array(
				'default'           => 'true',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo_slider_pauseonhover_control',
				array(
					'label'           => __( 'Slider Pause on Hover', 'webenvo' ),
					'description'     => esc_html__( 'Toggle Pause Slider on Mouse Hover.', 'webenvo' ),
					'settings'        => 'webenvo_slider_pauseonhover',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) && webenvo_if_slider_autoplay_control_enabled( $control ) );
					},
					'choices'         => array(
						'true'  => __( 'On', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'false' => __( 'Off', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					),
				)
			)
		);
		// Slider Autoplay Speed.
		$wp_customize->add_setting(
			'webenvo_slider_speed',
			array(
				'default'           => 3000,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Slider_Custom_Control(
				$wp_customize,
				'webenvo_slider_speed_control',
				array(
					'label'           => esc_html__( 'Slider Autoplay Speed (ms)', 'webenvo' ),
					'settings'        => 'webenvo_slider_speed',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) && webenvo_if_slider_autoplay_control_enabled( $control ) );
					},
					'input_attrs'     => array(
						'min'  => 1000, // Required. Minimum value for the slider.
						'max'  => 20000, // Required. Maximum value for the slider.
						'step' => 100, // Required. The size of each interval or step the slider takes between the minimum and maximum values.
					),
				)
			)
		);
		// heading control.
		$wp_customize->add_setting(
			'webenvo_slider_colors_notice',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Simple_Notice_Custom_control(
				$wp_customize,
				'webenvo_slider_colors_notice_control',
				array(
					'label'           => __( 'Slider Color settings ', 'webenvo' ),
					'settings'        => 'webenvo_slider_colors_notice',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Custom Upgrade Control.
		$wp_customize->add_control(
			new Webenvo_Custom_Upgrade_Control(
				$wp_customize,
				'webenvo-slider-color-upgrade-control',
				array(
					'settings' => 'webenvo_slider_colors_notice',
					'section'  => 'webenvo-slider-section',
				)
			)
		);
		// Slider Title Tag text Color.
		$wp_customize->add_setting(
			'webenvo_slider_titletag_color',
			array(
				// 'default'           => '#ffffff',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo_slider_titletag_color_control',
				array(
					'label'           => __( 'Slider Title Tag text Color', 'webenvo' ),
					'settings'        => 'webenvo_slider_titletag_color',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
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

		// Slider Title text Color.
		$wp_customize->add_setting(
			'webenvo_slider_title_color',
			array(
				// 'default'           => '#ffffff',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo_slider_title_color_control',
				array(
					'label'           => __( 'Slider Title text Color', 'webenvo' ),
					'settings'        => 'webenvo_slider_title_color',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
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
		// Slider description text Color.
		$wp_customize->add_setting(
			'webenvo_slider_description_color',
			array(
				// 'default'           => '#ffffff',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo_slider_description_color_control',
				array(
					'label'           => __( 'Slider Description text Color', 'webenvo' ),
					'settings'        => 'webenvo_slider_description_color',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
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
		// Slider button text Color.
		$wp_customize->add_setting(
			'webenvo_slider_btntext_color',
			array(
				// 'default'           => '#ffffff',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo_slider_btntext_color_control',
				array(
					'label'           => __( 'Slider Button text Color', 'webenvo' ),
					'settings'        => 'webenvo_slider_btntext_color',
					'section'         => 'webenvo-slider-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_slider_show_control_enabled( $control ) );
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
