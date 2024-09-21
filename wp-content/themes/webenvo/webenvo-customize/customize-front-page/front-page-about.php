<?php
/**
 * Custom about Section.
 *
 * @package webenvo
 */

/** Section for "about". */
	$wp_customize->add_section(
		'webenvo-about-section',
		array(
			'title'       => __( 'About settings', 'webenvo' ),
			'priority'    => apply_filters( 'webenvo_section_priority', 10, 'webenvo-about-section' ), // First parameter, 10, is the section default priority, second parameter, 'hestia_features', is secton id
			'panel'       => 'webenvo-fpsections-panel',
			'description' => __( 'Settings to Display About Section and its Additional features.', 'webenvo' ),
		)
	);

	/** Setting to display about */
	$wp_customize->add_setting(
		'webenvo-about-show',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-about-show-control',
			array(
				'label'    => esc_html__( 'Show About on Frontpage', 'webenvo' ),
				'section'  => 'webenvo-about-section',
				'settings' => 'webenvo-about-show',
			)
		)
	);

	/** Setting to display about on template */
	$wp_customize->add_setting(
		'webenvo-about-show-template',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'webenvo-about-show-template-control',
			array(
				'label'    => esc_html__( 'Display on About-us Template', 'webenvo' ),
				'section'  => 'webenvo-about-section',
				'settings' => 'webenvo-about-show-template',
			)
		)
	);

	// /** Selective refresh about */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo-about-show',
			array(
				'selector' => '.sr-about',
			)
		);
	}
	/** Check about Show Enabled Active callback. */
	function webenvo_if_about_show_control_enabled( $control ) {
		if ( 1 === $control->manager->get_setting( 'webenvo-about-show' )->value() || 1 === $control->manager->get_setting( 'webenvo-about-show-template' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	// heading control.
	$wp_customize->add_setting(
		'webenvo-about-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-about-notice-control',
			array(
				'label'           => __( 'About settings ', 'webenvo' ),
				'settings'        => 'webenvo-about-notice',
				'section'         => 'webenvo-about-section',
				'active_callback' => function( $control ) {
					return ( webenvo_if_about_show_control_enabled( $control ) );
				},
			)
		)
	);
	// About Image Control.
	$wp_customize->add_setting(
		'webenvo-about-image',
		array(
			'default'           => ENVO_COMPANION_PLUGIN_URL. 'inc/webenvo/img/about.jpg',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'webenvo-about-image_control',
			array(
				'label'           => __( 'About Image', 'webenvo' ),
				'description'     => esc_html__( 'Choose Image for About.', 'webenvo' ),
				'section'         => 'webenvo-about-section',
				'settings'        => 'webenvo-about-image',
				'active_callback' => function( $control ) {
					return ( webenvo_if_about_show_control_enabled( $control ) );
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
	/** About section Title  */
	$wp_customize->add_setting(
		'webenvo-about-title',
		array(
			'default'           => esc_html__( 'Consultancy Excellence', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-about-title-control',
			array(
				'label'           => __( 'About Title', 'webenvo' ),
				'section'         => 'webenvo-about-section',
				'settings'        => 'webenvo-about-title',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_about_show_control_enabled( $control ) );
				},
			)
		)
	);
	/** About section Subtitle. */
	$wp_customize->add_setting(
		'webenvo-about-subtitle',
		array(
			'default'           => esc_html__( 'Where can we help', 'webenvo' ),
			'sanitize_callback' => array( $this, 'sanitize_custom_text' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'webenvo-about-subtitle-control',
			array(
				'label'           => __( 'About Subtitle', 'webenvo' ),
				'section'         => 'webenvo-about-section',
				'settings'        => 'webenvo-about-subtitle',
				'type'            => 'text',
				'active_callback' => function( $control ) {
					return ( webenvo_if_about_show_control_enabled( $control ) );
				},
			)
		)
	);

	/** Setting About Information */
	$wp_customize->add_setting(
		'webenvo-about-info',
		array(
			'default'           => '<p>We are dedicated to providing exceptional advisory services and strategic guidance to organizations across various industries. We understand that every client is unique, and we tailor our approach to meet their specific needs and challenges.</p> 
			Our team of highly skilled consultants brings a wealth of expertise and experience to the table. We have a deep understanding of industry trends, emerging technologies, and best practices, enabling us to deliver insightful and innovative solutions.',
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_TinyMCE_Custom_control(
			$wp_customize,
			'webenvo-about-info-control',
			array(
				'label'           => __( 'About Information', 'webenvo' ),
				'description'     => __( 'Edit About Information Both way TEXT ot HTML.', 'webenvo' ),
				'section'         => 'webenvo-about-section',
				'settings'        => 'webenvo-about-info',
				'input_attrs'     => array(
					'toolbar1'     => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'toolbar2'     => 'formatselect outdent indent | blockquote charmap',
					'mediaButtons' => true,
				),
				'active_callback' => function( $control ) {
					return ( webenvo_if_about_show_control_enabled( $control ) );
				},
			)
		)
	);
