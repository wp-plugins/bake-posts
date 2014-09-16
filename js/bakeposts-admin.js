jQuery(document).ready(function($){
	$("#bakeposts-form").submit(function(){
		var type 		= $('#baketype').val(); 
		var limit 		= $('#bakelimit').val();
		var excerpt 	= $("#bakeexcerpt:checked").val();
		var featured 	= $("#bakeimage:checked").val();
		
		var shortcode = '';
		switch(type){
			case 'recent':
				shortcode += '[bake-post-recent ';
				break;
			case 'category':
				shortcode += '[bake-post-category ';
				break;
			case 'tags':
				shortcode += '[bake-post-tags ';
				break;	
		}
		
		shortcode += 'term="id" ';
	
		shortcode += 'limit='+limit+' ';
		
		if(excerpt == "yes"){
			shortcode += 'excerpt="yes" ';
		}
		else{
			shortcode += 'excerpt="no" ';
		}
		
		if(featured == "yes"){
			shortcode += 'featured_image="yes" ';
		}
		else{
			shortcode += 'featured_image="no" ';
		}
		
		switch(type){
			case 'category':
				shortcode += 'category="';
				var count = $('#category_list').find('input[type=checkbox]:checked').length;
				var i=1;
				$('#category_list input[type=checkbox]:checked').each(function(){
					shortcode += $(this).val();
					if(i<count)
						shortcode += ',';
					else
						shortcode += '"';	
					i++;	
				})
				break;
			case 'tags':
				shortcode += 'tag_id="';
				var count = $('#tags_list').find('input[type=checkbox]:checked').length;
				var i=1;
				$('#tags_list input[type=checkbox]:checked').each(function(){
					shortcode += $(this).val();
					if(i<count)
						shortcode += ',';
					else
						shortcode += '"';
					i++;	
				})
				break;
			default:
				break;
		}
		shortcode += ']';
		/****   Result   *****/
		$("#shortcode").text(shortcode);
		$("#shortcode").focus();
		$("#shortcode").select();
		
		return false; // Do not submit form;
	});
	
	$("#baketype").change(function(){
		var type = $("#baketype").val();
		switch(type){
			case 'category':
				$('#tags_list').addClass('hide');
				$('#category_list').removeClass('hide');
				break;
			case 'tags':
				$('#category_list').addClass('hide');
				$('#tags_list').removeClass('hide');
				break;
			default:
				$('#category_list').addClass('hide');
				$('#tags_list').addClass('hide');
		}
	});
	
	/* $('#bakeimage').click(function(){
		$('.sizebox').fadeToggle("slow");
	}); */
});