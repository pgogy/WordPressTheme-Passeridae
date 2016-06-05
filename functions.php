<?php

function passeridae_setup() {

	load_theme_textdomain( 'passeridae', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );
	
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'custom-background' );
	
	if ( ! isset( $content_width ) ) $content_width = 900;
	
	$chargs = array(
		'width' => 980,
		'height' => 300,
		'uploads' => true,
	);
	
	set_post_thumbnail_size( 825, 510, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'passeridae' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
add_action( 'after_setup_theme', 'passeridae_setup' );

function passeridae_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area Right', 'passeridae' ),
		'id'            => 'sidebar-right',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'passeridae' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Widget Area Bottom', 'passeridae' ),
		'id'            => 'sidebar-bottom',
		'description'   => __( 'Add widgets here to appear in your footer.', 'passeridae' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'passeridae_widgets_init' );
  
function passeridae_scripts() {

	wp_enqueue_style( 'passeridae-style', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'passeridae-style-custom', get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'passeridae-core-style', get_template_directory_uri() . '/css/wp_core.css' );
	wp_enqueue_style( 'passeridae-style-mobile-1000', get_template_directory_uri() . '/css/mobile1000.css' );
	wp_enqueue_style( 'passeridae-style-mobile-768', get_template_directory_uri() . '/css/mobile768.css' );
	wp_enqueue_style( 'passeridae-style-mobile-400', get_template_directory_uri() . '/css/mobile400.css' );
	wp_enqueue_style( 'passeridae-main-menu-style', get_template_directory_uri() . '/css/menu/main-menu.css' );
	wp_enqueue_style( 'passeridae-slide-menu-style', get_template_directory_uri() . '/css/menu/slide-menu.css' );
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );

	wp_enqueue_script( 'passeridae-table-fix', get_template_directory_uri() . '/js/display/table_fix.js', array( 'jquery' ) );
	wp_enqueue_script( 'passeridae-youtube', get_template_directory_uri() . '/js/display/youtube-fix.js', array( 'jquery' ) );
	wp_enqueue_script( 'passeridae-search', get_template_directory_uri() . '/js/search/search-form.js', array( 'jquery' ) );
	wp_enqueue_script( 'passeridae-main-menu', get_template_directory_uri() . '/js/menus/main-menu.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'passeridae_scripts' );

function passeridae_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function passeridae_extra_style(){

	?><style>
	
		<?PHP
			$background = explode(" ", get_theme_mod("bkgsetting"));
			$clean = array_filter($background);
			shuffle($clean);
		?>
		
		html{
			background-image: url('<?PHP echo wp_get_attachment_url( $clean[0], array(1200,1200) ); ?>');
			background-color: <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>;
			color: <?PHP echo get_theme_mod('site_alltext_colour'); ?>;
		}
		
		.site-navigation ul li a{
			color :  <?PHP echo get_theme_mod('site_menu_text_colour'); ?>;
		}

		li.sub-menu{
			background-color :  <?PHP echo get_theme_mod('site_submenu_background_colour'); ?>;
		}
		
		.site-navigation li a:hover, 
		.site-navigation li a:focus {
			transition: background-color 0.5s ease;
			color: <?PHP echo get_theme_mod('site_menu_text_hover_colour'); ?>;
		}
		
		.site-navigation li:hover, 
		.site-navigation li:focus {
			transition: background-color 0.5s ease;
			background-color: <?PHP echo get_theme_mod('site_menu_background_hover_colour'); ?>;
		}
		
		.site-navigation ul li .current-menu-item a{
			background: <?PHP echo get_theme_mod('site_menu_background_current_colour'); ?>;  
			background-color: <?PHP echo get_theme_mod('site_menu_background_current_colour'); ?>;  
		}
		
		#searchform form input[type=text],
		#commentform input[type=text],
		#commentform input[type=email],
		#commentform input[type=url],
		textarea{
			background-color: <?PHP echo get_theme_mod('site_menu_background_colour'); ?>;
		}
		
		<?PHP
			$hex = passeridae_hex2rgb(get_theme_mod('site_header_background_colour'));
		?>
	
		header#masthead,
		#comments,
		.widget-area aside,
		main .page-header,
		.search .page-title,
		.error404 main{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.9); 
		}

		<?PHP
			$hex = passeridae_hex2rgb(get_theme_mod('pagination_background_colour'));
		?>
		
		.pagination *,
		.pagination a,
		.pagination span{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.9); 
			color: <?PHP echo get_theme_mod('pagination_link_colour'); ?>; 
		}	

		<?PHP
			$hex = passeridae_hex2rgb(get_theme_mod('site_bottom_sidebar_background_colour'));
		?>
		
		#widget-area-bottom aside{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.9); 
			color : <?PHP echo get_theme_mod('site_bottom_sidebar_text_colour'); ?>;
		}
		
		#widget-area-bottom aside a{
			color : <?PHP echo get_theme_mod('site_bottom_sidebar_link_colour'); ?>;
		}
		
		#widget-area-bottom aside a:hover{
			transition: background-color 0.6s ease;
			color: <?PHP echo get_theme_mod('site_alllink_hover_colour'); ?>;
		}
		
		<?PHP
			$hex = passeridae_hex2rgb(get_theme_mod('site_right_sidebar_background_colour'));
		?>
		
		#widget-area-right aside{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.9); 
			color : <?PHP echo get_theme_mod('site_right_sidebar_text_colour'); ?>;
		}
		
		#widget-area-right aside a{
			color : <?PHP echo get_theme_mod('site_right_sidebar_link_colour'); ?>;
		}
		
		#widget-area-right aside a:hover{
			transition: background-color 0.5s ease;
			color: <?PHP echo get_theme_mod('site_alllink_hover_colour'); ?>;
		}
		
		<?PHP
			$hex = passeridae_hex2rgb(get_theme_mod('site_post_background_colour'));
		?>
	
		article{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.9); 
		}
	
		a{
			color: <?PHP echo get_theme_mod('site_alllink_colour'); ?>;
		}
		
		#content a:hover,
		#content a:focus{
			transition: background-color 0.5s ease;
			color: <?PHP echo get_theme_mod('site_alllink_hover_colour'); ?>;
		}
		
		header#masthead h1 a,
		header#masthead p a{
			color: <?PHP echo get_theme_mod("site_title_colour"); ?>;
		}
		
		header#masthead h1 a:hover,
		header#masthead p a:hover{
			transition: background-color 0.5s ease;
			color: <?PHP echo get_theme_mod('site_alllink_hover_colour'); ?>;
		}
		
		button,
		input[type=submit]{
			background-color:  <?PHP echo get_theme_mod("site_button_colour"); ?>;
			color:  <?PHP echo get_theme_mod("site_button_text_colour"); ?>;
		}
		
		article .entry-title{
			color:  <?PHP echo get_theme_mod("site_title_colour"); ?>;
		}
		
	</style><?PHP

}
add_action("wp_head", "passeridae_extra_style");

