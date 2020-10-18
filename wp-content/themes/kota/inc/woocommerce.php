<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Kota
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function kota_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'kota_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function kota_woocommerce_scripts() {
	wp_enqueue_style( 'kota-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	wp_add_inline_style( 'kota-woocommerce-style', kota_woocommerce_custom_style() );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'kota-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'kota_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function kota_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'kota_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function kota_woocommerce_related_products_args( $args ) {
	$columns = get_option( 'woocommerce_catalog_columns', 4 );
	if ( $columns == 1 ) {
		$posts_per_page = 2;
	} else {
		$posts_per_page = $columns;
	}
	$defaults = array(
		'posts_per_page' => absint( $posts_per_page ),
		'columns'        => absint( $columns ),
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'kota_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'kota_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function kota_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'kota_woocommerce_wrapper_before' );

if ( ! function_exists( 'kota_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function kota_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'kota_woocommerce_wrapper_after' );

if ( ! function_exists( 'kota_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function kota_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		kota_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'kota_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'kota_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function kota_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'kota' ); ?>">
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count">(<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>)</span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'kota_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function kota_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<i class="fa fa-shopping-cart"></i> <?php kota_woocommerce_cart_link(); ?>
			</li>
			
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			
		</ul>
		<?php
	}
}

if ( ! function_exists( 'kota_woocommerce_header_search' ) ) {
	/**
	 * Display Header Search.
	 *
	 * @return void
	 */
	function kota_woocommerce_header_search() {
		$instance = array(
			'title' => '',
		);

		the_widget( 'WC_Widget_Product_Search', $instance );
	}
}

/**
 * Output the selected WooCommerce styling from the customizer
 */
if ( ! function_exists( 'kota_woocommerce_custom_style' ) ) :
	function kota_woocommerce_custom_style( $css = array() ) {

		$accent_color = get_theme_mod( 'accent_color' );
		if ( $accent_color ) :
			$css[] = 'ul.products li.product .woocommerce-loop-category__title:hover, ul.products li.product .woocommerce-loop-product__title:hover { color: ' . esc_attr( $accent_color ) . '; }';

			$css[] = 'ul.products li.product .onsale, .single-product div.product .onsale, .widget_price_filter .ui-slider .ui-slider-handle, .widget_price_filter .ui-slider .ui-slider-range { background: ' . esc_attr( $accent_color ) . '; }';
		endif;

		return implode( '', $css );

	}
endif;