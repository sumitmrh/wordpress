<?php
/**
 * Custom Title and Background.
 *
 * @package webenvo
 */

	/** Section for "Page Title". */
	$wp_customize->add_section(
		'webenvo-title-section',
		array(
			'title'       => __( 'Page/Blog Title settings', 'webenvo' ),
			'priority'    => 6,
			'description' => __( 'Settings For title visibility and background..', 'webenvo' ),
			'panel'       => 'webenvo-options-panel',
		)
	);
	// heading control.
	$wp_customize->add_setting(
		'webenvo-title-notice',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'skyrocket_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Simple_Notice_Custom_control(
			$wp_customize,
			'webenvo-title-notice-control',
			array(
				'label'    => __( 'Title Section settings ', 'webenvo' ),
				'settings' => 'webenvo-title-notice',
				'section'  => 'webenvo-title-section',
			)
		)
	);

	// Title Image Control.
	$wp_customize->add_setting(
		'webenvo-title-image',
		array(
			'default'           => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/page-header.jpg',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'webenvo-title-image_control',
			array(
				'label'         => __( 'Title Background Image', 'webenvo' ),
				'description'   => esc_html__( 'Choose Image for Title Background. Best fit : (width 1920px) by (any desired height: default 731px)', 'webenvo' ),
				'section'       => 'webenvo-title-section',
				'settings'      => 'webenvo-title-image',
				'button_labels' => array( // Optional.
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
	// TITLE Overlay Color.
		$wp_customize->add_setting(
			'webenvo_title_overlay',
			array(
				'default'           => 'rgba(0,9,15,0.8)',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization',
			)
		);
		$wp_customize->add_control(
			new Webenvo_Customizer_Alpha_Color_Control(
				$wp_customize,
				'webenvo_title_overlay_control',
				array(
					'label'       => __( 'TITLE Overlay Color', 'webenvo' ),
					// 'description' => esc_html__( 'Sample color control with Alpha channel','webenvo' ),
					'settings'    => 'webenvo_title_overlay',
					'section'     => 'webenvo-title-section',
					'input_attrs' => array(
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
