<?php
function vehicles_post_type_init(){
	$labels = array(
		'name'               => _x( 'Vehicles', 'post type general name', 'twenty-seventeen-child' ),
		'singular_name'      => _x( 'Vehicle', 'post type singular name', 'twenty-seventeen-child' ),
		'menu_name'          => _x( 'Vehicles', 'admin menu', 'twenty-seventeen-child' ),
		'name_admin_bar'     => _x( 'Vehicle', 'add new on admin bar', 'twenty-seventeen-child' ),
		'add_new'            => _x( 'Add New', 'vehicle', 'twenty-seventeen-child' ),
		'add_new_item'       => __( 'Add New Vehicle', 'twenty-seventeen-child' ),
		'new_item'           => __( 'New Vehicle', 'twenty-seventeen-child' ),
		'edit_item'          => __( 'Edit Vehicle', 'twenty-seventeen-child' ),
		'view_item'          => __( 'View Vehicle', 'twenty-seventeen-child' ),
		'all_items'          => __( 'All Vehicles', 'twenty-seventeen-child' ),
		'search_items'       => __( 'Search Vehicles', 'twenty-seventeen-child' ),
		'parent_item_colon'  => __( 'Parent Vehicles:', 'twenty-seventeen-child' ),
		'not_found'          => __( 'No vehicles found.', 'twenty-seventeen-child' ),
		'not_found_in_trash' => __( 'No vehicles found in Trash.', 'twenty-seventeen-child' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'twenty-seventeen-child' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'vehicle' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'comments' )
	);
	register_post_type('vehicles', $args);


}
add_action('init' , 'vehicles_post_type_init');

//register brand taxonomies to vehicle post type 
/// create vehicle taxonomies for the post type "vehicles"
function create_vehicle_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Vehicles', 'taxonomy general name', 'twenty-seventeen-child' ),
		'singular_name'     => _x( 'Vehicle', 'taxonomy singular name', 'twenty-seventeen-child' ),
		'search_items'      => __( 'Search Vehicles', 'twenty-seventeen-child' ),
		'all_items'         => __( 'All Vehicles', 'twenty-seventeen-child' ),
		'parent_item'       => __( 'Parent Vehicle', 'twenty-seventeen-child' ),
		'parent_item_colon' => __( 'Parent Vehicle:', 'twenty-seventeen-child' ),
		'edit_item'         => __( 'Edit Vehicle', 'twenty-seventeen-child' ),
		'update_item'       => __( 'Update Vehicle', 'twenty-seventeen-child' ),
		'add_new_item'      => __( 'Add New Vehicle', 'twenty-seventeen-child' ),
		'new_item_name'     => __( 'New Vehicle Name', 'twenty-seventeen-child' ),
		'menu_name'         => __( 'Brand', 'twenty-seventeen-child' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'brand' ),
	);

	register_taxonomy( 'brand', array( 'vehicles' ), $args );
}
// hook into the init action and call create_vehicle_taxonomies when it fires
add_action( 'init', 'create_vehicle_taxonomies', 0 );

//register post type slide
function post_slides_init() {
	$labels = array(
		'name'               => _x( 'Slides', 'post type general name', 'twenty-seventeen-child' ),
		'singular_name'      => _x( 'Slide', 'post type singular name', 'twenty-seventeen-child' ),
		'menu_name'          => _x( 'Slides', 'admin menu', 'twenty-seventeen-child' ),
		'name_admin_bar'     => _x( 'Slide', 'add new on admin bar', 'twenty-seventeen-child' ),
		'add_new'            => _x( 'Add New', 'slide', 'twenty-seventeen-child' ),
		'add_new_item'       => __( 'Add New Slide', 'twenty-seventeen-child' ),
		'new_item'           => __( 'New Slide', 'twenty-seventeen-child' ),
		'edit_item'          => __( 'Edit Slide', 'twenty-seventeen-child' ),
		'view_item'          => __( 'View Slide', 'twenty-seventeen-child' ),
		'all_items'          => __( 'All Slides', 'twenty-seventeen-child' ),
		'search_items'       => __( 'Search Slides', 'twenty-seventeen-child' ),
		'parent_item_colon'  => __( 'Parent Slides:', 'twenty-seventeen-child' ),
		'not_found'          => __( 'No slides found.', 'twenty-seventeen-child' ),
		'not_found_in_trash' => __( 'No slides found in Trash.', 'twenty-seventeen-child' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'slide' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'slide', $args );
}
add_action( 'init', 'post_slides_init' );



/// create  taxonomies for the post type "slide"
function create_slide_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Instruments', 'taxonomy general name', 'twenty-seventeen-child' ),
		'singular_name'     => _x( 'Instrument', 'taxonomy singular name', 'twenty-seventeen-child' ),
		'search_items'      => __( 'Search Instruments', 'twenty-seventeen-child' ),
		'all_items'         => __( 'All Instruments', 'twenty-seventeen-child' ),
		'parent_item'       => __( 'Parent Instrument', 'twenty-seventeen-child' ),
		'parent_item_colon' => __( 'Parent Instrument:', 'twenty-seventeen-child' ),
		'edit_item'         => __( 'Edit Instrument', 'twenty-seventeen-child' ),
		'update_item'       => __( 'Update Instrument', 'twenty-seventeen-child' ),
		'add_new_item'      => __( 'Add New Instrument', 'twenty-seventeen-child' ),
		'new_item_name'     => __( 'New Instrument Name', 'twenty-seventeen-child' ),
		'menu_name'         => __( 'Instrument', 'twenty-seventeen-child' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'instrument' ),
	);

	register_taxonomy( 'instrument', array( 'slide' ), $args );
}
// hook into the init action and call create_Instrument_taxonomies when it fires
add_action( 'init', 'create_slide_taxonomies', 0 );


