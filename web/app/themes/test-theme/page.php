<?php
/**
 * Template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _frc
 */

	get_header(); ?>

	<div class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// if ( comments_open() || get_comments_number() ) comments_template();

			endwhile; ?>

		</main>
	</div>

<?php /* get_sidebar(); */ ?>
<?php get_footer(); ?>