<?php
/**
 * Custom Top Bar section
 *
 * @package webenvo
 */

/** Section for "Top Bar". */
	$wp_customize->add_section(
		'webenvo-topbar-section',
		array(
			'title'       => 'Top Bar settings',
			'priority'    => 1,
			'panel'       => 'webenvo-options-panel',
			'description' => __( 'Settings to Display Topbar and its Additional features.', 'webenvo' ),
		)
	);
	/** Top Bar Settings Start */

	/** Setting to display Top Bar */
		$wp_customize->add_setting(
			'webenvo-topbar-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-topbar-show-control',
				array(
					'label'    => esc_html__( 'Show Top Bar', 'webenvo' ),
					'section'  => 'webenvo-topbar-section',
					'settings' => 'webenvo-topbar-show',
				)
			)
		);
		/** Selective refresh topbar */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'webenvo-topbar-show',
				array(
					'selector' => '.sr-topbar',
				)
			);
		}
		/** Check Topbar Show Enabled Active callback. */
		function webenvo_if_topbar_show_control_enabled( $control ) {
			if ( 1 === $control->manager->get_setting( 'webenvo-topbar-show' )->value() ) {
				return true;
			} else {
				return false;
			}
		}

		// Topbar Settings  heading control.
		$wp_customize->add_setting(
			'webenvo-topbar-notice',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Simple_Notice_Custom_control(
				$wp_customize,
				'webenvo-topbar-notice-control',
				array(
					'label'           => __( 'Top Bar Settings.', 'webenvo' ),
					'settings'        => 'webenvo-topbar-notice',
					'section'         => 'webenvo-topbar-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control ) );
					},
				)
			)
		);
		/** Top Bar Email  */
		$wp_customize->add_setting(
			'webenvo-topbar-email',
			array(
				'default'           => 'example@corpo.com',
				'sanitize_callback' => array( $this, 'sanitize_custom_email' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'webenvo-topbar-email-control',
				array(
					'label'           => 'Site Email',
					'section'         => 'webenvo-topbar-section',
					'settings'        => 'webenvo-topbar-email',
					'type'            => 'text',
					'active_callback' => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control ) );
					},
				)
			)
		);

		/** Setting for Telephone Number */
		$wp_customize->add_setting(
			'webenvo-topbar-tel',
			array(
				'default'           => '+00123456789',
				'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'webenvo-topbar-tel-control',
				array(
					'label'           => 'Telephone/Callback',
					'section'         => 'webenvo-topbar-section',
					'settings'        => 'webenvo-topbar-tel',
					'type'            => 'text',
					'active_callback' => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Social Icons heading control.
		$wp_customize->add_setting(
			'webenvo-topbar-social-notice',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Simple_Notice_Custom_control(
				$wp_customize,
				'webenvo-topbar-social-notice-control',
				array(
					'label'           => __( 'Social Icons Settings.', 'webenvo' ),
					'settings'        => 'webenvo-topbar-social-notice',
					'section'         => 'webenvo-topbar-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control ) );
					},
				)
			)
		);
		/** Setting to display Social Icons */
		$wp_customize->add_setting(
			'webenvo-topbar-social-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-topbar-social-show-control',
				array(
					'label'           => esc_html__( 'Show Social Icons at Topbar', 'webenvo' ),
					'section'         => 'webenvo-topbar-section',
					'settings'        => 'webenvo-topbar-social-show',
					'active_callback' => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control ) );
					},
				)
			)
		);
		/** Selective refresh topbar */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'webenvo-topbar-social-show',
				array(
					'selector' => '.sr-social-icons',
				)
			);
		}
		/** Check Topbar Show Enabled Active callback. */
		function webenvo_if_topbar_social_show_control_enabled( $control ) {
			if ( 1 === $control->manager->get_setting( 'webenvo-topbar-social-show' )->value() ) {
				return true;
			} else {
				return false;
			}
		}
		/** Settings for Images / Title / Description */
		// Carousel Images / Title / Description Fetch by Repeater.

		$wp_customize->add_setting(
			'webenvo-topbar-social-repeater',
			array(
				'sanitize_callback' => 'customizer_repeater_sanitize',
				'transport'         => 'refresh',
				'default'           => TOPBAR_DEFAULTS,
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Repeater(
				$wp_customize,
				'webenvo-topbar-social-repeater-control',
				array(
					'label'                                => esc_html__( 'Manage Topbar Social Icons', 'webenvo' ),
					'settings'                             => 'webenvo-topbar-social-repeater',
					'section'                              => 'webenvo-topbar-section',
					'add_field_label'                      => esc_html__( 'Manage Social Icons', 'webenvo' ),
					'item_name'                            => esc_html__( 'Social Icons', 'webenvo' ),
					'priority'                             => 10,
					'customizer_repeater_image_control'    => false,
					'customizer_repeater_icon_control'     => false,
					'customizer_repeater_title_control'    => false,
					'customizer_repeater_btntitle_control' => false,
					'customizer_repeater_subtitle_control' => false,
					'customizer_repeater_text_control'     => false,
					'customizer_repeater_text2_control'    => false,
					'customizer_repeater_link_control'     => false,
					'customizer_repeater_link2_control'    => false,
					'customizer_repeater_shortcode_control' => false,
					'customizer_repeater_repeater_control' => true,
					'customizer_repeater_color_control'    => false,
					'customizer_repeater_color2_control'   => false,
					'active_callback'                      => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control )
						&&
						webenvo_if_topbar_social_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Custom Upgrade Control.
		$wp_customize->add_control(
			new Webenvo_Custom_Upgrade_Control(
				$wp_customize,
				'webenvo-topbar-upgrade-control',
				array(
					'settings' => 'webenvo-topbar-social-repeater',
					'section'  => 'webenvo-topbar-section',
				)
			)
		);
		// Social Icons heading control.
		$wp_customize->add_setting(
			'webenvo-topbar-button-notice',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Simple_Notice_Custom_control(
				$wp_customize,
				'webenvo-topbar-button-notice-control',
				array(
					'label'           => __( 'Button Settings.', 'webenvo' ),
					'settings'        => 'webenvo-topbar-button-notice',
					'section'         => 'webenvo-topbar-section',
					'active_callback' => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Button.
		$wp_customize->add_setting(
			'webenvo-topbar-button-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-topbar-button-show-control',
				array(
					'label'           => esc_html__( 'Show Button', 'webenvo' ),
					'section'         => 'webenvo-topbar-section',
					'settings'        => 'webenvo-topbar-button-show',
					'active_callback' => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control ) );
					},
				)
			)
		);
		// Button Text.
		function webenvo_ac_button_text( $control ) {
			if ( 1 === $control->manager->get_setting( 'webenvo-topbar-button-show' )->value() ) {
				return true;
			} else {
				return false;
			}
		}
		// Setting for Button text.
		$wp_customize->add_setting(
			'webenvo-topbar-button-text',
			array(
				'default'           => 'Get Started',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'webenvo-topbar-button-text-control',
				array(
					'label'           => 'Button Text',
					'section'         => 'webenvo-topbar-section',
					'settings'        => 'webenvo-topbar-button-text',
					'type'            => 'text',
					'active_callback' => function( $control ) {
						return (
							webenvo_if_topbar_show_control_enabled( $control )
							&&
							webenvo_ac_button_text( $control )
						);
					},
					'input_attrs'     => array(
						'placeholder' => 'Get Started',
					),
				)
			)
		);
		// Callout Button URL.
		$wp_customize->add_setting(
			'webenvo-topbar-btnlink',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_custom_url' ),
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'webenvo-topbar-btnlink-control',
				array(
					'label'           => 'Topbar Button link',
					'section'         => 'webenvo-topbar-section',
					'settings'        => 'webenvo-topbar-btnlink',
					'type'            => 'text',
					'active_callback' => function( $control ) {
						return ( webenvo_if_topbar_show_control_enabled( $control )
						&&
						webenvo_ac_button_text( $control )
						);
					},
					'input_attrs'     => array(
						'placeholder' => 'https://',
					),
				)
			)
		);
