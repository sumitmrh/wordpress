<?php
/**
 * Custom team Section.
 *
 * @package webenvo
 */

/** Section for "team". */
	$wp_customize->add_section(
		'webenvo-team-section',
		array(
			'title'       => __( 'Team settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-team-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display team and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display team */
	$wp_customize->add_setting(
		'webenvo-team-show',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-team-show-control',
			array(
				'label'    => esc_html__( 'Show Team on Frontpage', 'webenvo' ),
				'section'  => 'webenvo-team-section',
				'settings' => 'webenvo-team-show',
			)
		)
	);
	/** Selective refresh callout */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo-team-show',
			array(
				'selector' => '.sr-team',
			)
		);
	}
	/** Check team Show Enabled Active callback. */
	function webenvo_if_team_show_control_enabled( $control ) {
		if ( 1 === $control->manager->get_setting( 'webenvo-team-show' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	// heading control.
	$wp_customize->add_setting(
		'webenvo-team-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-team-notice-control',
			array(
				'label'           => __( 'Team settings ', 'webenvo' ),
				'settings'        => 'webenvo-team-notice',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Team section Title  */
	$wp_customize->add_setting(
		'webenvo-team-title-tag',
		array(
			'default'           => esc_html__( 'Collaborative Experts Driving Innovation and Success', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-team-title-tag-control',
			array(
				'label'           => __( 'Team Title Tag', 'webenvo' ),
				'section'         => 'webenvo-team-section',
				'settings'        => 'webenvo-team-title-tag',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Team section Subtitle  */
	$wp_customize->add_setting(
		'webenvo-team-title',
		array(
			'default'           => esc_html__( 'MEET OUR EXTRAORDINARY TEAM', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-team-title-control',
			array(
				'label'           => __( 'Team Title', 'webenvo' ),
				'section'         => 'webenvo-team-section',
				'settings'        => 'webenvo-team-title',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
			)
		)
	);

	/** Settings for Images / Title / Description */
	// Carousel Images / Title / Description Fetch by Repeater.

	$wp_customize->add_setting(
		'webenvo-team-repeater',
		array(
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'default'           => TEAM_DEFAULTS,
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Repeater(
			$wp_customize,
			'webenvo-team-repeater-control',
			array(
				'label'                                 => esc_html__( 'Manage Team', 'webenvo' ),
				'settings'                              => 'webenvo-team-repeater',
				'section'                               => 'webenvo-team-section',
				'add_field_label'                       => esc_html__( 'Add Team Member', 'webenvo' ),
				'item_name'                             => esc_html__( 'Team Member', 'webenvo' ),
				'priority'                              => 10,
				'customizer_repeater_image_control'     => true,
				'customizer_repeater_icon_control'      => false,
				'customizer_repeater_title_control'     => true,
				'customizer_repeater_btntitle_control'  => false,
				'customizer_repeater_subtitle_control'  => true,
				'customizer_repeater_text_control'      => false,
				'customizer_repeater_text2_control'     => false,
				'customizer_repeater_link_control'      => false,
				'customizer_repeater_link2_control'     => false,
				'customizer_repeater_shortcode_control' => false,
				'customizer_repeater_repeater_control'  => true,
				'customizer_repeater_color_control'     => false,
				'customizer_repeater_color2_control'    => false,
				'active_callback'                       => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-team-upgrade-control',
			array(
				'settings' => 'webenvo-team-repeater',
				'section'  => 'webenvo-team-section',
			)
		)
	);
	// Container Size.
	$wp_customize->add_setting(
		'webenvo-team-size',
		array(
			'default'           => 'container-fluid',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Text_Radio_Button_Custom_Control(
			$wp_customize,
			'webenvo-team-size-control',
			array(
				'label'           => __( 'Team Section size', 'webenvo' ),
				'description'     => esc_html__( 'Choose container size of Team section.', 'webenvo' ),
				'section'         => 'webenvo-team-section',
				'settings'        => 'webenvo-team-size',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
				'choices'         => array(
					'container'       => __( 'Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					'container-full'  => __( 'Full Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					'container-fluid' => __( 'fluid', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
				),
			)
		)
	);
	// Team Slider Controls heading control.
	$wp_customize->add_setting(
		'webenvo-team-controls-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-team-controls-notice-control',
			array(
				'label'           => __( 'Team Slider Controls ', 'webenvo' ),
				'settings'        => 'webenvo-team-controls-notice',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Slider Prev/Next button Control.
	$wp_customize->add_setting(
		'webenvo-team-prevnext',
		array(
			'default'           => 'true',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Text_Radio_Button_Custom_Control(
			$wp_customize,
			'webenvo-team-prevnext-control',
			array(
				'label'           => __( 'Prev/Next Controls', 'webenvo' ),
				'description'     => esc_html__( 'Toggle Show/Hide sliders prev/next controls.(Note: On-hover only).', 'webenvo' ),
				'settings'        => 'webenvo-team-prevnext',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
				'choices'         => array(
					'true'  => __( 'Show', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					'false' => __( 'Hide', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
				),
			)
		)
	);
	// Team Slider Autoplay Control.
	$wp_customize->add_setting(
		'webenvo-team-autoplay',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-team-autoplay-control',
			array(
				'label'           => __( 'Toggle Slider Autoplay', 'webenvo' ),
				'description'     => esc_html__( 'Toggle slider autoplay on/off.', 'webenvo' ),
				'settings'        => 'webenvo-team-autoplay',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Team Colors Controls heading control.
	$wp_customize->add_setting(
		'webenvo-team-colors-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-team-colors-notice-control',
			array(
				'label'           => __( 'Team Colors ', 'webenvo' ),
				'settings'        => 'webenvo-team-colors-notice',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-team-colors-upgrade-control',
			array(
				'settings' => 'webenvo-team-colors-notice',
				'section'  => 'webenvo-team-section',
			)
		)
	);
	// Team Title text Color.
	$wp_customize->add_setting(
		'webenvo-team-title-color',
		array(
			// 'default'           => '#0f0d1d',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-team-title-color-control',
			array(
				'label'           => __( 'Team Title text Color', 'webenvo' ),
				'settings'        => 'webenvo-team-title-color',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
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
	// Team description text Color.
	$wp_customize->add_setting(
		'webenvo-team-description-color',
		array(
			// 'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-team-description-color-control',
			array(
				'label'           => __( 'Team Title-tag text Color', 'webenvo' ),
				'settings'        => 'webenvo-team-description-color',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
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
	// Team Members Position text Color.
	$wp_customize->add_setting(
		'webenvo-team-position-color',
		array(
			// 'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo_team_position_color_control',
			array(
				'label'           => __( 'Members Position text Color', 'webenvo' ),
				'settings'        => 'webenvo-team-position-color',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
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
	// Team Member title text Color.
	$wp_customize->add_setting(
		'webenvo-team-member-title-color',
		array(
			// 'default'           => '#ffffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-team-member-title-color-control',
			array(
				'label'           => __( 'Members Name text Color', 'webenvo' ),
				'settings'        => 'webenvo-team-member-title-color',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
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
	// Team Project Icons Color.
	$wp_customize->add_setting(
		'webenvo-team-icons-color',
		array(
			// 'default'           => '#ffffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-team-icons-color-control',
			array(
				'label'           => __( 'Social Icons Color', 'webenvo' ),
				'settings'        => 'webenvo-team-icons-color',
				'section'         => 'webenvo-team-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_team_show_control_enabled( $control ) );
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
