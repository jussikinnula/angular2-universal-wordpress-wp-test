<?php
/**
 * Template for displaying the header
 *
 * Displays everything up until <div class="site-content">
 *
 * @package _frc
 */
?><!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js ie ie7 lt-ie10 lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if lt IE 9]><html class="no-js ie ie8 lt-ie10 lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if lt IE 10]><html class="no-js ie ie9 lt-ie10" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="author" href="/humans.txt" />
	<link rel="profile" href="http://gmpg.org/xfn/11" /><?php

	// Meta description and keywords
	if ( is_singular() || is_front_page() || is_home() ) :

		$excerpt = get_the_excerpt();
		$keywords = get_the_tag_list( false, ', ', false );

		if ( ! empty( $excerpt ) ) : echo "\n"; ?>

		<meta name="description" content="<?php echo strip_tags( trim( $excerpt ) ); ?>" /><?php

	endif;

		if ( ! empty ( $keywords ) ) : ?>

		<meta name="keywords" content="<?php echo strip_tags( $keywords ); ?>" /><?php

	endif; ?>

	<?php endif; ?>

	<!--[if (lt IE 9) & (!IEMobile)]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/nwmatcher/1.2.5/nwmatcher.min.js" type="text/javascript"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js" type="text/javascript"></script>
	<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="site-header" role="banner">

		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<nav class="header-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<?php echo esc_html_x( 'Menu', 'Text for menu toggle button on mobile', '_frc' ); ?>
			</button>
			<?php wp_nav_menu( array(
				'container'      => false,
				'theme_location' => 'header',
				'menu_class'     => 'nav-primary',
				'menu_id'        => 'primary-menu' // Required by aria-controls
			) ); ?>
		</nav>

	</header>

	<div class="site-content">
