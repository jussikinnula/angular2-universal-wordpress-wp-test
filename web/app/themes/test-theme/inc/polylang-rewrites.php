<?php
/**
 * Polylang - Translate URL Rewrite Slugs
 *
 * @link https://polylang.wordpress.com/
 * @link https://github.com/KLicheR/wp-polylang-translate-rewrite-slugs
 */

	add_filter( 'pll_translated_post_type_rewrite_slugs', 'theme_slug_translations' );
	function theme_slug_translations( $post_type_translated_slugs ) {
/*
		// Add translations
		$post_type_translated_slugs = array(

			// Custom Post Type name
			'custom-post-type-name' => array(
				'en' => array(
					'has_archive' => false,
					'rewrite' => array(
						'slug' => 'custom-post-type-slug-english',
					),
				),
				'fi' => array(
					'has_archive' => false,
					'rewrite' => array(
						'slug' => 'custom-post-type-slug-finnish',
					),
				),
			),

		);
*/
		return $post_type_translated_slugs;

	}
