<?php
/**
 * Custom Copyright section
 *
 * @package webenvo
 */

/** Section for "Copyright". */
	$wp_customize->add_section(
		'webenvo-copyright-section',
		array(
			'title'       => 'Copyright settings',
			'priority'    => 3,
			'panel'       => 'webenvo-options-panel',
			'description' => __( 'Settings to Adjust Copyrights.', 'webenvo' ),
		)
	);
	/** Copyright Settings Start */

	/** Setting Copyright Information */
	$wp_customize->add_setting(
		'webenvo_copyright',
		array(
			'default'           => '<p>Copyright © Webenvo 2022. Created By <a href="#"><b>WP Frank</b></a></p>',
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_TinyMCE_Custom_control(
			$wp_customize,
			'webenvo_copyright_control',
			array(
				'label'       => __( 'Copyright Information', 'webenvo' ),
				'description' => __( 'Edit Copyright Information Both way TEXT ot HTML.', 'webenvo' ),
				'section'     => 'webenvo-copyright-section',
				'settings'    => 'webenvo_copyright',
				'input_attrs' => array(
					'toolbar1'     => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'toolbar2'     => 'formatselect outdent indent | blockquote charmap',
					'mediaButtons' => true,
				),
			)
		)
	);
	/** Selective refresh copyright */
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'webenvo_copyright',
			array(
				'selector' => '.sr-copyright',
			)
		);
	}
