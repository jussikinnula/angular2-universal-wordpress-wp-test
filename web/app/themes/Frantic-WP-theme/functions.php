<?php
/**
 * _frc functions and theme setup
 *
 * @package _frc
 */

 /**
  * Classes
  */
 	require_once get_template_directory() . '/lib/class-transient-extensions.php';

/**
 * Theme setup
 */
	require_once get_template_directory() . '/inc/customizer.php';
	require_once get_template_directory() . '/inc/template-tags.php';
	require_once get_template_directory() . '/inc/compatibility-wordpress.php';

/**
 * Plugins
 */
	if ( function_exists( 'icl_object_id' ) ) {
		require_once get_template_directory() . '/inc/compatibility-wpml.php';
	}

