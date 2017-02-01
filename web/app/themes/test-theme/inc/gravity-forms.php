<?php
/**
 * Gravity Forms specific functions and filters
 *
 * @package _frc
 */

/**
 * Disable Admin Notifications from Gravity Forms
 *
 * @link http://www.gravityhelp.com/documentation/gravity-forms/extending-gravity-forms/hooks/filters/gform_disable_admin_notification/
 */
/*
add_filter( 'gform_disable_admin_notification', 'disable_gf_admin_notification', 10, 3 );
function disable_gf_admin_notification( $is_disabled, $form, $entry ) {
	return true;
}
*/
/**
 * Set access to Gravity Forms based on a specific role
 */
/*
add_action( 'admin_init', 'gf_additional_user_roles' );
function gf_additional_user_roles() {
	$role = get_role( 'editor' );
	$role->add_cap( 'gform_full_access' );
}
*/
