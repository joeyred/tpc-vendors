<?php
/**
 * Frontend functions
 *
 * @package TPC Vendors/Frontend
 * @since  0.1.0
 */

/**
 * Get image stored via cmb2 file upload
 *
 * @param  string $image_id The field ID of image field.
 * @return string           full image HTML markup
 */
function tpcvendors_get_image( $image_id ) {

	$image_id .= '_id';

	$image = wp_get_attachment_image( get_post_meta( get_the_ID(), $image_id, 1 ), 'full' );

	return $image;
}

/**
 * Logo Header Markup
 */
function tpcvendors_header_logo() {

    $heading_logo = tpcvendors_get_image( 'vendor_header_image' );

    if ( ! empty($header_logo) ) {
        ?>
        <div class="v-logo-wrap">
	        <div class="row  collapse">
	            <div class="small-12 columns">
	                <?php echo $header_logo ?>
	            </div>   
	        </div>
        </div>
        <?php
    }
}

/**
 * Heading
 *
 * @param string $media Media Query specific markup.
 */
function tpcvendors_header_heading( $media ) {
	$heading = get_post_meta( get_the_ID(), 'vendor_heading_text', true );

    if ( $media === 'medium' ) {
        $markup = '<div class="columns small-12 hide-for-large-up">'
                . '<h2>' .  $heading . '</h2>'
                . '</div>';
    }
    if ( $media === 'large' ) {
        $markup = '<h2 class="show-for-large-up">'
                . $heading
                . '</h2>';
    }

    if ( ! empty( $heading ) ) {
        echo $markup;
    }
}

/**
 * Landing markup output
 *
 * @return void
 */
function tpcvendors_landing_section() {

	$entry = array(
		'heading' => get_post_meta( get_the_ID(), 'vendor_heading_text', true ),
		'sub_heading' => get_post_meta( get_the_ID(), 'vendor_subheading_wysiwyg', true ),
		'header_media' => get_post_meta( get_the_ID(), 'vendor_header_media_wysiwyg', true ),
		'button_text' => get_post_meta( get_the_ID(), 'vendor_header_button_text', true ),
		);

	if ( isset( $entry['heading'] ) ) {

    	$heading = esc_html( $entry['heading'] );
	}
	if ( isset( $entry['sub_heading'] ) ) {

    	$sub_heading = $entry['sub_heading'];
	}
	if ( isset( $entry['header_media'] ) ) {

    	$header_media = $entry['header_media'];
	}
	if ( isset( $entry['button_text'] ) ) {

    	$button_text = esc_html( $entry['button_text'] );
	}
	?>
	<div class="v-landing-image-bg" style="">
		<div class="v-landing-wrap wrap full-height-section">

			<?php tpcvendors_header_logo() ?>

		</div>
	</div>	
	<?php
}

/**
 * Infobox markup output
 *
 * @return void
 * @todo  Section title
 */
function tpcvendors_infobox_section() {

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
    if ( ! empty( $entries ) ) {

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

/**
 * Infobox markup output
 *
 * @return void
 * @todo  Section title
 */
function tpcvendors_staff_section() {

	$entries = get_post_meta( get_the_ID(), '_tpcvendors_staff_group', true );

	// Conditional css classes
	$total_staff = count( $entries );

    if ( $total_staff === 1 ) {
    	$classes = 'large-6 large-centered';

    } elseif ( $total_staff <= 2 ) {
    	$classes = 'large-6';
    }

	// Markup
    if ( ! empty( $entries ) ) {

	    echo '<div class="v-staff-section wrap">'; // Wrap Open
	    echo '<div class="row">'; // Row Open

		foreach ( (array) $entries as $key => $entry ) {

			// Store field values in variables to use in markup
			if ( isset( $entry['name'] ) ) {

	        	$name = esc_html( $entry['name'] );
			}

	        if ( isset( $entry['title'] ) ) {

	        	$title = esc_html( $entry['title'] );
	        }

	        if ( isset( $entry['content'] ) ) {

	        	$content = esc_html( $entry['content'] );
	        }

	        if ( isset( $entry['avatar_id'] ) ) {

	        	$avatar = wp_get_attachment_image( $entry['avatar_id'], 'full' );
	        }
	        ?>
			<div class="columns <?php echo $classes; ?>">
				<div class="staff-profile">

					<div class="row staff-header">

						<div class="columns small-4">
							<div class="avatar-wrap">
								<?php echo $avatar; ?>
							</div>
						</div>

						<div class="columns small-8">
							<div class="name-title-wrap">

								<h2><?php echo $name; ?></h2>

								<h4><?php echo $title; ?></h4> 

							</div>
						</div>
					</div>

					<div class="row staff-description">
						<div class="columns small-12">

							<?php echo $content ?>

						</div>
					</div>
				</div>
			</div>
	        <?php
		}

		echo '</div></div>'; // Warp & Row Close
	}
}

/**
 * Extra Content markup output
 *
 * @return void
 */
function tpcvendors_extra_content_section() {

	$entries = get_post_meta( get_the_ID(), '_tpcvendors_additional_content_group', true );

	if ( ! empty( $entries ) ) {

		foreach ( (array) $entries as $key => $entry ) {

			// Store field values in variables to use in markup
	        if ( isset( $entry['section_title'] ) ) {

	        	$section_title = esc_html( $entry['section_title'] );
	        }

	        if ( isset( $entry['content'] ) ) {

	        	$content = esc_html( $entry['content'] );
	        }

	        echo '<div class="extra-content-wrap wrap">'; // Wrap Open
			echo '<div class="row">'; // Row Open
			echo '<div class="small-12 columns">';
			echo '<h1 class="section-title">' . $section_title . '</h1>';
			echo $content;
			echo '</div></div></div>' // Wrap, Row, and Column Close

	    }
	}
}
