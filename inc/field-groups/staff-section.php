<?php

add_action( 'cmb2_admin_init', 'tpcvendors_register_staff_metabox' );
function tpcvendors_register_staff_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_tpcvendors_staff_';

	/**
	 * Set Up Metabox
	 */
	$cmb_staff = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Staff Member Section', 'cmb2' ),
		'object_types'  => array( 'vendor', ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		'priority'   	=> 'high',
		//'show_names' 	=> false, // Show field names on the left
		//'cmb_styles' 	=> false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	/**
	 * Section Heading
	 *
	 * Type: Text Field
	 */
	$cmb_staff->add_field( array(
	    'name'    => 'Section Heading',
	    'desc'    => '',
	    'default' => '',
	    'id'      => 'vendor_staff_heading_text',
	    'type'    => 'text',
	) );

	/**
	 * Meet the Staff
	 *
	 * Type: Repeatable Group
	 */
	$group_field_id = $cmb_staff->add_field( array(
	    'id'          => $prefix . 'group',
	    'type'        => 'group',
	    'description' => __( 'Add Staff Members to page', 'cmb2' ),
	    'options'     => array(
	        'group_title'   => __( 'Staff Member {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Staff Member', 'cmb2' ),
	        'remove_button' => __( 'Remove Staff Member', 'cmb2' ),
	        'sortable'      => true, // beta
	        // 'closed'     => true, // true to have the groups closed by default
	    ),
	) );

	/**
	 * Avatar
	 *
	 * Type: File Upload
	 */
	$cmb_staff->add_group_field( $group_field_id, array(
	    'name' => 'Avatar',
		'id'   => 'avatar',
		'type' => 'file',
		 'options' => array(
	        'url' => false, // Hide the text input for the url
	        'add_upload_file_text' => 'Add Avatar' // Change upload button text. Default: "Add or Upload File"
	    ),
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	/**
	 * Name
	 *
	 * Type: Text Field
	 */
	$cmb_staff->add_group_field( $group_field_id, array(
	    'name' 		  => 'Name',
	    'description' => __('', 'cmb2' ),
	    'id'   		  => 'name',
	    'type' 		  => 'text',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	/**
	 * Title
	 *
	 * Type: Text Field
	 */
	$cmb_staff->add_group_field( $group_field_id, array(
	    'name' 		  => 'Title',
	    'description' => __('', 'cmb2' ),
	    'id'   		  => 'title',
	    'type' 		  => 'text',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	/**
	 * Content
	 *
	 * Type: WYSIWYG
	 */
	$cmb_staff->add_group_field( $group_field_id, array(
	    'name'    => 'Content',
	    //'desc'    => 'Sub headers or a short description.',
	    'id'      => 'content',
	    'type'    => 'wysiwyg',
	    'options' => array(
	        'wpautop' => true, // use wpautop?
	        'media_buttons' => false, // show insert/upload button(s)
	        'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
	        'textarea_rows' => get_option('default_post_edit_rows', 8), // rows="..."
	        'tabindex' => '',
	        'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
	        'editor_class' => '', // add extra class(es) to the editor textarea
	        'teeny' => true, // output the minimal editor config used in Press This
	        'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
	        'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
	        'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
	    ),
	) );
}
	
