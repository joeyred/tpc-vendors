<?php
/**
 * Affiliate link metabox and input field creation
 *
 * @package TPC Vendors
 * @since  0.1.0
 */

add_action( 'cmb2_admin_init', 'tpcvendors_register_affiliate_metabox' );
/**
 * Build metabox and input fields for affiliate link
 *
 * @return void
 */
function tpcvendors_register_affiliate_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_tpcvendors_affiliate_';

	/**
	 * Set Up Metabox
	 */
	$cmb_affiliate = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Affiliate Link', 'cmb2' ),
		'object_types'  => array( 'vendor', ), // Post type
		// 'show_on_cb' 	=> 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    	=> 'side', // 'normal', 'advanced', or 'side'
		'priority'   	=> 'high', // 'high', 'core', 'default' or 'low'
		// 'show_names' 	=> false, // Show field names on the left
		// 'cmb_styles' 	=> false, // false to disable the CMB stylesheet
		// 'closed'     	=> true, // true to keep the metabox closed by default
	) );

	/**
	 * Affiliate Link
	 *
	 * Type: URL Text Field
	 */
	$cmb_affiliate->add_field( array(
	    'name' => __( 'Affiliate Link/URL', 'cmb' ),
	    'id'   => 'vendor_affiliate_link',
	    'type' => 'text_url',
	    // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
	) );

}
