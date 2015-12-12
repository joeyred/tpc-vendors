<?php
/**
 * Frontend functions
 *
 * @package TPC Vendors
 * @since  0.1.0
 */

/**
 * Debugger
 *
 * @param  string $function function to call.
 * @param  string $args     arguments to pass.
 * @return void
 */
function tpcvendors_debugger( $function, $args = '' ) {

	$debug = call_user_func( $function, $args );

	echo $debug;
}

/**
 * Get image stored via cmb2 file upload
 *
 * @param  string $id The field ID of image field.
 * @return string     full image HTML markup
 */
function tpcvendors_get_image( $id ) {

	$id .= '_id';

	$image = wp_get_attachment_image( get_post_meta( get_the_ID(), $id, 1 ), 'full' );

	return $image;
}

/**
 * WYSIWYG helper to process shortcodes and embeds
 *
 * @param  string  $content content already retrived from wysiwyg field.
 * @param  boolean $autop   use auto paragraph function or not.
 * @return string           fully processed content
 */
function tpcvendors_do_wysiwyg_output( $content, $autop = true ) {

	global $wp_embed;

	$content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = do_shortcode( $content );

    if ( $autop === true ) {
    	$content = wpautop( $content );
	}

	return $content;
}

/**
 * WYSIWYG helper to retrieve meta and process shortcodes and embeds
 *
 * @param  string  $meta_key id of the field.
 * @param  integer $post_id  post id.
 * @param  bool    $autop    use auto paragraph function or not.
 * @return string            fully processed content
 */
function tpcvendors_get_wysiwyg_output( $meta_key, $post_id = 0, $autop = true ) {

	global $wp_embed;

    $post_id = $post_id ? $post_id : get_the_id();

    $content = get_post_meta( $post_id, $meta_key, 1 );
    $content = tpcvendors_do_wysiwyg_output( $content, $autop );

    return $content;
}

/**
 * Button builder
 *
 * @param  string $id button field id
 * @return void
 */
function tpcvendors_button( $id ) {

	$button_text = get_post_meta( get_the_ID(), $id, true );
	$button_link = get_post_meta( get_the_ID(), 'vendor_affiliate_link', true );

	if ( isset( $button_text ) ) {

    	$button_text = esc_html( $button_text );
    }
    if ( isset( $button_link ) ) {

    	$button_link = esc_html( $button_link );
    }

	echo '<a href="' . $button_link . '" class="button expand">' . $button_text . '</a>';
}

/**
 * Section Title Markup
 * 
 * @param  string $content content to be passed into title.
 * @return void
 */
function tpcvendors_section_title( $content ) {

	if ( ! empty( $content ) ) {
		echo '<div class="row"><div class="small-12 columns">';
		echo '<h1 class="section-title">' . $content . '</h1>';
		echo '</div></div>';
	}
}

/**
 * Logo Header Markup
 */
function tpcvendors_header_logo() {

    $header_logo = tpcvendors_get_image( 'vendor_header_image' );

    if ( ! empty( $header_logo ) ) {
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

	$entry = get_post_meta( get_the_ID(), 'vendor_heading_text', true );

	if ( isset( $entry ) ) {

    	$heading = esc_html( $entry );
	}

    if ( $media === 'medium' ) {
        $markup = '<div class="columns small-12 hide-for-large-up">'
                . '<h1>' .  $heading . '</h1>'
                . '</div>';
    }

    if ( $media === 'large' ) {
        $markup = '<h1 class="show-for-large-up">'
                . $heading
                . '</h1>';
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
		'sub_heading' => get_post_meta( get_the_ID(), 'vendor_subheading_wysiwyg', true ),
		'header_media' => tpcvendors_get_wysiwyg_output( 'vendor_header_media_wysiwyg', get_the_ID(), false ),
		);

	if ( isset( $entry['sub_heading'] ) ) {

    	$sub_heading = $entry['sub_heading'];
	}
	if ( isset( $entry['header_media'] ) ) {

    	$header_media = $entry['header_media'];
	}
	?>
	<div class="v-landing-image-bg" style="">
		<div class="v-landing-wrap wrap">

			<?php tpcvendors_header_logo() ?>

			<div class="row">
				<?php tpcvendors_header_heading( 'medium' ); ?>
				<div class="small-12 medium-6 columns">
					<div class="header-media-content-wrap">
           				<div class="header-media-content">
							<?php echo $header_media; ?>
						</div>
					</div>	

				</div>

				<div class="small-12 medium-6 columns">

					<?php tpcvendors_header_heading( 'large' ); ?>

					<?php echo $sub_heading; ?>

					<?php tpcvendors_button( 'vendor_header_button_text' ) ?>

				</div>
				
			</div>
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

	$section_title = get_post_meta( get_the_ID(), 'vendor_ib_heading_text', true );

	if ( isset( $section_title ) ) {

    	$section_title = esc_html( $section_title );
    }

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

	    tpcvendors_section_title( $section_title );

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
		    echo '<p>' . $content . '</p>'; // Description
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

	$section_title = get_post_meta( get_the_ID(), 'vendor_staff_heading_text', true );

	if ( isset( $section_title ) ) {

    	$section_title = esc_html( $section_title );
    }

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

	    tpcvendors_section_title( $section_title );

		foreach ( (array) $entries as $key => $entry ) {

			// Store field values in variables to use in markup
			if ( isset( $entry['name'] ) ) {

	        	$name = esc_html( $entry['name'] );
			}

	        if ( isset( $entry['title'] ) ) {

	        	$title = esc_html( $entry['title'] );
	        }

	        if ( isset( $entry['content'] ) ) {

	        	$content = tpcvendors_do_wysiwyg_output( $entry['content'] );
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

	        	$content = tpcvendors_do_wysiwyg_output( $entry['content'] );
	        }

	        echo '<div class="extra-content-wrap wrap">'; // Wrap Open

	        tpcvendors_section_title( $section_title );

			echo '<div class="row">'; // Row Open
			echo '<div class="small-12 columns">';
			echo $content;
			echo '</div></div></div>'; // Wrap, Row, and Column Close

	    }
	}
}

/**
 * Call to Action Section Markup
 *
 * @return void
 */
function tpcvendors_final_cta() {

	$entry = get_post_meta( get_the_ID(), 'vendor_header_button_text', true );

	if ( isset( $entry ) ) {
		?>
		<div class="call-to-action cta-final-wrap wrap">
		  	<div class="row">
			    <div class="large-8 medium-9 medium-centered columns">
			    	<?php tpcvendors_button( 'vendor_header_button_text' ); ?>
			    </div>  
		  	</div>
		</div>
		<?php
	}
}
