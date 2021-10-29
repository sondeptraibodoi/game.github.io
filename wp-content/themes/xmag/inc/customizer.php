<?php
/**
 * xMag: Customizer
 *
 * @package xMag
 * @since xMag 1.0
 */


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function xmag_customize_preview_js() {
	wp_enqueue_script( 'xmag_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20171003', true );
}
add_action( 'customize_preview_init', 'xmag_customize_preview_js' );


/**
 * This function adds some styles to the WordPress Customizer
 */
function xmag_customizer_styles() {

	$customizer_custom_styles = '.customize-control-xmag-custom-content {margin: 0;}';

	echo '<style id="xmag-customizer-css">' . $customizer_custom_styles . '</style>';

}
add_action( 'customize_controls_print_styles', 'xmag_customizer_styles', 999 );


/**
 * Custom Classes
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class Xmag_Important_Links extends WP_Customize_Control {

		public $type = "xmag-important-links";

		public function render_content() {
			$important_links = array(
				'upgrade' => array(
				'link' => esc_url('https://www.designlabthemes.com/xmag-plus-wordpress-theme/?utm_source=customizer_link&utm_medium=wordpress_dashboard&utm_campaign=xmag_upsell'),
				'text' => __('Try xMag Plus', 'xmag'),
				),
				'theme' => array(
				'link' => esc_url('https://www.designlabthemes.com/xmag-wordpress-theme/'),
				'text' => __('Theme Homepage', 'xmag'),
				),
		        'documentation' => array(
				'link' => esc_url('https://www.designlabthemes.com/xmag-documentation/'),
				'text' => __('Theme Documentation', 'xmag'),
				),
				'rating' => array(
				'link' => esc_url('https://wordpress.org/support/theme/xmag/reviews/#new-post'),
				'text' => __('Rate This Theme', 'xmag'),
				),
				'instagram' => array(
				'link' => esc_url('https://www.instagram.com/designlabthemes/'),
				'text' => __('Follow on Instagram', 'xmag'),
				),
				'twitter' => array(
				'link' => esc_url('https://twitter.com/designlabthemes'),
				'text' => __('Follow on Twitter', 'xmag'),
				)
			);
			foreach ($important_links as $important_link) {
				echo '<p><a class="button" target="_blank" href="' . esc_url( $important_link['link'] ). '" >' . esc_html($important_link['text']) . ' </a></p>';
			}
		}
	}

	class Xmag_Plus_Version extends WP_Customize_Control {
		public $type = 'xmag-plus-version';

		function render_content() {
		$pro_version_text = esc_html( 'Try xMag Plus', 'xmag' );
		$pro_version_link = esc_url( 'https://www.designlabthemes.com/xmag-plus-wordpress-theme/?utm_source=customizer_link&utm_medium=wordpress_dashboard&utm_campaign=xmag_upsell' );

		if ( ! empty( $this->label ) ) {
			echo '<div class="description customize-control-description xmag-custom-description">';
			echo '<strong>' . esc_html( $this->label ) . '</strong> ';
			echo '<a target="_blank" href="' . esc_url( $pro_version_link ). '" >' . esc_html( $pro_version_text ) . '</a>';
			echo '</div>';
			}
		}
	}

	class Xmag_Custom_Content extends WP_Customize_Control {
		public $type = 'xmag-custom-content';

		function render_content() {
			if ( ! empty( $this->label ) ) {
				echo '<span class="customize-control-title xmag-custom-title">' . esc_html( $this->label ) . '</span>';
			}
			if ( ! empty( $this->description ) ) {
				echo '<div class="description customize-control-description xmag-custom-description">' . $this->description . '</div>';
			}
		}
	}

}


/**
 * Theme Settings
 */
