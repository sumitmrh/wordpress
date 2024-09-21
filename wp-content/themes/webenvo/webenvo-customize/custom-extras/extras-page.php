<?php
/**
 * Submenu page for extras.
 *
 * @package webenvo
 */

function register_webenvo_extras_submenu_page() {
	add_theme_page(
		'Webenvo Extras', // Page title.
		'Webenvo Extras', // Menu title.
		'manage_options', // Capability required to access the page.
		'webenvo-extras', // Menu slug.
		'webenvo_extras_page_callback', // Callback function to display the page content.
		5 // Menu position.
	);
}
add_action( 'admin_menu', 'register_webenvo_extras_submenu_page' );

function webenvo_extras_page_callback() {
	wp_enqueue_style( 'admin-bootstrap-min-css' );

	// Enqueue custom CSS for the submenu page.
	wp_register_style( 'webenvo-extras-css', get_template_directory_uri() . '/webenvo-customize/custom-extras/extras-page.css', array(), 1.0, false );
	wp_enqueue_style( 'webenvo-extras-css' );
	// Extras Page Template.
	get_template_part( 'webenvo-customize/custom-extras/extras-template' );
}

/** Extras Install Scripts */
function webenvo_extras_action_handler() {
	// Enqueue and localize the JavaScript file.
	wp_register_script( 'webenvo-extras-script', get_template_directory_uri() . '/webenvo-customize/custom-extras/extras-scripts.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'webenvo-extras-script' );
	wp_localize_script(
		'webenvo-extras-script',
		'webenvoExtrasAjax',
		array(
			'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
			'extnonce' => wp_create_nonce( 'extra-nonce' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'webenvo_extras_action_handler' );
// Enqueue the admin-ajax.php file.
//wp_enqueue_script( 'wp-ajax' );

// Process the AJAX request to install and activate plugins.
add_action( 'wp_ajax_extras_plugin_install', 'extras_install_plugin' );
add_action( 'wp_ajax_extras_plugin_update', 'extras_update_plugin' );
add_action( 'wp_ajax_extras_plugin_activate', 'extras_activate_plugin' );

// Process the AJAX request to install, update, and activate themes.
add_action( 'wp_ajax_extras_theme_install', 'extras_install_theme' );
add_action( 'wp_ajax_extras_theme_activate', 'extras_activate_theme' );
add_action( 'wp_ajax_extras_theme_update', 'extras_update_theme' );

function extras_install_plugin() {
	// Verify the nonce for install action.
	$extnonce = $_POST['extnonce'];
	if ( ! wp_verify_nonce( $extnonce, 'extra-nonce' ) ) {
		wp_send_json_error( 'Invalid nonce.' );
	}

	// Retrieve the plugin slug.
	$extplugin_slug = $_POST['slug'];

	// Include the necessary files.
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	// Get plugin information.
	$get_plugin_info = plugins_api( 'plugin_information', array( 'slug' => sanitize_key( wp_unslash( $extplugin_slug ) ) ) );
	// Create the plugin upgrader instance.
	$upgrader = new Plugin_Upgrader( new Plugin_Upgrader_Skin( compact( 'title', 'url', 'nonce', 'plugin', 'api' ) ) );

	// Install the plugin.
	$result = $upgrader->install( $get_plugin_info->download_link );

	// Check the installation result.
	if ( is_wp_error( $result ) ) {
		wp_send_json_error( 'Plugin installation failed.' );
	}

	// Send response.
	extras_activate_plugin();
	wp_send_json_success( 'Plugin installed successfully.' );
}

function extras_update_plugin() {
	// Verify the nonce for update action.
	$nonce = $_POST['extnonce'];
	if ( ! wp_verify_nonce( $nonce, 'extra-nonce' ) ) {
		wp_send_json_error( 'Invalid nonce.' );
	}

	// Retrieve the plugin slug.
	$extplugin_slug = $_POST['slug'];

	// Include the necessary files.
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	// Get plugin information.
	$get_plugin_info = plugins_api( 'plugin_information', array( 'slug' => sanitize_key( wp_unslash( $extplugin_slug ) ) ) );
	// Create the plugin upgrader instance.
	$upgrader = new Plugin_Upgrader( new Plugin_Upgrader_Skin( compact( 'title', 'url', 'nonce', 'plugin', 'api' ) ) );

	// Update the plugin.
	$result = $upgrader->upgrade( $get_plugin_info->download_link );

	// Check the update result.
	if ( is_wp_error( $result ) ) {
		wp_send_json_error( 'Plugin update failed.' );
	}

	// Send response.
	wp_send_json_success( 'Plugin updated successfully.' );
}

function extras_activate_plugin() {
	// Verify the nonce for activate action.
	$nonce = $_POST['extnonce'];
	if ( ! wp_verify_nonce( $nonce, 'extra-nonce' ) ) {
		wp_send_json_error( 'Invalid nonce.' );
	}

	// Retrieve the plugin slug.
	$plugin_slug = $_POST['slug'];

	// Include the necessary files.
	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	// Activate the plugin.
	$activate_result = activate_plugin( $plugin_slug . '/' . $plugin_slug . '.php' );

	// Check the activation result.
	if ( is_wp_error( $activate_result ) ) {
		wp_send_json_error( 'Plugin activation failed.' );
	}

	// Send response.
	wp_send_json_success( 'Plugin activated successfully.' );
}

// Theme functions.
function extras_install_theme() {
	// Verify the nonce for install action.
	$extnonce = $_POST['extnonce'];
	if ( ! wp_verify_nonce( $extnonce, 'extra-nonce' ) ) {
		wp_send_json_error( 'Invalid nonce.' );
	}

	// Retrieve the theme slug.
	$exttheme_slug = $_POST['slug'];

	// Include the necessary files.
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once ABSPATH . 'wp-admin/includes/theme-install.php';

	// Get theme information.
	$get_theme_info = themes_api( 'theme_information', array( 'slug' => sanitize_key( wp_unslash( $exttheme_slug ) ) ) );

	// Create the theme upgrader instance.
	$upgrader = new Theme_Upgrader( new Theme_Upgrader_Skin( compact( 'title', 'url', 'nonce', 'theme' ) ) );

	// Install the theme.
	$result = $upgrader->install( $get_theme_info->download_link );

	// Check the installation result.
	if ( is_wp_error( $result ) ) {
		wp_send_json_error( 'Theme installation failed.' );
	}

	// Send response.
	wp_send_json_success( 'Theme installed successfully.' );
}

function extras_update_theme() {
	// Verify the nonce for update action.
	$nonce = $_POST['extnonce'];
	if ( ! wp_verify_nonce( $nonce, 'extra-nonce' ) ) {
		wp_send_json_error( 'Invalid nonce.' );
	}

	// Retrieve the theme slug.
	$theme_slug = $_POST['slug'];

	// Include the necessary files.
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once ABSPATH . 'wp-admin/includes/theme-install.php';

	// Get theme information.
	$get_theme_info = themes_api( 'theme_information', array( 'slug' => sanitize_key( wp_unslash( $theme_slug ) ) ) );

	// Create the theme upgrader instance.
	$upgrader = new Theme_Upgrader( new Theme_Upgrader_Skin( compact( 'title', 'url', 'nonce', 'theme' ) ) );

	// Update the theme.
	$result = $upgrader->upgrade( $get_theme_info->download_link );

	// Check the update result.
	if ( is_wp_error( $result ) ) {
		wp_send_json_error( 'Theme update failed.' );
	}

	// Send response.
	wp_send_json_success( 'Theme updated successfully.' );
}
