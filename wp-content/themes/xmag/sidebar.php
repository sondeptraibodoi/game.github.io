<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package xMag
 * @since xMag 1.0
 */
?>

<div id="secondary" class="sidebar widget-area  <?php xmag_widget_style(); ?>" role="complementary">

	<?php if ( has_nav_menu( 'social_navigation' ) ) {
		wp_nav_menu(
			array(
				'theme_location'  => 'social_navigation',
				'container'       => false,
				'menu_id'         => 'social-links',
				'menu_class'      => 'social-links',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => '',
			)
		);
	} // Social Links ?>
	
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	
	<?php else : ?>
	
		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>

		<aside id="meta" class="widget widget_meta">
			<h3 class="widget-title"><span><?php _e( 'Meta', 'xmag' ); ?></span></h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>

	<?php endif; // Sidebar widget area ?>
	
</div><!-- #secondary .widget-area -->
