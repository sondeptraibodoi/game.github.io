<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package xMag
 * @since xMag 1.0
 */
?>
		
		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<div class="footer widget-area" role="complementary">
			<div class="container">
				<div class="row">
					<div class="col-4" id="footer-area-left">
						<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
							<?php dynamic_sidebar( 'footer-1' ); ?>
						<?php endif; // end footer widget area left ?>
					</div>	
					<div class="col-4" id="footer-area-center">
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
							<?php dynamic_sidebar( 'footer-2' ); ?>
						<?php endif; // end footer widget area center ?>
					</div>
					<div class="col-4" id="footer-area-right">
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<?php dynamic_sidebar( 'footer-3' ); ?>
						<?php endif; // end footer widget area right ?>
					</div>
				</div><!-- .row -->
			</div>
		</div>
		
		<div class="footer-copy">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="site-info">
							<?php xmag_credits(); ?>
							<span class="sep">/</span>
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'xmag' ) ); ?>"><?php printf( __( 'Powered by %s', 'xmag' ), 'WordPress' ); ?></a>
							<span class="sep">/</span>
							<a href="<?php echo esc_url( __( 'https://www.designlabthemes.com/', 'xmag' ) ); ?>" rel="nofollow"><?php printf( __( 'Theme by %s', 'xmag' ), 'Design Lab' ); ?></a>
						</div>
					</div>
					<div class="col-6">
						<?php if ( has_nav_menu( 'footer_navigation' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'footer_navigation', 'menu_class' => 'footer-menu', 'container_class' => 'footer-navigation', 'depth' => 1 ) ); ?>
						<?php } ?>
					</div>
				</div><!-- .row -->
			</div>
		</div>
	</footer><!-- #colophon -->
	
	<?php if ( get_theme_mod('xmag_scroll_up') ) { ?>
		<a href="#masthead" id="scroll-up"><span class="icon-arrow-up"></span></a>
	<?php } ?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>