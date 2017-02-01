<?php
/**
 * Media related features
 *
 * @package _frc
 */

/**
 * Set the image quality for thumbnails
 *
 * @param int $quality The default quality (90)
 * @return int $quality Amended quality (100)
 */

add_filter( 'jpeg_quality', 'image_quality' );
add_filter( 'wp_editor_set_quality', 'image_quality' );
function image_quality( $quality ) {
	return 100;
}

/**
 * Remove height and width attributes from images
 *
 * @link http://css-tricks.com/snippets/wordpress/remove-width-and-height-attributes-from-inserted-images/
 */

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
function remove_width_attribute( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	return $html;
}

/**
 * Remove links from images by default
 *
 * @link http://andrewnorcross.com/tutorials/stop-hyperlinking-images/
 */

add_action( 'admin_init', 'remove_image_links', 10 );
function remove_image_links() {
	$image_set = get_option( 'image_default_link_type' );
	if ( $image_set !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}
