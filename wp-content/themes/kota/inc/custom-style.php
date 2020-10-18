<?php
/**
 * Output the selected styling from the customizer
 *
 * @package Kota
 */
if ( ! function_exists( 'kota_custom_style' ) ) :
	function kota_custom_style( $css = array() ) {

		$accent_color = get_theme_mod( 'accent_color' );
		if ( $accent_color ) :
			$css[] = 'h2.entry-title a:hover, h2.entry-title a:focus, h2.entry-title a:active, a, a:visited, a:hover, a:focus, a:active, .entry-categories a:hover, .entry-categories a:focus, .entry-categories a:active, .entry-meta a:hover, .entry-meta a:focus, .entry-meta a:active, .entry-footer a:hover, .entry-footer a:focus, .entry-footer a:active, .site-main .comment-navigation a:hover, .site-main .posts-navigation a:hover, .site-main .post-navigation a:hover, .site-main .comment-navigation a:focus, .site-main .posts-navigation a:focus, .site-main .post-navigation a:focus, .site-main .comment-navigation a:active, .site-main .posts-navigation a:active, .site-main .post-navigation a:active { color: ' . esc_attr( $accent_color ) . '; }';

			$css[] = 'button, .wp-block-button__link, a.button, a.added_to_cart, input[type="button"], input[type="reset"], input[type="submit"], button:hover, .wp-block-button__link:hover, a.button:hover, a.added_to_cart:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:active, .wp-block-button__link:active, a.button:active, a.added_to_cart:active, button:focus, .wp-block-button__link:focus, a.button:focus, a.added_to_cart:focus, input[type="button"]:active, input[type="button"]:focus, input[type="reset"]:active, input[type="reset"]:focus, input[type="submit"]:active, input[type="submit"]:focus, .site-navbar a.button { background: ' . esc_attr( $accent_color ) . '; }';

			$css[] = '.main-navigation ul ul { border-color: ' . esc_attr( $accent_color ) . '; }';
		endif;

		return implode( '', $css );

	}
endif;