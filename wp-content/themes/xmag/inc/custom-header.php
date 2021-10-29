<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package xMag
 * @since xMag 1.0
 */


/**
 * Set up the WordPress core custom header feature.
 *
 * @uses xmag_header_style()
 * @uses xmag_admin_header_style()
 * @uses xmag_admin_header_image()
 */
function xmag_custom_header_setup() {
	$header_image_height = get_theme_mod( 'xmag_header_image_height', 360 );
	$header_image_width = get_theme_mod( 'xmag_header_image_width', 1920 );
	add_theme_support( 'custom-header', apply_filters( 'xmag_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => $header_image_width,
		'height'                 => $header_image_height,
		'flex-height'            => false,
		'wp-head-callback'       => 'xmag_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'xmag_custom_header_setup' );


if ( ! function_exists( 'xmag_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see xmag_custom_header_setup().
 */
function xmag_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-header .site-title,
		.site-header .site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-header .site-title a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // xmag_header_style
