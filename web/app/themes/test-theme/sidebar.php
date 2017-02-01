<?php
/**
 * The sidebar containing the main widget area
 *
 * @package _frc
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) { return; } ?>

	<aside class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