function xmag_theme_customizer( $wp_customize ) {

	// Add postMessage support for site title and description for the Theme Customizer
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Change default WordPress customizer settings
	$wp_customize->get_control( 'background_color' )->section	= 'colors_general';
	$wp_customize->get_control( 'background_color' )->priority  = 1;
	$wp_customize->get_control( 'header_textcolor' )->section	= 'colors_header';
	$wp_customize->get_control( 'header_textcolor' )->priority  = 2;
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title', 'xmag' );
	$wp_customize->get_section( 'header_image' )->panel  = 'xmag_panel';
	$wp_customize->get_section( 'header_image' )->priority  = 20;
	$wp_customize->get_control( 'header_image' )->priority  = 1;
	$wp_customize->remove_section('colors');

	/* Panels */
	$wp_customize->add_panel( 'xmag_panel', array(
		'title' => __( 'xMag Settings', 'xmag' ),
		'priority' => 10,
	) );

	$wp_customize->add_panel( 'xmag_colors', array(
		'title'		=> __( 'Colors', 'xmag' ),
		'priority'	=> 21,
	) );

	/* Sections */
	$wp_customize->add_section('xmag_links_section', array(
		'priority' => 2,
		'title' => __('xMag Links', 'xmag'),
	) );

	$wp_customize->add_section( 'xmag_general_section', array(
		'title'       => __( 'General', 'xmag' ),
		'priority'    => 5,
		'panel' => 'xmag_panel',
		'description'	=> __( 'General Settings.', 'xmag' ),
	) );

	$wp_customize->add_section( 'xmag_header_section', array(
		'title'       => __( 'Header Options', 'xmag' ),
		'priority'    => 15,
		'panel' => 'xmag_panel',
	) );

	$wp_customize->add_section( 'xmag_blog_section', array(
		'title'       => __( 'Homepage', 'xmag' ),
		'priority'    => 25,
		'panel' => 'xmag_panel',
		'description'	=> __( 'Settings for Blog Index Page.', 'xmag' ),
	) );

	$wp_customize->add_section( 'xmag_archive_section', array(
		'title'       => __( 'Categories and Archives', 'xmag' ),
		'priority'    => 30,
		'panel' => 'xmag_panel',
		'description'	=> __( 'Settings for Category, Tag, Search result, Author and Archive Pages.', 'xmag' ),
	) );

	$wp_customize->add_section( 'xmag_post_section', array(
		'title'       => __( 'Post', 'xmag' ),
		'priority'    => 35,
		'panel' => 'xmag_panel',
	) );

	$wp_customize->add_section( 'xmag_page_section', array(
		'title'       => __( 'Page', 'xmag' ),
		'priority'    => 40,
		'panel' => 'xmag_panel',
	) );

	$wp_customize->add_section( 'xmag_footer_section', array(
		'title'       => __( 'Footer', 'xmag' ),
		'priority'    => 45,
		'panel' => 'xmag_panel',
	) );

	$wp_customize->add_section( 'colors_general', array(
		'title'	=> __( 'General', 'xmag' ),
		'panel'	=> 'xmag_colors',
	) );

	$wp_customize->add_section( 'colors_header', array(
		'title'	=> __( 'Header', 'xmag' ),
		'panel'	=> 'xmag_colors',
	) );

	$wp_customize->add_section( 'colors_footer', array(
		'title'	=> __( 'Footer', 'xmag' ),
		'panel'	=> 'xmag_colors',
	) );

	/* Controls */

	// General - Site Layout
	$wp_customize->add_setting( 'xmag_layout_style', array(
        'default' => 'site-fullwidth',
        'type' => 'option',
		'capability' => 'edit_theme_options',
        'sanitize_callback' => 'xmag_sanitize_choices',
    ) );

	$wp_customize->add_control( 'xmag_layout_style', array(
	    'label'    => __( 'Site Layout', 'xmag' ),
	    'section'  => 'xmag_general_section',
	    'priority' => 1,
	    'type'     => 'select',
		'choices'  => array(
			'site-fullwidth' => __('Full width', 'xmag'),
			'site-boxed' => __('Boxed', 'xmag'),
	) ) );

	// General - Widget Style
	$wp_customize->add_setting( 'xmag_widget_style', array(
        'default' => 'grey',
        'sanitize_callback' => 'xmag_sanitize_choices',
    ) );

	$wp_customize->add_control( 'xmag_widget_style', array(
	    'label'    => __( 'Widget Style', 'xmag' ),
	    'section'  => 'xmag_general_section',
	    'type'     => 'select',
		'choices'  => array(
			'grey' => __('Grey', 'xmag'),
			'white' => __('White', 'xmag'),
			'minimal' => __('Minimal', 'xmag'),
	) ) );

	// General - Site Options
	$wp_customize->add_setting( 'xmag_site_options', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

	$wp_customize->add_control( new Xmag_Custom_Content( $wp_customize, 'xmag_site_options', array(
		'label'      => __( 'Site Options', 'xmag' ),
		'section'  => 'xmag_general_section',
	) ) );

	$wp_customize->add_setting( 'xmag_read_more', array(
        'default' => '',
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'xmag_read_more', array(
	    'label'    => __( 'Display Read More Link', 'xmag' ),
	    'section'  => 'xmag_general_section',
	    'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'general_pro_link', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Xmag_Plus_Version( $wp_customize, 'general_pro_link', array(
		'label'      => __( 'Need more options?', 'xmag' ),
		'section'  => 'xmag_general_section',
	) ) );

	// Header - Main Menu Style
	$wp_customize->add_setting( 'xmag_menu_style', array(
        'default' => 'dark',
        'sanitize_callback' => 'xmag_sanitize_choices',
    ) );

	$wp_customize->add_control( 'xmag_menu_style', array(
	    'label'    => __( 'Main Menu Style', 'xmag' ),
	    'section'  => 'xmag_header_section',
	    'type'     => 'select',
		'choices'  => array(
			'dark' => __('Dark', 'xmag'),
			'light' => __('Light', 'xmag'),
			'custom' => __('Custom Background', 'xmag'),
		),
	) );

	// Header - Main Menu Background
	$wp_customize->add_setting( 'main_menu_background', array(
		'default' => '#e54e53',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_background', array(
		'description' => __( 'Set a custom background for the Main Menu', 'xmag' ),
		'section'  => 'xmag_header_section',
		'active_callback' => 'xmag_has_custom_menu',
	) ) );

	// Header Options
	$wp_customize->add_setting( 'xmag_header_options', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

	$wp_customize->add_control( new Xmag_Custom_Content( $wp_customize, 'xmag_header_options', array(
		'label'      => __( 'Header Options', 'xmag' ),
		'section'  => 'xmag_header_section',
	) ) );

	$wp_customize->add_setting( 'xmag_sticky_menu', array(
        'default' => '',
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'xmag_sticky_menu', array(
	    'label'    => __( 'Sticky Main Menu', 'xmag' ),
	    'section'  => 'xmag_header_section',
	    'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'xmag_home_icon', array(
        'default' => 1,
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'xmag_home_icon', array(
	    'label'    => __( 'Display the Home icon in the Main Menu', 'xmag' ),
	    'section'  => 'xmag_header_section',
	    'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'xmag_show_search', array(
        'default' => 1,
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'xmag_show_search', array(
	    'label'    => __( 'Display Search Form in the Top Menu', 'xmag' ),
	    'section'  => 'xmag_header_section',
	    'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'header_pro_link', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Xmag_Plus_Version( $wp_customize, 'header_pro_link', array(
		'label'      => __( 'Need more options?', 'xmag' ),
		'section'  => 'xmag_header_section',
	) ) );

	// Header Image Width
	$wp_customize->add_setting( 'xmag_header_image_width', array(
        'default' => 1920,
        'sanitize_callback' => 'absint',
    ) );

	$wp_customize->add_control( 'xmag_header_image_width', array(
		'label' => __( 'Header Image Width', 'xmag' ),
	    'description' => __( 'After changing the size save and add a new image.', 'xmag' ),
	    'section'  => 'header_image',
	    'priority'    => 1,
	    'type'     => 'number',
	) );

	// Header Image Height
	$wp_customize->add_setting( 'xmag_header_image_height', array(
        'default' => 360,
        'sanitize_callback' => 'absint',
    ) );

	$wp_customize->add_control( 'xmag_header_image_height', array(
		'label' => __( 'Header Image Height', 'xmag' ),
	    'description' => __( 'After changing the size save and add a new image.', 'xmag' ),
	    'section'  => 'header_image',
	    'priority'    => 2,
	    'type'     => 'number',
	) );

	// Header Image Options
	$wp_customize->add_setting( 'xmag_header_image_options', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

	$wp_customize->add_control( new Xmag_Custom_Content( $wp_customize, 'xmag_header_image_options', array(
		'label'      => __( 'Header Image Options', 'xmag' ),
		'section'  => 'header_image',
		'priority'    => 3,
	) ) );

	$wp_customize->add_setting( 'show_header_image', array(
        'default' => '',
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'show_header_image', array(
	    'label'    => __( 'Display Header Image on Mobile', 'xmag' ),
	    'section'  => 'header_image',
	    'priority'    => 4,
	    'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'xmag_show_header_image', array(
        'default' => 1,
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'xmag_show_header_image', array(
	    'label'    => __( 'Display Header Image on Front Page Only', 'xmag' ),
	    'section'  => 'header_image',
	    'priority'    => 5,
	    'type'     => 'checkbox',
	) );

	// Homepage - Layout
	$wp_customize->add_setting( 'xmag_blog', array(
        'default' => 'layout2',
        'sanitize_callback' => 'xmag_sanitize_choices',
    ) );

	$wp_customize->add_control( 'xmag_blog', array(
	    'label'    => __( 'Layout', 'xmag' ),
	    'section'  => 'xmag_blog_section',
	    'type'     => 'select',
		'choices'  => array(
			'layout1' => __('List: Small Thumbnail + Sidebar', 'xmag'),
			'layout2' => __('List: Medium Thumbnail + Sidebar', 'xmag'),
			'layout3' => __('Classic: Large Posts + Sidebar', 'xmag'),
			'layout11' => __('Full Content Post + Sidebar', 'xmag'),
			),
	) );

	// Homepage - Excerpt Length
	$wp_customize->add_setting( 'xmag_excerpt_size', array(
        'default' => 20,
        'sanitize_callback' => 'absint',
    ) );

	$wp_customize->add_control( 'xmag_excerpt_size', array(
	    'label'    => __( 'Excerpt length', 'xmag' ),
	    'section'  => 'xmag_blog_section',
	    'type'     => 'number',
	) );

	// Homepage - Pro Link
	$wp_customize->add_setting( 'blog_pro_link', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Xmag_Plus_Version( $wp_customize, 'blog_pro_link', array(
		'label'      => __( 'Need more options?', 'xmag' ),
		'section'  => 'xmag_blog_section',
	) ) );

	// Archive - Layout
	$wp_customize->add_setting( 'xmag_archive', array(
        'default' => 'layout2',
        'sanitize_callback' => 'xmag_sanitize_choices',
    ) );

	$wp_customize->add_control( 'xmag_archive', array(
	    'label'    => __( 'Layout', 'xmag' ),
	    'section'  => 'xmag_archive_section',
	    'type'     => 'select',
		'choices'  => array(
			'layout1' => __('Small Thumbnail + Sidebar', 'xmag'),
			'layout2' => __('Medium Thumbnail + Sidebar', 'xmag'),
			'layout3' => __('Classic: Large Posts + Sidebar', 'xmag'),
	) ) );

	// Archive - Excerpt Length
	$wp_customize->add_setting( 'xmag_archive_excerpt_size', array(
        'default' => 20,
        'sanitize_callback' => 'absint',
    ) );

	$wp_customize->add_control( 'xmag_archive_excerpt_size', array(
	    'label'    => __( 'Excerpt length', 'xmag' ),
	    'section'  => 'xmag_archive_section',
	    'type'     => 'number',
	) );

	// Archive - Pro Link
	$wp_customize->add_setting( 'archive_pro_link', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Xmag_Plus_Version( $wp_customize, 'archive_pro_link', array(
		'label'      => __( 'Need more options?', 'xmag' ),
		'section'  => 'xmag_archive_section',
	) ) );

	// Post - Featured Image
	$wp_customize->add_setting( 'post_featured_image', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

	$wp_customize->add_control( new Xmag_Custom_Content( $wp_customize, 'post_featured_image', array(
		'label'      => __( 'Featured Image', 'xmag' ),
		'section'  => 'xmag_post_section',
	) ) );

	$wp_customize->add_setting( 'xmag_post_featured_image', array(
        'default' => '',
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'xmag_post_featured_image', array(
	    'label'    => __( 'Display Featured Image', 'xmag' ),
	    'section'  => 'xmag_post_section',
	    'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'xmag_post_featured_image_size', array(
        'default' => 'default',
        'sanitize_callback' => 'xmag_sanitize_choices',
    ) );

	$wp_customize->add_control( 'xmag_post_featured_image_size', array(
	    'description' => __( 'Featured Image Size', 'xmag' ),
	    'section'  => 'xmag_post_section',
	    'type'     => 'radio',
		'choices'  => array(
			'default' => __('Default', 'xmag'),
			'fullwidth' => __('Full width (images must be at least 1120px)', 'xmag'),
			),
		'active_callback' => 'xmag_post_has_featured_image',
	) );

	// Post - Pro Link
	$wp_customize->add_setting( 'post_pro_link', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Xmag_Plus_Version( $wp_customize, 'post_pro_link', array(
		'label'      => __( 'Need more options?', 'xmag' ),
		'section'  => 'xmag_post_section',
	) ) );

	// Page - Featured Image
	$wp_customize->add_setting( 'page_featured_image', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

	$wp_customize->add_control( new Xmag_Custom_Content( $wp_customize, 'page_featured_image', array(
		'label'      => __( 'Featured Image', 'xmag' ),
		'section'  => 'xmag_page_section',
	) ) );

	$wp_customize->add_setting( 'xmag_page_featured_image', array(
        'default' => '',
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'xmag_page_featured_image', array(
	    'label'    => __( 'Display Featured Image', 'xmag' ),
	    'section'  => 'xmag_page_section',
	    'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'xmag_page_featured_image_size', array(
        'default' => 'default',
        'sanitize_callback' => 'xmag_sanitize_choices',
    ) );

	$wp_customize->add_control( 'xmag_page_featured_image_size', array(
	    'description'    => __( 'Featured Image Size', 'xmag' ),
	    'section'  => 'xmag_page_section',
	    'type'     => 'radio',
		'choices'  => array(
			'default' => __('Default', 'xmag'),
			'fullwidth' => __('Full width (images must be at least 1120px)', 'xmag'),
			),
		'active_callback' => 'xmag_page_has_featured_image',
	) );

	// Footer - Scroll Up
	$wp_customize->add_setting( 'xmag_scroll_up', array(
        'default' => '',
        'sanitize_callback' => 'xmag_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'xmag_scroll_up', array(
	    'label'    => __( 'Display Scroll Up button', 'xmag' ),
	    'section'  => 'xmag_footer_section',
	    'type'     => 'checkbox',
	) );

	// Colors - General
	$wp_customize->add_setting( 'accent_color', array(
		'default' => '#e54e53',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label' => __( 'Accent Color', 'xmag' ),
		'section' => 'colors_general',
		'priority' => 2,
	) ) );

	$wp_customize->add_setting( 'colors_general_pro_link', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Xmag_Plus_Version( $wp_customize, 'colors_general_pro_link', array(
		'label'      => __( 'Need more colors?', 'xmag' ),
		'section'  => 'colors_general',
		'priority' => 3,
	) ) );

	// Colors - Header
	$wp_customize->add_setting( 'header_background', array(
		'default' => '#ffffff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
		'label' => __( 'Header Background', 'xmag' ),
		'section' => 'colors_header',
		'priority' => 1,
	) ) );

	$wp_customize->add_setting( 'site_tagline_color', array(
		'default' => '#777777',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_tagline_color', array(
		'label' => __( 'Site Tagline', 'xmag' ),
		'section' => 'colors_header',
		'priority' => 3,
	) ) );

	// Colors - Footer
	$wp_customize->add_setting( 'footer_background', array(
		'default' => '',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background', array(
		'label' => __( 'Footer Background', 'xmag' ),
		'section' => 'colors_footer',
	) ) );

	// xMag Links
	$wp_customize->add_setting('xmag_links', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control(new Xmag_Important_Links($wp_customize, 'xmag_links', array(
	  'section' => 'xmag_links_section',
	) ) );

}
add_action('customize_register', 'xmag_theme_customizer');


/**
 * Sanitize Checkbox
 *
 */
function xmag_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}


/**
 * Sanitize Radio Buttons and Select Lists
 *
 */
function xmag_sanitize_choices( $input, $setting ) {
    global $wp_customize;

    $control = $wp_customize->get_control( $setting->id );

    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}


/**
 * Sanitize text: only safe HTML tags (the same tags that are allowed in a standard WordPress post)
 *
 */
function xmag_sanitize_text( $input ) {
    return wp_kses_post( $input );
}


/**
 * Strips all of the HTML in the content.
 *
 */
function xmag_nohtml_sanitize( $input ) {
    return wp_filter_nohtml_kses( esc_url_raw( $input ) );
}


/**
 * Callback for Main Menu.
 */
function xmag_has_custom_menu( $control ) {
    if ( $control->manager->get_setting('xmag_menu_style')->value() == 'custom' ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Callback for Post Featured Image
 */
function xmag_post_has_featured_image( $control ) {
    if ( $control->manager->get_setting('xmag_post_featured_image')->value() == 1 ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Callback for Page Featured Image.
 */
function xmag_page_has_featured_image( $control ) {
    if ( $control->manager->get_setting('xmag_page_featured_image')->value() == 1 ) {
		return true;
    } else {
        return false;
    }
}
