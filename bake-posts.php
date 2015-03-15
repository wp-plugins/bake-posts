<?php
/**
 * Plugin Name: Bake posts
 * Plugin URI: http://wordpress.org/plugins/bake-posts/
 * Description: Plugin to display Posts on selected Categories,Tags and Recent posts.
 * Version: 2.1
 * Author: wpnaga
 * Author URI: http://profiles.wordpress.org/wpnaga/
 * License: GPL2
 */


class bakePost{
	public $term = "";
	public $to_show = "";
	public $limit = "";
	public $featured_image = "";
	public $task = "";
	public $keyword = "";

	public function __construct($term,$to_show,$limit,$featured_image,$keyword,$task){
		$this->term = $term;
		$this->to_show = $to_show;
		$this->limit = $limit;
		$this->featured_image = $featured_image;
		$this->task = $task;
		$this->keyword = $keyword;
		$this->showAll();
	}

	public function showAll(){
		echo "<br>Term:".$this->term;
		echo "<br>To Show:".$this->to_show;
		echo "<br>limit:".$this->limit;
		echo "<br>featured_image:".$this->featured_image;
		echo "<br>task:".$this->task;
		echo "<br>keyword:".$this->keyword;
	}

	public function bake_me(){
		switch($this->task){
			case 1: //Recent
				$the_query = new WP_Query( 'showposts='.$this->limit ); 
				break;
			case 2: // Category
				$the_query = ($this->term == "slug")?new WP_Query( 'category_name='.$this->keyword.'&posts_per_page='.$this->limit ):new WP_Query( 'cat='.$this->keyword.'&posts_per_page='.$this->limit );
				break;
			case 3: // Tags
				$the_query = ($this->term == "slug")?new WP_Query( 'tag='.$this->keyword.'&posts_per_page='.$this->limit ):new WP_Query( 'tag_id='.$this->keyword.'&posts_per_page='.$this->limit );
				break;
		}
		return $this->get_posts($the_query);
	}

	public function get_posts($the_query){
		$to_show = $this->get_to_show($this->to_show);
		if ( $the_query->have_posts() ) {
			$output ='<ul style="list-style-type:none;line-height:24px;">';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$output .='<li><a href="'.get_the_permalink().'"><h3>' . get_the_title() . '</h3></a><p>';
				if($this->featured_image == "yes")
					$output .= get_the_post_thumbnail(get_the_ID(),array(100,100),array('align'=>"left",'style'=>"margin-right:10px;"));
				if($to_show != null)
					$output .= $to_show();
				$output .='</p></li>';
			}
			$output .='</ul>';
		} else {
			$output ='No posts available.';
		}
		return $output;
	}

	public function get_to_show($to_show){
		if($to_show == "title")
			return null;
		else if($to_show == "yes")
			return 'get_the_excerpt';
		else if($to_show == "no")
			return 'get_the_content';
	}
}

add_shortcode("bake-post-category", "bake_post_category"); 
add_shortcode("bake-post-tags", "bake_post_tags"); 
add_shortcode("bake-post-recent", "bake_post_recent"); 

add_filter( 'widget_text', 'do_shortcode');

function bake_post_recent($atts){
	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		extract($atts);
		$baker = new bakePost($term,$excerpt,$limit,$featured_image,"",1);
		$output = $baker->bake_me();
	}
	wp_reset_postdata();
	return $output;
}

function bake_post_category($atts){
	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		extract($atts);
		$baker = new bakePost($term,$excerpt,$limit,$featured_image,$category,2);
		$output = $baker->bake_me();
	}
	wp_reset_postdata();
	return $output;
}

function bake_post_tags($atts){
	if(empty($atts)){
		$output ="Please set parameters in shortcode";
	}
	else{
		extract($atts);
		$baker = new bakePost($term,$excerpt,$limit,$featured_image,$tag_id,3);
		$output = $baker->bake_me();
	}
	wp_reset_postdata();
	return $output;
}

include ('settings.php');

?>