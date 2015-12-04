<?php
/**
 * Single Post Template
 *
 * @package TPC Vendors/Templates/Single
 * @since  0.1.0
 */

require( dirname(__FILE__) . '/../inc/frontend-functions.php' );

get_header();

tpcvendors_landing_section();

tpcvendors_infobox_section();

tpcvendors_staff_section();

tpcvendors_extra_content_section();

tpcvendors_final_cta();

get_footer();

?>
