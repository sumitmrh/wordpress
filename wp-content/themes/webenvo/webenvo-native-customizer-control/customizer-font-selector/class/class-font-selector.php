<?php
/**
 * Font selector.
 *
 * @package customizer-controls
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Class Webenvo_Font_Selector
 */
class Webenvo_Font_Selector extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'selector-font';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'select-script', get_template_directory_uri() . '/customizer-font-selector/js/select.js', array( 'jquery' ), WEBENVO_FONT_SELECTOR_VERSION, true );
		wp_enqueue_style( 'select-style', get_template_directory_uri() . '/customizer-font-selector/css/select.css', null, WEBENVO_FONT_SELECTOR_VERSION );
		wp_enqueue_script( 'typography-js', get_template_directory_uri() . '/customizer-font-selector/js/typography.js', array( 'jquery', 'select-script' ), WEBENVO_FONT_SELECTOR_VERSION, true );
		wp_enqueue_style( 'typography', get_template_directory_uri() . '/customizer-font-selector/css/typography.css', null );
	}

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper in $this->render().
	 *
	 * @access protected
	 */
	protected function render_content() {
		$this_val = $this->value(); ?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<select class="typography-select" <?php $this->link(); ?>>
				<option value="" 
				<?php
				if ( ! $this_val ) {
					echo 'selected="selected"';}
				?>
><?php esc_html_e( 'Default', 'webenvo' ); ?></option>
				<?php
				// Get Standard font options
				$std_fonts = webenvo_font_selector_get_standard_fonts();
				if ( ! empty( $std_fonts ) ) {
					?>
					<optgroup label="<?php esc_attr_e( 'Standard Fonts', 'webenvo' ); ?>">
						<?php
						// Loop through font options and add to select
						foreach ( $std_fonts as $font ) {
							?>
							<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_val ); ?>><?php echo esc_html( $font ); ?></option>
						<?php } ?>
					</optgroup>
					<?php
				}

				// Google font options
				$google_fonts = webenvo_font_selector_get_google_fonts_array();
				if ( ! empty( $google_fonts ) ) {
					?>
					<optgroup label="<?php esc_attr_e( 'Google Fonts', 'webenvo' ); ?>">
						<?php
						// Loop through font options and add to select
						foreach ( $google_fonts as $font ) {
							?>
							<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_val ); ?>><?php echo esc_html( $font ); ?></option>
						<?php } ?>
					</optgroup>
				<?php } ?>
			</select>

		</label>

		<?php
	}
}
