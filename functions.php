<?php
/**
 * @package Ascetica
 * @subpackage Functions
 * @version 0.1.8
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( get_template_directory() . '/library/hybrid.php' );
$theme = new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'ascetica_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 */
function ascetica_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'subsidiary', 'after-singular' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer' ) );
	add_theme_support( 'hybrid-core-meta-box-footer' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Add theme support for framework extensions. */
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'cleaner-gallery' );

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );

	/* Embed width/height defaults. */
	add_filter( 'embed_defaults', 'ascetica_embed_defaults' );

	/* Filter the sidebar widgets. */
	add_filter( 'sidebars_widgets', 'ascetica_disable_sidebars' );
        
	/* Image sizes */
	add_action( 'init', 'ascetica_image_sizes' );

	/* Excerpt ending */
	add_filter( 'excerpt_more', 'ascetica_excerpt_more' );
 
	/* Custom excerpt length */
	add_filter( 'excerpt_length', 'ascetica_excerpt_length' );    
        
	/* Filter the pagination trail arguments. */
	add_filter( 'loop_pagination_args', 'ascetica_pagination_args' );
	
	/* Filter the comments arguments */
	add_filter( "{$prefix}_list_comments_args", 'ascetica_comments_args' );	
	
	/* Filter the commentform arguments */
	add_filter( 'comment_form_defaults', 'ascetica_commentform_args', 11, 1 );
	
	/* Enqueue scripts (and related stylesheets) */
	add_action( 'wp_enqueue_scripts', 'ascetica_scripts' );
	
	/* Enqueue Google fonts */
	add_action( 'wp_enqueue_scripts', 'ascetica_google_fonts' );
	
	/* Style settings */
	add_action( 'wp_head', 'ascetica_style_settings' );
	
	/* Add support for custom backgrounds */
	add_custom_background();
	
	/* Add theme settings */
	if ( is_admin() )
	    require_once( trailingslashit( TEMPLATEPATH ) . 'admin/functions-admin.php' );
	    
	/* Default footer settings */
	add_filter( "{$prefix}_default_theme_settings", 'ascetica_default_footer_settings' );
	
	/* Widgets */
	add_action( 'widgets_init', 'ascetica_register_widgets' );
	
	/* Undergister sidebar */
	add_action( 'widgets_init', 'ascetica_unregister_sidebar', 999 );
	
	/* Add support for Post Formats */
	add_theme_support( 'post-formats', array( 'gallery' ) );	
	
}

/**
 * Disables sidebars if viewing a two-column - wide page, or a gallery post.
 *
 */
function ascetica_disable_sidebars( $sidebars_widgets ) {
	
	global $wp_query;
	
	    if ( is_page_template( 'page-template-wide.php' ) || ( is_singular() &&  has_post_format( 'gallery', get_queried_object_id() ) ) ) {
			$sidebars_widgets['secondary'] = false;
	    }

	return $sidebars_widgets;
}

/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly
 * expand the full width on video pages.  This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 */
function ascetica_embed_defaults( $args ) {
	
	$args['width'] = 470;
		
	if ( is_page_template( 'page-template-wide.php' ) )
		$args['width'] = 660;

	return $args;
}

/**
 * Excerpt ending 
 *
 */
function ascetica_excerpt_more( $more ) {	
	return '...';
}

/**
 *  Custom excerpt lengths 
 *
 */
function ascetica_excerpt_length( $length ) {
	return 35;
}

/**
 * Enqueue scripts (and related stylesheets)
 *
 */
function ascetica_scripts() {
	
	if ( !is_admin() ) {
		
		/* Enqueue Scripts */	
		wp_enqueue_script( 'ascetica_fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', array( 'jquery' ), '1.0', true );		
		wp_enqueue_script( 'ascetica_fitvids', get_template_directory_uri() . '/js/fitvids/jquery.fitvids.js', array( 'jquery' ), '1.0', true );	
		wp_enqueue_script( 'ascetica_flexslider', get_template_directory_uri() . '/js/flex-slider/jquery.flexslider-min.js', array( 'jquery' ), '1.0', true );	
		wp_enqueue_script( 'ascetica_footer-scripts', get_template_directory_uri() . '/js/footer-scripts.js', array( 'jquery', 'ascetica_fitvids', 'ascetica_fancybox', 'ascetica_flexslider' ), '1.0', true );

		/* Enqueue Styles */
		wp_enqueue_style( 'ascetica_fancybox-stylesheet', get_template_directory_uri() . '/js/fancybox/jquery.fancybox-1.3.4.css', false, 1.0, 'screen' );
		wp_enqueue_style( 'ascetica_flexslider-stylesheet', get_template_directory_uri() . '/js/flex-slider/flexslider.css', false, 1.0, 'screen' );
	}
}

/**
 * Pagination args 
 *
 */
function ascetica_pagination_args( $args ) {
	
	$args['prev_text'] = __( '&laquo; Previous', 'ascetica' );
	$args['next_text'] = __( 'Next &raquo;', 'ascetica' );

	return $args;
}

/**
 *  Image sizes
 *
 */
function ascetica_image_sizes() {
	
	add_image_size( 'singular-gallery-thumbnail', 400, 230, true );
	add_image_size( 'singular-thumbnail', 660, 250, true );
}

/**
 *  Unregister Hybrid widgets
 *
 */
function ascetica_unregister_widgets() {
	
	unregister_widget( 'Hybrid_Widget_Search' );
	register_widget( 'WP_Widget_Search' );	
}

/**
 * Custom comments arguments
 * 
 */
function ascetica_comments_args( $args ) {
	
	$args['avatar_size'] = 40;
	return $args;
}

/**
 *  Custom comment form arguments
 * 
 */
