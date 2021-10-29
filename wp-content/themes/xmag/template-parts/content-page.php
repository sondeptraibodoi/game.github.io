<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package xMag
 * @since xMag 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( has_post_thumbnail() && get_theme_mod('xmag_page_featured_image') ) : ?>
	
		<?php if ( get_theme_mod('xmag_page_featured_image_size', 'default') == 'default' ) : ?>
		
			<header class="entry-header has-featured-image">	
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<figure class="entry-thumbnail">
					<?php the_post_thumbnail('large'); ?>
				</figure>
			</header><!-- .entry-header -->
		
		<?php endif; ?>
	
	<?php else : ?>	
		
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
		
	<?php endif; ?>

	<div class="entry-content">
		<?php 
			the_content();
			wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'xmag' ),
			'after'  => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'xmag' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
