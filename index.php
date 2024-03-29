<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 col-md-9">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
     <div class="row">
            <div id="primary" class="content-area col-xs-12 col-sm-12 col-md-10">
                <div id="content" class="site-content" role="main">
        
                <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
        
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
        						
                        endwhile;
                        // Previous/next post navigation.
                        twentyfourteen_paging_nav();
        
                    else :
                        // If no content, include the "No posts found" template.
                        get_template_part( 'content', 'none' );
        
                    endif;
                ?>
        
                </div><!-- #content -->
            </div><!-- #primary -->
        <div class="right-sidebar col-xs-12 col-sm-12 col-md-2 col-lg-2">
        <?php get_sidebar( 'content' ); ?>
        
        </div>
    </div>
</div><!-- #main-content -->

<?php
//get_sidebar();
get_footer();
