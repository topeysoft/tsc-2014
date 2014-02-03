 <?php
 $user_id=NULL;
 $user_data=NULL;
 if(isset($_POST["user-cookie"])){
	 if ( isset($_POST["user_email"]) && isset($_POST["user_password"]) ) {

		$user_login     = esc_attr($_POST["user_login"]);
		$user_password  = esc_attr($_POST["user_password"]);
		$user_email     = esc_attr($_POST["user_email"]);
		
		$user_data = array(
			'user_login'    =>      $user_login,
			'user_pass'     =>      $user_password,
			'user_email'    =>      $user_email,
			//'role'          =>      'student'
		);

		// Inserting new user to the db
		$user_id=wp_insert_user( $user_data );
	//On success
		if( !is_wp_error($user_id) ) {
		 //echo "User created : ". $user_id;
		
	$userID = $user_id;

	wp_set_current_user( $userID, $user_login );
	wp_set_auth_cookie( $userID, true, false );
	do_action( 'wp_login', $user_login );
		
	if ( is_user_logged_in() ){
		?>
        <script >
			$(function(){
			//setTimeout("	_redirectTo('<?php echo $_POST['redirect_to'] ?>')",5000);
			});
		</script>
        <div class="wrapper">
            <div class=" overlay-float tsc-ajaxify">
                <i class=" close-btn fa fa-times fa-lg"></i>
                    <div class="message-box tsc-message tsc-success">
                        
                        You have been successfully registered and a message has been sent to the email address you provided with your registration details.<br />

                       	Please   <a  href="<?php echo $_POST['redirect_to'] ?>"  >click here</a> to continue
                        
                    </div>
          </div>
      </div>
        <?php	
		return ;
		}
		
	}
		
	?>
    	<?php
	}
	}
// run it before the headers and cookies are sent
	//add_action( 'after_setup_theme', 'tsc_custom_login' );
 ?>
    	<div class="wrapper">
    	<div class=" overlay-float tsc-ajaxify">
        <i class=" close-btn  fa fa-times fa-lg"></i>
        	<div class="inner-div">
        			
            
              <div class="panel-body">
                <div class="row">
                	<div class="col-xs-12" >
                    	
						<?php if ( is_wp_error($user_id) ):
							?>
								<div class="message-box tsc-message tsc-error card-like" >
										
										   
											<?php echo $user_id->get_error_message(); ?>
										
									</div>
							<?php
							else:
							
							?>
                            <?php get_template_part('tsc-inc/login-message');
							
								endif;
								
							?>
                            
                    </div>
                	<div class="col-xs-12 col-sm-6">
                    	<div class="message-box card-like" >
                        	<div class="third-party-login-div" style="text-align:center">
                            <h4 style="text-align:center">Register using: </h4>
                        	<?php
								get_template_part( "tsc-inc/login-third-party"); 
							?> 
                        
                        <h4 style="text-align:center"> or </h4>
                       
                        	<a href="#login-topeysoft" class="btn btn-info login-button topeysoft-login self-login-button">
                            	<i class="fa tsc-icon color-blue fa-lg"><img height="25" src="//topeysoft.com/_global/images/icon_white.png" /></i>Use TopeySoft form</a>
                       		
                       </div>
                        <div class="self-login-div" style="display:none;">
                        	<?php
							 global $user_email, $user_login;
							 	$user_email=$user_data["user_email"];
								$user_login=$user_data["user_login"];
								
								global $redirect_to;
								$redirect_to=site_url('my-account');
								
								
								get_template_part( "tsc-inc/signup-form"); 
							?> 
                           <div style="text-align:center">
                            <a href="#login-topeysoft" class="btn btn-default login-button  third-party-login-buttons">
                            	<i class="fa fa-lock fa-lg"></i>Use third party </a>
                       		</div>
                           </div>
                        </div>
                     </div>
                    <div class="col-xs-12 col-sm-6">
                    	<div class="message-box card-like">
                       <h4>Do you have an account with us?</h4>
                       <a href="#login-topeysoft" data-type="ajax" data-source="<?php echo site_url("ajax/?_request=login-form") ?>"  class="btn btn-info login-button  third-party-login-buttons">
                            	<i class="fa fa-lock fa-lg"></i> Login here</a>
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
