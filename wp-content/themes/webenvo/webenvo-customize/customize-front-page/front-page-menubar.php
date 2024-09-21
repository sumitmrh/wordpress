<?php
/**
 * Custom Menu Bar section
 *
 * @package webenvo
 */

/** Section for "Menu Bar". */
	$wp_customize->add_section(
		'webenvo-menubar-section',
		array(
			'title'       => __( 'Menu Bar settings', 'webenvo' ),
			'priority'    => 2,
			'panel'       => 'webenvo-options-panel',
			'description' => __( 'Settings to Display Menubar Additional features.', 'webenvo' ),
		)
	);

	/** Menu Bar Settings Start */
		// Container Size.
		$wp_customize->add_setting(
			'webenvo-menu-size',
			array(
				'default'           => 'container',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo-menu-size-control',
				array(
					'label'       => __( 'Menu size', 'webenvo' ),
					'description' => esc_html__( 'Choose size of menu.', 'webenvo' ),
					'section'     => 'webenvo-menubar-section',
					'settings'    => 'webenvo-menu-size',
					'choices'     => array(
						'container'           => __( 'Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'container-full'      => __( 'Full Container', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'container-fluid p-0' => __( 'fluid', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					),
				)
			)
		);
		/** Selective refresh menubar */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'webenvo-menu-size',
				array(
					'selector' => '.sr-menubar',
				)
			);
		}
		// Sticky.
		$wp_customize->add_setting(
			'webenvo-menu-sticky',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'webenvo-menu-sticky-control',
				array(
					'label'       => __( 'Menu Sticky', 'webenvo' ),
					'description' => __( 'Choose sticky setting of menu.', 'webenvo' ),
					'section'     => 'webenvo-menubar-section',
					'settings'    => 'webenvo-menu-sticky',
					'choices'     => array(
						''                     => __( 'Default', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
						'webenvo-header-inner' => __( 'Sticky', 'webenvo' ), // Required. Setting for this particular radio button choice and the text to display.
					),
				)
			)
		);

		/** Setting to Enable/Disable Search Icon */
		$wp_customize->add_setting(
			'webenvo-searchicon-show',
			array(
				'default'           => 1,
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'webenvo-searchicon-show-control',
				array(
					'label'    => ( 'Search Icon Show' ),
					'section'  => 'webenvo-menubar-section',
					'settings' => 'webenvo-searchicon-show',
				)
			)
		);
