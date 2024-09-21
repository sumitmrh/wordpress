<?php
/**
 * Custom Blogs Landing Page section
 *
 * @package webenvo
 */

/** Section for "Blogs Landing Page". */
	$wp_customize->add_section(
		'webenvo-blogs-land-section',
		array(
			'title'       => 'Page settings',
			'priority'    => 3,
			'panel'       => 'webenvo-options-panel',
			'description' => __( 'Settings for Blogs Landing Page.', 'webenvo' ),
		)
	);
	/** Blogs Landing Page Settings Start */

	// Container Size.
		$wp_customize->add_setting(
			'webenvo-blogs-land-size',
			array(
				'default'           => 'container',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo-blogs-land-size-control',
				array(
					'label'       => __( 'Landing Page/Blogs size', 'webenvo' ),
					'description' => esc_html__( 'Choose container size of all blogs landing page.', 'webenvo' ),
					'section'     => 'webenvo-blogs-land-section',
					'settings'    => 'webenvo-blogs-land-size',
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
			'webenvo-blogs-land-sidebar',
			array(
				'default'           => 'sidebarright',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo-blogs-land-sidebar-control',
				array(
					'label'       => __( 'Page Sidebar Position', 'webenvo' ),
					'description' => esc_html__( 'Select sidebar visibility or position left or right.', 'webenvo' ),
					'section'     => 'webenvo-blogs-land-section',
					'settings'    => 'webenvo-blogs-land-sidebar',
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
