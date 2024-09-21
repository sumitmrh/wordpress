<?php
/**
 *  Theme Functions
 *
 *  @package Webenvo
 */
 update_option( 'siteurl', 'http://test.sumit.com' );
 update_option( 'home', 'http://test.sumit.com' );
// Webenvo URL's.
define( 'WEBENVO_TEMPLATE_URL', get_template_directory_uri() );
define( 'WEBENVO_URL', get_template_directory() );

// Theme version.
$webenvo_theme = wp_get_theme();
define( 'WEBENVO_VERSION', $webenvo_theme->get( 'Version' ) );
define( 'WEBENVO_NAME', $webenvo_theme->get( 'Name' ) );

/** Theme Options. */
function webenvo_theme_options() {

	// Add Theme support Title Tag.
	add_theme_support( 'title-tag' );

	// Logo.
	add_theme_support( 'custom-logo' );

	// Custom Header.
	// add_theme_support( 'custom-header' );

	// Set up the WordPress core custom background feature.
	// add_theme_support(
	// 'custom-background',
	// apply_filters(
	// 'webenvo_cust_back_args',
	// array(
	// 'default-color' => 'ffffff',
	// 'default-image' => '',
	// )
	// )
	// );

	add_editor_style( 'css/editor-style.css' );

	// Featured Image.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'webenvo-thumb', 375, 375, true );

	// RSS Feed.
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// woo-commerce theme support.
	add_theme_support( 'woocommerce' );

	add_theme_support( 'wc-product-gallery-zoom' );

	add_theme_support( 'wc-product-gallery-lightbox' );

	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'webenvo_theme_options' );

/** Remove Header Image and Color Control  */
function webenvo_remove_register( $wp_customize ) {
	$wp_customize->remove_control( 'header_image' );
	$wp_customize->remove_section( 'colors' );
}
add_action( 'customize_register', 'webenvo_remove_register' );

/** Menu File Custom Twenty Twenty  */
require WEBENVO_URL . '/theme-menu/menu-file.php';

/** Initialize Widgets and Sidebar */
function webenvo_widgets_sidebars_init() {
	register_sidebar(
		array(
			'name'          => __( 'Webenvo Blog Sidebar ', 'webenvo' ),
			'id'            => 'webenvo_blogwidget',
			'description'   => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'webenvo' ),
			'before_widget' => '<div class="card-holder double base"><aside id="%1$s" class="widget %2$s card__image shadow-lg p-4 mt-2 bg-white rounded">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Webenvo Footer Widget 1', 'webenvo' ),
			'id'            => 'webenvo_footer_widget_1',
			'description'   => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'webenvo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Webenvo Footer Widget 2', 'webenvo' ),
			'id'            => 'webenvo_footer_widget_2',
			'description'   => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'webenvo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Webenvo Footer Widget 3', 'webenvo' ),
			'id'            => 'webenvo_footer_widget_3',
			'description'   => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'webenvo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'webenvo_widgets_sidebars_init' );


/** Customizer Custom Control Master */
	require WEBENVO_URL . '/webenvo-customizer-custom-control/functions.php';
/** Customizer Control Master */
	require WEBENVO_URL . '/webenvo-native-customizer-control/customizer-alpha-color-picker/class-customizer-alpha-color-control.php';

/**  Customizer Repeater Settings. */

	/** Calling Customizer repeater just before my Custom customizer class. */
	require WEBENVO_URL . '/webenvo-native-customizer-control/customizer-repeater/functions.php';
	/** Customizer Custom Class. */
	require WEBENVO_URL . '/webenvo-customize/webenvo-customizer-main.php';
	/** Custom Control */
	require WEBENVO_URL . '/webenvo-customize/custom-control/webenvo_custom-upgrade-control.php';
	new Webenvo_Customize();
	/**  Enqueue customizer css. */
