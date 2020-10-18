<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Kota
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kota_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'kota_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kota_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'kota_pingback_header' );

/**
 * Filters the archive title and styles the word before the first colon.
 *
 * @param string $title Current archive title.
 */
if ( ! function_exists( 'kota_get_the_archive_title' ) ) :
	function kota_get_the_archive_title( $title ) {

		$regex = apply_filters(
			'kota_get_the_archive_title_regex',
			array(
				'pattern'     => '/(\A[^\:]+\:)/',
				'replacement' => '<span class="opacity-accent">$1</span>',
			)
		);

		if ( empty( $regex ) ) {

			return $title;

		}

		return preg_replace( $regex['pattern'], $regex['replacement'], $title );

	}
endif;
add_filter( 'get_the_archive_title', 'kota_get_the_archive_title' );
