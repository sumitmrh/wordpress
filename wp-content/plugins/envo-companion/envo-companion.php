<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
* Plugin Name:  Envo Companion
* Plugin URI:   https://wordpress.org/plugins/envo-companion
* Description:  Envo Companion plugin provides themes extra settings for theme envo.
* Version:      0.0.6
* Author:       Webenvo
* Author URI:   https://webenvo.com/
* Tested up to: 6.2
* Requires:     4.0 or higher
* License:      GPLv3 or later
* License URI:  http://www.gnu.org/licenses/gpl-3.0.html
* Requires PHP: 4.0 tested up to 8.0.26
* Text Domain:  envo-companion
* Domain Path:  /languages
*/

/*
Envo Companion is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Envo Companion is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Envo Companion. If not, see http://www.gnu.org/licenses/gpl-3.0.html.
*/

define( 'ENVO_COMPANION_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ENVO_COMPANION_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


if ( ! function_exists( 'envo_companion_init' ) ) {
	/** Initialize Companion Plugin */
	function envo_companion_init() {
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;
		if ( 'Webenvo' == $activate_theme ) {
			require 'inc/webenvo/webenvo.php';
		}

	}
	add_action( 'init', 'envo_companion_init' );
}

/** Plugin activation. */
function envo_companion_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/envo-companion-activator.php';
	Envo_Companion_Activator::activate();
}
register_activation_hook( __FILE__, 'envo_companion_activate' );
