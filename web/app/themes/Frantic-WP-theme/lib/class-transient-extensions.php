<?php
/**
 * Transient Extensions with Polylang and WPML Support
 *
 * @link http://codex.wordpress.org/Transients_API
 *
 * @package _frc
 * @package Algol
 */

class TransientExtensions {

/**
 * Compress HTML before saving to transient
 */
	function compress_transient( $content ) {

		// Remove tabs
		$content = str_replace( "\t", '', $content );

		// Remove line breaks
		$content = str_replace( "\n", '', $content );

		return $content;
	}

/**
 * Remove all theme related transients
 *
 * This will delete all transients starting with the table prefix defined in wp-config.php
 * All theme transients are saved by default using this prefix
 *
 * @example $transient_extensions = new TransientExtensions();
 * @example $transient_extensions->delete_all_transients();
 *
 * @return Redirects to self removing any custom queries from the URL
 */
	function delete_all_transients() {

		global $wpdb;

		$prefix = $this->transient_prefix();
		$transients = $this->get_all_transients( $prefix );

		if ( ! empty( $transients ) && is_array( $transients ) ) {
			foreach( $transients as $transient ) {
				if ( isset( $transient->name ) ) {
					$transient_name = str_replace( '_transient_', '', $transient->name );
					delete_transient( $transient_name );
				}
			}
		}
	}

/**
 * Remove individual transient
 *
 * This will delete any transient containing a keyword (including language versions)
 *
 * @example $transient_extensions = new TransientExtensions();
 * @example $transient_extensions->delete_transients_like( 'footer-navigation' );
 *
 * This would remove footer-navigation-anything-en and footer-navigation-anything-fi
 */
	function delete_transients_like( $transient_name = false ) {

		if ( empty( $transient_name ) ) return;

		global $wpdb;

		$prefix = $this->transient_prefix();

		$prefix = esc_sql( $prefix );
		$transient_name = esc_sql( $transient_name );

		$sql = "SELECT `option_name` AS `name`
				FROM  $wpdb->options
				WHERE `option_name` LIKE '%\_transient\_$prefix%$transient_name%'
				ORDER BY `option_name`";

		$transients = $wpdb->get_results( $sql );

		// Remove all transients found one by one
		foreach( $transients as $transient ) {
			if ( isset( $transient->name ) ) {
				$transient_name = str_replace( '_transient_', '', $transient->name );
				delete_transient( $transient_name );
			}
		}
	}

/**
 * Display transient data
 *
 * Use this to output the transient data or return it in a string
 * @param mixed $content               Content of the transient
 * @param boolean $served_from_cache   Used to determine whether the transient came from cache
 * @param string $transient_name       Name of the transient
 *
 * Echo the results:
 * @example <?php display_transient( $content, $served_from_cache, $transient_name ); ?>
 *
 * Store the results in a variable
 * @example <?php $display = display_transient( $content, $served_from_cache, $transient_name, false ); ?>
 */

