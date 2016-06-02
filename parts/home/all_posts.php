<?php if ( have_posts() ){
	
	while ( have_posts() ) : the_post();

		get_template_part( 'parts/content/content-index', get_post_format() );

	endwhile;
	
	if(get_theme_mod("pagination")=="on"){
	
		get_template_part('parts/pagination/pagination');
	
	}
	
	if(get_theme_mod("search")=="on"){
	
		get_template_part('parts/search-form/standard');
	
	}
	
}else{

	get_template_part( 'content', 'none' );

}

?>