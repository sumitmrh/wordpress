<?php
/**
 * Customize Heading control class.
 *
 * @package webenvo
 *
 * @see     WP_Customize_Control
 * @access  public
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Webenvo Upgrade Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Webenvo_Custom_Upgrade_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'webenvo_upgrade';
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$webenvo_upgrade_link = 'https://webenvo.com/premium-themes/webenvo-pro/';
			?>
			<div class="webenvo-upgrade-pro-message simple-notice-custom-control" style="display:none">
				<h4 class="customize-control-title"><?php echo wp_kses_post( 'Upgrade to <a href="' . $webenvo_upgrade_link . '" target="_blank" > WEBENVO Pro </a> to change/add more', 'webenvo' ); ?><?php esc_html_e( ' and additionally get the other premium features.', 'webenvo' ); ?></h4>
			</div>
			<?php
		}
	}
}
