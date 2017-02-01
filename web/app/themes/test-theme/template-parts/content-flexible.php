<?php
/**
 * Content template for loading ACF's Flexible Content templates
 *
 * @link http://www.advancedcustomfields.com/resources/flexible-content/
 *
 * @package _frc
 */

if ( have_rows( 'flexible-content' ) ) :

	while ( have_rows( 'flexible-content' ) ) : the_row();

		switch ( get_row_layout() ) :

			case 'flexible-example':
				get_template_part( 'acf/flexible', 'example' );

		endswitch;

	endwhile;

endif;