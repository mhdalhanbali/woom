/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-description, .site-navbar a, .main-navigation a, .menu-toggle, .site-branding, .site-navbar' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Accent color.
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {

			var color = 'h2.entry-title a:hover, h2.entry-title a:focus, h2.entry-title a:active, a, a:visited, a:hover, a:focus, a:active, .entry-categories a:hover, .entry-categories a:focus, .entry-categories a:active, .entry-meta a:hover, .entry-meta a:focus, .entry-meta a:active, .entry-footer a:hover, .entry-footer a:focus, .entry-footer a:active, .site-main .comment-navigation a:hover, .site-main .posts-navigation a:hover, .site-main .post-navigation a:hover, .site-main .comment-navigation a:focus, .site-main .posts-navigation a:focus, .site-main .post-navigation a:focus, .site-main .comment-navigation a:active, .site-main .posts-navigation a:active, .site-main .post-navigation a:active { color: ' + to + '; }';

			var background = 'button, .wp-block-button__link, a.button, a.added_to_cart, input[type="button"], input[type="reset"], input[type="submit"], button:hover, .wp-block-button__link:hover, a.button:hover, a.added_to_cart:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:active, .wp-block-button__link:active, a.button:active, a.added_to_cart:active, button:focus, .wp-block-button__link:focus, a.button:focus, a.added_to_cart:focus, input[type="button"]:active, input[type="button"]:focus, input[type="reset"]:active, input[type="reset"]:focus, input[type="submit"]:active, input[type="submit"]:focus, .site-navbar a.button { background: ' + to + '; }';

			var border = '.main-navigation ul ul { border-color: ' + to + '; }';

			var wcColor = 'ul.products li.product .woocommerce-loop-category__title:hover, ul.products li.product .woocommerce-loop-product__title:hover { color: ' + to + '; }';

			var wcBackground = 'ul.products li.product .onsale, .single-product div.product .onsale, .widget_price_filter .ui-slider .ui-slider-handle, .widget_price_filter .ui-slider .ui-slider-range { color: ' + to + '; }';

			$('head').append('<style>' + color + background + border + wcColor + wcBackground + '</style>');

		} );
	} );

} )( jQuery );
