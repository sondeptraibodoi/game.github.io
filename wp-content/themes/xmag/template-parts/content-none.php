<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package xMag
 * @since xMag 1.0
 */
?>

<section class="no-results not-found">
	
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'xmag' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'xmag' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'xmag' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
		
	</div><!-- .entry-content -->
	
</section><!-- .no-results -->

