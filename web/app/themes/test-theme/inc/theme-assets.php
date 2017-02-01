<?php
/**
 * Enqueue scripts and styles.
 *
 * @package _frc
 */

/**
 * Admin specific styles and scripts
 *
 * Assets will be assigned a version number based on their modified date (filetime)
 * Usage: wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
 */

// Load admin styles in front-end for users who can edit content
// You can use admin.scss to style content management tools such as edit buttons and the Admin Bar
if ( current_user_can( 'edit_posts' ) ) {
	add_action( 'wp_enqueue_scripts', 'admin_styles' );
}

// Load admin styles and scripts in Admin view
add_action( 'admin_enqueue_scripts', 'admin_styles' );
function admin_styles() {
	wp_enqueue_style( 'admin-styles', get_stylesheet_directory_uri() . '/assets/css/admin.css' );
}

// Load editor styles generated based on editor-style.scss
// http://codex.wordpress.org/Function_Reference/add_editor_style
add_action( 'admin_init', 'custom_editor_styles' );
function custom_editor_styles() {
	add_editor_style( get_stylesheet_directory_uri() . '/assets/css/editor-style.css' );
}

// Load styles for the login screen generated based on login.scss
add_action( 'login_enqueue_scripts', 'login_styles' );
function login_styles() {
	wp_enqueue_style( 'login-style', get_stylesheet_directory_uri() . '/assets/css/login.css' );
}

/**
 * Enqueue theme styles and scripts
 *
 * Assets will be assigned a version number based on their modified date (filetime)
 * Usage: wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
 */

add_action( 'wp_enqueue_scripts', 'theme_assets' );
function theme_assets() {

	// Load jQuery
	wp_enqueue_script( 'jquery' );

	// Load Modernizr
	// wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/assets/js/modernizr.js', 'plugins', filemtime( get_stylesheet_directory() . '/assets/js/modernizr.js' ), false );

	wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/main.min.css', false, filemtime( get_stylesheet_directory() . '/assets/css/main.min.css' ), 'all' );
	wp_enqueue_style( 'print', get_stylesheet_directory_uri() . '/assets/css/print.css', 'theme-style', filemtime( get_stylesheet_directory() . '/assets/css/print.css' ), 'print' );
	wp_enqueue_script( 'theme-js', get_stylesheet_directory_uri() . '/assets/js/main.min.js', 'plugins', filemtime( get_stylesheet_directory() . '/assets/js/main.min.js' ), true );
/*
	if ( strtolower( getenv( 'WP_DEV' ) ) === 'true' ) {
		// Only in development
	} else {
		// Only in production
	}
*/
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