function ascetica_commentform_args( $args ) {
	
	global $user_identity;

	/* Get the current commenter. */
	$commenter = wp_get_current_commenter();

	/* Create the required <span> and <input> element class. */
	$req = ( ( get_option( 'require_name_email' ) ) ? ' <span class="required">' . __( '*', 'ascetica' ) . '</span> ' : '' );
	$input_class = ( ( get_option( 'require_name_email' ) ) ? ' req' : '' );
	
	
	$fields = array(
		'author' => '<p class="form-author' . $input_class . '"><input type="text" class="text-input" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" size="40" /><label for="author">' . __( 'Name', 'ascetica' ) . $req . '</label></p>',
		'email' => '<p class="form-email' . $input_class . '"><input type="text" class="text-input" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="40" /><label for="email">' . __( 'Email', 'ascetica' ) . $req . '</label></p>',
		'url' => '<p class="form-url"><input type="text" class="text-input" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="40" /><label for="url">' . __( 'Website', 'ascetica' ) . '</label></p>'
	);
	
	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field' => '<p class="form-textarea req"><!--<label for="comment">' . __( 'Comment', 'ascetica' ) . '</label>--><textarea name="comment" id="comment" cols="60" rows="10"></textarea></p>',
		'must_log_in' => '<p class="alert">' . sprintf( __( 'You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', 'ascetica' ), wp_login_url( get_permalink() ) ) . '</p><!-- .alert -->',
		'logged_in_as' => '<p class="log-in-out">' . sprintf( __( 'Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', 'ascetica' ), admin_url( 'profile.php' ), esc_attr( $user_identity ) ) . ' <a href="' . wp_logout_url( get_permalink() ) . '" title="' . esc_attr__( 'Log out of this account', 'ascetica' ) . '">' . __( 'Log out &raquo;', 'ascetica' ) . '</a></p><!-- .log-in-out -->',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_form' => 'commentform',
		'id_submit' => 'submit',
		'title_reply' => __( 'Leave a Reply', 'ascetica' ),
		'title_reply_to' => __( 'Leave a Reply to %s', 'ascetica' ),
		'cancel_reply_link' => __( 'Click here to cancel reply.', 'ascetica' ),
		'label_submit' => __( 'Post Comment', 'ascetica' ),
	);
	
	return $args;
}

/**
 * Default footer settings
 *
 */
function ascetica_default_footer_settings( $settings ) {
    
    $settings['footer_insert'] = '<p class="copyright">' . __( 'Copyright &#169; [the-year] [site-link]', 'ascetica' ) . '</p>' . "\n\n" . '<p class="credit">' . __( 'Powered by [wp-link] and [theme-link]', 'ascetica' ) . '</p>';
    
    return $settings;
}

/**
 * Google fonts
 *
 */
function ascetica_google_fonts() {
	
	if ( hybrid_get_setting( 'ascetica_font_family' ) ) {
		
		switch ( hybrid_get_setting( 'ascetica_font_family' ) ) {
			case 'PT Serif':
				wp_enqueue_style( 'font-pt-serif', 'http://fonts.googleapis.com/css?family=PT+Serif:400,400italic', false, 1.0, 'screen' );
				break;				
			case 'Droid Serif':
				wp_enqueue_style( 'font-droid-serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic', false, 1.0, 'screen' );
				break;			
			case 'Istok Web':
				wp_enqueue_style( 'font-istok-web', 'http://fonts.googleapis.com/css?family=Istok+Web', false, 1.0, 'screen' );
				break;
			case 'Droid Sans':
				wp_enqueue_style( 'font-droid-sans', 'http://fonts.googleapis.com/css?family=Droid+Sans', false, 1.0, 'screen' );
				break;				
			case 'Bitter':
				wp_enqueue_style( 'font-bitter', 'http://fonts.googleapis.com/css?family=Bitter', false, 1.0, 'screen' );
				break;
		}
	}	
}

/**
 * Style settings
 *
 */
function ascetica_style_settings() {
	
	echo "\n<!-- Style settings -->\n";
	echo "<style type=\"text/css\" media=\"all\">\n";
	
	if ( hybrid_get_setting( 'ascetica_font_size' ) )
		echo 'html { font-size: ' . esc_html( hybrid_get_setting( 'ascetica_font_size' ) ) . "px; }\n";
	
	if ( hybrid_get_setting( 'ascetica_font_family' ) )
		echo 'body, #respond #submit, .button, a.button, .wpcf7-submit, #loginform .button-primary, .pagination a.page-numbers, .comment-navigation a.page-numbers, input[type="text"], input[type="password"], input[type="email"], .input-text, textarea, select { font-family: ' . esc_html( hybrid_get_setting( 'ascetica_font_family' ) ) . ", serif; }\n";
	
	if ( hybrid_get_setting( 'ascetica_link_color' ) ) {
		echo 'a, #footer a:hover, .entry-title a:hover { color: ' . esc_html( hybrid_get_setting( 'ascetica_link_color' ) ) . "; }\n";
		echo "a:hover, a:focus { color: #000; }\n";
	}	
	if ( hybrid_get_setting( 'ascetica_custom_css' ) )
		echo esc_html( hybrid_get_setting( 'ascetica_custom_css' ) ) . "\n";
	
	echo "</style>\n";

}

/**
 *  Widgets
 *
 */
function ascetica_register_widgets() {
	
	/* Include widget classes */
	require_once( get_template_directory() . '/includes/widget-thumbnails.php' );
	
	/* Register widgets */
	register_widget( 'Ascetica_Thumbnails_Widget' );
		
}


function ascetica_unregister_sidebar() {
	unregister_sidebar( 'secondary' );
}

?>
