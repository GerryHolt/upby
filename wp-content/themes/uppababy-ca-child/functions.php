<?php

function my_theme_enqueue_styles() {

$parent_style = 'style'; // This is 'uppababy' for the Twenty Fifteen theme.

wp_enqueue_style( $parent_style, 'https://uppababy.com/ui/css/style.css' );
wp_enqueue_style( 'child-style',
    'https://uppababy.com/ui/css/ca-style.css',
    array( $parent_style ),
    wp_get_theme()->get('Version')
);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

?>
