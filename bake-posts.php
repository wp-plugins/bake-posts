<?php
/**
 * Plugin Name: Bake posts
 * Plugin URI: http://wordpress.org/plugins/bake-posts/
 * Description: Plugin to display Posts on selected Categories,Tags and Recent posts.
 * Version: 1.01
 * Author: wpnaga
 * Author URI: http://profiles.wordpress.org/wpnaga/
 * License: GPL2
 */



add_shortcode("bake-post-category", "bake_post_category"); 
add_shortcode("bake-post-tags", "bake_post_tags"); 
add_shortcode("bake-post-recent", "bake_post_recent"); 

add_filter( 'widget_text', 'do_shortcode');

function bake_post_category($atts){
	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		extract($atts);
		
		//Check if Category term is Slug or Id
		
		if($term == "slug"){
			$the_query = new WP_Query( 'category_name='.$category.'&posts_per_page='.$limit );
		}	
		else if($term == "id"){
			$the_query = new WP_Query( 'cat='.$category.'&posts_per_page='.$limit );
		}	
		
		$excerpt = isset($excerpt)?$excerpt:"no"; // Check if Excerpt value is Set by user. If not set, set value as No
		// The Loop
		if($excerpt == "yes"){
			if ( $the_query->have_posts() ) {
				$output ='<ul style="list-style-type:none;line-height:24px;">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$output .='<li><a href="'.get_the_permalink().'"><h3>' . get_the_title() . '</h3></a><p>'.get_the_excerpt().'</p></li>';
				}
				$output .='</ul>';
			} else {
				$output ='No posts available.';
			}
		}
		else{
			if ( $the_query->have_posts() ) {
				$output ='<ul>';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$output .='<li><a href="'.get_the_permalink().'"><h3>' . get_the_title() . '</h3></a><p>'.get_the_content().'</p></li>';
				}
				$output .='</ul>';
			} else {
				$output ='No posts available.';
			}
		}
		/* Restore original Post Data */
		 wp_reset_postdata();
	}	
	return $output;
	
}

/*   Function to get posts from Specific Tags  */

function bake_post_tags($atts){

	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		extract($atts);
		
		//Check if Category term is Slug or Id
		
		if($term == "slug"){
			$the_query = new WP_Query( 'tag='.$tag.'&posts_per_page='.$limit );
		}	
		else if($term == "id"){
			$the_query = new WP_Query( 'tag_id='.$tag.'&posts_per_page='.$limit );
		}	
		
		$excerpt = isset($excerpt)?$excerpt:"no"; // Check if Excerpt value is Set by user. If not set, set value as No
		// The Loop
		if($excerpt == "yes"){
			if ( $the_query->have_posts() ) {
				$output ='<ul style="list-style-type:none;line-height:24px;">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$output .='<li><a href="'.get_the_permalink().'"><h3>' . get_the_title() . '</h3></a><p>'.get_the_excerpt().'</p></li>';
				}
				$output .='</ul>';
			} else {
				$output ='No posts available.';
			}
		}
		else{
			if ( $the_query->have_posts() ) {
				$output ='<ul style="list-style-type:none;line-height:24px;">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$output .='<li><a href="'.get_the_permalink().'"><h3>' . get_the_title() . '</h3></a><p>'.get_the_content().'</p></li>';
				}
				$output .='</ul>';
			} else {
				$output ='No posts available.';
			}
		}
		/* Restore original Post Data */
		wp_reset_postdata();	
	}
	return $output;
}


/*   Function to get Recent posts  */
function bake_post_recent($atts){
	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		extract($atts);
		
		$the_query = new WP_Query( 'showposts='.$limit ); 
		
		$excerpt = isset($excerpt)?$excerpt:"no"; // Check if Excerpt value is Set by user. If not set, set value as No
		// The Loop
		if($excerpt == "yes"){
			if ( $the_query->have_posts() ) {
				$output ='<ul style="list-style-type:none;line-height:24px;">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$output .='<li><a href="'.get_the_permalink().'"><h3>' . get_the_title() . '</h3></a><p>'.get_the_excerpt().'</p></li>';
				}
				$output .='</ul>';
			} else {
				$output ='No posts available.';
			}
		}
		else{
			if ( $the_query->have_posts() ) {
				$output ='<ul style="list-style-type:none;line-height:24px;">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$output .='<li><a href="'.get_the_permalink().'"><h3>' . get_the_title() . '</h3></a><p>'.get_the_content().'</p></li>';
				}
				$output .='</ul>';
			} else {
				$output ='No posts available.';
			}
		}
		/* Restore original Post Data */
		wp_reset_postdata();		
	}
	return $output;
	
}
