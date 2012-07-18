<?php
/*
 * Theme Settings
 *
 * @package Ascetica
 * @subpackage Template
 */
	
add_action( 'admin_menu', 'ascetica_theme_admin_setup' );

function ascetica_theme_admin_setup() {
    
	global $theme_settings_page;
	
	/* Get the theme settings page name */
	$theme_settings_page = 'appearance_page_theme-settings';

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'ascetica_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'ascetica_theme_validate_settings' );
	
	/* Enqueue scripts */
	add_action( 'admin_enqueue_scripts', 'ascetica_admin_scripts' );
	
}

/* Adds custom meta boxes to the theme settings page. */
function ascetica_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'ascetica-theme-meta-box',			// Name/ID
		__( 'General settings', 'ascetica' ),	// Label
		'ascetica_theme_meta_box',			// Callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'normal',					// Which meta box holder?
		'high'					// High/low within the meta box holder
	);

}

/* Function for displaying the meta box. */
function ascetica_theme_meta_box() { ?>

	<table class="form-table">
	    
		<!-- Favicon upload -->
		<tr class="favicon_url">
			<th>
				<label for="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_favicon_url' ) ); ?>"><?php _e( 'Favicon:', 'ascetica' ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_favicon_url' ) ); ?>" name="<?php echo esc_attr( hybrid_settings_field_name( 'ascetica_favicon_url' ) ); ?>" value="<?php echo esc_url( hybrid_get_setting( 'ascetica_favicon_url' ) ); ?>" />
				<input id="ascetica_favicon_upload_button" class="button" type="button" value="Upload" />
				<br />
				<span class="description"><?php _e( 'Upload favicon image (recommended max size: 32x32).', 'ascetica' ); ?></span>
				
				<?php /* Display uploaded image */
				if ( hybrid_get_setting( 'ascetica_favicon_url' ) ) { ?>
                    <p><img src="<?php echo esc_url( hybrid_get_setting( 'ascetica_favicon_url' ) ); ?>" alt=""/></p>
				<?php } ?>
			</td>
		</tr>
		
		<!-- Logo upload -->
		<tr class="logo_url">
			<th>
				<label for="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_logo_url' ) ); ?>"><?php _e( 'Logo:', 'ascetica' ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_logo_url' ) ); ?>" name="<?php echo esc_attr( hybrid_settings_field_name( 'ascetica_logo_url' ) ); ?>" value="<?php echo esc_url( hybrid_get_setting( 'ascetica_logo_url' ) ); ?>" />
				<input id="ascetica_logo_upload_button" class="button" type="button" value="Upload" />
				<br />
				<span class="description"><?php _e( 'Upload logo image.', 'ascetica' ); ?></span>
				
				<?php /* Display uploaded image */
				if ( hybrid_get_setting( 'ascetica_logo_url' ) ) { ?>
                    <p><img src="<?php echo esc_url( hybrid_get_setting( 'ascetica_logo_url' ) ); ?>" alt=""/></p>
				<?php } ?>
			</td>
		</tr>		
		
		<!-- Font family -->
		<tr>
			<th>
				<label for="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_font_family' ) ); ?>"><?php _e( 'Font family:', 'ascetica' ); ?></label>
			</th>
			<td>
			    <select id="<?php echo hybrid_settings_field_id( 'ascetica_font_family' ); ?>" name="<?php echo hybrid_settings_field_name( 'ascetica_font_family' ); ?>">
				<option value="Georgia" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Georgia' ); ?>> <?php echo __( 'Georgia', 'ascetica' ) ?> </option>
				<option value="PT Serif" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'PT Serif' ); ?>> <?php echo __( 'PT Serif', 'ascetica' ) ?> </option>				
				<option value="Bitter" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Bitter' ); ?>> <?php echo __( 'Bitter', 'ascetica' ) ?> </option>
				<option value="Droid Serif" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Droid Serif' ); ?>> <?php echo __( 'Droid Serif', 'ascetica' ) ?> </option>				
				<option value="Helvetica" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Helvetica' ); ?>> <?php echo __( 'Helvetica', 'ascetica' ) ?> </option>
				<option value="Istok Web" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Istok Web' ); ?>> <?php echo __( 'Istok Web', 'ascetica' ) ?> </option>
				<option value="Arial" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Arial' ); ?>> <?php echo __( 'Arial', 'ascetica' ) ?> </option>
				<option value="Verdana" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Verdana' ); ?>> <?php echo __( 'Verdana', 'ascetica' ) ?> </option>
				<option value="Lucida Sans Unicode" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Lucida Sans Unicode' ); ?>> <?php echo __( 'Lucida Sans Unicode', 'ascetica' ) ?> </option>
				<option value="Droid Sans" <?php selected( hybrid_get_setting( 'ascetica_font_family' ), 'Droid Sans' ); ?>> <?php echo __( 'Droid Sans', 'ascetica' ) ?> </option>
			    </select>
			</td>
		</tr>
		
		<!-- Font size -->
		<tr>
			<th>
			    <label for="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_font_size' ) ); ?>"><?php _e( 'Font size:', 'ascetica' ); ?></label>
			</th>
			<td>
			    <select id="<?php echo hybrid_settings_field_id( 'ascetica_font_size' ); ?>" name="<?php echo hybrid_settings_field_name( 'ascetica_font_size' ); ?>">
				<option value="16" <?php selected( hybrid_get_setting( 'ascetica_font_size' ), '16' ); ?>> <?php echo __( 'default', 'ascetica' ) ?> </option>
				<option value="18" <?php selected( hybrid_get_setting( 'ascetica_font_size' ), '18' ); ?>> <?php echo __( '18', 'ascetica' ) ?> </option>				
				<option value="17" <?php selected( hybrid_get_setting( 'ascetica_font_size' ), '17' ); ?>> <?php echo __( '17', 'ascetica' ) ?> </option>
				<option value="16" <?php selected( hybrid_get_setting( 'ascetica_font_size' ), '16' ); ?>> <?php echo __( '16', 'ascetica' ) ?> </option>
				<option value="15" <?php selected( hybrid_get_setting( 'ascetica_font_size' ), '15' ); ?>> <?php echo __( '15', 'ascetica' ) ?> </option>
				<option value="14" <?php selected( hybrid_get_setting( 'ascetica_font_size' ), '14' ); ?>> <?php echo __( '14', 'ascetica' ) ?> </option>				
				<option value="13" <?php selected( hybrid_get_setting( 'ascetica_font_size' ), '13' ); ?>> <?php echo __( '13', 'ascetica' ) ?> </option>
				<option value="12" <?php selected( hybrid_get_setting( 'ascetica_font_size' ), '12' ); ?>> <?php echo __( '12', 'ascetica' ) ?> </option>
			    </select>
			    <span class="description"><?php _e( 'The base font size in pixels.', 'ascetica' ); ?></span>
			</td>
		</tr>		
	    
		<!-- Link color -->
		<tr>
			<th>
				<label for="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_link_color' ) ); ?>"><?php _e( 'Link color:', 'ascetica' ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_link_color' ) ); ?>" name="<?php echo esc_attr( hybrid_settings_field_name( 'ascetica_link_color' ) ); ?>" size="8" value="<?php echo ( hybrid_get_setting( 'ascetica_link_color' ) ) ? esc_attr( hybrid_get_setting( 'ascetica_link_color' ) ) : '#bb2530'; ?>" data-hex="true" />
				<div id="colorpicker_link_color"></div>
				<span class="description"><?php _e( 'Set the theme link color.', 'ascetica' ); ?></span>
			</td>
		</tr>	    

		<!-- Custom CSS -->
		<tr>
			<th>
				<label for="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_custom_css' ) ); ?>"><?php _e( 'Custom CSS:', 'ascetica' ); ?></label>
			</th>
			<td>
				<textarea id="<?php echo esc_attr( hybrid_settings_field_id( 'ascetica_custom_css' ) ); ?>" name="<?php echo esc_attr( hybrid_settings_field_name( 'ascetica_custom_css' ) ); ?>" cols="60" rows="8"><?php echo wp_htmledit_pre( esc_html( hybrid_get_setting( 'ascetica_custom_css' ) ) ); ?></textarea>
				<span class="description"><?php _e( 'Add your custom CSS here. If it\'s more than a few lines, it\'s recommended to separate your modifications in a child theme.', 'ascetica' ); ?></span>
			</td>
		</tr>

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}

/* Validate theme settings. */
function ascetica_theme_validate_settings( $input ) {
    
	$input['ascetica_favicon_url'] = esc_url_raw( $input['ascetica_favicon_url'] );
	$input['ascetica_logo_url'] = esc_url_raw( $input['ascetica_logo_url'] );
	$input['ascetica_font_family'] = wp_filter_nohtml_kses( $input['ascetica_font_family'] );
	$input['ascetica_font_size'] = wp_filter_nohtml_kses( intval( $input['ascetica_font_size'] ) );
    $input['ascetica_link_color'] = wp_filter_nohtml_kses( $input['ascetica_link_color'] );      
    $input['ascetica_custom_css'] = wp_filter_nohtml_kses( $input['ascetica_custom_css'] );

    /* Return the array of theme settings. */
    return $input;
}

/* Enqueue scripts (and related stylesheets) */
function ascetica_admin_scripts( $hook_suffix ) {
    
    global $theme_settings_page;
	
    if ( $theme_settings_page == $hook_suffix ) {
	    
	    /* Enqueue Scripts */
	    wp_enqueue_script( 'ascetica_functions-admin', get_template_directory_uri() . '/admin/functions-admin.js', array( 'jquery', 'media-upload', 'thickbox', 'farbtastic' ), '1.0', false );
		
		/* Localize script strings */
		wp_localize_script( 'ascetica_functions-admin', 'js_text', array( 'insert_into_post' => __( 'Use this Image', 'ascetica' ) ) );
	    
	    /* Enqueue Styles */
	    wp_enqueue_style( 'ascetica_functions-admin', get_template_directory_uri() . '/admin/functions-admin.css', false, 1.0, 'screen' );
	    wp_enqueue_style( 'farbtastic' );
		
    }
}

?>