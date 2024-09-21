<?php
/**
 * Custom Blogs single Page section
 *
 * @package webenvo
 */

/** Section for "Blogs single Page". */
	$wp_customize->add_section(
		'webenvo-blog-single-section',
		array(
			'title'       => 'Single Blog settings',
			'priority'    => 3,
			'panel'       => 'webenvo-options-panel',
			'description' => __( 'Settings for Blogs single Page.', 'webenvo' ),
		)
	);
	/** Blogs single Page Settings Start */

	// Container Size.
		$wp_customize->add_setting(
			'webenvo-blog-single-size',
			array(
				'default'           => 'container',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo-blog-single-size-control',
				array(
					'label'       => __( 'Single Blog size', 'webenvo' ),
					'description' => esc_html__( 'Choose container size of Single Blog page.', 'webenvo' ),
					'section'     => 'webenvo-blog-single-section',
					'settings'    => 'webenvo-blog-single-size',
					'choices'     => array(
						'container'           => __( 'Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'container-full'      => __( 'Full Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'container-fluid' => __( 'fluid', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					),
				)
			)
		);

		// Sidebar Position.
		$wp_customize->add_setting(
			'webenvo-blog-single-sidebar',
			array(
				'default'           => 'sidebarright',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo-blog-single-sidebar-control',
				array(
					'label'       => __( 'Single Blog Sidebar Position', 'webenvo' ),
					'description' => esc_html__( 'Select sidebar visibility or position left or right.', 'webenvo' ),
					'section'     => 'webenvo-blog-single-section',
					'settings'    => 'webenvo-blog-single-sidebar',
					'choices'     => array(
						'sidebarleft'  => array(  // Required.
							'image' => trailingslashit( get_template_directory_uri() ) . 'webenvo-customizer-custom-control/images/sidebar-left-2.png', // Required.
							'name'  => __( 'Left Sidebar', 'webenvo' ), // Required.
						),
						'sidebarnone'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'webenvo-customizer-custom-control/images/sidebar-none-2.png',
							'name'  => __( 'No Sidebar', 'webenvo' ),
						),
						'sidebarright' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'webenvo-customizer-custom-control/images/sidebar-right-2.png',
							'name'  => __( 'Right Sidebar', 'webenvo' ),
						),
					),
				)
			)
		);