function passeridae_excerpt_more( $excerpt ) {
	$parts = explode(" ", $excerpt);
	array_pop($parts);
	$replace ='<a href="' . get_post_permalink() . '">' . _x("read more", "read more", "passeridae") . "</a>";
	return implode(" ", $parts) . "... " . $replace;
}
add_filter( 'excerpt_more', 'passeridae_excerpt_more' );

function passeridae_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'passeridae_excerpt_length', 999 );

function passeridae_init(){

	if(!get_option("passeridae_theme_colours_setting")){
	
		set_theme_mod('site_allsite_background_colour', '#444444'); 
		set_theme_mod('site_title_colour', '#555555'); 
		set_theme_mod('site_alltext_colour', '#888888'); 
		set_theme_mod('site_alllink_hover_colour', '#222222');
		set_theme_mod('site_menu_text_colour', '#000000'); 
		set_theme_mod('site_menu_text_hover_colour', '#FF0000'); 
		set_theme_mod('site_menu_background_hover_colour', '#aaaaaa'); 
		set_theme_mod('site_menu_background_current_colour', '#cccccc'); 
		set_theme_mod('site_menu_background_colour', '#dddddd');
		set_theme_mod('site_header_colour', '#dddddd');
		set_theme_mod('pagination_background_colour', '#dddddd');
		set_theme_mod('pagination_link_colour', '#ff0000'); 
		set_theme_mod('site_bottom_sidebar_background_colour', '#dddddd');
		set_theme_mod('site_bottom_sidebar_text_colour', '#ffffff'); 
		set_theme_mod('site_bottom_sidebar_link_colour', '#ff0000');
		set_theme_mod('site_right_sidebar_background_colour', '#dddddd');
		set_theme_mod('site_right_sidebar_text_colour', '#ffffff'); 
		set_theme_mod('site_right_sidebar_link_colour', '#ff0000'); 
		set_theme_mod('site_post_background_colour', '#dddddd');
		set_theme_mod('site_alllink_colour', '#ff0000');
		set_theme_mod("site_button_colour", '#dddddd'); 
		set_theme_mod("site_button_text_colour", '#ffffff'); 
		add_option("passeridae_theme_colours_setting", 1);
	
	}

}
add_action("init", "passeridae_init");

function passeridae_featured_category_create(){

	if(!get_option("passeridae_featured")){

		$id = wp_create_category(_x("Featured Content", "featured content", "passeridae"));
		add_option("passeridae_featured", $id);
	
	}
		
}
add_action("admin_head", "passeridae_featured_category_create");

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/menus/Walker_Menu.php';
require get_template_directory() . '/inc/menus/Walker_Menu_Slide.php';
