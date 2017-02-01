<?php
/**
 * Redirect subscribers to front page after a successful login
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 *
 * @package _frc
 */

add_filter( 'login_redirect', 'subscriber_login_redirect', 10, 3 );
function subscriber_login_redirect( $redirect_to, $request, $user ) {

	global $user;
	$user_roles = isset( $user->roles ) && is_array( $user->roles ) ? $user->roles : false;

	if ( ! empty( $user_roles ) ) {

		// Redirect subscribers to front page or a predetermined location other than wp-admin
		if ( in_array( 'subscriber', $user->roles ) && strpos( $redirect_to, 'wp-admin' ) ) {
			return home_url();

			// Redirect to default place
		} else {
			return $redirect_to;
		}
	} else {
		return $redirect_to;
	}

}
