<?php
/**
 * Template part for displaying results in search.php
 *
 * @package _frc
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', '_frc' ); ?></h1>
		</header>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

		<footer class="entry-footer">
			<?php theme_entry_footer(); ?>
		</footer>

	</article>
