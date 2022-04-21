<?php

//Remove emoji scripts & css
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

//Remove JQuery migrate 
function remove_jquery_migrate( $scripts ) {
  if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
       $script = $scripts->registered['jquery'];
    if ( $script->deps ) { 
        // Check whether the script has any dependencies

        $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
    }
  }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

//Remove Gutenbrg CSS
function dequeue_gutenberg_theme_css() {
    wp_dequeue_style( 'wp-block-library' );
  }
  add_action( 'wp_enqueue_scripts', 'dequeue_gutenberg_theme_css', 100);
  