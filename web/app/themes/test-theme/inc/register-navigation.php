<?php
/**
 * Register navigation menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
 * @link http://generatewp.com/nav-menus/
 *
 * @package _frc
 */

register_nav_menus( array(
	'header' => esc_html__( 'Header navigation', '_frc' ),
	'footer' => esc_html__( 'Footer navigation', '_frc' ),
) );
