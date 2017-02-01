<?php
/**
 * _frc theme setup
 *
 * @link http://generatewp.com/theme-support/
 *
 * @package _frc
 */

if ( ! function_exists( 'theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
	add_action( 'after_setup_theme', 'theme_setup' );
	function theme_setup() {

	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _frc, use a find and replace
	 * to change '_frc' to the name of your theme in all the template files
	 */
		load_theme_textdomain( '_frc', get_stylesheet_directory() . '/languages' );

	/**
	 * Set custom image sizes
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_image_size
	 */

	#	add_image_size( 'featured-image', 1280, 350, array('center', 'center') );

	/**
	 * Add custom styles to TinyMCE
	 *
	 * @link http://codex.wordpress.org/TinyMCE_Custom_Styles
	 */
		/*
		if ( ! function_exists( 'theme_mce_before_init' ) ) {
			add_filter( 'tiny_mce_before_init', 'theme_mce_before_init' );
			function theme_mce_before_init( $settings ) {

				$style_formats = array(

					array(
						'title'    => esc_html__( 'Prevent wrapping', '_frc' ),
						'inline'   => 'span',
						'classes'  => 'no-wrap',
					),

				);

				$settings['style_formats'] = json_encode( $style_formats );
				return $settings;
			}
		}
		*/

	/**
	 * Add default posts and comments RSS feed links to head
	 */
		add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
		add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
		add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	 * See http://codex.wordpress.org/Post_Formats
	 */
		/*
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link',
		) );
		*/

	/**
	 * Add theme support for HTML5 Semantic Markup
	 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

	/**
	 * Enable excerpts for pages
	 *
	 * @link http://codex.wordpress.org/Excerpt
	 */
		add_action( 'init', 'add_page_excerpt_support' );
		function add_page_excerpt_support() {
			add_post_type_support( 'page', 'excerpt' );
		}

	/**
	 * Set excerpt length
	 *
	 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length
	 */
		add_filter( 'excerpt_length', 'custom_excerpt_length' );
		function custom_excerpt_length( $length ) {
			$excerpt_length = 40;
			return $excerpt_length;
		}

	/**
	 * Replace [...] in excerpts
	 *
	 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
	 */
		add_filter( 'excerpt_more', 'custom_excerpt_more' );
		function custom_excerpt_more( $more ) {
			return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' .
			sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', '_frc' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) . '</a>';
		}

	}

endif;