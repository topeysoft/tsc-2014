<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>
<div id="content-sidebar" class="content-sidebar widget-area  col-xs-12 col-md-2" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div><!-- #content-sidebar -->
