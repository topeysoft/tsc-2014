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
if ( !is_user_logged_in() ){
		wp_redirect(site_url("/login"));
		exit;
}
get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 ">


     <div class="row">
            <div id="primary" class="content-area col-xs-10 col-xs-push-1 col-sm-push-0 col-sm-12 col-md-10">
            	
                <header class="page-header">
                    <h3 class="page-title"><?php echo get_the_title($ID); ?> </h3>
                </header>
            
                <div id="content" class="site-content   card-like" role="main">
        
                <?	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly; ?>

					<?php get_template_part("content","my-account"); ?> 
                </div><!-- #content -->
            </div><!-- #primary -->
        <div class="right-sidebar col-xs-12 col-sm-12 col-md-2">
        <?php get_sidebar( 'content' ); ?>
        </div>
    </div>
</div><!-- #main-content -->

<?php
//get_sidebar();
get_footer();
