<?php
/**
 * Menu from Twenty-Twenty.
 *
 * @package webenvo
 */ ?>

<?php $sticky_head_id = get_theme_mod( 'webenvo-menu-sticky' ); ?>

<div id="<?php echo esc_html( $sticky_head_id ); ?>" class="header-inner section-inner sr-menubar">

				<div class="header-titles-wrapper">

					<?php

					// Check whether the header search is activated in the customizer.
					$enable_header_search = get_theme_mod( 'webenvo-searchicon-show', 1 );

					if ( 1 === $enable_header_search ) {

						?>

						<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<?php webenvo_the_theme_svg( 'search' ); ?>
								</span>
								<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'webenvo' ); ?></span>
							</span>
						</button><!-- .search-toggle -->

					<?php } ?>

					<div class="header-titles">

						<?php
							// Site title or logo.
							webenvo_site_logo(); // title and Logo interchange condition is already in function.
							webenvo_site_description();
						?>

					</div><!-- .header-titles -->

					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php webenvo_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php _e( 'Menu', 'webenvo' ); ?></span>
						</span>
					</button><!-- .nav-toggle -->

				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-wrapper">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'webenvo' ); ?>">

								<ul class="primary-menu reset-list-style">

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new webenvo_Walker_Page(),
										)
									);

								}
								?>

								</ul>

							</nav><!-- .primary-menu-wrapper -->

						<?php
					}

					if ( 1 === $enable_header_search || has_nav_menu( 'expanded' ) ) {
						?>

						<div class="header-toggles hide-no-js">

						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>

							<div class="primary-menu-wrapper toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'webenvo' ); ?></span>
										<span class="toggle-icon">
											<?php webenvo_the_theme_svg( 'ellipsis' ); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

							<?php
						}

						if ( 1 === $enable_header_search ) {
							?>

							<div class="toggle-wrapper search-toggle-wrapper">

								<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php webenvo_the_theme_svg( 'search' ); ?>
										<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'webenvo' ); ?></span>
									</span>
								</button><!-- .search-toggle -->

							</div>

							<?php
						}
						?>

						</div><!-- .header-toggles -->
						<?php
					}
					?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->

			<?php
			// Output the search modal (if it is activated in the customizer).
			if ( 1 === $enable_header_search ) {
				get_template_part( 'theme-menu/modal-search' );
			}
			?>
		<?php
		// Output the menu modal.
		get_template_part( 'theme-menu/modal-menu' );

