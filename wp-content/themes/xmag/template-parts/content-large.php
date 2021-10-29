<?php
/**
 * The default template for displaying large posts.
 *
 * @package xMag
 * @since xMag 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'large-post' ); ?>>
		<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<span class="category"><?php the_category( ', ' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title text-center"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta text-center">
				<?php xmag_time_link(); ?>
			</div>
		<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<figure class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'xmag-main' ); ?>
					<span class="format-icon"></span>
				</a>
			</figure>
		<?php endif; // if has_post_thumbnail ?>

		<div class="entry-summary">
			<?php
			if ( is_home() && get_theme_mod( 'xmag_blog', 'layout2' ) == 'layout11' ) {
				the_content();
				wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'xmag' ),
				'after'  => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
				) );
			} else {
				the_excerpt();
			} ?>

			<?php if ( get_theme_mod( 'xmag_read_more' ) ) { ?>
				<p class="read-more">
					<a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php _e( 'Read more', 'xmag' ); ?>
					</a>
				</p>
			<?php } ?>
		</div><!-- .entry-summary -->
	</article><!-- #post-## -->
