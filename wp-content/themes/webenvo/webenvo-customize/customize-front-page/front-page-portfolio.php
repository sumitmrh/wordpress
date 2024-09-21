<?php
/**
 * Custom portfolio Section.
 *
 * @package webenvo
 */

/** Section for "portfolio". */
	$wp_customize->add_section(
		'webenvo-portfolio-section',
		array(
			'title'       => __( 'Portfolio settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-portfolio-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display portfolio and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display portfolio */
	$wp_customize->add_setting(
		'webenvo-portfolio-show',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-portfolio-show-control',
			array(
				'label'    => esc_html__( 'Show Portfolio on Frontpage', 'webenvo' ),
				'section'  => 'webenvo-portfolio-section',
				'settings' => 'webenvo-portfolio-show',
			)
		)
	);
	/** Selective refresh Services */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo-portfolio-show',
			array(
				'selector' => '.sr-portfolio',
			)
		);
	}
	/** Check portfolio Show Enabled Active callback. */
	function webenvo_if_portfolio_show_control_enabled( $control ) {
		if ( 1 === $control->manager->get_setting( 'webenvo-portfolio-show' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	// heading control.
	$wp_customize->add_setting(
		'webenvo-portfolio-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-portfolio-notice-control',
			array(
				'label'           => __( 'Portfolio settings ', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-notice',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Portfolio section Title  */
	$wp_customize->add_setting(
		'webenvo-portfolio-title',
		array(
			'default'           => esc_html__( 'OUR DIVERSE ARRAY OF PROJECTS', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-portfolio-title-control',
			array(
				'label'           => __( 'Title', 'webenvo' ),
				'section'         => 'webenvo-portfolio-section',
				'settings'        => 'webenvo-portfolio-title',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** Portfolio section Subtitle  */
	$wp_customize->add_setting(
		'webenvo-portfolio-subtitle',
		array(
			'default'           => esc_html__( 'From groundbreaking initiatives to cutting-edge solutions, explore our latest ventures shaping the future.', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-portfolio-subtitle-control',
			array(
				'label'           => __( 'Subtitle', 'webenvo' ),
				'section'         => 'webenvo-portfolio-section',
				'settings'        => 'webenvo-portfolio-subtitle',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
			)
		)
	);

	/** Settings for Images / Title / Description */
	// Carousel Images / Title / Description Fetch by Repeater.

	$wp_customize->add_setting(
		'webenvo-portfolio-repeater',
		array(
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'default'           => PORTFOLIO_DEFAULTS,
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Repeater(
			$wp_customize,
			'webenvo-portfolio-repeater-control',
			array(
				'label'                                 => esc_html__( 'Manage Portfolio', 'webenvo' ),
				'settings'                              => 'webenvo-portfolio-repeater',
				'section'                               => 'webenvo-portfolio-section',
				'add_field_label'                       => esc_html__( 'Add Project', 'webenvo' ),
				'item_name'                             => esc_html__( 'Project', 'webenvo' ),
				'priority'                              => 10,
				'customizer_repeater_image_control'     => true,
				'customizer_repeater_icon_control'      => false,
				'customizer_repeater_title_control'     => true,
				'customizer_repeater_btntitle_control'  => false,
				'customizer_repeater_subtitle_control'  => true,
				'customizer_repeater_text_control'      => false,
				'customizer_repeater_text2_control'     => false,
				'customizer_repeater_link_control'      => true,
				'customizer_repeater_link2_control'     => false,
				'customizer_repeater_shortcode_control' => false,
				'customizer_repeater_repeater_control'  => false,
				'customizer_repeater_color_control'     => false,
				'customizer_repeater_color2_control'    => false,
				'active_callback'                       => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-portfolio-upgrade-control',
			array(
				'settings' => 'webenvo-portfolio-repeater',
				'section'  => 'webenvo-portfolio-section',
			)
		)
	);
	// Container Size.
	$wp_customize->add_setting(
		'webenvo-portfolio-size',
		array(
			'default'           => 'container-full',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Text_Radio_Button_Custom_Control(
			$wp_customize,
			'webenvo-portfolio-size-control',
			array(
				'label'           => __( 'Portfolio Section size', 'webenvo' ),
				'description'     => esc_html__( 'Choose container size of Portfolio section.', 'webenvo' ),
				'section'         => 'webenvo-portfolio-section',
				'settings'        => 'webenvo-portfolio-size',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
				'choices'         => array(
					'container'       => __( 'Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					'container-full'  => __( 'Full Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					'container-fluid' => __( 'fluid', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
				),
			)
		)
	);
	// Portfolio Slider Controls heading control.
	$wp_customize->add_setting(
		'webenvo-portfolio-controls-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-portfolio-controls-notice-control',
			array(
				'label'           => __( 'Portfolio Slider Controls ', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-controls-notice',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Slider Prev/Next button Control.
	$wp_customize->add_setting(
		'webenvo-portfolio-prevnext',
		array(
			'default'           => 'true',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Text_Radio_Button_Custom_Control(
			$wp_customize,
			'webenvo-portfolio-prevnext-control',
			array(
				'label'           => __( 'Prev/Next Controls', 'webenvo' ),
				'description'     => esc_html__( 'Toggle Show/Hide sliders prev/next controls.(Note: On-hover only).', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-prevnext',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
				'choices'         => array(
					'true'  => __( 'Show', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					'false' => __( 'Hide', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
				),
			)
		)
	);
	// Portfolio Slider Autoplay Control.
	$wp_customize->add_setting(
		'webenvo-portfolio-autoplay',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-portfolio-autoplay-control',
			array(
				'label'           => __( 'Toggle Slider Autoplay', 'webenvo' ),
				'description'     => esc_html__( 'Toggle slider autoplay on/off.', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-autoplay',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Portfolio colors heading control.
	$wp_customize->add_setting(
		'webenvo-portfolio-colors-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-portfolio-colors-notice-control',
			array(
				'label'           => __( 'Portfolio Colors ', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-colors-notice',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
				},
			)
		)
	);
	// Custom Upgrade Control.
	$wp_customize->add_control(
		new Webenvo_Custom_Upgrade_Control(
			$wp_customize,
			'webenvo-portfolio-colors-upgrade-control',
			array(
				'settings' => 'webenvo-portfolio-colors-notice',
				'section'  => 'webenvo-portfolio-section',
			)
		)
	);

	// Portfolio Title text Color.
	$wp_customize->add_setting(
		'webenvo-portfolio-title-color',
		array(
			// 'default'           => '#0f0d1d',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-portfolio-title-color-control',
			array(
				'label'           => __( 'Portfolio Title text Color', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-title-color',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
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
	
	// Portfolio description text Color.
	$wp_customize->add_setting(
		'webenvo-portfolio-description-color',
		array(
			// 'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-portfolio-description-color-control',
			array(
				'label'           => __( 'Portfolio Subtitle text Color', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-description-color',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
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
	// Portfolio Project tag text Color.
	$wp_customize->add_setting(
		'webenvo-portfolio-tag-color',
		array(
			// 'default'           => '#726f84',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-portfolio-tag-color-control',
			array(
				'label'           => __( 'Project tag text Color', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-tag-color',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
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
	// Portfolio Project title text Color.
	$wp_customize->add_setting(
		'webenvo-portfolio-project-title-color',
		array(
			// 'default'           => '#ffffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-portfolio-project-title-color-control',
			array(
				'label'           => __( 'Project title text Color', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-project-title-color',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
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
	// Portfolio Project Icons Color.
	$wp_customize->add_setting(
		'webenvo-portfolio-icons-color',
		array(
			// 'default'           => '#ffffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-portfolio-icons-color-control',
			array(
				'label'           => __( 'Project Icons Color', 'webenvo' ),
				'settings'        => 'webenvo-portfolio-icons-color',
				'section'         => 'webenvo-portfolio-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_portfolio_show_control_enabled( $control ) );
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
