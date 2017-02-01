<?php
/**
 * Localized strings for JavaScript files
 *
 * @param objectL10n
 * @example console.log( objectL10n.localized_string );
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_localize_script
 *
 * @package _frc
 */

add_action( 'wp_enqueue_scripts', 'theme_localize_js' );
function theme_localize_js() {

	wp_localize_script( 'main-js', 'objectL10n', array(
		'localized_string' => esc_js( 'Localized string', '_frc' ),
	) );

}
