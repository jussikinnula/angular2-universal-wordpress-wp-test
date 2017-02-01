<?php
/**
 * _frc functions and theme setup
 *
 * @package _frc
 */

/**
 * Theme setup
 */
	require_once get_stylesheet_directory() . '/inc/admin-features.php';
	require_once get_stylesheet_directory() . '/inc/customizer.php';
	require_once get_stylesheet_directory() . '/inc/localize-js.php';
	require_once get_stylesheet_directory() . '/inc/media.php';
	require_once get_stylesheet_directory() . '/inc/theme-assets.php';
	require_once get_stylesheet_directory() . '/inc/theme-setup.php';

/**
 * Register custom elements
 */
	# require_once get_stylesheet_directory() . '/inc/register-navigation.php';
	# require_once get_stylesheet_directory() . '/inc/register-post-types.php';
	# require_once get_stylesheet_directory() . '/inc/register-sidebars.php';
	# require_once get_stylesheet_directory() . '/inc/register-taxonomies.php';

/**
 * Transient Management
 */
	# require_once get_stylesheet_directory() . '/inc/transient-management.php';

/**
 * Extras
 */
 #	require_once get_stylesheet_directory() . '/inc/login-redirects.php';
	require_once get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Plugins
 */
	# require_once get_stylesheet_directory() . '/inc/acf-options.php';
	# require_once get_stylesheet_directory() . '/inc/gravity-forms.php';
	# require_once get_stylesheet_directory() . '/inc/polylang-rewrites.php';


/**
 * WP-API extensions
 */
	require_once get_stylesheet_directory() . '/inc/wp-api-extensions.php';
