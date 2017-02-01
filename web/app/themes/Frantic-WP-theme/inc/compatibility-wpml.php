<?php
/**
 * WPML Compatibility File
 *
 * @package _frc
 */

 if ( ! function_exists( 'remove_wpml_features' ) ) :

	 add_action( 'init', 'remove_wpml_features' );
	 function remove_wpml_features() {

	 	global $sitepress;

	 	if ( empty( $sitepress ) ) { return; }

	 	// Remove WPML's generator meta tag
	 	add_action( 'wp_head', function() {
	 		remove_action( current_filter(), array( $GLOBALS['sitepress'], 'meta_generator_tag' ) );
	 	}, 0 );

	 	// Remove stylesheets for WPML's Language Selector
	 	define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );

	 	// Remove WPML promotions for translation services
	 	define( 'ICL_DONT_PROMOTE', true );

	 	// Hide iCanLocalize reminders panel
	 	remove_action( 'admin_notices', array( $sitepress, 'icl_reminders' ) );

	 	// Removes WPML's Dashboard metabox
	 	remove_action( 'wp_dashboard_setup', array( $sitepress, 'dashboard_widget_setup' ) );

	 	// Remove Access Group and Content Template (requires Access plugin)
	 	if ( defined('Access_Helper') ) {
	 		remove_action( 'admin_head', array( Access_Helper, 'wpcf_access_select_group_metabox' ));
	 	}

	 }

	 /**
	  * Remove WPML's Multilingual Content Setup metabox
	  *
	  * @link http://codex.wordpress.org/Function_Reference/remove_meta_box
	  */
	 	add_action( 'admin_head', 'remove_wpml_metaboxes' );
	 	function remove_wpml_metaboxes() {
	 		$screen = get_current_screen();
	 		remove_meta_box( 'icl_div_config', $screen->post_type, 'normal' );
	 	}

 endif;
