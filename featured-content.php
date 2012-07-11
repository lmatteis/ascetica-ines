<?php
/**
 * Featured content
 *
 * The sticky posts, if any, are displayed in this area.
 * If the sticky posts are more than one, they are presented as slides.
 *
 * @package Ascetica
 * @subpackage Template
 */

$sticky = get_option('sticky_posts');

if ( ! empty( $sticky ) ) :

	$args = array( 'post__in' => $sticky );
	$loop = new WP_Query( $args );

	if ( $loop->have_posts() ) : ?>
		
		<div id="featured-content" class="flexslider">
		
			<ul class="slides">
				
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
				<li>
				   
					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?> featured">
		
						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'singular-thumbnail', 'image_class' => 'featured', 'default_image' => get_template_directory_uri() . '/images/singular_thumbnail_placeholder.png', 'width' => 660, 'height' => 330 ) ); ?>
						
						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>				
					
					</div> <!-- .featured-post -->
				
				</li>
				
			<?php endwhile; ?>
			
			</ul>
			
		</div><!-- #featured-content -->
	
	<?php endif; ?>

<?php endif; ?>
	
