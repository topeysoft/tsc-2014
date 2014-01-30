 <?php
 
 ?>
    	<div class="wrapper">
    	<div class=" overlay-float tsc-ajaxify1">
        
        	<div class="inner-div">
        			
            
              <div class="panel-body">
                <div class="row">
                	<div class="col-xs-12" >
                    	
						<?php if ( is_wp_error($user_id) ):
							?>
								
										<div class="message-box tsc-message tsc-error" >
										   
										<i class="fa fa-warning fa-lg"></i> 	<?php echo $user_id->get_error_message(); ?>
										</div>
									
							<?php
							else:
							
							?>
                            <?php //get_template_part('tsc-inc/login-message');
							
								endif;
								
							?>
                            
                    </div>
                	<div class="col-xs-12 col-sm-6  col-lg-5 right-and-bottom-borders " >
                    	<div class="message-box " >
                        	<?php
							 global $user_email, $user_login;
							 	$user_email=$user_data["user_email"];
								$user_login=$user_data["user_login"];
								
								global $redirect_to;
								$redirect_to=site_url('my-account');
								
								
								get_template_part( "tsc-inc/signup-form"); 
							?> 
                            
                        <div class="self-login-div" style="display:none;">
                        	
                           <div style="text-align:center">
                            <a href="#login-topeysoft" class="btn btn-default login-button  third-party-login-buttons">
                            	<i class="fa fa-lock fa-lg"></i>Use third party </a>
                       		</div>
                           </div>
                        </div>
                     </div>
                    <div class="col-xs-12 col-sm-6 col-lg-7">
                    	<div class="message-box ">
                       		
                        	<div class="third-party-login-div" style="text-align:center">
                            <h4 style="text-align:center">You may register using: </h4>
                        	<?php
								get_template_part( "tsc-inc/login-third-party"); 
							?> 
                        
                       <h4>Do you have an account with us?</h4>
                       <a href="<?php echo site_url('/login'); ?>"   data-source="<?php echo site_url("ajax/?_request=register-form") ?>"  class="btn btn-info">
                            	<i class="fa fa-lock fa-lg"></i> Login here</a>
                        <?php
								//get_template_part( "tsc-inc/signup-form"); 
							?> 
                       </div>
                        
                        </div><!-- /.message-box -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.panel-body -->
           </div>
  		</div><!-- /.login-float -->
  	</div><!-- /.wrapper -->
