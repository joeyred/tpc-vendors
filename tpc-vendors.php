<?php

/**
 * Simple Plugin for adding a custom post type for Vendors using theme stylings and built on Foundation for Sites 5.
 *
 * @package   TPC Vendors
 * @author    Joey Hayes
 * @copyright 2015 Joey Hayes
 * @license   GPL-2.0+
 * @link      https://github.com/joeyred
 *
 * @wordpress-plugin
 * Plugin Name:       TPC Vendors
 * Plugin URI:        https://github.com/joeyred/tpc-vendors
 * Description:       Simple Plugin for adding a custom post type for Vendors
 * Version:           0.1.0
 * Author:            Joey Hayes
 * Author URI:        https://github.com/joeyred
 * Text Domain:       tpc-vendors
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
*/

define('PLUGIN_DOMAIN', "tpc-vendors");


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

// Filter the single_template with our custom function 
add_filter('single_template', 'tpcvendors_custom_single_template');

/**
 * Display custom tempalte for single post
 * 
 * @param  string $single_template Original Path
 * @return string                  Ammended Path
 */
function tpcvendors_custom_single_template( $single_template ){

  global $wp_query, $post;

  $found = locate_template('single-vendor.php');

  if ( $post->post_type == 'vendor' ) {
    $single_template = dirname(__FILE__) . '/templates/single-vendor.php';
  }

  return $single_template;

}

function tpcvendors_index_shortcode( $atts, $content = null ) {

	global $post;

	ob_start(); // Buffer

	require( 'templates/vendor-index.php' );

	$content = ob_get_clean(); // Set buffered function to object 

	return $content; // Return object

}
add_shortcode( 'vendor_index', 'tpcvendors_index_shortcode' );

