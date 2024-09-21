<?php
/**
 * Posts Contents Post Lists.
 *
 * @package webenvo
 */

?>
<article class="post shadow-lg mt-2 bg-white rounded col-md-4">
	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-thumbnail">
			<a href="<?php echo esc_html( wp_get_shortlink() ); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
			<span class="entry-date"><a href="#"><time datetime="2018-06-25"><?php echo get_the_date( 'j F, Y' ); ?></time></a></span>
		</figure>
	<?php } ?>
	<div class="full-content">
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php echo esc_html( wp_get_shortlink() ); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-meta">
			<span class="byline"> <span class="author vcard">
			<a class="url fn n" href="#"><?php the_author(); ?></a></span>
			</span>
			<span class="comment"><a href="<?php the_permalink(); ?>/#comments"><?php echo esc_html( get_comments_number() ); ?> comments</a></span>
		</div>
		<div class="entry-content">
			<p><?php the_excerpt(); ?></p>
			<p><a href="<?php echo esc_html( wp_get_shortlink() ); ?>" class="more-link">READ MORE</a></p>
		</div>
	</div>
</article>
