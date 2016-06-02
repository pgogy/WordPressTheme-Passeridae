<?php 

	$post_categories = get_categories( array('exclude' => get_option("passeridae_featured"), 'hide_empty' => 0) );

	foreach($post_categories as $c){
		$cat = get_category( $c );
		
		if(get_theme_mod("category_" . $c->term_id)=="on"){
		
		?><article style="<?php passeridae_category_thumbnail_background($c->term_id); ?>" >
			<header class="entry-header">
				<h1 style="<?PHP passeridae_category_title_background($c->term_id); ?>" class="entry-title">
					<a href="<?PHP echo get_category_link($c); ?>">
						<?PHP echo $cat->name; ?>
					</a>
				</h1>				
			</header>		
		</article><!-- #post-## --><?PHP
		
		}
		
	}
	
?>