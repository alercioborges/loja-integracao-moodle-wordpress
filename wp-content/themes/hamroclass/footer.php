<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
?>
</div><!-- .hmc-container -->
</div><!-- #content -->
<?php do_action( 'hamroclass_footer' ); ?>
</div><!-- #page -->
<?php

	/**
     * hamroclass_after_page hook
     *
     * @since 1.0.0
     */
	do_action( 'hamroclass_after_page' );

	wp_footer(); 
	
	?>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/example.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.mask.min.js"></script>
</body>
</html>
