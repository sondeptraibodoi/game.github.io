<?php
/**
 * xMag: Custom styles handled by the Theme customizer
 *
 * @package xMag
 * @since xMag 1.0
 */


/**
 * Get Contrast
 */
function xmag_get_brightness($hex) {
 // returns brightness value from 0 to 255
 // strip off any leading #
 $hex = str_replace('#', '', $hex);

 $c_r = hexdec(substr($hex, 0, 2));
 $c_g = hexdec(substr($hex, 2, 2));
 $c_b = hexdec(substr($hex, 4, 2));

 return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
}


/**
 * Set the custom CSS via Customizer options.
 */
function xmag_custom_css() {
	$accent_color = esc_attr( get_option('accent_color') );
	$header_background = esc_attr( get_option('header_background') );
	$site_tagline_color = esc_attr( get_option( 'site_tagline_color') );
	$footer_background = esc_attr( get_option('footer_background') );
	$main_menu_background = esc_attr( get_option('main_menu_background') );
	$main_menu_style = get_theme_mod('xmag_menu_style');

	$theme_css = "";

	// Show Header Image on Mobile
	if ( get_theme_mod( 'show_header_image' ) ) {
		$theme_css .= ".header-image {display: block;}";
	}

	// Accent Color
	if ( ! empty($accent_color) ) {
		$theme_css .= "
		a, .site-title a:hover, .entry-title a:hover, .entry-content .has-accent-color,
		.post-navigation .nav-previous a:hover, .post-navigation .nav-previous a:hover span,
		.post-navigation .nav-next a:hover, .post-navigation .nav-next a:hover span,
		.widget a:hover, .block-heading a:hover, .widget_calendar a, .author-social a:hover,
		.top-menu a:hover, .top-menu .current_page_item a, .top-menu .current-menu-item a,
		.nav-previous a:hover span, .nav-next a:hover span, .more-link, .author-social .social-links li a:hover:before {
			color: {$accent_color};
		}
		button, input[type='button'], input[type='reset'], input[type='submit'], .entry-content .has-accent-background-color,
		.pagination .nav-links .current, .pagination .nav-links .current:hover, .pagination .nav-links a:hover,
		.entry-meta .category a, .featured-image .category a, #scroll-up, .large-post .more-link {
			background-color: {$accent_color};
		}
		blockquote {
			border-left-color: {$accent_color};
		}
		.sidebar .widget-title span:before {
			border-bottom-color: {$accent_color};
		}";
		if ( xmag_get_brightness($accent_color) > 150) {
			$theme_css .= "
			.entry-meta .category a, .featured-image .category a,
			button, input[type='button'], input[type='reset'], input[type='submit'],
			#scroll-up, .search-submit, .large-post .more-link {
				color: rgba(0,0,0,.7);
			}
			.entry-meta .category a:before {
				background-color: rgba(0,0,0,.7);
			}";
		}
	}

	// Header Background
	if ( ! empty($header_background) && $header_background != '#ffffff' ) {
		$theme_css .= "
		.site-header {
		background-color: {$header_background};
		}";
		if ( xmag_get_brightness($header_background) > 150) {
			$theme_css .= "
			.site-title a, .site-description, .top-navigation > ul > li > a {
			color: rgba(0,0,0,.8);
			}
			.site-title a:hover, .top-navigation > ul > li > a:hover {
			color: rgba(0,0,0,.6);
			}";
		} else {
			$theme_css .= "
			.site-title a, .site-description, .top-navigation > ul > li > a {
			color: #fff;
			}
			.site-title a:hover, .top-navigation > ul > li > a:hover {
			color: rgba(255,255,255,0.8);
			}
			.site-header .search-field {
			border: 0;
			}
			.site-header .search-field:focus {
			border: 0;
			background-color: rgba(255,255,255,0.9);
			}";
		}
	}

	// Site Tagline Color
	if ( ! empty($site_tagline_color) ) {
		$theme_css .= ".site-header .site-description {color: {$site_tagline_color};}";
	}

	// Footer Background
	if ( ! empty($footer_background) ) {
		$theme_css .= "
		.site-footer,
		.site-boxed .site-footer {
		background-color: {$footer_background};
		}";

		if ( xmag_get_brightness($footer_background) > 150) {
			$theme_css .= "
			.site-footer .footer-copy, .site-footer .widget, .site-footer .comment-author-link {
			color: rgba(0,0,0,.4);
			}
			.site-footer .footer-copy a, .site-footer .footer-copy a:hover,
			.site-footer .widget a, .site-footer .widget a:hover,
			.site-footer .comment-author-link a, .site-footer .comment-author-link a:hover {
			color: rgba(0,0,0,.5);
			}
			.site-footer .widget-title, .site-footer .widget caption {
			color: rgba(0,0,0,.6);
			}";
		} else {
		$theme_css .= "
			.site-footer .footer-copy, .site-footer .widget, .site-footer .comment-author-link {
			color: rgba(255,255,255,0.5);
			}
			.site-footer .footer-copy a, .site-footer .footer-copy a:hover,
			.site-footer .widget a, .site-footer .widget a:hover,
			.site-footer .comment-author-link a, .site-footer .comment-author-link a:hover {
			color: rgba(255,255,255,0.7);
			}
			.site-footer .widget-title, .site-footer .widget caption {
			color: #fff;
			}
			.site-footer .widget .tagcloud a {
			background-color: transparent;
			border-color: rgba(255,255,255,.1);
			}
			.footer-copy {
			border-top-color: rgba(255,255,255,.1);
			}";
		}
	}

	// Main Menu Custom Background
	if ( ! empty($main_menu_background) && $main_menu_style == 'custom' ) {
		$theme_css .= "
		.main-navbar {
		background-color: {$main_menu_background};
		position: relative;
		}
		.mobile-header {
		background-color: {$main_menu_background};
		}
		.main-menu ul {
		background-color: {$main_menu_background};
		}
		.main-menu > li a:hover, .home-link a:hover, .main-menu ul a:hover {
		background-color: rgba(0,0,0,0.05);
		}
		.main-navbar::before {
	    background-color: rgba(0, 0, 0, 0.15);
	    content: '';
	    display: block;
	    height: 4px;
	    position: absolute;
	    top: 0;
	    width: 100%;
		}
		.main-menu > li > a, .home-link a {
		line-height: 24px;
		padding: 12px 12px 10px;
		}";
		if ( xmag_get_brightness($main_menu_background) > 150) {
			$theme_css .= "
			.main-menu > li > a, .main-menu ul a, .home-link a,
			.mobile-header .mobile-title, .mobile-header .menu-toggle {
			color: rgba(0,0,0,.9);
			}
			.home-link a:hover, .main-menu > li > a:hover,
			.main-menu > li.current-menu-item > a, .main-menu > li.current_page_item > a {
			color: rgba(0,0,0,0.6);
			}
			.main-menu ul a:hover,
			.main-menu ul .current-menu-item a,
			.main-menu ul .current_page_item a {
			color: rgba(0,0,0,.9);
			background-color: rgba(0,0,0,.05);
			}
			.mobile-header a {
			color: rgba(0,0,0,.9);
			}
			.button-toggle, .button-toggle:before, .button-toggle:after {
			background-color: rgba(0,0,0,.9);
			}";
		}
	}

	// Main Menu Light
	if ( $main_menu_style == 'light' ) {
		$theme_css .= "
		.main-navbar {
		background-color: #fff;
		border-top: 1px solid #eee;
		border-bottom: 1px solid #eee;
		-webkit-box-shadow: 0 3px 2px 0 rgba(0, 0, 0, 0.03);
		box-shadow: 0 3px 2px 0 rgba(0, 0, 0, 0.03);
		}
		.main-menu > li > a, .home-link a {
		color: #333;
		border-left: 1px solid #f2f2f2;
		}
		.main-menu > li:last-child > a {
		border-right: 1px solid #f2f2f2;
		}
		.home-link a:hover, .main-menu > li > a:hover,
		.main-menu > li.current-menu-item > a,
		.main-menu > li.current_page_item > a{
		background-color: #fff;
		color: {$accent_color};
		}
		.home-link a:hover:before, .main-menu > li:hover:before, .main-menu > li:active:before,
		.main-menu > li.current_page_item:before, .main-menu > li.current-menu-item:before {
		content: '';
		position: absolute;
		bottom: 0;
		left: 0;
		display: block;
		width: 100%;
		height: 2px;
		z-index: 2;
		background-color: {$accent_color};
		}
		.main-menu ul {
		background-color: #fff;
		border: 1px solid #eee;
		}
		.main-menu ul a {
		border-top: 1px solid #f2f2f2;
		color: #555;
		}
		.main-menu ul a:hover {
		color: {$accent_color};
		}
		.mobile-header {
		background-color: #fff;
		border-bottom: 1px solid #eee;
		-webkit-box-shadow: 0 3px 2px 0 rgba(0, 0, 0, 0.03);
		box-shadow: 0 3px 2px 0 rgba(0, 0, 0, 0.03);
		}
		.mobile-header .mobile-title,
		.mobile-header .menu-toggle {
		color: #333;
		}
		.button-toggle,
		.button-toggle:before,
		.button-toggle:after {
		background-color: #333;
		}";
	}

	return $theme_css;
}


