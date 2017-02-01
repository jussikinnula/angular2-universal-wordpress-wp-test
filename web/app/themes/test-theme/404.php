<?php
/**
 * Template for displaying 404 pages (not found)
 *
 * @package _frc
 */

	get_header(); ?>

	<div class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'That page can&rsquo;t be found.', '_frc' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_frc' ); ?></p>

					<?php get_search_form(); ?>

				</div>
			</section>

		</main>
	</div>

<?php get_footer(); ?>