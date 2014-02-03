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
$user="";
	//function tsc_custom_login() {
	if(isset($_POST["user-cookie"])){
	$creds = array();
	$creds['user_login'] = esc_attr($_POST['log']);
	$creds['user_password'] =  esc_attr($_POST['pwd']);
	$creds['remember'] =  isset($_POST['rememberme'])?true:false;
	
	
	if ( is_email( $creds['user_login'] ) ) {
        $user = get_user_by_email( $creds['user_login'] );
        if ( $user ) $creds['user_login'] = $user->user_login;
    }
	$user = wp_signon( $creds, false );
	$userID = $user->ID;
	
	
	wp_set_current_user( $userID, $user_login );
	wp_set_auth_cookie( $userID, true, false );
	do_action( 'wp_login', $user_login );
	
		}
		if ( is_user_logged_in() ){
		wp_redirect(site_url("/my-account"));
		exit;
}
// run it before the headers and cookies are sent
	//add_action( 'after_setup_theme', 'tsc_custom_login' );
 
get_header(); ?>

<div id="main-content" class="main-content col-xs-12 col-sm-9 ">


     <div class="row">
                <div id="primary" class="content-area col-xs-10 col-xs-push-1 col-sm-push-0 col-sm-12 col-md-10">
                
                <header class="page-header">
                    <h3 class="page-title"><?php echo get_the_title(); ?> </h3>
                </header>
                <?php
                        if ( is_wp_error($user) ):
                        ?>
                            
                                    <div class="tsc-message-box tsc-message tsc-error">
                                        
                                        <?php echo $user->get_error_message(); ?>
                                    </div>
                              
                        <?php
                          
						   endif;
						?>
                <?php 
					if(isset($_GET["logged-out"])):
				?><div class="alert alert-dismissible tsc-message-box card-like tsc-message tsc-warning">
                		<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                		<i class="fa fa-unlock fa-lg"></i> You have been logged out.
                	</div>
                <?php 
					endif;
					
					if ( is_user_logged_in() ){
						?>
						<script >
							$(function(){
							setTimeout("_redirectTo('<?php echo $_POST['redirect_to'] ?>')",5000);
							});
						</script>
						<div class="alert alert-dismissible tsc-message-box card-like tsc-message tsc-info">
                		<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
										
										If you are not automatically redirected after 5 seconds <strong><a  href="<?php echo $_POST['redirect_to'] ?>"  >click here.</a></strong>
										
						</div>
					  
						<?php	
						return ;
						
					}
				?>
                
                <div id="content" class="site-content   card-like" role="main">
        
                <?	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly; ?>

					<?php get_template_part("content","login"); ?> 
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
