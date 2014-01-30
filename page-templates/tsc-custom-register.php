<?php
/**
 * Template Name: TopeySoft Sign Up
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
global $home_slider,$navbar_has_border;
$navbar_has_border=false;
 				
				
get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
		
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
?>