	function display_transient( $content, $served_from_cache = false, $transient_name = false, $echo = true ) {

		if ( empty( $content ) ) return;

		// Only print out HTML comment if we're logged-in or
		// in debug mode with cache turned off
		$html_comment = is_user_logged_in() ||
		( true === WP_DEBUG && false === WP_CACHE ) ?
		$this->get_cache_status( $served_from_cache, $transient_name ) : '';

		if ( $echo ) { echo $content . $html_comment . "\n"; }
		else { return $content . $html_comment; }
	}

/**
 * Returns an array of all transients stored in database
 *
 * Use optional parameter to limit search to certain transients saved using a prefix
 *
 * @param string $prefix (optional, but important for determining theme-related transients)
 * @see transient_prefix()
 *
 * Retrieve all the transients from site:
 * @example $transient_extensions = new TransientExtensions();
 * @example $transients = $transient_extensions->get_transients();
 *
 * Retrieve specific transients using a prefix
 * @example $transient_extensions = new TransientExtensions();
 * @example $transients = $transient_extensions->get_transients( 'prefix_name' );
 *
 * Retrieve theme specific transients using the table prefix from wp-config.php:
 * If you don't know which one to use, use this!
 * @example $transient_extensions = new TransientExtensions();
 * @example $theme_prefix = $this->transient_prefix();
 * @example $transients = $transient_extensions->get_transients( $theme_prefix );
 *
 * @return array containing PHP objects
 */
	function get_all_transients( $prefix = '' ) {

		global $wpdb;

		$prefix = esc_sql( $prefix );

		$sql = "SELECT `option_name` AS `name`
				FROM  $wpdb->options
				WHERE `option_name` LIKE '%\_transient\_$prefix%'
				ORDER BY `option_name`";

		$transients = $wpdb->get_results( $sql );

		return $transients;
	}

/**
 * Get cache status
 *
 * @param string $content Content of the transient
 * @param string $transient_name Name of the transient
 *
 * @return string HTML comment
 */
	function get_cache_status( $served_from_cache = false, $transient_name = false ) {

		if ( empty( $served_from_cache ) ) {
			$cache_message = '<!-- Transient created -->';
		} else {
			$cache_message = '<!-- Served from cache -->';
		}

	/**
	 * Append transient name if present
	 *
	 * @return string <!-- Transient created: Transient name -->
	 * @return string <!-- Served from cache: Transient name -->
	 */
		if ( ! empty ( $transient_name ) ) {
			$cache_message = preg_replace('/ -->/', ': ' . $transient_name . ' -->', $cache_message );
		}

		return $cache_message;
	}

/**
 * Build transient name
 *
 * Returns transient name with prefix and suffix attached to it
 * Whether those two contain anything is up to how they are called
 *
 * @see transient_prefix() and transient_suffix()
 *
 * @param string $name Name of transient
 *
 * @example $transient_extensions = new TransientExtensions();
 * @example $transient_name = $transient_extensions->build_transient_name( 'header-navigation' );
 *
 * @return string (prefix_)header-navigation(_suffix)
 */
	function build_transient_name( $name, $custom_suffix = '' ) {

		if ( empty( $name ) ) return;
		else return $this->transient_prefix() . $name . $this->transient_suffix( $custom_suffix );
	}

/**
 * Save transient
 *
 * @param string $transient_name Name of the transient
 * @param string $content Contents on what you want to Save
 * @param int $expiration Time until expiration in seconds. Default 0.
 *
 * @link https://developer.wordpress.org/reference/functions/set_transient/
 */
	function save_transient( $transient_name, $content, $expiration = 0 ) {

		if ( empty( $transient_name ) || empty( $content ) ) return;

		// Clean up HTML before saving to cache
		$content = $this->compress_transient( $content );

		set_transient( $transient_name, $content, $expiration );

		return $content;
	}

/**
 * String added to the beginning of get_transient() and set_transient()
 * based on table prefix set in `wp-config.php`
 *
 * @return String
 */
	function transient_prefix() {
		global $wpdb; return $wpdb->prefix;
	}

/**
 * String added to the end of get_transient() and set_transient()
 *
 * Adds support for language code if Polylang / WPML are prsent
 * Adds an additional string if user is logged in
 *
 * @return string $suffix Contains logged in status and language information
 */
	function transient_suffix( $suffix = '' ) {

		// User is logged in
		if ( is_user_logged_in() ) {
			$suffix .= '_' . 'logged-in';
		}

		// Store locale if Polylang or WPML are present
		if ( function_exists( 'pll_current_language' ) || defined( 'ICL_LANGUAGE_CODE' ) ) {
			$suffix .= '_' . get_locale();
		}

		return $suffix;
	}

/**
 * Function used to determine whether to use transients or not
 *
 * @example $transient_extensions = new TransientExtensions();
 * @example $transient_extensions->use_transients();
 *
 * @return Boolean
 */
	function use_transients() {
		if ( defined( 'WP_CACHE' ) && 'false' === strtolower( WP_CACHE ) ) {
			return false;

		} else {
			return true;
		}
	}

} // End Transient Extensions class
