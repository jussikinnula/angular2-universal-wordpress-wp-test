<?php
/**
 * _frc Theme Customizer
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 * @package _frc
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object
 */

if ( ! function_exists( 'theme_customize_register' ) ) :

	add_action( 'customize_register', 'theme_customize_register' );
	function theme_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	}

endif;