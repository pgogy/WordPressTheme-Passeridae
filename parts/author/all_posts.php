<?php if ( have_posts() ) : 

	passeridae_author_title();
	
	while ( have_posts() ) : the_post();

		get_template_part( 'parts/content/content-author');

	endwhile;
	
	get_template_part('parts/pagination/pagination');
	
else :

	get_template_part( 'content', 'none' );

endif;

?>