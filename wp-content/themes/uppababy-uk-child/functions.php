<?php

function my_theme_enqueue_styles() {

$parent_style = 'style'; // This is 'uppababy' for the Twenty Fifteen theme.

wp_enqueue_style( $parent_style, 'https://uppababy.com/ui/css/style.css' );
wp_enqueue_style( 'child-style',
    'https://uppababy.com/ui/css/uk-style.css',
    array( $parent_style ),
    wp_get_theme()->get('Version')
);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Hiding prices

add_filter( 'woocommerce_get_price_html', function( $price ) {
	if ( is_admin() ) return $price;

	return '';
} );

add_filter( 'woocommerce_cart_item_price', '__return_false' );
add_filter( 'woocommerce_cart_item_subtotal', '__return_false' );

?>
