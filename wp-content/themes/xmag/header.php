<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package xMag
 * @since xMag 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
wp_body_open();
?>

<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'xmag' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="header-top collapse">
			<div class="container">
				<div class="row">
					<div class="col-4">
						<div class="site-branding">
							<?php if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php endif; ?>

							<?php $description = get_bloginfo( 'description', 'display' ); ?>
							<?php if ( $description || is_customize_preview() ) { ?>
									<p class="site-description"><?php echo $description; ?></p>
							<?php } ?>
						</div>
					</div>
					<div class="col-8">
						<div class="header-navigation">
							<?php if ( get_theme_mod( 'xmag_show_search', 1 ) ) { ?>
								<div class="search-top">
									<?php get_search_form(); ?>
								</div>
							<?php } ?><!-- Search Form -->
							<nav id="top-navigation" class="top-navigation" role="navigation">
								<?php
									if ( has_nav_menu( 'top_navigation' ) ) {
									wp_nav_menu( array( 'theme_location' => 'top_navigation', 'menu_class' => 'top-menu', 'container' => false, 'fallback_cb' => false ) );
									}
								?>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .header-top -->

		<?php
		// Header image
		if ( get_header_image() ) xmag_header_image();
		?>

		<div class="header-bottom <?php if( get_theme_mod( 'xmag_sticky_menu' ) ) echo esc_attr( 'sticky-header' ); ?>">

			<div id="main-navbar" class="main-navbar">
				<div class="container">
					<?php if ( get_theme_mod( 'xmag_home_icon', 1 ) ) : ?>
						<div class="home-link">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span class="icon-home"></span></a>
						</div>
					<?php endif; // Home icon ?>

					<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'xmag' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'main_navigation',
								'menu_id'        => 'main-menu',
								'menu_class'     => 'main-menu',
								'container'      => false,
								'fallback_cb'    => 'xmag_fallback_menu'
								) );
							// Main menu
						?>
					</nav>
				</div>
			</div>

			<div id="mobile-header" class="mobile-header">
				<a class="menu-toggle" id="menu-toggle" href="#" title="<?php esc_attr_e( 'Menu', 'xmag' ); ?>"><span class="button-toggle"></span></a>
				<a class="mobile-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div>
		</div><!-- .header-bottom -->

	</header><!-- .site-header -->

	<?php get_template_part( 'template-parts/header/navigation-mobile' ); ?>
	
	<div id="content" class="site-content">
		<div class="container">
