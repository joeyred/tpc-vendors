<?php
/**
 * Simple Plugin for adding a custom post type for Vendors using theme stylings.
 *
 * @package   TPC Vendors
 * @author    Joey Hayes
 * @copyright 2015 Joey Hayes
 * @license   GPL-2.0+
 * @link      https://github.com/joeyred/tpc-vendors
 *
 * @wordpress-plugin
 * Plugin Name:       TPC Vendors
 * Plugin URI:        https://github.com/joeyred/tpc-vendors
 * Description:       Simple Plugin for adding a custom post type for Vendors
 * Version:           0.1.2
 * GitHub Plugin URI: https://github.com/joeyred/tpc-vendors
 * Author:            Joey Hayes
 * Author URI:        https://github.com/joeyred
 * Text Domain:       tpc-vendors
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

define('PLUGIN_DOMAIN', 'tpc-vendors');

/**
 * Get CMB2 Library
 */
if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
  require_once  __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once  __DIR__ . '/CMB2/init.php';
}

/**
 * Custom Post Type Registration, Settings and Taxonomies
 */
require( 'inc/register-cpt.php' );

/**
 * Metaboxes and input fields
 */
require( 'inc/custom-fields.php' );


// Filter the single_template with our custom function
add_filter('single_template', 'tpcvendors_custom_single_template');

/**
 * Display custom tempalte for vendor single post
 *
 * @param  string $single_template Original Path.
 *
 * @return string                  Ammended Path
 */
function tpcvendors_custom_single_template( $single_template ) {

  global $wp_query, $post;

  $found = locate_template('single-vendor.php');

  if ( $post->post_type == 'vendor' ) {
    $single_template = dirname(__FILE__) . '/templates/single-vendor.php';
  }

  return $single_template;

}

/**
 * Create shortcode to display searchable vendor archive
 *
 * @param  array  $atts    attributes passed.
 * @param  string $content raw content.
 *
 * @return string          buffered content
 */
function tpcvendors_index_shortcode( $atts, $content = null ) {

	global $post;

	ob_start(); // Buffer

	require( 'templates/vendor-index.php' );

	$content = ob_get_clean(); // Set buffered function to object

	return $content; // Return object

}
add_shortcode( 'vendor_index', 'tpcvendors_index_shortcode' );

