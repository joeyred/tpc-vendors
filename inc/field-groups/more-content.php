<?php
/**
 * More Content metabox and input field creation
 *
 * @package TPC Vendors/Metaboxes/More Content
 * @since  0.1.0
 */

add_action( 'cmb2_admin_init', 'tpcvendors_register_additional_content_metabox' );
/**
 * Build metabox and input fields for additional content
 *
 * @return void
 */
function tpcvendors_register_additional_content_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_tpcvendors_additional_content_';

	/**
	 * Set Up Metabox
	 */
	$cmb_additonal_content = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Additional Content', 'cmb2' ),
		'object_types'  => array( 'vendor', ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    	=> 'normal',
		'priority'   	=> 'high',
		// 'show_names' 	=> false, // Show field names on the left
		// 'cmb_styles' 	=> false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	/**
	 * Additional Content Sections
	 *
	 * Type: Repeatable Group
	 */
	$group_field_id = $cmb_additonal_content->add_field( array(
	    'id'          => $prefix . 'group',
	    'type'        => 'group',
	    'description' => __( 'Add more content sections as needed', 'cmb2' ),
	    'options'     => array(
	        'group_title'   => __( 'Additional Content Section {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Content Section', 'cmb2' ),
	        'remove_button' => __( 'Remove Content Section', 'cmb2' ),
	        'sortable'      => true, // beta
	        // 'closed'     => true, // true to have the groups closed by default
	    ),
	) );

	/**
	 * Section Title
	 *
	 * Type: Text Field
	 */
	$cmb_additonal_content->add_group_field( $group_field_id, array(
	    'name' 		  => 'Section Title',
	    // 'description' => __('', 'cmb2' ),
	    'id'   		  => 'section_title',
	    'type' 		  => 'text',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	/**
	 * Content
	 *
	 * Type: WYSIWYG
	 */
	$cmb_additonal_content->add_group_field( $group_field_id, array(
	    'name'    => 'Content',
	    // 'desc'  => '',
	    'id'      => 'content',
	    'type'    => 'wysiwyg',
	    'options' => array(
	        'wpautop'       => true, // use wpautop?
	        'media_buttons' => true, // show insert/upload button(s)
	        'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
	      // 'textarea_rows' => get_option('default_post_edit_rows', 8), // rows="..."
	        'tabindex' 		=> '',
	        'editor_css' 	=> '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
	        'editor_class' 	=> '', // add extra class(es) to the editor textarea
	        'teeny' 		=> false, // output the minimal editor config used in Press This
	        'dfw' 			=> false, // replace the default fullscreen with DFW (needs specific css)
	        'tinymce' 		=> true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
	        'quicktags' 	=> true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
	    ),
	) );

}
