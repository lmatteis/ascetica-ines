<?php
/**
 * Standard Content Template
 *
 * Displays the content of standard posts.
 *
 * @package Ascetica
 * @subpackage Template
 */
 
do_atomic( 'before_entry' ); // ascetica_before_entry ?>

	<?php if ( is_singular() ) { ?>					
		
		<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
		
			<div class="post-content">
				
				<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title permalink="0"]' ); ?>

				<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[entry-published] &middot; by [entry-author] &middot; in [entry-terms taxonomy="category" before=""] [entry-edit-link before=" &middot; "]', 'ascetica' ) . '</div>' ); ?>

				<div class="entry-content">
					
					<?php the_content(); ?>
					
					<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'ascetica' ), 'after' => '</p>' ) ); ?>
					
				</div><!-- .entry-content -->

				<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms taxonomy="post_tag" before="Tags: "]', 'ascetica' ) . '</div>' ); ?>

				<?php do_atomic( 'close_entry' ); // ascetica_close_entry ?>
			
			</div><!-- .post-content -->
			
		</div><!-- .hentry -->

		<?php do_atomic( 'after_entry' ); // ascetica_after_entry ?>

		<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

		<?php do_atomic( 'after_singular' ); // ascetica_after_singular ?>

		<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>
		
			
	<?php } else { ?>
	
			<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
	
		<?php do_atomic( 'open_entry' ); // ascetica_open_entry ?>	
	
			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
	
			<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[entry-published] &middot; by [entry-author] &middot; in [entry-terms taxonomy="category" before=""] [entry-edit-link before=" &middot; "]', 'ascetica' ) . '</div>' ); ?>
				
			<?php// the_excerpt(); ?>
				
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'ascetica' ), 'after' => '</p>' ) ); ?>
	
			<?php do_atomic( 'close_entry' ); // ascetica_close_entry ?>
	
		</div><!-- .hentry -->
	
	<?php } ?>	

<?php do_atomic( 'after_entry' ); // ascetica_after_entry ?>
