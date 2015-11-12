<?php

// Hook post type registration into 'init' action
add_action( 'init', 'tpcvendor_register_custom_post_type' );
/**
 * Register the post type
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function tpcvendor_register_custom_post_type() {

	$labels = array(
		'name'               => _x( 'Vendors', 'post type general name', PLUGIN_DOMAIN ),
		'singular_name'      => _x( 'Vendor', 'post type singular name', PLUGIN_DOMAIN ),
		'menu_name'          => _x( 'Vendors', 'admin menu', PLUGIN_DOMAIN ),
		'name_admin_bar'     => _x( 'Vendor', 'add new on admin bar', PLUGIN_DOMAIN ),
		'add_new'            => _x( 'Add New', 'vendor', PLUGIN_DOMAIN ),
		'add_new_item'       => __( 'Add New Vendor', PLUGIN_DOMAIN ),
		'new_item'           => __( 'New Vendor', PLUGIN_DOMAIN ),
		'edit_item'          => __( 'Edit Vendor', PLUGIN_DOMAIN ),
		'view_item'          => __( 'View Vendor', PLUGIN_DOMAIN ),
		'all_items'          => __( 'All Vendors', PLUGIN_DOMAIN ),
		'search_items'       => __( 'Search Vendors', PLUGIN_DOMAIN ),
		'parent_item_colon'  => __( 'Parent Vendors:', PLUGIN_DOMAIN ),
		'not_found'          => __( 'No vendors found.', PLUGIN_DOMAIN ),
		'not_found_in_trash' => __( 'No vendors found in Trash.', PLUGIN_DOMAIN )
	);
	$args = array(
		'labels'             => $labels,
        'description'        => __( 'TPC Approved vendors with great products and services that can help your practice run more efficiently and grow.', PLUGIN_DOMAIN ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon'          => 'dashicons-businessman',
		'rewrite'            => array( 'slug' => 'vendor' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		//'taxonomies'          => array( 'category', 'post_tag' )
	);
	register_post_type( "vendor", $args );
}
	
add_action( 'init', 'tpcvendors_create_taxonomies', 0 );	
/**
 * Register custom taxonomies
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function tpcvendors_create_taxonomies() {	

	$labels = array(
		'name'              => __( 'Services', 'taxonomy general name', PLUGIN_DOMAIN ), 
		'singular_name'     => __( 'Service', 'taxonomy singular name', PLUGIN_DOMAIN ), 
		'search_items'      => __( 'Search Services', PLUGIN_DOMAIN ), 
		'all_items'         => __( 'All Services', PLUGIN_DOMAIN ), 
		'parent_item'       => __( 'Parent Service', PLUGIN_DOMAIN ), 
		'parent_item_colon' => __( 'Parent Service:', PLUGIN_DOMAIN ), 
		'edit_item'         => __( 'Edit Services', PLUGIN_DOMAIN ), 
		'update_item'       => __( 'Update Services', PLUGIN_DOMAIN ), 
		'add_new_item'      => __( 'Add New Services', PLUGIN_DOMAIN ), 
		'new_item_name'     => __( 'Services', PLUGIN_DOMAIN ) 
	);

	$args = array(
		'hierarchical'      => true,     // if this is true, it acts like categories             
		'labels'            => $labels,
		'show_admin_column' => true, 
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'service' ),
	);

	register_taxonomy( 'custom_cat', array('vendors'), $args );   
}