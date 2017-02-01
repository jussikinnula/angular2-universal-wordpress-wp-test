<?php
/**
 * Template used for displaying page content in page.php
 *
 * @package _frc
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>
		</header>

		<div class="entry-content">
			<?php the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_frc' ),
					'after'  => '</div>',
				) ); ?>
		</div>

		<footer class="entry-footer">
			<?php get_template_part( 'template-parts/content', 'entry-footer' ); ?>
		</footer>

	</article>
