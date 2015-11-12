<?php

add_action( 'cmb2_admin_init', 'tpcvendors_register_infoboxes_metabox' );
function tpcvendors_register_infoboxes_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_tpcvendors_infoboxes_';

	/**
	 * Set Up Metabox
	 */
	$cmb_header = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Info Box Section', 'cmb2' ),
		'object_types'  => array( 'vendor', ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		'priority'   	=> 'high',
		//'show_names' 	=> false, // Show field names on the left
		'cmb_styles' 	=> false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

}	