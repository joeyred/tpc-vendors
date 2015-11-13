<?php

function tpcvendors_landing_section() {}

function tpcvendors_staff_section() {}

function tpcvendors_extra_content_section() {}

/**
 * Infobox markup output
 *
 * @return void
 */
function tpc_vendors_infobox_section() {

	$entries = get_post_meta( get_the_ID(), '_tpcvendors_infoboxes_group', true );

	// Conditional css classes
	$total_infoboxes = count( $entries );

    if ( $total_infoboxes === 3 || $total_infoboxes === 5 ) {
    	$classes = array(
    		'column' 	=> 'large-4',
    		'infobox' 	=> ' row',
    		'icon_wrap' => ' medium-3 large-12 columns',
    		'box_inner' => ' medium-9 large-12 columns',
    		);

    } elseif ( $total_infoboxes === 4 || $total_infoboxes === 6 ) {
    	$classes = array(
    		'column' 	=> 'medium-6 large-3',
    		'infobox' 	=> '',
    		'icon_wrap' => '',
    		'box_inner' => '',
    		);
    }

    // Markup
    if ( isset( $entries ) ) {

	    echo '<div class="v-info-box-section wrap">'; // Wrap Open
	    echo '<div class="row" data-equalizer data-equalizer-mq="medium-up">'; // Row Open

		foreach ( (array) $entries as $key => $entry ) {

			// Store field values in variables to use in markup
			if ( isset( $entry['icon'] ) ) {

	        	$icon = esc_html( $entry['icon'] );
			}

	        if ( isset( $entry['title'] ) ) {

	        	$title = esc_html( $entry['title'] );
	        }

	        if ( isset( $entry['content'] ) ) {

	        	$content = esc_html( $entry['content'] );
	        }

	        // Single Info Box Markup
		    echo '<div class="columns small-12 ' . $classes['column'] . '" data-equalizer-watch>'; // Column Open
		    echo '<div class="info-box' . $classes['infobox'] . '">'; // Info Box Open
		    echo '<div class="icon-wrap' . $classes['icon_wrap'] . '"><span class="fa fa-' . $icon . '"></span></div>'; // Icon
		    echo '<div class="box-inner' . $classes['box_inner'] . '">'; // Inner Box Open
		    echo '<h3>' . $title . '</h3>'; // Title
		    echo $content ; // Description
		    echo '</div></div></div>'; // box-inner, info-box, and column Close
		}

		echo '</div></div>'; // Warp & Row Close
	}
}
