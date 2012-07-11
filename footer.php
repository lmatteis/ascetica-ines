<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Ascetica
 * @subpackage Template
 */
?>
				<?php get_sidebar( 'secondary' ); // Loads the sidebar-secondary.php template. ?>

				<?php do_atomic( 'close_main' ); // ascetica_close_main ?>

		</div><!-- #main -->

		<?php do_atomic( 'after_main' ); // ascetica_after_main ?>
		
		
		<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>		

		<?php do_atomic( 'before_footer' ); // ascetica_before_footer ?>

		<div id="footer">

			<?php do_atomic( 'open_footer' ); // ascetica_open_footer ?>
				
				<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>

				<?php do_atomic( 'footer' ); // ascetica_footer ?>

			<?php do_atomic( 'close_footer' ); // ascetica_close_footer ?>

		</div><!-- #footer -->

		<?php do_atomic( 'after_footer' ); // ascetica_after_footer ?>
		
		</div><!-- .wrap -->

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); // ascetica_close_body ?>

	<?php wp_footer(); // wp_footer ?>
	
</body>
</html>
