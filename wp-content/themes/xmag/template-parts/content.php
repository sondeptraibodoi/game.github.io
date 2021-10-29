<?php
/**
 * The default template for displaying content.
 *
 * @package xMag
 * @since xMag 1.0
 */
?>

	<?php
	$thumb_size = xmag_thumb_size();
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'list-post' ); ?>>

		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<figure class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( $thumb_size ); ?>
					<span class="format-icon"></span>
				</a>
			</figure>
		<?php endif; // if has_post_thumbnail ?>

		<header class="entry-header">
			<div class="entry-meta">
				<?php xmag_time_link(); ?>
				<span class="category"><?php the_category(' '); ?></span>
			</div>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<p>
				<?php echo get_the_excerpt(); ?>
				<?php if ( get_theme_mod( 'xmag_read_more' ) ) { ?>
					<a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php _e( 'Read more', 'xmag' ); ?>
					</a>
				<?php } ?>
			</p>
		</div><!-- .entry-summary -->

	</article><!-- #post-## -->
