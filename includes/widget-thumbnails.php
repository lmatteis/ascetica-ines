<?php
/**
 *  Widget: Thumbnails
 *
 * A simple widget to display post images from a chosen category.
 *
 * @package Ascetica
 * @subpackage Template 
*/

class Ascetica_Thumbnails_Widget extends WP_Widget {
	
	/* Prefix for the widget. */
	var $prefix;

	/* Set up the widget's unique name, ID, class, description, and other options. */
	function __construct() {

		/* Set the widget prefix. */
		$this->prefix = hybrid_get_prefix();

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'ascetica-thumbnails-widget',
			'description' => esc_html__( 'Display post images from selected category.', 'ascetica' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width' => 300,
			'height' => 350
		);

		/* Create the widget. */
		$this->WP_Widget(
			'ascetica-thumbnails-widget',		// $this->id_base
			__( 'Ascetica - Thumbnails', 'ascetica' ),	// $this->name
			$widget_options,			// $this->widget_options
			$control_options			// $this->control_options
		);
	}	
	
	/* Outputs the widget based on the arguments input through the widget controls. */
	function widget( $args, $instance ) {
		
		extract( $args );
		
		/* Output the theme's $before_widget wrapper. */
		echo $before_widget;
		
			if ( !empty( $instance['title'] ) )
				echo $before_title . apply_filters( 'widget_title',  esc_html( $instance['title'] ), $instance, $this->id_base ) . $after_title;

			$maxitems = $instance['thumbnails_count'];  
			?>
		
			<!-- thumbnails list -->	
			<?php if ( $maxitems == 0 ) { ?>
				<li><?php esc_html_e('No images.', 'ascetica'); ?></li>
			<?php } else {
				
				$args = array(
					'cat' => $instance['thumbnails_cat'],
					'orderby' => !empty( $instance['thumbnails_randomize']) ? 'rand' : '',
					'posts_per_page' => $instance['thumbnails_count']
				);
				$loop = new WP_Query( $args );				
				$thumbcounter = 1;
				
				if ( $loop->have_posts() ) : ?>
				
					<ul class="loop-thumbnails">
						
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
						<?php if ( current_theme_supports( 'get-the-image' ) ) { ?>
					
							<li class="<?php echo 'number-' . $thumbcounter; echo ( $thumbcounter % 2 == 0 ) ? ' even' : ' odd'; ?>">
					
								<?php get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'thumbnail', 'default_image' => get_template_directory_uri() . '/images/thumbnail_placeholder.png', 'width' => 150, 'height' => 150 ) ); ?>
							
							</li>
						
						<?php } ?>
						
						<?php $thumbcounter++; ?>
						
					<?php endwhile; ?>
					
					</ul>
					
				<?php endif;							
			}			
	
		/* Output the theme's $after_widget wrapper. */
		echo $after_widget;
	}
	
	/* Updates the widget control options for the particular instance of the widget. */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['thumbnails_cat'] = strip_tags( $new_instance['thumbnails_cat'] );
		$instance['thumbnails_count'] = strip_tags( intval( $new_instance['thumbnails_count'] ) );
		$instance['thumbnails_randomize'] = ( isset( $new_instance['thumbnails_randomize'] ) ? 1 : 0 );
		
		return $instance;
	}
	
	 /* Displays the widget control options in the Widgets admin screen. */
	function form( $instance ) {
		
		/* Default form values. */
		$defaults = array(
			'title' => esc_attr__( 'Thumbnails', 'ascetica' ),
			'thumbnails_cat' => 1,
			'thumbnails_count' => 4,
			'thumbnails_randomize' => ''
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'ascetica' ); ?>:</label><br />
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnails_cat' ); ?>">Category</label><br />
			<select class="widefat" id="<?php echo $this->get_field_id( 'thumbnails_cat' ); ?>" name="<?php echo $this->get_field_name( 'thumbnails_cat' ); ?>"> 
			 <option value="1"><?php echo esc_attr(__('Select Category', 'ascetica')); ?></option>	 
			 <?php 
			  $categories=  get_categories(); 
			  foreach ( $categories as $category ) { ?>
			  <option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['thumbnails_cat'], $category->term_id ); ?>><?php echo esc_html( $category->cat_name . ' (' . $category->count . ')' ); ?></option>		  
			  <?php } ?>
			</select>						
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnails_count' ); ?>"><?php _e( 'Number of thumbnails', 'ascetica' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumbnails_count' ); ?>" name="<?php echo $this->get_field_name( 'thumbnails_count' ); ?>" value="<?php echo esc_attr( $instance['thumbnails_count'] ); ?>" size="3" maxlength="2" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnails_randomize' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['thumbnails_randomize'], true ); ?> id="<?php echo $this->get_field_id( 'thumbnails_randomize' ); ?>" name="<?php echo $this->get_field_name( 'thumbnails_randomize' ); ?>" /> <?php _e( 'Display in random order', 'ascetica' ); ?></label>
		</p>		
		
	<?php }
}

?>