function webenvo_customize_enqueue() {
	wp_register_style( 'webenvo-customize-style', WEBENVO_TEMPLATE_URL . '/webenvo-customize/customize-styles.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'webenvo-customize-style' );
	// For Customizer Section Scroll.
	wp_register_script( 'section-scroll-js', WEBENVO_TEMPLATE_URL . '/webenvo-customize/section-scroll.js', array(), 1.0, true );
	wp_enqueue_script( 'section-scroll-js' );
}
	add_action( 'customize_controls_enqueue_scripts', 'webenvo_customize_enqueue' );

	// If plugin active Load customizer Defaults.
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( is_plugin_active( 'envo-companion/envo-companion.php' ) ) {
	/** CUSTOMIZER DEFAULTS */
	require WEBENVO_URL . '/webenvo-customize/customize-front-page/repeater_defaults.php';
	/** Sections Order Custom Settings  */
	require WEBENVO_URL . '/webenvo-native-customizer-control/customizer-sections-order/customizer-sections-order.php';
}

	/** TOP BAR CUSTOMIZER REPEATER DEFAULT VALUES */
	define(
		'TOPBAR_DEFAULTS',
		wp_json_encode(
			array(
				/* Repeater's first team */
				array(
					'title'           => 'Selected Social Icons',
					'social_repeater' => '[{&quot;icon&quot;:&quot;fa-brands fa-twitter&quot;,&quot;link&quot;:&quot;#&quot;,&quot;id&quot;:&quot;cr-social-repeater-topbar-twitter&quot;},{&quot;icon&quot;:&quot;fa-brands fa-facebook&quot;,&quot;link&quot;:&quot;#&quot;,&quot;id&quot;:&quot;cr-social-repeater-topbar-fb&quot;},{&quot;icon&quot;:&quot;fa-brands fa-instagram&quot;,&quot;link&quot;:&quot;#&quot;,&quot;id&quot;:&quot;cr-social-repeater-topbar-instagram&quot;}]',
					'id'              => 'cr_topbar_social_1',
				),
			)
		)
	);


	/**
	 * Enqueue admin scripts and styles. Only For Free version
	 */
	function webenvo_admin_enqueue_scripts() {

		// Styles For Get Started Admin Notice.
		wp_register_style( 'webenvo-gs-admin-style', get_template_directory_uri() . '/assets/admin/css/admin-styles.css', array(), 1.0, false );
		wp_enqueue_style( 'webenvo-gs-admin-style' );
		// Fontawesone.
		wp_register_style( 'font-awesome-all-min-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/fontawesome/css/all.min.css', array(), 1.0, false );
		wp_enqueue_style( 'font-awesome-all-min-css' );

		// Get Started Button object.
		wp_register_script( 'webenvo-gs-admin-script', WEBENVO_TEMPLATE_URL . '/assets/admin/js/webenvo-admin-script.js', array( 'jquery' ), 1.0, true );
		wp_enqueue_script( 'webenvo-gs-admin-script' );
		wp_localize_script(
			'webenvo-gs-admin-script',
			'webenvo_gs_ajax_object',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
		);
		// Bootstrap.
		wp_register_style( 'admin-bootstrap-min-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/bootstrap/css/bootstrap.min.css', array(), 5.0 );
	}
	add_action( 'admin_enqueue_scripts', 'webenvo_admin_enqueue_scripts' );

	/** Skeleton. */
	function webenvo_skeleton() {

		// Google Fonts Library.
		wp_register_style( 'webenvo_font', 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap', array(), 1.0, false );
		wp_enqueue_style( 'webenvo_font' );

		// Bootstrap.
		wp_register_style( 'bootstrap-min-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/bootstrap/css/bootstrap.min.css', array(), 5.0 );
		wp_enqueue_style( 'bootstrap-min-css' );

		// Animate.
		wp_register_style( 'animate-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/animate/animate.min.css', array(), 1.0, false );
		wp_enqueue_style( 'animate-css' );

		// Fontawesone.
		wp_register_style( 'font-awesome-all-min-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/fontawesome/css/all.min.css', array(), 1.0, false );
		wp_enqueue_style( 'font-awesome-all-min-css' );

		// Swiper.
		wp_register_style( 'Swiper-min-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/swiper/swiper.min.css', array(), 1.0, false );
		wp_enqueue_style( 'Swiper-min-css' );

		// Owl Carousel.
		wp_register_style( 'owl-carousel-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/owl-carousel/owl.carousel.min.css', array(), 1.0, false );
		wp_enqueue_style( 'owl-carousel-css' );

		// Odometer.
		wp_register_style( 'odometer-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/odometer/odometer.min.css', array(), 1.0, false );
		wp_enqueue_style( 'odometer-css' );

		// BxSlider.
		wp_register_style( 'bxslider-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/bxslider/css/jquery.bxslider.css', array(), 1.0, false );
		wp_enqueue_style( 'bxslider-css' );

		// Switcher.
		wp_register_style( 'switcher-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/switcher/switcher.css', array(), 1.0, false );
		wp_enqueue_style( 'switcher-css' );

		wp_register_style( 'webenvo-skin-default', WEBENVO_TEMPLATE_URL . '/assets/css/colors/skin-default.css', array(), 1.0, false );
		wp_enqueue_style( 'webenvo-skin-default' );

		/** Webenvo Stylesheets. */
		wp_register_style( 'webenvo-style-css', get_stylesheet_uri(), array(), filemtime( WEBENVO_URL . '/style.css' ), 'all' );
		wp_enqueue_style( 'webenvo-style-css' );

		// fetching custom Colors.
		require get_stylesheet_directory() . '/webenvo-customize/custom-styling-colors/fetch-styling.php';
		$webenvo_custom_styling_css = webenvo_get_styling_css();
		// Modify stylesheet with custom colors.
		wp_add_inline_style( 'webenvo-style-css', $webenvo_custom_styling_css );

		// wp_enqueue_style( 'webenvo-responsive-css', WEBENVO_TEMPLATE_URL . '/assets/css/aivons-responsive.css', array(), filemtime( WEBENVO_URL . '/assets/css/webenvo-responsive.css' ), 'all' );

		// Menu Style.
		wp_register_style( 'menu-style-css', WEBENVO_TEMPLATE_URL . '/theme-menu/menu-css.css', array(), 1.0, false );
		wp_enqueue_style( 'menu-style-css' );

		// RTL Support.
		// wp_enqueue_style( 'rtl-support-css', WEBENVO_TEMPLATE_URL . '/assets/css/aivons-rtl.css', array(), false );
		// Switcher.
		// wp_enqueue_style( 'switcher-css', WEBENVO_TEMPLATE_URL . '/assets/vendors/switcher/switcher.css', array(), false );
		// Colors.
		// wp_enqueue_style( 'skin-colors-css', WEBENVO_TEMPLATE_URL . '/assets/css/colors/skin-default.css', array(), false );

		// WEBENVO all Scripts.

		wp_enqueue_script( 'jquery' );

		wp_register_script( 'jquery-appear-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/jquery-appear/jquery.appear.min.js', array(), 1.0, true );
		wp_enqueue_script( 'jquery-appear-js' );

		wp_register_script( 'jquery-easing-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/jquery-easing/jquery.easing.min.js', array(), 1.0, true );
		wp_enqueue_script( 'jquery-easing-js' );

		// Bootstrap-JS.
		wp_register_script( 'bootstrap-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/bootstrap/js/bootstrap.bundle.min.js', array(), 5.0, true );
		wp_enqueue_script( 'bootstrap-js' );

		wp_register_script( 'wow-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/wow/wow.js', array(), 1.0, true );
		wp_enqueue_script( 'wow-js' );

		wp_register_script( 'isotope-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/isotope/isotope.js', array(), 1.0, true );
		wp_enqueue_script( 'isotope-js' );

		wp_register_script( 'countdown-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/countdown/countdown.min.js', array(), 1.0, true );
		wp_enqueue_script( 'countdown-js' );

		wp_register_script( 'owl-carousel-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/owl-carousel/owl.carousel.min.js', array(), 1.0, true );
		wp_enqueue_script( 'owl-carousel-js' );
		// wp_enqueue_script( 'twenty-move-event-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/twentytwenty/jquery.event.move.js', array(), false, true );
		wp_register_script( 'odometer-js', WEBENVO_TEMPLATE_URL . '/assets/vendors/odometer/odometer.min.js', array(), 1.0, true );
		wp_enqueue_script( 'odometer-js' );

		// template js.
		wp_register_script( 'webenvo-scripts-js', WEBENVO_TEMPLATE_URL . '/assets/js/webenvo.js', array(), 1.0, true );
		wp_enqueue_script( 'webenvo-scripts-js' );

		// JS navigation.
		wp_register_script( 'webenvo-navigation', WEBENVO_TEMPLATE_URL . '/assets/js/navigation.js', array(), 1.0, true );
		wp_enqueue_script( 'webenvo-navigation' );
	}
	add_action( 'wp_enqueue_scripts', 'webenvo_skeleton' );

	// Starter Contents.

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 *//*
	if ( is_customize_preview() ) {
		require get_template_directory() . '/template-parts/webenvo-starter-content.php';
		add_theme_support( 'starter-content', webenvo_get_starter_content() );
	}*/

	/** Webenvo Extras */
	require WEBENVO_URL . '/webenvo-customize/custom-extras/extras-page.php';

	/** Position Admin Bar if Admin logged in */
	function webenvo_adminbar_setup() {
		add_theme_support( 'admin-bar', array( 'callback' => 'webenvo_admin_bar_css' ) );
	}
	add_action( 'after_setup_theme', 'webenvo_adminbar_setup' );
	/** CSS for admin bar. */
	function webenvo_admin_bar_css() { ?>
	<style>
		/* .home {
			margin-top: 32px !important;
		} */
		.header {
			top: 32px !important;
		}
		.webenvo-sticky-top {
			top: -128px !important;
		}
		@media screen and ( max-width: 782px ) {
			.header {
			top: 46px !important;
		}
		}
	</style>
		<?php
	}

	/** Add User Meta For users Social Links  */
	// Add user contact methods.
	// add_filter( 'user_contactmethods', 'wpse_user_contactmethods', 10, 1 );
	// function wpse_user_contactmethods( $contact_methods ) {
	// $contact_methods['facebook'] = __( 'Facebook URL', 'webenvo' );
	// $contact_methods['twitter']  = __( 'Twitter URL', 'webenvo' );
	// $contact_methods['linkedin'] = __( 'LinkedIn URL', 'webenvo' );
	// $contact_methods['youtube']  = __( 'YouTube URL', 'webenvo' );

	// return $contact_methods;
	// }

	/**  Moves the comment text area field to the bottom. */
	function webenvo_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}
	add_filter( 'comment_form_fields', 'webenvo_move_comment_field_to_bottom' );

	/** Woocommerce Cart Icon */
	require WEBENVO_URL . '/cart-icon/cart-icon.php';


	/** Plugin Notice */
	if ( ! is_plugin_active( 'envo-companion/envo-companion.php' ) ) {
		function webenvo_customizer_repeater_scripts() {
			wp_enqueue_script( 'webenvo_repeater_msg', get_template_directory_uri() . '/webenvo-customize/custom-notice/custom-msg.js', array( 'jquery' ), '1.0', true );
			wp_localize_script(
				'webenvo_repeater_msg',
				'ajax_var',
				array(
					'url'      => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'updates' ),
					'actnonce' => wp_create_nonce( 'actupdates' ),
				)
			);
		}
		add_action( 'customize_controls_print_scripts', 'webenvo_customizer_repeater_scripts' );
		add_action( 'wp_ajax_action_install_plugin', 'wp_ajax_install_plugin' );
		add_action( 'wp_ajax_activate_plugin', 'webenvo_activate_plugin' );
		function webenvo_activate_plugin() {
			if ( ! wp_verify_nonce( $_POST['actnonce'], 'actupdates' ) ) {
				// nonce is invalid.
				wp_send_json_error( 'Invalid Nonce' );
				return;
			}
			$plugin = $_POST['plugin'];
			$result = activate_plugin( $plugin );
			if ( is_wp_error( $result ) ) {
				wp_send_json_error( $result->get_error_message() );
			} else {
				wp_send_json_success();
			}
		}
	}
	/** Custom mgs Front Panel */
	if ( is_plugin_active( 'envo-companion/envo-companion.php' ) ) {
		function webenvo_fp_msg_script() {
			wp_enqueue_script( 'webenvo_fp_msg_script', get_template_directory_uri() . '/webenvo-customize/custom-notice/custom-fp-msg.js', array( 'customize-controls' ), '1.0', true );
		}
		add_action( 'customize_controls_enqueue_scripts', 'webenvo_fp_msg_script' );
	}
	/**
	 * Demo Content.
	 * OCDI install scripts already presented with Template Tags.
	 */
	if ( is_plugin_active( 'envo-companion/envo-companion.php' ) ) {
		require ENVO_COMPANION_PLUGIN_DIR . '/inc/webenvo/demo-content/setup.php';

	}

