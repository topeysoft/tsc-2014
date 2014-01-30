<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 col-md-9">
<header class="page-header">
				<h1 class="page-title"> <?php _e( 'Oops! Not Found', 'twentyfourteen' ); ?></h1>
			</header>
	<div class="row">
            <div id="primary" class="content-area col-xs-12 col-sm-12 col-md-10">
                <div id="content" class="site-content" role="main">

			

			<div class="page-content panel ">
				

                <div class="row panel-body">
                   <div class=" col-xs-12 col-sm-6 col-sm-push-3">
                   <i class="pull-left fa fa-info fa-3x color-blue"></i><p><?php _e( 'It looks like nothing was found at this location. You may try a search?', 'twentyfourteen' ); ?></p>
                    <?php get_search_form(); ?>
                    </div>
                </div>
                </div><!-- .page-content -->
               <div class="panel">
               	<div class="  panel-body">
                <?php get_sidebar(  ); ?>
                </div>
               </div>
			

		</div><!-- #content -->
	</div><!-- #primary -->
        <div class="right-sidebar col-xs-12 col-sm-12 col-md-2">
        <?php get_sidebar( 'content' ); ?>
        </div>
    </div>
</div><!-- #main-content -->
<?php
get_sidebar();
get_footer();
