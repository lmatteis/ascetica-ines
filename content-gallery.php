<?php
/**
 * Gallery Content Template
 *
 * Displays the content of gallery (post format) posts.
 *
 * @package Ascetica
 * @subpackage Template
 */
?>
	
<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // ascetica_open_entry ?>
	
	<?php if ( is_singular() ) { ?>
	
		<div class="gallery-header">
	
			<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'singular-gallery-thumbnail', 'link_to_post' => false, 'image_class' => 'featured', 'default_image' => get_template_directory_uri() . '/images/singular_gallery_thumbnail_placeholder.png', 'width' => 400, 'height' => 230 ) ); ?>
			
			<div class="gallery-info">
	
				<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title permalink="0"]' ); ?>
		
				<?php echo apply_atomic_shortcode( 'byline_published', '<div class="byline">' . '[entry-published]' . '</div>' ); ?>
				
				<?php echo apply_atomic_shortcode( 'byline_author', '<div class="byline">' . __( '[entry-author before="Author: "]', 'ascetica' ) . '</div>' ); ?>
				
				<?php echo apply_atomic_shortcode( 'byline_category', '<div class="byline">' . __( '[entry-terms taxonomy="category" before="Category: "]', 'ascetica' ) . '</div>' ); ?>
				
				<?php echo apply_atomic_shortcode( 'byline_tags', '<div class="byline">' . __( '[entry-terms taxonomy="post_tag" before="Tags: "]', 'ascetica' ) . '</div>' ); ?>
				
			</div>
		
		</div>
		
		<div class="entry-content">
			
			<?php the_content(); ?>
			
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'ascetica' ), 'after' => '</p>' ) ); ?>
		
		</div>
		
	<?php } else { ?>
	
		<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'thumbnail', 'image_class' => 'featured', 'default_image' => get_template_directory_uri() . '/images/archive_gallery_thumbnail_placeholder.png', 'width' => 50, 'height' => 50 ) ); ?>
		
		<div class="gallery-archive-info">

			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
	
			<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[entry-published] &middot; by [entry-author] &middot; in [entry-terms taxonomy="category" before=""] [entry-edit-link before=" &middot; "]', 'ascetica' ) . '</div>' ); ?>
			
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'ascetica' ), 'after' => '</p>' ) ); ?>
		
		</div>
	
	<?php } ?>

	<?php do_atomic( 'close_entry' ); // ascetica_close_entry ?>

</div><!-- .hentry -->