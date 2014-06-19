<?php
/**
 * Plugin Name: Print All Posts
 * Plugin URI: http://endocreative.com
 * Description: A shortcode to display all your posts on one page - <strong>[print_all_posts]</strong>
 * Version: 1.0
 * Author: Endo Creative
 * Author URI: http://endocreative.com
 * License: GPL2
 */


function pap_shortcode( $atts ){

	$args = array(
		'posts_per_page' => '9999',
		'post_type' => 'post'
	);

	// The Query
	$the_query = new WP_Query( $args );

	$output = "";

	// The Loop
	if ( $the_query->have_posts() ) {
	   
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$output .= '<div class="pap-article">'; 
			$output .= '<h1 class="pap-title">' . get_the_title() . '</h1>';
			$output .= apply_filters('the_content', get_the_content() );
			$output .= '</div>';
		}
	       
	} else {
		$output .= "No posts found";
	}
	/* Restore original Post Data */
	wp_reset_postdata();

	return $output;
}
add_shortcode( 'print_all_posts', 'pap_shortcode' );