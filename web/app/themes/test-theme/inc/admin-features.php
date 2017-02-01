<?php
/**
 * Admin features
 *
 * @package _frc
 */

/**
 * Force users to login
 *
 * @link https://gist.github.com/richardmtl/a3b7a93131aaeb405990
 */
if ( 'true' === strtolower( getenv( 'WP_DEV' ) ) ) { add_action( 'init', 'force_login' ); }
function force_login() {

	if ( is_user_logged_in() ) { return; }

	// List of pages that will not be blocked
	$exclusions = array(
		'import-csv',
		'wp-login.php',
		'wp-register.php',
		'wp-cron.php',
		'wp-trackback.php',
		'wp-app.php',
		'xmlrpc.php'
	);

	if ( in_array( basename( $_SERVER['PHP_SELF'] ), $exclusions ) ) { return; }
	auth_redirect();
}

/**
 * Actions to be taken in DEVELOPMENT
 * Useful for development and staging enviroments
 */
if ( strtolower( getenv( 'WP_DEV' ) ) === 'true' ) {

	/**
	 * Add warning message to login
	 * Inform the user that they're about to login to a development environment
	 *
	 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/login_message
	 */

	add_filter( 'login_message', 'development_message' );
	function development_message( $message ) {
		return '<p class="message" style="border-left: 4px solid #FFBA00;">' . wp_kses( __( '<strong>Note:</strong> You are about to login to a development environment', '_frc' ), 'strong' ) . '</p>';
	}

	/**
	 * Show included templates in footer (see page source)
	 */

	add_action( 'wp_footer', 'show_templates', 9999 );
	function show_templates() {
		if ( is_super_admin() ) {

			$included_files = get_included_files();
			$stylesheet_dir = str_replace( '\\', '/', get_stylesheet_directory() );
			$template_dir   = str_replace( '\\', '/', get_template_directory() );

			foreach ( $included_files as $key => $path ) {
				$path   = str_replace( '\\', '/', $path );
				if ( false === strpos( $path, $stylesheet_dir ) && false === strpos( $path, $template_dir ) ) {
					unset( $included_files[$key] );
				}
			}

			echo "\n" . '<!-- WordPress Development' . "\n\n" . ' Templates used to generate this page: ' . "\n\n";
			foreach ( $included_files as $file ) {
				// Show templates without revealing their actual location
				echo ' * ' . str_replace( $stylesheet_dir, '', $file ) . "\n";
			}
			echo "\n" . '-->';

		}
	}

}

/**
 * Always show second bar in TinyMCE
 *
 * For further customizations, donwload this:
 * @link https://wordpress.org/plugins/tinymce-advanced/
 */

add_filter( 'tiny_mce_before_init', 'show_tinymce_toolbar' );
function show_tinymce_toolbar( $in ) {
	$in['wordpress_adv_hidden'] = false;
	return $in;
}

/**
 * Customize login page
 *
 * @link http://codex.wordpress.org/Function_Reference/login_header
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/login_headerurl
 */

// Title
add_filter( 'login_headertitle', 'theme_login_headertitle' );
function theme_login_headertitle() {
	return get_bloginfo( 'name' );
}

// URL
add_filter( 'login_headerurl', 'theme_login_headerurl' );
function theme_login_headerurl() {
	return home_url();
}

/**
 * Reorder admin menu
 */

add_filter( 'menu_order', 'custom_menu_order' );
add_filter( 'custom_menu_order', 'custom_menu_order' ); // Activate custom_menu_order
function custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) { return true; }
	return array(
		'index.php', // Dashboard
		'separator1', // Separator
		'edit.php?post_type=page', // Pages
		'edit.php', // Posts
		'separator1', // Separator
		'edit-comments.php', // Comments
		// 'gf_edit_forms', // Gravity forms
		'upload.php', // Media
		'users.php', // Users
		'separator2', // Separator
		// Add custom post types here like this:
		// 'edit.php?post_type=event',
		'separator3', // Separator
		'themes.php', // Appearance
		'options-general.php', // Settings
		'plugins.php', // Plugins
		'tools.php', // Tools
		'separator-last', // Last separator
	);
}

/**
 * Remove menu items from the Dashboard
 */

add_action( 'admin_menu', 'remove_dashboard_menus' );
function remove_dashboard_menus() {

	/**
	 * Specify which users can see the following items based on their email address
	 */
	$user_data = get_userdata( get_current_user_id() );
	$user_email = isset( $user_data->user_email ) ? $user_data->user_email : '';

	if ( ! strpos( $user_email, '@frantic.com' ) ) {

		// Hide Advanced Custom Fields
		remove_menu_page( 'edit.php?post_type=acf-field-group' );

		// Hide AWS plugin
		remove_menu_page( 'amazon-web-services' );

		// Hide "Updates" under Dashboard menu
		remove_submenu_page( 'index.php', 'update-core.php' );

		// Hide General Settings
		remove_menu_page( 'options-general.php' );

		// Hide Plugins
		remove_menu_page( 'plugins.php' );

		// Hide Access
		remove_menu_page( 'types_access' );

		// Hide Jetpack
		remove_menu_page( 'jetpack' );

		// Hide Themes, but keep Menus visible
		remove_submenu_page( 'themes.php', 'themes.php' );
		remove_submenu_page( 'themes.php', 'customize.php?return=' . urlencode( $_SERVER['REQUEST_URI'] ) );

		// Comment out the following to show widgets if they are in fact used in your project.
		remove_submenu_page( 'themes.php', 'widgets.php' );

		// Hide Tools
		remove_menu_page( 'tools.php' );

	}
}