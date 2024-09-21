<?php
/**
 * Single Post Template.
 *
 * @package webenvo
 */

?>	
	<!-- Blog Post Content Single -->
	<article class="post shadow-lg p-4 mt-2 bg-white rounded">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
				?>
				<figure class="post-thumbnail">
				<span class="entry-date"><a href="#"><time datetime="2018-06-25"><?php echo get_the_date( 'j F, Y' ); ?></time></a></span>
				</figure>
				<?php
			}
			?>
		<div class="full-content">
			<div class="entry-meta">
				<span class="byline"> <span class="author vcard">
				<a class="url fn n" href="#"><?php the_author(); ?></a></span>
				</span>
				<span class="comment"><a href="#comments"><?php echo esc_html( get_comments_number() ); ?> Comments</a></span>
			</div>
			<header class="entry-header">
				<h2 class="entry-title"><?php the_title(); ?></h2>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	</article>
	<!-- End Blog Post Content Single -->
	<!--Blog Tags-->
	<article class="blog-details">
		<div class="tags">
			<?php
				$webenvo_post_tags = get_the_tags();
			if ( $webenvo_post_tags ) {
				?>
				<span>Tags:</span>
				<?php
				foreach ( $webenvo_post_tags as $tag_data ) {
					?>
					<a href="<?php the_permalink(); ?>"><?php echo esc_html( $tag_data->name ); ?></a> 
					<?php
				}
			}
			?>
		</div>
	</article>
	<!--End Blog Tags-->
	<!--Blog Author-->
	<article class="blog-author">
		<div class="media">
			<figure class="avatar">
			<?php
				echo get_avatar( get_the_author_meta( 'ID' ), $size = '', $default = '', $alt = '', $args = array( 'class' => 'img-circle' ) );
			?>
				<!-- <img src="assets/images/blog/blog-3.jpg" class="img-circle"> -->
			</figure>
			<div class="media-body">
				<h5 class="name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h5>
				<?php
				$user_link = get_the_author_meta( 'user_url' );
				if ( $user_link ) {
					?>
				<h6 class="designation"><?php echo esc_url( $user_link ); ?></h6>
				<?php } ?>
				<p><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
				<div class="about-social-icons">
					<?php
					$fb_link = get_the_author_meta( 'facebook' );
					if ( $fb_link ) {
						?>
						<a href="<?php echo esc_url( $fb_link ); ?>" title="Facebook" class="facebook"><i class="fab fa-facebook"></i></a>
						<?php
					}
					$tw_link = get_the_author_meta( 'twitter' );
					if ( $tw_link ) {
						?>
						<a href="<?php echo esc_url( $tw_link ); ?>" title="Twitter" class="twitter"><i class="fab fa-twitter"></i></a>
						<?php
					}
					$ln_link = get_the_author_meta( 'linkedin' );
					if ( $ln_link ) {
						?>
						<a href="<?php echo esc_url( $ln_link ); ?>" title="Linkedin" class="linkedin"><i class="fab fa-linkedin"></i></a>
						<?php
					}
					$yt_link = get_the_author_meta( 'youtube' );
					if ( $yt_link ) {
						?>
						<a href="<?php echo esc_url( $yt_link ); ?>" title="youtube" class="youtube"><i class="fab fa-youtube"></i></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</article>
	<!--End Blog Author-->

	<!--Comment Section-->
	<?php
			comments_template();
	?>
