<?php 
//register custom sidebar 
add_action( 'widgets_init', 'show_post_sidebar' );
function show_post_sidebar() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twenty-seventeen-child' ),
		'id' => 'main-sidebar',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'twenty-seventeen-child' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}

/*
//widgets register 
add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Left Sidebar', 'twenty-seventeen-child' ),
		'id' => 'left-sidebar',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'twenty-seventeen-child' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}
*/