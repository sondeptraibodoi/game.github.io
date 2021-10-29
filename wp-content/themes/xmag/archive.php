<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package xMag
 * @since xMag 1.0
 */

get_header(); ?>
	
	<?php
	/* Archive Options */
	$post_template = xmag_archive_post_template();
	?>
	
	<div id="primary" class="content-area">
		
		<header class="page-header">
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			<?php
				if ( is_category() ) {
					// show an optional category description
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

				} elseif ( is_tag() ) {
					// show an optional tag description
					$tag_description = tag_description();
					if ( ! empty( $tag_description ) )
						echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
				}
			?>
		</header><!-- .page-header -->
		
		<main id="main" class="site-main" role="main">
		
				<?php if ( have_posts() ) : ?>
							
					<?php /* Start the Loop */ ?>
					<div class="posts-loop">
					<?php while ( have_posts() ) : the_post(); ?>
		
						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/' . $post_template );
						?>
		
					<?php endwhile; ?>
					</div><!-- / .posts-loop -->
					
					<?php the_posts_pagination( array(
						'mid_size' => 2,
		    			'prev_text' => esc_html( '&larr;' ),
						'next_text' => esc_html( '&rarr;' ),
					) ); ?>
		
				<?php else : ?>
		
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
		
				<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
