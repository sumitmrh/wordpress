<?php
/**
 * Posts Contents Post Lists.
 *
 * @package webenvo
 */

?>
<article class="post shadow-lg p-4 mt-2 bg-white rounded">
	<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) :

		printf(
			'<p>' . wp_kses(
			/* translators: 1: link to WP admin new post page. */
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'webenvo' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			) . '</p>',
			esc_url( admin_url( 'post-new.php' ) )
		);

	elseif ( is_search() ) :
		?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'webenvo' ); ?></p>
		<?php
		get_search_form();

	else :
		?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'webenvo' ); ?></p>
		<?php
		get_search_form();

	endif;
	?>
</article>
