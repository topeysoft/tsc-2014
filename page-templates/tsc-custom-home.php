<?php
/**
 * Template Name: TopeySoft Main Home
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
global $home_slider,$navbar_has_border;
$navbar_has_border=false;
 				ob_start();
					get_template_part('home-slideshow'); 
					$home_slider = ob_get_contents();
				ob_end_clean();
				
get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 col-md-9">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
//get_sidebar();
get_footer();
