<?php
/**
 * Home Template
 *
 * This is the default home page template.
 *
 * @package Ascetica
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // ascetica_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // ascetica_open_content ?>
			
			<?php query_posts( array( 'post__not_in' => get_option( 'sticky_posts' ), 'paged' => get_query_var( 'paged' ) ) ); ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

				<?php endwhile; ?>
				
				<?php wp_reset_query(); ?> 

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		<?php do_atomic( 'close_content' ); // ascetica_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // ascetica_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>