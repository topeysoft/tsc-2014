<?php 
	//function tsc_custom_login() {
		$user="";
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
	if ( is_user_logged_in() ){
		?>
        <script >
			$(function(){
			setTimeout("	_redirectTo('<?php echo $_POST['redirect_to'] ?>')",5000);
			});
		</script>
        <div class="wrapper">
            <div class=" overlay-float tsc-ajaxify">
                <i class=" close-btn fa fa-times fa-lg"></i>
                    <div class="message-box tsc-message tsc-info">
                        
                        If you are not automatically redirected after 5 seconds <strong><a  href="<?php echo $_POST['redirect_to'] ?>"  >click here.</a></strong>
                        
                    </div>
          </div>
      </div>
        <?php	
		return ;
		
	}
		}
// run it before the headers and cookies are sent
	//add_action( 'after_setup_theme', 'tsc_custom_login' );
 ?>
    	<div class="wrapper">
    	<div class=" overlay-float tsc-ajaxify">
        <i class=" close-btn fa fa-times fa-lg"></i>
        	<div class="inner-div">
        			
            
              <div class="panel-body">
                <div class="row">
                	<div class="col-xs-12" >
                    	<?php
                        if ( is_wp_error($user) ):
                        ?>
                            
                                    <div class="message-box tsc-message tsc-error">
                                        
                                        <?php echo $user->get_error_message(); ?>
                                    </div>
                              
                        <?php
                           else:
						?>
                    	<?php get_template_part('tsc-inc/login-message') ?>
                        <?php
						   endif;
						?>
                    </div>
                	<div class="col-xs-12 col-sm-6">
                    	<div class="message-box card-like" >
                        	<div class="third-party-login-div" style="text-align:center">
                            <h4 style="text-align:center">Login using: </h4>
                        	<?php
								get_template_part( "tsc-inc/login-third-party"); 
							?> 
                        
                        <h4 style="text-align:center"> or </h4>
                       
                        	<a href="#login-topeysoft" class="btn btn-info login-button topeysoft-login self-login-button">
                            	<i class="fa tsc-icon color-blue fa-lg"><img height="25" src="//topeysoft.com/_global/images/icon_white.png" /></i>Use TopeySoft login form</a>
                       		
                       </div>
                        <div class="self-login-div" style="display:none;">
                        	<?php
								global $redirect_to;
								$redirect_to=site_url('my-account');
								get_template_part( "tsc-inc/login-form");
							?> 
                           <div style="text-align:center">
                            <a href="#login-topeysoft" class="btn btn-default login-button  third-party-login-buttons">
                            	<i class="fa fa-lock fa-lg"></i>Use third party logins</a>
                       		</div>
                           </div>
                        </div>
                     </div>
                    <div class="col-xs-12 col-sm-6">
                    	<div class="message-box card-like">
                       <h4>New user?</h4>
                       <a href="#<?php echo site_url("ajax/?_request=register-form"); ?>"  data-type="ajax" data-source="<?php echo site_url("ajax/?_request=register-form") ?>"  class="btn btn-info login-button  third-party-login-buttons">
                            	<i class="fa fa-plus fa-lg"></i> Register now</a>
                        <?php
								//get_template_part( "tsc-inc/signup-form"); 
							?> 
                        
                        
                        </div><!-- /.message-box -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.panel-body -->
           </div>
  		</div><!-- /.login-float -->
  	</div><!-- /.wrapper -->
