<?php
/**
 * Template Name: Fullwidth Page Template
 *
 * @package xMag
 * @since xMag 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
		
	<?php if ( get_theme_mod('xmag_page_featured_image') && get_theme_mod('xmag_page_featured_image_size') == 'fullwidth' && has_post_thumbnail() ) : ?>
	
		<?php global $post; ?>

		<div class="featured-image">
			<header class="entry-header overlay">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>
			<div class="cover-bg" style="background-image:url(<?php the_post_thumbnail_url('xmag-thumb'); ?>)"></div>
		</div><!-- .featured-image -->
		
	<?php endif; ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php endif; ?>

<?php get_footer(); ?>
