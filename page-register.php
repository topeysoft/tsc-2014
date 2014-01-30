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
		wp_redirect(site_url("/my-account"));
		exit;
}

if(isset($_POST["user-cookie"])){
	 if ( isset($_POST["user_email"]) && isset($_POST["user_password"]) ) {

		$user_login     = esc_attr($_POST["user_login"]);
		$user_password  = $_POST["user_password"];
		$user_email     = esc_attr($_POST["user_email"]);
		
		$user_data = array(
			'user_login'    =>      sanitize_user( $user_login),
			'user_pass'     =>      $user_password,
			'user_email'    =>      sanitize_email( $user_email),
			
			//'role'          =>      'student'
		);

		// Inserting new user to the db
		$user_id=wp_insert_user( $user_data );
	//On success
		if( !is_wp_error($user_id) ) {
		 //echo "User created : ". $user_id;
		 wp_new_user_notification( $user_id, $user_password );
		
	$userID = $user_id;

	wp_set_current_user( $userID, $user_login );
	wp_set_auth_cookie( $userID, true, false );
	do_action( 'wp_login', $user_login );
		
	
		
	}
		
	?>
    	<?php
	}
	}
// run it before the headers and cookies are sent
	//add_action( 'after_setup_theme', 'tsc_custom_login' );

get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 col-md-9 ">


     <div class="row">
            <div id="primary" class="content-area col-xs-10 col-xs-push-1 col-sm-push-0 col-sm-12 col-md-10">
            	
                <header class="page-header">
                    <h3 class="page-title"><?php echo get_the_title($ID); ?> </h3>
                </header>
            	
                 <?php
                        if ( is_wp_error($user_id) ):
                        ?>
                            
                                    <div class="tsc-message-box tsc-message tsc-error">
                                        
                                       <i class="fa fa-warning fa-lg"></i>   <?php echo $user_id->get_error_message(); ?>
                                    </div>
                              
                        <?php
                          
						   endif;
						   
						   if ( is_user_logged_in() ){
								?>
								<script >
									$(function(){
									//setTimeout("	_redirectTo('<?php echo $_POST['redirect_to'] ?>')",5000);
									});
								</script>
								 <div class="tsc-message-box tsc-message tsc-success">
												
											<i class="fa fa-check-square fa-lg"></i>  You have successfully registered and a message has been sent to the email address you provided with your registration details.<br />
						
												Please   <a  href="<?php echo $_POST['redirect_to'] ?>"  >click here</a> to continue
												
										
								  </div>
							  
								<?php	
								//return ;
								}
						?>
                
                
                <div id="content" class="site-content   card-like" role="main">
        
                <?	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly; ?>

					<?php get_template_part("content","register"); ?> 
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
