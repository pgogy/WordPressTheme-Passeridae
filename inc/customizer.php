<?php

function passeridae_customize_register_modify( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'header_image' );
	
}

function passeridae_customize_register_home_page_layout( $wp_customize ){

	$wp_customize->add_section( 'home_page_layout' , array(
		'title'      => __( 'Home Page', 'passeridae' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'home_page',
		array(
			'default' => 'all_posts',
		)
	);
	 
	$wp_customize->add_control(
		'home_page',
		array(
			'type' => 'radio',
			'label' => 'Home page layout',
			'section' => 'home_page_layout',
			'choices' => array(
				'all_posts' => 'All Posts',
				'all_categories' => 'All Categories',			
				'featured_posts' => 'Featured Posts',			
				'featured_c' => 'Selected Categories (see below)',
				'featured_c_and_p' => 'Selected Categories (see below) and featured posts',		
				'featured_p_and_c' => 'Selected Categories (see below) and featured posts',		
			),
		)
	);
	
	$post_categories = get_categories( array('exclude' => get_option("passeridae_featured"), 'hide_empty' => 0) );
	
	foreach($post_categories as $c){
	
		$cat = get_category( $c );
				
		$wp_customize->add_setting(
			'category_' . $c->term_id,
			array(
				'default' => 'on',
			)
		);
		 
		$wp_customize->add_control(
			'category_' . $c->term_id,
			array(
				'type' => 'radio',
				'label' => 'Display Category - ' . $cat->name,
				'section' => 'home_page_layout',
				'choices' => array(
					"on" => "Display",
					"off" => "Don't display"
				),
			)
		);

	}
	
}

function passeridae_customize_register_page_layout( $wp_customize ){

	$wp_customize->add_section( 'page_layout' , array(
		'title'      => __( 'Page Options', 'passeridae' ),
		'priority'   => 2,
	) );
	
	$wp_customize->add_setting(
		'pagination',
		array(
			'default' => 'on',
		)
	);
	 
	$wp_customize->add_control(
		'pagination',
		array(
			'type' => 'radio',
			'label' => 'Display pagination',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
	$wp_customize->add_setting(
		'search',
		array(
			'default' => 'on',
		)
	);
	 
	$wp_customize->add_control(
		'search',
		array(
			'type' => 'radio',
			'label' => 'Display Search',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
	$wp_customize->add_setting(
		'author',
		array(
			'default' => 'on',
		)
	);
	 
	$wp_customize->add_control(
		'author',
		array(
			'type' => 'radio',
			'label' => 'Display Author',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
	
}

function passeridae_customize_register_fav_icon( $wp_customize ){
	
	$wp_customize->add_section( 'fav_icon' , array(
		'title'      => __( 'Fav Icon', 'passeridae' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'fav_icon_url'
	);
	 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'fav_icon_url',
			array(
				'label' => 'Fav Icon',
				'section' => 'fav_icon',
				'settings' => 'fav_icon_url'
			)
		)
	);
	
}

function passeridae_customize_register_add_site_colours( $wp_customize ) {
	
	$wp_customize->add_section( 'site_colours' , array(
		'title'      => __( 'Site Colours', 'passeridae' ),
		'priority'   => 30,
	) );
	
	$wp_customize->add_setting(
		'site_allsite_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_allsite_background_colour',
			array(
				'label' => 'Site background colour',
				'section' => 'site_colours',
				'settings' => 'site_allsite_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alllink_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alllink_colour',
			array(
				'label' => 'Site Link Colour',
				'section' => 'site_colours',
				'settings' => 'site_alllink_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alllink_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alllink_hover_colour',
			array(
				'label' => 'Site Link Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_alllink_hover_colour'
			)
		)
	);

	
	$wp_customize->add_setting(
		'site_post_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_post_background_colour',
			array(
				'label' => 'Site Post Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_post_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alltext_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alltext_colour',
			array(
				'label' => 'Site Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_alltext_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_title_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_title_colour',
			array(
				'label' => 'Site Article Title Colour',
				'section' => 'site_colours',
				'settings' => 'site_title_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_header_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_header_background_colour',
			array(
				'label' => 'Site Header Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_header_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_header_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_header_text_colour',
			array(
				'label' => 'Site Header Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_header_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_title_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_title_colour',
			array(
				'label' => 'Site Title Colour',
				'section' => 'site_colours',
				'settings' => 'site_title_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_footer_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_footer_colour',
			array(
				'label' => 'Site Footer Colour',
				'section' => 'site_colours',
				'settings' => 'site_footer_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_submenu_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_submenu_background_colour',
			array(
				'label' => 'Site SubMenu Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_submenu_background_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'site_menu_background_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_background_hover_colour',
			array(
				'label' => 'Site Menu Background Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_background_hover_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_background_current_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_background_current_colour',
			array(
				'label' => 'Site Menu Current Page Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_background_current_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_text_colour',
			array(
				'label' => 'Site Menu Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_text_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_text_hover_colour',
			array(
				'label' => 'Site Menu Text Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_text_hover_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_button_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_button_colour',
			array(
				'label' => 'Site Button Colour',
				'section' => 'site_colours',
				'settings' => 'site_button_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_button_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_button_text_colour',
			array(
				'label' => 'Site Button Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_button_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_right_sidebar_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_right_sidebar_background_colour',
			array(
				'label' => 'Site Right Sidebar Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_right_sidebar_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_right_sidebar_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_right_sidebar_text_colour',
			array(
				'label' => 'Site right Sidebar Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_right_sidebar_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_right_sidebar_link_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_right_sidebar_link_colour',
			array(
				'label' => 'Site Right Sidebar Link Colour',
				'section' => 'site_colours',
				'settings' => 'site_right_sidebar_link_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_bottom_sidebar_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_bottom_sidebar_background_colour',
			array(
				'label' => 'Site Bottom Sidebar Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_bottom_sidebar_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_bottom_sidebar_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_bottom_sidebar_text_colour',
			array(
				'label' => 'Site Bottom Sidebar Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_bottom_sidebar_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_bottom_sidebar_link_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_bottom_sidebar_link_colour',
			array(
				'label' => 'Site Bottom Sidebar Link Colour',
				'section' => 'site_colours',
				'settings' => 'site_bottom_sidebar_link_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'pagination_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_background_colour',
			array(
				'label' => 'Pagination Background Colour',
				'section' => 'site_colours',
				'settings' => 'pagination_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'pagination_link_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_link_colour',
			array(
				'label' => 'Pagination Link Colour',
				'section' => 'site_colours',
				'settings' => 'pagination_link_colour'
			)
		)
	);
	
}

function passeridae_customize_register_new_background( $wp_customize ) {

	$wp_customize->add_section( 'bkg_theme' , array(
		'title'      => __( 'Site Backgrounds', 'passeridae' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'bkgsetting',
		array()
	);
	 
	$wp_customize->add_control(
		new PasseridaeMultiImageBackground( 
			$wp_customize, 
			'bkgsetting', 
			array(
				'label'      => __( 'Multiple Backgrounds', 'passeridae' ),
				'section'    => 'bkg_theme',
				'settings'   => 'bkgsetting',
				'priority'   => 1
			)
		)
	);
	
}

function passeridae_customize_register( $wp_customize ) {

	passeridae_customize_register_new_background( $wp_customize );
	passeridae_customize_register_modify( $wp_customize );
	passeridae_customize_register_add_site_colours( $wp_customize );
	passeridae_customize_register_page_layout( $wp_customize );
	passeridae_customize_register_home_page_layout( $wp_customize );
	passeridae_customize_register_fav_icon( $wp_customize );
	
}
add_action( 'customize_register', 'passeridae_customize_register' );


function passeridae_customize_preview_js() {
	wp_enqueue_script( 'passeridae_customizer', get_template_directory_uri() . '/js/passeridae_customiser.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'passeridae_customize_preview_js' );

require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );
require get_template_directory() . '/inc/custom_backgrounds.php';