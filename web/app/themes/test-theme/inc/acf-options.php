<?php
/**
 * Advanced Custom Fields
 *
 * @package _frc
 */

/**
 * ACF Options page
 *
 * @link http://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
/*
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'menu_title' => esc_html__( 'Options', '_frc' ),
		'menu_slug'  => 'theme-settings',
		'capability' => 'switch_themes',
		'icon_url'   => 'dashicons-feedback',
		'redirect'   => true
	));

	acf_add_options_sub_page( array(
		'title'      => esc_html__( 'Theme settings', '_frc' ),
		'parent'     => 'theme-settings',
		'capability' => 'switch_themes'
	));

}
*/

/**
 * Filter data from ACF Relationship fields
 *
 * @link http://www.advancedcustomfields.com/resources/acf-fields-relationship-query/
 */

add_filter( 'acf/fields/relationship/query', 'acf_relationship_query', 10, 3 );
function acf_relationship_query( $options, $field, $the_post ) {

	// Show only published posts
	$options['post_status'] = array(
		'publish'
	);

	return $options;
}
