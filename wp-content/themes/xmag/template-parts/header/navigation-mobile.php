<?php
/**
 * The template used for displaying Mobile Naviagation
 *
 * @package xMag
 * @since xMag 1.3.1
 */
?>

<aside id="mobile-sidebar" class="mobile-sidebar">
	<nav id="mobile-navigation" class="mobile-navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'xmag' ); ?>">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'main_navigation',
				'menu_id'        => 'mobile-menu',
				'menu_class'     => 'mobile-menu',
				'container'      => false,
				'fallback_cb'    => 'xmag_fallback_menu'
			) );
			if ( has_nav_menu( 'top_navigation' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'top_navigation',
					'menu_class'     => 'mobile-menu',
					'container'      => false,
					'fallback_cb'    => false
				) );
			}
		?>
	</nav>
</aside>
