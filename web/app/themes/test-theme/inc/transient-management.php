<?php
/**
 * Transient management
 *
 * @link http://codex.wordpress.org/Function_Reference/delete_transient
 *
 * @package _frc
 */

/**
 * Initialize Transient Extensions
 */
 	require_once( get_template_directory() . '/lib/class-transient-extensions.php' );
	$transient_extensions = new TransientExtensions();

/**
 * Add link to Admin Bar to delete all transients
 */
	if ( is_super_admin() ) add_action( 'admin_bar_menu', 'toolbar_delete_cache', 999 );
	function toolbar_delete_cache( $wp_admin_bar ) {
		$args = array(
			'id'    => 'delete-cache',
			'title' => __( 'Delete cache', 'Algol' ),
			'href'  => '?delete-cache=true',
			'meta'  => array( 'class' => 'toolbar-delete-cache' )
		);
		$wp_admin_bar->add_node( $args );
	}

/**
 * Clear transients on load, if `WP_CACHE` env is set to `false` (see functions.php)
 */
	if ( false === $transient_extensions->use_transients() ) {
		add_action( 'init', 'delete_all_transients' );
	}

/**
 * Delete all transients if URL contains ?delete-cache=true
 */
	if ( isset( $_GET['delete-cache'] ) && strtolower( $_GET['delete-cache'] ) === 'true' ) {
		$transient_extensions->delete_all_transients();
		wp_redirect( $_SERVER['PHP_SELF'] );
		exit();
	}

/**
 * Main actions
 */

#	add_action( 'edit_category', 'theme_flush_all' );
#	add_action( 'edit_term', 'theme_flush_all' );
#	add_action( 'save_post', 'theme_post_type_transients' );
#	add_action( 'wp_update_nav_menu', 'theme_nav_transients' );
#	add_filter( 'widget_update_callback', 'theme_flush_all' );

/**
 * Transient functions
 */
	function theme_flush_all() {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		if ( empty( $post_id ) ) return;

		$transient_extensions = new TransientExtensions();
		$transient_extensions->delete_all_transients();

	}

/**
 * Example of flushing nav transients
 */
	function theme_nav_transients( $post_id ) {

		if ( empty( $post_id ) ) return;

		$transient_extensions = new TransientExtensions();
		$transient_extensions->delete_transients_like( 'transient-name' );
	}

/**
 * Example of flushing by post type
 */
	function theme_post_type_transients( $post_id ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		if ( empty( $post_id ) ) return;

		$transient_extensions = new TransientExtensions();

		switch ( get_post_type( $post_id ) ) :

			case 'custom-post-type':
				$transient_extensions->delete_transients_like( 'transient-name' );
				break;

			default:
				$transient_extensions->delete_all_transients();

		endswitch;
	}
