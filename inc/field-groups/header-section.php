<?php
/**
 * Header section metabox and input field creation
 *
 * @package TPC Vendors
 * @since  0.1.0
 */

add_action( 'cmb2_admin_init', 'tpcvendors_register_heading_metabox' );
/**
 * Build metabox and input fields for header section
 *
 * @return void
 */
function tpcvendors_register_heading_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_tpcvendors_heading_';

	/**
	 * Set Up Metabox
	 */
	$cmb_header = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Header Section', 'cmb2' ),
		'object_types'  => array( 'vendor', ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    	=> 'normal',
		'priority'   	=> 'high',
		// 'show_names' 	=> false, // Show field names on the left
		'cmb_styles' 	=> false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	/**
	 * Header Logo
	 *
	 * Type: File Upload
	 */
	$cmb_header->add_field( array(
	    'name'    => 'Header Logo',
	    'desc'    => 'A logo or banner for the top of the page.',
	    'id'      => 'vendor_header_image',
	    'type'    => 'file',
	    // Optional:
	    'options' => array(
	        'url' => false, // Hide the text input for the url
	        'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
	    ),
	) );

	/**
	 * Heading
	 *
	 * Type: Text Field
	 */
	$cmb_header->add_field( array(
	    'name'    => 'Heading',
	    'desc'    => 'A logo or banner for the top of the page.',
	    'default' => '',
	    'id'      => 'vendor_heading_text',
	    'type'    => 'text',
	) );

	/**
	 * Sub Heading
	 *
	 * Type: WYSIWYG
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_editor For Information on editor_id() function
	 */
	$cmb_header->add_field( array(
	    'name'    => 'Sub Heading',
	    'desc'    => 'Sub headers or a short description.',
	    'id'      => 'vendor_subheading_wysiwyg',
	    'type'    => 'wysiwyg',
	    'options' => array(
	        'wpautop' => true, // use wpautop?
	        'media_buttons' => false, // show insert/upload button(s)
	        'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
	        'textarea_rows' => get_option('default_post_edit_rows', 5), // rows="..."
	        'tabindex' => '',
	        'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
	        'editor_class' => '', // add extra class(es) to the editor textarea
	        'teeny' => true, // output the minimal editor config used in Press This
	        'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
	        'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
	        'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
	    ),
	) );

	/**
	 * Header Media
	 *
	 * Type: WYSIWYG
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_editor For Information on editor_id() function
	 */
	$cmb_header->add_field( array(
	    'name'    => 'Header Media',
	    'desc'    => 'Either an image, a video, or lightbox/modal video.',
	    'id'      => 'vendor_header_media_wysiwyg',
	    'type'    => 'wysiwyg',
	     'options' => array(
	        'wpautop' => false, // use wpautop?
	        'media_buttons' => true, // show insert/upload button(s)
	        'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
	        'textarea_rows' => get_option('default_post_edit_rows', 6), // rows="..."
	        'tabindex' => '',
	        'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
	        'editor_class' => '', // add extra class(es) to the editor textarea
	        'teeny' => false, // output the minimal editor config used in Press This
	        'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
	        'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
	        'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
	    ),
	) );

	/**
	 * Button Text
	 *
	 * Type: Text Field
	 */
	$cmb_header->add_field( array(
	    'name'    => 'Button Label',
	    'desc'    => 'Button Text for Affiliate Link in Header section',
	    'default' => '',
	    'id'      => 'vendor_header_button_text',
	    'type'    => 'text',
	) );
}
