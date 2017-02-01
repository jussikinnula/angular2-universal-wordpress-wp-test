<?php
/**
 * Custom template tags for this theme
 *
 * @package _frc
 */

/**
 * Filter Body classes
 *
 * @link http://codex.wordpress.org/Function_Reference/body_class
 * @link https://core.trac.wordpress.org/browser/tags/4.1.1/src/wp-includes/post-template.php#L501
 */

 if ( ! function_exists( 'theme_body_classes' ) ) :

	add_filter( 'body_class', 'theme_body_classes', 10, 2 );
	function theme_body_classes( $wp_classes = array(), $extra_classes = array() ) {

		global $post;

		// List of general classes we want to keep
		$whitelist = array(
			'admin-bar',
			'attachment',
			'archive',
			'blog',
			'category',
			'date',
			'error404',
			'has-post-thumbnail',
			'home',
			'logged-in',
			'page',
			'post',
			'post-password-required',
			'post-type-archive',
			'search',
			'single',
			'singular',
			'sticky',
			'tag',
		);

		// List of dynamic classes we want to keep
		$dynamic_classes = array(
			'attachmentid-([a-zA-Z])', # attachmentid-[attachment-name]
			'category-([a-zA-Z])',     # category-[category-name]
			'page-id-(.)',             # page-id-[id]
			'postid-(.)',              # postid-[id]
			'post-type-archive-(.)',   # post-type-archive-[post-type]
			'single-format-(.)',       # single-format-[post-format]
			'tag-([a-zA-Z])',          # tag-[tag-name]
		);

		$pattern = '/(' . implode( '|', $dynamic_classes ) . ')/i';

		foreach ( $wp_classes as $wp_class ) {
			if ( preg_match( $pattern, $wp_class ) ) { array_push( $extra_classes, $wp_class ); }
		}

		// Custom classes we want to add
		if ( get_post_type() && ! is_attachment() && ! is_search() ) { array_push( $extra_classes, 'post-type-' . sanitize_html_class( get_post_type() ) ); } # [post-type]-[slug]
		if ( is_page_template() ) { array_push( $extra_classes, 'template-' . sanitize_html_class( pathinfo( get_page_template() )['filename'] ) ); } # template-[filename]
		if ( is_front_page() ) { array_push( $extra_classes, 'template-front-page' ); }
		if ( is_home() ) { array_push( $extra_classes, 'template-home' ); }

		// Remove non-whitelisted classes
		$wp_classes = array_intersect( $wp_classes, $whitelist );

		// Merge extra classes and sort everything alphabetically
		$theme_classes = array_merge( $wp_classes, $extra_classes );
		sort( $theme_classes );

		// Return modified classes
		return $theme_classes;

	}

endif;

if ( ! function_exists( 'theme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
	function theme_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', '_frc' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', '_frc' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK

	}

endif;

if ( ! function_exists( 'theme_archive_title' ) ) :
/**
 * Shim for `theme_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
	function theme_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( esc_html__( 'Category: %s', '_frc' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( esc_html__( 'Tag: %s', '_frc' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( esc_html__( 'Author: %s', '_frc' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( esc_html__( 'Year: %s', '_frc' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', '_frc' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( esc_html__( 'Month: %s', '_frc' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', '_frc' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( esc_html__( 'Day: %s', '_frc' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', '_frc' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = esc_html_x( 'Asides', 'post format archive title', '_frc' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = esc_html_x( 'Galleries', 'post format archive title', '_frc' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = esc_html_x( 'Images', 'post format archive title', '_frc' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = esc_html_x( 'Videos', 'post format archive title', '_frc' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = esc_html_x( 'Quotes', 'post format archive title', '_frc' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = esc_html_x( 'Links', 'post format archive title', '_frc' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = esc_html_x( 'Statuses', 'post format archive title', '_frc' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = esc_html_x( 'Audio', 'post format archive title', '_frc' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = esc_html_x( 'Chats', 'post format archive title', '_frc' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( esc_html__( 'Archives: %s', '_frc' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s: %2$s', '_frc' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = esc_html__( 'Archives', '_frc' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_theme_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;  // WPCS: XSS OK
		}
	}

endif;
