<?php
/**
 * Blog Section
 *
 * @package webenvo
 */

?>

<!-- News/Blog Section -->
<?php
if ( get_theme_mod( 'webenvo-news-show', 1 ) === 1 ) {
	$news_title             = get_theme_mod( 'webenvo-news-title', 'Discover Insights and Ideas' );
	$news_description       = get_theme_mod( 'webenvo-news-title-tag', 'INSPIRATION FOR GROWTH' );
	$news_title_color       = get_theme_mod( 'webenvo-news-title-color' );
	$news_description_color = get_theme_mod( 'webenvo-news-description-color' );
	?>
	<section id="news-section" class="home-news blog">
		<div class="container sr-news">

			<div class="row">
				<div class="col-md-12">
					<div class="section-header">
						<p class="section-subtitle" style="color:<?php echo esc_html( $news_description_color ); ?>"><?php echo esc_html( $news_description ); ?></p>
						<h1 class="section-title" style="color:<?php echo esc_html( $news_title_color ); ?>"><?php echo esc_html( $news_title ); ?></h1>
						<div class="divider-line"></div>
					</div>
				</div>
			</div>
			<div class="row baseline">
				<?php
				$webenvo_recent_posts = wp_get_recent_posts(
					array(
						'numberposts' => 3, // Number of recent posts thumbnails to display.
						'post_status' => 'publish', // Show only the published posts.
					)
				);
				foreach ( $webenvo_recent_posts as $webenvo_post_item ) {
					$webenvo_author_name = get_the_author_meta( 'display_name', $webenvo_post_item['post_author'] );
					$post_title_trimmed  = wp_trim_words( $webenvo_post_item['post_title'], 8, '...' );
					?>
					<div class="col-xl-4 col-lg-4 wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
						<article class="post">
							<figure class="post-thumbnail">
								<a href="<?php echo esc_html( the_permalink( $webenvo_post_item['ID'] ) ); ?>"><?php echo get_the_post_thumbnail( $webenvo_post_item['ID'], 'webenvo-thumb' ); ?></a>
							</figure>
							<div class="blog-head">
								<div class="news-date">
									<span><?php echo get_the_date( 'F - j', $webenvo_post_item['ID'] ); ?></span>
								</div>
								<div class="entry-meta">
									<span class="byline"> by <span class="author vcard"><a class="url fn n" href="#"><?php echo esc_html( $webenvo_author_name ); ?></a></span></span>
								</div>
								<header class="entry-header">
									<h3 class="entry-title"><a href="<?php echo esc_html( the_permalink( $webenvo_post_item['ID'] ) ); ?>"><?php echo esc_html( $post_title_trimmed ); ?></a></h3>
								</header>
							</div>

							<div class="full-content">
								<div class="entry-content">
									<?php
									// For Exerpt size limit.
									$webenvo_post_excerpt = get_the_excerpt( $webenvo_post_item['ID'] );

									$webenvo_post_excerpt  = substr( $webenvo_post_excerpt, 0, 160 );
									$webenvo_exerpt_result = substr( $webenvo_post_excerpt, 0, strrpos( $webenvo_post_excerpt, ' ' ) );
									?>
									<p><?php echo esc_html( $webenvo_exerpt_result ); ?></p>
									<p><a href="<?php echo esc_html( the_permalink( $webenvo_post_item['ID'] ) ); ?>" class="more-link">READ MORE</a></p>
								</div>
							</div>
						</article>
					</div>
					<?php
					wp_reset_postdata();
				}
				?>
			</div> <!-- row end -->
		</div> <!-- container end -->
</section>
<?php } ?>
<!-- End of News/Blog Section -->

<div class="clearfix"></div>
