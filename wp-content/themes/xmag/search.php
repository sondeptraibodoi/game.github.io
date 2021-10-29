<?php
/**
 * The template for displaying search results pages.
 *
 * @package xMag
 * @since xMag 1.0
 */

get_header(); ?>
	
	<?php
	/* Archive Options */
	$post_template = xmag_archive_post_template();
	?>
	
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<?php if ( have_posts() ) : ?>
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'xmag' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php else : ?>
					<h1 class="page-title"><?php _e( 'Nothing Found', 'xmag' ); ?></h1>
				<?php endif; ?>
			</header><!-- .page-header -->
			
			<?php if ( have_posts() ) : ?>
			
				<?php /* Start the Loop */ ?>
				<div class="posts-loop">
				<?php while ( have_posts() ) : the_post(); ?>
	
					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
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
				
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'xmag' ); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
