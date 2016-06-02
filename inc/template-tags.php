<?php

function passeridae_get_categories($id){

	$post_categories = wp_get_post_categories($id);
	$cats = array();
		
	foreach($post_categories as $c){
		$cat = get_category( $c );
		$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug, 'link' => get_category_link($c) );
	}
	
	return $cats;

}

function passeridae_get_categories_links($id){

	$html = array();
	$cats = passeridae_get_categories($id);
	
	foreach($cats as $cat){
		$html[] = "<a href='" . $cat['link'] ."'>" . $cat['name'] . "</a>";
	}
	
	
	if(count($html)==0){
		$html[] = _x("No Categories", "passeridae");
	}
	
	return $html;

}

function passeridae_get_tags($id){

	$post_tags = wp_get_post_tags($id);
	$cats = array();
		
	foreach($post_tags as $c){
		$cat = get_tag( $c );
		$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug, 'link' => get_tag_link($c) );
	}
	
	return $cats;

}

function passeridae_get_tags_links($id){

	$html = array();
	$cats = passeridae_get_tags($id);
	
	foreach($cats as $cat){
		$html[] = "<a href='" . $cat['link'] ."'>" . $cat['name'] . "</a>";
	}
	
	if(count($html)==0){
		$html[] = _x("No Tags", "passeridae");
	}
	
	return $html;

}

function passeridae_entry_meta() {
	
	?><div>
		<h6 class='meta_label'><?PHP echo _x('Categories', 'passeridae'); ?></h6><span><?PHP echo implode(" / ", passeridae_get_categories_links(get_the_ID())); ?></span>
	</div>
	<div>
		<h6 class='meta_label'><?PHP echo _x('Tags', 'passeridae'); ?></h6><span><?PHP echo implode(" / ", passeridae_get_tags_links(get_the_ID())); ?></span>
	</div>
	<?PHP if(get_theme_mod("author")=="on"){ ?>
	<div>
		<h6 class='meta_label'><?PHP echo _x('Author', 'passeridae'); ?></h6><span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span></h6>
	</div>
	<?PHP
	}
	
}

function passeridae_archive_title(){

	if(isset($_GET['cat'])){
		$term = $_GET['cat'];
	}else{
		$term = get_term_by( "slug", $_GET['tag'], "post_tag" );
		$term = $term->term_id;
	}

	?><header class="page-header">
		<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			$thumbnail = get_option( 'passeridae_' . $term . '_thumbnail_id', 0 );
			if($thumbnail){
				$html = 'background:url(' . wp_get_attachment_url($thumbnail) . ') 0px 0px / cover no-repeat;';
				the_archive_description( '<div class="taxonomy-description"><div class="taxonomy_picture" style="' . $html . '"></div><div class="taxonomy_content">', '</div></div>' );
			}else{
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			}
		?>
	</header><?PHP

}

function passeridae_author_title(){

	?><header class="page-header">
		<?php
			echo '<h1 class="page-title">' . ucfirst(get_the_author_meta("display_name")) . '</h1>';
			if(get_the_author_meta("description")!=""){
				echo '<div class="taxonomy-description">' . get_the_author_meta("description") . '</div>';
			}
		?>
	</header><?PHP

}

function passeridae_child_categories(){

	?><footer class="page-footer">
		<h1 class="page-title"><?PHP echo _x('Related Categories', 'passeridae'); ?></h1>
		<div class="taxonomy-description"><?PHP
		
			$category = get_category($_GET['cat']);
			
			$childcats = get_categories('child_of=' . $category->parent . '&hide_empty=1&exclude=' . $_GET['cat']);
			$output = array();
			foreach ($childcats as $childcat) {
				if (cat_is_ancestor_of($ancestor, $childcat->cat_ID) == false){
					$output[] = '<a href="'.get_category_link($childcat->cat_ID).'">' . $childcat->cat_name . '</a>';
					$ancestor = $childcat->cat_ID;
				}
			}
			
			echo implode(" / ", $output);
			
		?></div>
	</footer><?PHP

}

function passeridae_posts_authors_list($type, $id){

	$the_query = new WP_Query( array($type => $id, 'posts_per_page' => 99) );
	
	$authors = array();

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$authors[] = get_the_author_meta('ID');
		}
	} 
	
	wp_reset_postdata();
	
	return $authors;
	
}

function passeridae_posts_authors_html($type, $id){

	$authors = array_unique(passeridae_posts_authors_list($type, $id));

	$output = array();
	foreach($authors as $author){
		$output[] = "<a href='" . get_author_posts_url($author) . "'>" . ucfirst(get_the_author_meta( 'display_name', $author )) . "</a>";
	}
	
	echo implode(" / ", $output);

}

function passeridae_posts_content($type, $id){

	$the_query = new WP_Query( array($type => $id, 'posts_per_page' => 99) );
	
	$content = "";

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$content .= str_replace("\r", "", str_replace("\n", "", str_replace(".", "", preg_replace("/(?![=$'%-])\p{P}/u", " ", strip_tags(strtolower(get_the_content()))))));
		}
	} 
	
	wp_reset_postdata();
	
	return $content;
	
}

function passeridae_featured_posts_content($type, $id){

	if($type == "category"){
		$new_type = "category__and";
		$id = array($id, get_option("passeridae_featured"));
		$the_query = new WP_Query( array($new_type => $id, 'posts_per_page' => 99) );
	}else{
		$the_query = new WP_Query( array($type => $id, 'posts_per_page' => 99, 'category__and' => get_option("passeridae_featured")) );
	}
	
	if ( $the_query->have_posts() ) {

		?><footer class="page-footer featured-content">
			<h1 class="page-title"><?PHP echo _x('Featured Content', 'passeridae'); ?></h1>
		</footer>
		<div class="featured-content">
			<?PHP
				
				passeridae_featured_posts_content_html($the_query, $type);
				
			?>
		</div><?PHP
	
	}else{
	
		wp_reset_postdata();
	
	}
	
}

function passeridae_featured_posts_content_html($the_query, $type){

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			get_template_part("parts/content/content-" . $type);
		}
	} 
	
	wp_reset_postdata();
	
}