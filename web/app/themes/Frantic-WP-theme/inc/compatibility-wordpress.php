<?php
/**
 * WordPress Compatibility File
 *
 * @package _frc
 */

 if ( ! function_exists( 'remove_wordpress_features' ) ) :

	 add_action( 'init', 'remove_wordpress_features' );
	 function remove_wordpress_features() {

	 	// Remove RSS feeds
	 	# remove_action( 'wp_head', 'feed_links', 2 );
	 	# remove_action( 'wp_head', 'feed_links_extra', 3 );

	 	remove_action( 'wp_head', 'rsd_link' );
	 	remove_action( 'wp_head', 'wlwmanifest_link' );
	 	# remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	 	# remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	 	# remove_action( 'wp_head', 'index_rel_link' );
	 	# remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	 	// Remove WordPress version and shortlink
	 	add_action( 'the_generator', 'remove_version_info' );
	 	function remove_version_info() { return ''; }
	 	remove_action( 'wp_head', 'wp_generator' );
	 	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	 	// Remove inline styles from Tag cloud
	 	add_filter( 'wp_generate_tag_cloud', 'xf_tag_cloud', 10, 3 );
	 	function xf_tag_cloud( $tag_string ) {
	 		return preg_replace( "/style='font-size:.+pt;'/", '', $tag_string );
	 	}

	 }

	 /**
	  * Disable Emojis
	  *
	  * @link http://wordpress.stackexchange.com/a/185578
	  */

	 if ( ! function_exists( 'frc_disable_emojicons_tinymce' ) ) {
	 	function frc_disable_emojicons_tinymce( $plugins ) {
	 		if ( is_array( $plugins ) ) {
	 			return array_diff( $plugins, array( 'wpemoji' ) );
	 		} else {
	 			return array();
	 		}
	 	}
	 }

	 if ( ! function_exists( 'frc_disable_emojicons_tinymce' ) ) {
	 	add_action( 'init', 'frc_disable_emojicons_tinymce' );
	 	function frc_disable_emojicons_tinymce() {

	 		// Remove Emojis from TinyMCE
	 		add_filter( 'tiny_mce_plugins', 'frc_disable_emojicons_tinymce' );

	 		// Remove Emoji styles
	 		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	 		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	 		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	 		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	 		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	 		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	 		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	 	}
	 }

	 /**
	  * Remove Admin Bar from Subscribers
	  */
	 if ( ! current_user_can( 'edit_posts' ) ) {
	 	show_admin_bar( false );
	 	add_filter( 'show_admin_bar', '__return_false' );
	 }

	 /**
	  * Remove Customize link from Admin Bar
	  *
	  * @link wordpress.org/support/topic/customize-in-admin-bar-is-not-welcome-_-
	  */
	 add_action( 'admin_bar_menu', 'remove_customize', 999 );
	 function remove_customize( $wp_admin_bar ) {
	 	$wp_admin_bar->remove_node( 'customize' );
	 }

	 /**
	  * Remove Update Core message from Dashboard
	  */
	 add_action( 'admin_menu', 'hide_wordpress_update_notices' );
	 function hide_wordpress_update_notices() {
	 	remove_action( 'admin_notices', 'update_nag', 3 );
	 }

	 /**
	  * Disable XMLRPC functionalities
	  *
	  * @link http://codex.wordpress.org/Function_Reference/bloginfo
	  * @link http://codex.wordpress.org/Plugin_API/Action_Reference/wp
	  * @link https://developer.wordpress.org/reference/hooks/wp_headers/
	  * @link https://developer.wordpress.org/reference/hooks/xmlrpc_call/
	  * @link https://developer.wordpress.org/reference/hooks/xmlrpc_enabled/
	  * @link https://developer.wordpress.org/reference/hooks/xmlrpc_methods/
	  */

	 // Disable XMLRPC completely
	 # add_filter( 'xmlrpc_enabled', '__return_false' );

	 // Disable X-Pingback HTTP Header
	 add_filter( 'wp_headers', 'disable_pingback_header', 11, 2 );
	 function disable_pingback_header( $headers, $wp_query ) {
	 	if ( isset( $headers['X-Pingback'] ) ) { unset( $headers['X-Pingback'] ); }
	 	return $headers;
	 }

	 // Hijack pingback_url for get_bloginfo (<link rel="pingback" />)
	 add_filter( 'bloginfo_url', 'disable_pingback_url', 11, 2 );
	 function disable_pingback_url( $output, $property ) {
	 	return ( $property == 'pingback_url' ) ? null : $output;
	 }

	 // Remove Pingback method
	 add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
	 function remove_xmlrpc_pingback_ping( $methods ) {
	 	unset( $methods['pingback.ping'] );
	 	return $methods;
	 }

	 // Remove rsd_link from filters (<link rel="EditURI" />)
	 add_action( 'wp', 'disable_rsd_link', 9 );
	 function disable_rsd_link() {
	 	remove_action( 'wp_head', 'rsd_link' );
	 }

	 // Disable specific XMLRPC calls
	 add_action( 'xmlrpc_call', function( $method ) {
	 	switch ( $method ) {

	 		case 'pingback.ping':
	 			wp_die(
	 				'Pingback functionality is disabled on this site',
	 				'Pingback disabled', array( 'response' => 403 )
	 			);
	 			break;

	 		default:
	 			return;
	 	}
	 });

 endif;