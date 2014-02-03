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
// Check if user arrived at this page via the generated link in email or redirected for error and confirmation 
// if so , proceed otherwise redirect away from page 
if(!isset($_POST['action'] ) 
	&& !(isset($_GET["key"]) 
	&& isset($_GET["login"])) 
	&&  !isset( $_GET['err']) 
	&& !isset($_GET["reset"]))
	{
	wp_redirect(home_url("/login"));
		exit;
}
/**
 * Handles sending password retrieval email to user.
 *
 * @uses $wpdb WordPress Database object
 * @param string $user_login User Login or Email
 * @return bool true on success false on error
 */
 
 if(isset($_GET['key'])){
	 tsc_check_reset_key();
	 
 	//$user = check_password_reset_key($_GET['key'], $_GET['login']);
	
 }
if($_POST['action'] == "tsc_pwd_reset"){
	//echo $_GET['key']; exit(
	$user=tsc_check_reset_key();

	$errors = new WP_Error();

	if ( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] )
		$errors->add( 'password_reset_mismatch', __( 'The passwords do not match.' ) );
	
	if(isset( $_POST['pass1'] ) && empty( $_POST['pass1'] ) )
		$errors->add( 'password_reset_mismatch', __( 'You must provide a password' ) );
	/**
	 * Fires before the password reset procedure is validated.
	 *
	 * @since 3.5.0
	 *
	 * @param object           $errors WP Error object.
	 * @param WP_User|WP_Error $user   WP_User object if the login and reset key match. WP_Error object otherwise.
	 */
	do_action( 'validate_password_reset', $errors, $user );
	
	

	if ( ( ! $errors->get_error_code() ) && isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {
		reset_password($user, $_POST['pass1']);
		wp_redirect(home_url("/reset-password?reset=true"));
		//login_header( __( 'Password Reset' ), '<p class="message reset-pass">' . __( 'Your password has been reset.' ) . ' <a href="' . esc_url( wp_login_url() ) . '">' . __( 'Log in' ) . '</a></p>' );
		//login_footer();
		exit;
		
	}

	

	//login_header(__('Reset Password'), '<p class="message reset-pass">' . __('Enter your new password below.') . '</p>', $errors );
}

$no_form=false;
if ( isset( $_GET['err'] ) ) {
		if ( 'invalidkey' == $_GET['err'] ){
			$errors = new WP_Error( 'invalidkey', __( 'Sorry, that key does not appear to be valid.' ) );
			
			$no_form=true;
		}
		elseif ( 'expiredkey' == $_GET['err'] ){
			$errors = new WP_Error( 'expiredkey', __( 'Sorry, that key has expired. Please try again.' ) );
			$no_form=true;
		}
	}
	
	wp_enqueue_script('utils');
	wp_enqueue_script('user-profile');

get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 ">


     <div class="row">
                <div id="primary" class="content-area col-xs-10 col-xs-push-1 col-sm-push-0 col-sm-12 col-md-10">
                
                <header class="page-header">
                    <h3 class="page-title"><?php echo get_the_title($ID);  ?> </header>
                 <?php
                        if ( is_wp_error($errors) ):
                        ?>
                            
                                    <div class="tsc-message-box tsc-message tsc-error">
                                        
                                       <i class="fa fa-warning fa-lg"></i>   <?php echo $errors->get_error_message(); ?>
                                    </div>
                              
                        <?php
                          
						   endif;
						   
						   if(isset($_GET["reset"]) && $_GET['reset']==true){
								?>
								
								 <div class="tsc-message-box tsc-message tsc-success">
												
											<i class="fa fa-check-square fa-lg"></i> <?php
												echo __( 'Your password has been reset.' ) ?>  <a  href="<?php echo esc_url(home_url("/login")) ?>"  >click here</a> to login now.
												
										
								  </div>
							  
								<?php	
								//return ;
								}
						?>
                
                
                
                
                <div id="content" class="site-content   card-like" role="main">
				<?php
                            if( !$no_form){
								
								if(!isset($_GET['reset'])){
                        ?>
               
                    
					<?php get_template_part("content","reset-password"); ?> 
                    
                    <?php 
								}
							}
					
					 ?>
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
