<?php
/**
 * Info Box section metabox and input field creation
 *
 * @package TPC Vendors
 * @since  0.1.0
 */

add_action( 'cmb2_admin_init', 'tpcvendors_register_infoboxes_metabox' );
/**
 * Build metabox and input fields for infobox section
 *
 * @return void
 */
function tpcvendors_register_infoboxes_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_tpcvendors_infoboxes_';

	/**
	 * Set Up Metabox
	 */
	$cmb_infobox = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Info Box Section', 'cmb2' ),
		'object_types'  => array( 'vendor', ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    	=> 'normal',
		'priority'   	=> 'high',
		// 'show_names' 	=> false, // Show field names on the left
		// 'cmb_styles' 	=> false, // false to disable the CMB stylesheet
		// 'closed'     	=> true, // true to keep the metabox closed by default
	) );

	/**
	 * Section Heading
	 *
	 * Type: Text Field
	 */
	$cmb_infobox->add_field( array(
	    'name'    => 'Section Heading',
	    'desc'    => '',
	    'default' => '',
	    'id'      => 'vendor_ib_heading_text',
	    'type'    => 'text',
	) );

	/**
	 * Info Boxes
	 *
	 * Type: Repeatable Group
	 */
	$group_field_id = $cmb_infobox->add_field( array(
	    'id'          => $prefix . 'group',
	    'type'        => 'group',
	    'description' => __( 'Generates reusable form entries', 'cmb2' ),
	    'options'     => array(
	        'group_title'   => __( 'Info Box {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Info Box', 'cmb2' ),
	        'remove_button' => __( 'Remove Info Box', 'cmb2' ),
	        'sortable'      => true, // beta
	        'closed'     	=> true, // true to have the groups closed by default
	    ),
	) );

	/**
	 * Icon
	 *
	 * Type: Text Field
	 */
	$cmb_infobox->add_group_field( $group_field_id, array(
	    'name' 		  => 'Icon',
	    'description' => __('<a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">Click here for a full list of icons</a>', 'cmb2' ),
	    'id'   		  => 'icon',
	    'type' 		  => 'text',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	/**
	 * Title
	 *
	 * Type: Text Field
	 */
	$cmb_infobox->add_group_field( $group_field_id, array(
	    'name' => 'Title',
	    'id'   => 'title',
	    'type' => 'text',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	/**
	 * Content
	 *
	 * Type: Textarea
	 */
	$cmb_infobox->add_group_field( $group_field_id, array(
	    'name' => 'Content',
	    'id'   => 'content',
		'type' => 'textarea',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
}
