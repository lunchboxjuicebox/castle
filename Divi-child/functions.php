<?php
/*-------------------------------------------------------
 * Divi Child Theme Functions.php
------------------ ADD YOUR PHP HERE ------------------*/
 
function divichild_enqueue_styles() {
  
 $parent_style = 'parent-style';
  
 wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
 wp_enqueue_style( 'child-style',
 get_stylesheet_directory_uri() . '/style.css',
 array( $parent_style ),
 wp_get_theme()->get('Version')
 );
}
add_action( 'wp_enqueue_scripts', 'divichild_enqueue_styles' );

/*
 * Solution for Single Event page 404 errors
 * IMPORTANT: Flush permalinks after pasting this code: http://tri.be/support/documentation/troubleshooting-404-errors/
 * Updated to work with post 3.10 versions
 */

function qwerty_custom_rewrite_basic() {
    add_rewrite_rule('^event/(.+)/(.+)', 'index.php?tribe_events=$matches[1]&eventDate=$matches[2]', 'top');
  }
  add_action('init', 'qwerty_custom_rewrite_basic');

  /*
  * Adds start time to event titles in Month view
  */
  function tribe_add_start_time_to_event_title ( $post_title, $post_id ) {
    if(function_exists('tribe_is_event')){
      if ( !tribe_is_event($post_id) ) return $post_title;
    }
    if(function_exists('tribe_is_month')){
    // Checks if it is the month view, modify this line to apply to more views
    if ( !tribe_is_month() ) return $post_title;
    }
    if (function_exists('tribe_get_start_time')){
      $event_start_time = tribe_get_start_time( $post_id );
    }


    if ( !empty( $event_start_time ) ) {
        $post_title = $event_start_time . ' - ' . $post_title;
    }

    return $post_title;


  }
  add_filter( 'the_title', 'tribe_add_start_time_to_event_title', 100, 2 );

  /**
 * Enable unfiltered_html capability for Editors.
 *
 * @param  array  $caps    The user's capabilities.
 * @param  string $cap     Capability name.
 * @param  int    $user_id The user ID.
 * @return array  $caps    The user's capabilities, with 'unfiltered_html' potentially added.
 */

// function multisite_restore_unfiltered_html( $caps, $cap, $user_id, ...$args ) {
// 	if ( 'unfiltered_html' === $cap && ( user_can( $user_id, 'mloustaunau' ) || user_can( $user_id, 'jvalencia') ) ) {
// 		$caps = array( 'unfiltered_html' );
// 	}

// 	return $caps;
// }

// add_filter( 'map_meta_cap', 'multisite_restore_unfiltered_html', 1, 4 );