<?php
/**
 * Custom news Section.
 *
 * @package webenvo
 */

/** Section for "news". */
	$wp_customize->add_section(
		'webenvo-news-section',
		array(
			'title'       => __( 'News/Updates settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-news-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display news and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display news */
	$wp_customize->add_setting(
		'webenvo-news-show',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-news-show-control',
			array(
				'label'    => esc_html__( 'Show News on Frontpage', 'webenvo' ),
				'section'  => 'webenvo-news-section',
				'settings' => 'webenvo-news-show',
			)
		)
	);
	/** Selective refresh Services */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo-news-show',
			array(
				'selector' => '.sr-news',
			)
		);
	}
	/** Check news Show Enabled Active callback. */
	function webenvo_if_news_show_control_enabled( $control ) {
		if ( 1 === $control->manager->get_setting( 'webenvo-news-show' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	// heading control.
	$wp_customize->add_setting(
		'webenvo-news-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-news-notice-control',
			array(
				'label'           => __( 'News/Updates settings ', 'webenvo' ),
				'settings'        => 'webenvo-news-notice',
				'section'         => 'webenvo-news-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_news_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** News section Title  */
	$wp_customize->add_setting(
		'webenvo-news-title-tag',
		array(
			'default'           => esc_html__( 'Discover Insights and Ideas', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-news-title-tag-control',
			array(
				'label'           => __( 'News/Updates Title Tag', 'webenvo' ),
				'section'         => 'webenvo-news-section',
				'settings'        => 'webenvo-news-title-tag',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_news_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** News section Subtitle  */
	$wp_customize->add_setting(
		'webenvo-news-title',
		array(
			'default'           => esc_html__( 'Inspiration for Growth', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-news-title-control',
			array(
				'label'           => __( 'News/Updates Title', 'webenvo' ),
				'section'         => 'webenvo-news-section',
				'settings'        => 'webenvo-news-title',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_news_show_control_enabled( $control ) );
				},
			)
		)
	);
	// News Colors Controls heading control.
	$wp_customize->add_setting(
		'webenvo-news-colors-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-news-colors-notice-control',
			array(
				'label'           => __( 'News Colors ', 'webenvo' ),
				'settings'        => 'webenvo-news-colors-notice',
				'section'         => 'webenvo-news-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_news_show_control_enabled( $control ) );
				},
			)
		)
	);

	// News Title text Color.
	$wp_customize->add_setting(
		'webenvo-news-title-color',
		array(
			// 'default'           => '#fffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-news-title-color-control',
			array(
				'label'           => __( 'News Title Color', 'webenvo' ),
				'settings'        => 'webenvo-news-title-color',
				'section'         => 'webenvo-news-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_news_show_control_enabled( $control ) );
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
	// News description text Color.
	$wp_customize->add_setting(
		'webenvo-news-description-color',
		array(
			// 'default'           => '#fffff',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Webenvo_Customizer_Alpha_Color_Control(
			$wp_customize,
			'webenvo-news-description-color-control',
			array(
				'label'           => __( 'News tag Color', 'webenvo' ),
				'settings'        => 'webenvo-news-description-color',
				'section'         => 'webenvo-news-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_news_show_control_enabled( $control ) );
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
