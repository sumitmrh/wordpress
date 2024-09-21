<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Fetch theme parts.
 *
 * @package webenvo-companion.
 */

// Frontpage Sections.
if ( ! function_exists( 'webenvo_frontpage_sections' ) ) :
	/** Fetch Frontpage sections. */
	function webenvo_frontpage_sections() {
		// Diffrent Themes.
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-carousel.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-about.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-service.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-portfolio.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-callout.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-team.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-testimonial.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-funfact.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-news.php';

		require ENVO_COMPANION_PLUGIN_DIR . 'inc/webenvo/front-page/index-sponsor.php';

	}
	add_action( 'webenvo_frontpage', 'webenvo_frontpage_sections' );
endif;
