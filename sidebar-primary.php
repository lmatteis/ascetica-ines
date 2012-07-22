<?php
/**
 * Primary Sidebar Template
 *
 * Displays widgets for the Primary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, the default widgets are displayed.
 *
 * @package Ascetica
 * @subpackage Template
 */

do_atomic( 'before_sidebar_primary' ); // ascetica_before_sidebar_primary ?>

<div id="sidebar-primary" class="sidebar">

	<?php do_atomic( 'open_sidebar_primary' ); // ascetica_open_sidebar_primary ?>

    <div class="newsletter widget">
        Newsletter
    </div>
    <div class="aboutme widget">
        About me
    </div>
		
	<?php if ( ! is_active_sidebar( 'primary' ) ) { /* Output default widgets. */ ?>

		<div class="widget widget_meta widget-widget_meta">
			<div class="widget-wrap widget-inside">
				<h3 class="widget-title"><?php _e( 'Meta', 'ascetica' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</div>
		</div>
		
		<div class="widget archives widget-archives">
			<div class="widget-wrap widget-inside">
				<h3 class="widget-title"><?php _e( 'Archives', 'ascetica' ); ?></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</div>
		</div>
	
	<?php } else { ?>
	
		<?php dynamic_sidebar( 'primary' ); ?>
		
	<?php } ?>

	<?php do_atomic( 'close_sidebar_primary' ); // ascetica_close_sidebar_primary ?>

</div><!-- #sidebar-primary .aside -->

<?php do_atomic( 'after_sidebar_primary' ); // ascetica_after_sidebar_primary ?>
