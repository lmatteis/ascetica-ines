<?php
/**
 * Page Template
 *
 * This is the default page template.  It is used when a more specific template can't be found to display 
 * singular views of pages.
 *
 * @package Ascetica
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // ascetica_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // ascetica_open_content ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // ascetica_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // ascetica_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title permalink="0"]' ); ?>

						<div class="entry-content">
							
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ascetica' ) ); ?>
							
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'ascetica' ), 'after' => '</p>' ) ); ?>
							
						</div><!-- .entry-content -->

						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

						<?php do_atomic( 'close_entry' ); // ascetica_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // ascetica_after_entry ?>

					<?php do_atomic( 'after_singular' ); // ascetica_after_singular ?>
					
					<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		<?php do_atomic( 'close_content' ); // ascetica_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // ascetica_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>