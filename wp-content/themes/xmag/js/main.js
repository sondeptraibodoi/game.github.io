/**
 * File main.js
 *
 */


/**
 * Mobile Navigation
 */
( function( $ ) {

	var body, menuToggle, mobileSidebar, mobileNavigation;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} );

		container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable

		} );
	}
	initMainNavigation( $( '.mobile-navigation' ) );

	body         	   = $( 'body' );
	menuToggle         = $( '#menu-toggle' );
	mobileSidebar      = $( '#mobile-sidebar' );
	mobileNavigation   = $( '#mobile-navigation' );

	// Enable menuToggle.
	( function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggle.add( mobileNavigation ).attr( 'aria-expanded', 'false' );

		menuToggle.on( 'click.type', function() {
			$( this ).add( mobileSidebar ).toggleClass( 'toggled-on' );
			body.toggleClass( 'mobile-menu-active' );

			// jscs:disable
			$( this ).add( mobileNavigation ).attr( 'aria-expanded', $( this ).add( mobileNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! mobileNavigation.length || ! mobileNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 840 ) {
				$( document.body ).on( 'touchstart.xmag', function( e ) {
					if ( ! $( e.target ).closest( '.mobile-navigation li' ).length ) {
						$( '.mobile-navigation li' ).removeClass( 'focus' );
					}
				} );
				mobileNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.xmag', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				mobileNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart.xmag' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.xmag', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		mobileNavigation.find( 'a' ).on( 'focus.xmag blur.xmag', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();

	// Add the default ARIA attributes for the menu toggle and the navigations.
	function onResizeARIA() {
		if ( window.innerWidth < 840 ) {
			if ( menuToggle.hasClass( 'toggled-on' ) ) {
				menuToggle.attr( 'aria-expanded', 'true' );
			} else {
				menuToggle.attr( 'aria-expanded', 'false' );
			}

			if ( mobileSidebar.hasClass( 'toggled-on' ) ) {
				mobileNavigation.attr( 'aria-expanded', 'true' );
			} else {
				mobileNavigation.attr( 'aria-expanded', 'false' );
			}

			menuToggle.attr( 'aria-controls', 'site-navigation' );
		} else {
			menuToggle.removeAttr( 'aria-expanded' );
			mobileNavigation.removeAttr( 'aria-expanded' );
			menuToggle.removeAttr( 'aria-controls' );
		}
	}




} )( jQuery );

/**
 * Sticky Header
 */
( function( $ ) {

	var headerSticky = $('.sticky-header');

	// Return early if headerSticky is missing.
	if ( ! headerSticky.length ) {
		return;
	}

	var didScroll    = false;
	var headerHeight = parseInt( $( '.header-bottom' ).outerHeight() );
	var adminBar     = $('#wpadminbar');

	// Detect scroll event window.innerWidth <= 600
	$( window ).on( 'scroll', function () {
		didScroll = true;
	});

	// Used for throttling to improve performance
	setInterval( function () {
		if ( didScroll ) {
			didScroll = false;

			if ( $(window).scrollTop() > headerHeight ) {
				headerSticky.addClass( 'fixed' );
				var stickyheaderHeight = parseInt( $( '.sticky-header.fixed' ).outerHeight() );
				$('body').css( 'padding-top', stickyheaderHeight );
				if ( window.matchMedia('(max-width: 600px)').matches ) {
					headerSticky.css('top', 0);
					$('.mobile-sidebar').css( 'top', '50px');
				}
			} else {
				headerSticky.removeClass( 'fixed' );
				$('body').css( 'padding-top', '');
				headerSticky.css('top', '');
				$('.mobile-sidebar').css('top', '');
			}
		}
	}, 100);

} )( jQuery );


/**
 * Scroll Up
 */
jQuery(document).ready(function(){
	jQuery("#scroll-up").hide();
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 800) {
				jQuery('#scroll-up').fadeIn();
			} else {
				jQuery('#scroll-up').fadeOut();
			}
		});
		jQuery('a#scroll-up').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});
});


/* Search Icon Toggle effect */
jQuery(document).ready(function(){
	jQuery('.search-toggle').click(function(){
		jQuery('.search-container').toggleClass('active');
		jQuery('.search-toggle').toggleClass('close');
	});
});


/**
 * Skip link focus fix
 * Helps with accessibility for keyboard only users.
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();
