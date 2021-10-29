<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package xMag
 * @since xMag 1.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function xmag_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'xmag_jetpack_setup' );
