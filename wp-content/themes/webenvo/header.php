<?php
/**
 *
 * Header File
 *
 * @package Webenvo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'home woocommerce' ); ?> >

<?php if ( get_theme_mod( 'webenvo-loader-show' ) === 1 ) { ?>
	<!-- Page Loader/Loading animation -->
	<div id="webenvo-loading">
		<div class="webenvo-loader">
			<div class="webenvo-loading-square"></div>
			<div class="webenvo-loading-square"></div>
			<div class="webenvo-loading-square"></div>
			<div class="webenvo-loading-square"></div>
		</div>
	</div>
<?php } ?>
<?php wp_body_open(); ?>

<header id="site-header" class="header header-footer-group" role="banner">
	<?php $webenvo_menu_size_class = get_theme_mod( 'webenvo-menu-size', 'container' ); ?>
	<div class="<?php echo esc_attr( $webenvo_menu_size_class ); ?>">
		<?php if ( get_theme_mod( 'webenvo-topbar-show', 1 ) === 1 ) { ?>
			<!-- Topbar -->
			<?php get_template_part( 'template-parts/frontpage', 'topbar' ); ?>
		<?php } ?>

		<!-- Nav Menu -->
		<?php get_template_part( 'twenty', 'menu' ); ?>
	</div>
</header>
	<!-- Output the menu modal. -->
	<?php get_template_part( 'theme-menu/modal-menu' ); ?>
	<!-- Clear Fix for divs -->
	<div class="clearfix"></div>

	<?php
	// For section padding adjustments.
	if ( is_home() && is_front_page() ) {
		if ( current_user_can( 'manage_options' ) ) {
			$wrapper_padding = 'padding-top: 12.3rem;';
		} else {
			$wrapper_padding = 'padding-top: 11.5rem;';
		}
	} else {
		$wrapper_padding = '';
	}
	?>
<!-- Theme Container Wrapper  -->
<div class="theme-wrapper" style="<?php echo esc_attr( $wrapper_padding ); ?>">