/**
 * Enqueue styles for the block-based editor.
 */
function xmag_custom_style() {
	$custom_css = xmag_custom_css();
	if ( ! empty($custom_css) ) {
		wp_add_inline_style( 'xmag-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'xmag_custom_style' );


/**
  * Set the custom CSS via Customizer options.
  */
function xmag_editor_css() {
	$accent_color = esc_attr( get_option( 'accent_color' ) );

	$editor_css = "";

	// Accent Color
	if ( ! empty($accent_color) ) {
		$editor_css .= "
		.editor-styles-wrapper .wp-block a,
		.editor-styles-wrapper .wp-block a:hover,
		.wp-block-freeform.block-library-rich-text__tinymce a
		.wp-block-freeform.block-library-rich-text__tinymce a:hover {
			color: {$accent_color};
		}
		.edit-post-visual-editor .wp-block-quote,
		.edit-post-visual-editor .wp-block-quote.is-style-large,
		.edit-post-visual-editor .wp-block-quote.is-large,
		.wp-block-freeform.block-library-rich-text__tinymce blockquote {
			border-left-color: {$accent_color};
		}";
	}

	return $editor_css;
}


/**
 * Enqueue styles for the block-based editor.
 */
function xmag_editor_style() {
	// Add Google fonts.
	wp_enqueue_style( 'xmag-fonts', xmag_fonts_url(), array(), null );
	// Add Editor style.
	wp_enqueue_style( 'xmag-block-editor-style', get_theme_file_uri( '/inc/css/editor-blocks.css' ) );
	wp_add_inline_style( 'xmag-block-editor-style', xmag_editor_css() );
}
add_action( 'enqueue_block_editor_assets', 'xmag_editor_style' );
