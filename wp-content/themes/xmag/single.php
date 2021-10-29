<?php
/**
 * The template for displaying all single posts.
 *
 * @package xMag
 * @since xMag 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
		
	<?php if ( get_theme_mod('xmag_post_featured_image') && get_theme_mod('xmag_post_featured_image_size') == 'fullwidth' && has_post_thumbnail() ) : ?>
		
		<div class="featured-image">
			<header class="entry-header overlay">
				<span class="category"><?php the_category(' '); ?></span>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<div class="entry-meta">
					<?php
						xmag_posted_on();
						xmag_entry_comments();
					?>
				</div>
			</header>
			<div class="cover-bg" style="background-image:url(<?php the_post_thumbnail_url('xmag-thumb'); ?>)"></div>
		</div><!-- .featured-image -->

	<?php endif; ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
			<?php while ( have_posts() ) : the_post(); ?>
		
				<?php get_template_part( 'template-parts/content', 'single' ); ?>
				
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
			<?php endwhile; // end of the loop. ?>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
