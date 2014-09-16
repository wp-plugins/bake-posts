<?php
add_action('admin_menu', 'bakeposts_create_menu'); // Adding Menu to Dashboard
function bakeposts_create_menu() {
	//create new top-level menu
	$page_hook_suffix = add_menu_page('Bake Posts Plugin Settings', 'Bake Posts', 'administrator', __FILE__, 'bakeposts_settings_page',plugins_url('/images/icon.png', __FILE__));
	add_action('admin_print_scripts-' . $page_hook_suffix, 'bakeposts_admin_scripts');
}

function bakeposts_settings_page() {
?>
<div class="wrap">
<h2>Bake Posts Shortcode Generator</h2>
<form  id="bakeposts-form">
    <table class="form-table">
        <tr valign="top">
			<th scope="row">Type</th>
			<td>
				<select name="type" id="baketype">
					<option value="" selected>Please select</option>
					<option value="recent">Recent</option>
					<option value="category">Category</option>
					<option value="tags">Tags</option>
				</select>
				<style>
					.hide{
						display:none;
					}
				</style>
				<div id="type-reflex">
					<div id="category_list" class="hide">
						<h3>Category List</h3>
						<?php
							$args = array(
							  'orderby' => 'name'
							  );
							$categories = get_categories( $args );
							foreach ( $categories as $category ) {
								echo '<input type="checkbox" value="'.$category->term_id.'">'.$category->name.'<br/>';
							}
						?>
					</div>
					<div id="tags_list" class="hide">
						<h3>Tags List</h3>
						<?php
							$args = array(
							  'orderby' => 'name'
							  );
							$tags = get_tags($args);
							foreach ( $tags as $category ) {
								echo '<input type="checkbox" value="'.$category->term_id.'">'.$category->name.'<br/>';
							}
						?>
					</div>
				</div>
				
			</td>
        </tr>
		
        <tr valign="top">
			<th scope="row">Limit</th>
			<td><input type="number" name="limit" id="bakelimit" value="" placeholder="Number of posts" /></td>
        </tr>
		
		<tr valign="top">
			<th scope="row">To Show</th>
			<td>
				<input type="radio" id="bakeexcerpt" name="excerpt" value="yes" checked  /> Excerpt <br><br>
				<input type="radio" id="bakeexcerpt" name="excerpt" value="no"  /> Content
			</td>
        </tr>
		
		<tr valign="top">
        <th scope="row">Featured Image</th>
        <td>
			<input type="checkbox" id="bakeimage" name="image" value="yes" checked />Yes<br> <br>
			<!-- <div class="sizebox">
				Width : <input type="number" id="bakeimage_width" value="100" /> <br>
				Height: <input type="number" id="bakeimage_height" value="100" /> <br>
			</div> -->
		</td>
       </tr>
	   
	   <tr valign="top">
        <th scope="row"><button id="generate">Generate</button></th>
        <td>
			
		</td>
       </tr>
	   
	   
	   <tr valign="top">
	   
        <th scope="row">Shortcode</th>
        <td>
			<textarea id="shortcode" rows="6" cols="60" style="resize:none;" placeholder="copy and paste the shortcode in page/post/text widgets"></textarea>	
		</td>
       </tr>
       
    </table>
    
  
</form>
</div>
<?php }  
 
add_action( 'admin_init', 'bakeposts_admin_init' );

function bakeposts_admin_init() {
    /* Register our script. */
    wp_register_script( 'bakeposts-script', plugins_url( 'js/bakeposts-admin.js', __FILE__ ) );
}

function bakeposts_admin_scripts() {
    /* Link our already registered script to a page */
    wp_enqueue_script( 'bakeposts-script' );
} 