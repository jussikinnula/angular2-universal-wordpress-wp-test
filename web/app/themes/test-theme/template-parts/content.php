<?php
/**
 * Template for displaying content with permalinks
 * Use content-single.php for single posts and pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _frc
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumbnail">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
			<?php endif; ?>
		</header>

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>

		<footer class="entry-footer">
			<?php theme_entry_footer(); ?>
		</footer>

	</article>
