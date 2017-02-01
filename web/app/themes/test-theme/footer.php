<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of <div class="site-content">
 *
 * @package _frc
 */
?>

	</div>

	<footer class="site-footer" role="contentinfo">
		<div class="site-branding">
			<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html><!-- FRANTIC SERVER STATUS: OK -->