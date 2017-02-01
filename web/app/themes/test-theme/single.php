<?php
/**
 * Template for displaying all single posts
 *
 * @package _frc
 */

	get_header(); ?>

	<div class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			the_post_navigation();

			# if ( comments_open() ) comments_template();

		endwhile; ?>

		</main>
	</div>

<?php /* get_sidebar(); */ ?>
<?php get_footer(); ?>