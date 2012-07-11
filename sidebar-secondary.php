<?php
/**
 * Secondary Sidebar Template
 *
 * Displays widgets for the secondary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, the search form is displayed.
 *
 * @package Ascetica
 * @subpackage Template
 */

do_atomic( 'before_sidebar_secondary' ); // ascetica_before_sidebar_secondary ?>

<div id="sidebar-secondary" class="sidebar">

	<?php do_atomic( 'open_sidebar_secondary' ); // ascetica_open_sidebar_secondary ?>
		
	<?php if ( ( ! is_active_sidebar( 'secondary' ) ) && ( ! is_page_template( 'page-template-wide.php' ) ) ) { /* Output default widgets. */ ?>
		
		<div class="widget search widget-search">
			<div class="widget-wrap widget-inside">
				<h3 class="widget-title"><?php _e( 'Search', 'ascetica' ); ?></h3>
				<div class="search">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	
	<?php } else { ?>
	
		<?php dynamic_sidebar( 'secondary' ); ?>
		
	<?php } ?>

	<?php do_atomic( 'close_sidebar_secondary' ); // ascetica_close_sidebar_secondary ?>

</div><!-- #sidebar-secondary .aside -->

<?php do_atomic( 'after_sidebar_secondary' ); // ascetica_after_sidebar_secondary ?>