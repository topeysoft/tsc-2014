<?php
/**
 * TemplateName: My Stuff
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( !is_user_logged_in() ){
		wp_redirect(site_url("/login"));
		exit;
}
global $current_user;
get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 ">


     <div class="row">
            <div id="primary" class="content-area  col-xs-12 col-xs-push-0 col-sm-push-0 col-sm-12 col-md-10 no-padding-content">
            	<div class=" cover_image_row_div">
                	<div class="cover_image_div  card-like">
                        <div class="cover-image-edit btn btn-default btn-sm"><i class="fa fa-pencil"></i> Change cover</div>
                            
                    </div>
                    <div class="profile-image">
                            <?php tsc_get_profile_image(); ?>
                            <a href="#upload-profile-image"  
                                data-type="ajax" data-source="<?php echo site_url("ajax/?_request=profile-image-form?img_id=") ?>"  class="profile-image-edit btn btn-info btn-sm">
                                    <i class="fa fa-pencil"></i> Change</a>
                        </div>
                </div>
                
                <div class="account-nav-tab">
               <?php 
			   //tsc_set_my_stuff_child_temmplate();
			  
			   wp_nav_menu(
			    array( 
					'theme_location' 	=> 'my-stuff-menu',
					"container"		 =>false, 
					'items_wrap'		=> '<ul id="%1$s" class="nav nav-tabs %2$s">%3$s</ul>',
					"echo"			  =>true,
					'menu_class' 		=> ''
					 )); ?>
                </div>
                <div id="content" class="site-content " role="main">
        
                <?	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly; ?>

					<?php 
					get_template_part("my-account/".$post->post_name); ?> 
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
