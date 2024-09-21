<?php
/**
 * @package webenvo Starter Sites
 * @since 1.0
 */


/**
 * Set import files
 */
if ( ! function_exists( 'webenvo_starter_sites_import_files' ) ) {

	function webenvo_starter_sites_import_files() {

		// Demos url.
		$demo_url = ENVO_COMPANION_PLUGIN_URL;

		return array(
			array(
				'import_file_name'           => esc_html__( 'Webenvo', 'webenvo' ),
				'categories'                 => array( 'Free Demos' ),
				'import_file_url'            => $demo_url . 'inc/webenvo/demo-content/webenvo/webenvo.xml',
				'import_widget_file_url'     => $demo_url . 'inc/webenvo/demo-content/webenvo/webenvo.wie',
				'import_customizer_file_url' => $demo_url . 'inc/webenvo/demo-content/webenvo/webenvo.dat',
				'preview_url'                => 'https://webenvo.com/webenvo',
				'import_preview_image_url'   => ENVO_COMPANION_PLUGIN_URL . '/inc/webenvo/img/demo-screenshots/webenvo.png',
			),
			array(
				'import_file_name'           => esc_html__( 'Webenvo Pro', 'webenvo' ),
				'categories'                 => array( 'Pro Demos' ),
				'preview_url'                => 'https://webenvo.com/webenvo-pro',
				'import_preview_image_url'   => ENVO_COMPANION_PLUGIN_URL . '/inc/webenvo/img/demo-screenshots/webenvo-pro.webp',
			),
		);
	}
}
add_filter( 'ocdi/import_files', 'webenvo_starter_sites_import_files' );

/**
 * Define actions that happen after import
 */
if ( ! function_exists( 'webenvo_starter_sites_after_import_mods' ) ) {

	function webenvo_starter_sites_after_import_mods( $selected_import ) {

		$menu_name        = '';
		$front_page_title = '';
		$import_file_name = $selected_import['import_file_name'];

		switch ( $import_file_name ) {
			case 'Envo Business':
				$menu_name        = 'Envo Menu';
				$front_page_title = 'Envo Home';
				break;
			case 'Envo Pro':
				$menu_name        = 'Envo Pro Menu';
				$front_page_title = 'Envo Home';
				break;
		}

		// Assign the menu.
		$main_menu = get_term_by( 'name', $menu_name, 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array( 'primary' => $main_menu->term_id ) );

		// Assign the static front page and the blog page.
		$front_page = get_page_by_title( $front_page_title );
		$blog_page  = get_page_by_title( 'Blog' );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page->ID );
		update_option( 'page_for_posts', $blog_page->ID );

		// Set the front page template to 'page-templates/frontpage.php'.
		$front_page_template = '/page-templates/frontpage.php';
		update_post_meta( $front_page->ID, '_wp_page_template', $front_page_template );

	}
}
add_action( 'ocdi/after_import', 'webenvo_starter_sites_after_import_mods' );


// Custom CSS for OCDI plugin.
function webenvo_starter_sites_ocdi_css() { ?>
	<style >
		.ocdi__gl-item:nth-child(n+2) .ocdi__gl-item-buttons .button-primary, .ocdi .ocdi__theme-about, .ocdi__intro-text {
			display: none;
		}
		.ocdi__gl-item-image-container::after {
			padding-top: 75% !important;
		}

	</style>
	<?php
}
add_action( 'admin_enqueue_scripts', 'webenvo_starter_sites_ocdi_css' );

// Change the "One Click Demo Import" name from "Starter Sites" in Appearance menu.
function webenvo_starter_sites_ocdi_plugin_page_setup( $default_settings ) {

	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Webenvo Demo Import', 'webenvo' );
	$default_settings['menu_title']  = esc_html__( 'Webenvo Starter Sites', 'webenvo' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'one-click-demo-import';

	return $default_settings;

}
add_filter( 'ocdi/plugin_page_setup', 'webenvo_starter_sites_ocdi_plugin_page_setup' );

// Register required plugins for the demos.
function webenvo_starter_sites_register_plugins( $plugins ) {

 	// List of plugins used by all theme demos.
 	$theme_plugins = array(
 		array(
 			'name'     => 'Coming Soon Maintenance Mode',
 			'slug'     => 'coming-soon-maintenance-mode',
 			'required' => true,
 		),
 	);

 	return array_merge( $plugins, $theme_plugins );

}
 add_filter( 'ocdi/register_plugins', 'webenvo_starter_sites_register_plugins' );


function ocdi_change_time_of_single_ajax_call() {
	return 10;
}
add_filter( 'ocdi/time_for_one_ajax_call', 'ocdi_change_time_of_single_ajax_call' );

/**
* Remove branding
*/
// add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
