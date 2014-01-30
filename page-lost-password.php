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
if ( is_user_logged_in() ){
		wp_redirect(home_url("/my-account"));
		exit;
}
/**
 * Handles sending password retrieval email to user.
 *
 * @uses $wpdb WordPress Database object
 * @param string $user_login User Login or Email
 * @return bool true on success false on error
 */

if($_POST['action'] == "tsc_pwd_reset"){
	if ( !wp_verify_nonce( $_POST['tsc_pwd_nonce'], "tsc_pwd_nonce")) {
	  exit("No trick please");
	}
	
	//We shall SQL escape the input
	$user_input = $wpdb->escape(trim($_POST['user_login']));
		
		$user_login = $user_input;// sanitize_text_field( $_POST['user_login'] );
	$user_reset=tsc_retrieve_password($user_login);
	if (!is_wp_error($user_reset)){
		wp_redirect(home_url("/lost-password?reset=true")); 
		exit;//echo "SUCCESS";
	} 
}
get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 ">


     <div class="row">
                <div id="primary" class="content-area col-xs-10 col-xs-push-1 col-sm-push-0 col-sm-12 col-md-10">
                
                <header class="page-header">
                    <h3 class="page-title"><?php echo get_the_title($ID);  ?> </header>
                 <?php
                        if ( is_wp_error($user_reset) ):
                        ?>
                            
                                    <div class="tsc-message-box tsc-message tsc-error">
                                        
                                       <i class="fa fa-warning fa-lg"></i>   <?php echo $user_reset->get_error_message(); ?>
                                    </div>
                              
                        <?php
                          
						   endif;
						   
						   if(isset($_GET["reset"]) && $_GET['reset']==true){
								?>
								
								 <div class="tsc-message-box tsc-message tsc-success">
												
											<i class="fa fa-check-square fa-lg"></i> The instruction has been sent to your registered email .
						
												Please be sure to check your spam folder.
										
								  </div>
							  
								<?php	
								//return ;
								}
						?>
                
                
                
                <div id="content" class="site-content   card-like" role="main">
        
               
                    
					<?php get_template_part("content","lost-password"); ?> 
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
