 <?php
 
 ?>
    	<div class="wrapper">
    	<div class=" overlay-float tsc-ajaxify1">
        
        	<div class="inner-div">
        			
            
              <div class="panel-body">
                <div class="row">
                	<div class="col-xs-12" >
                    	
						<?php if ( is_wp_error($errors) ):
							?>
								
										<div class="message-box tsc-message tsc-error" >
										   
										<i class="fa fa-warning fa-lg"></i> 	<?php echo $errors->get_error_message(); ?>
										</div>
									
							<?php
							else:
							
							?>
                            <?php //get_template_part('tsc-inc/login-message');
							
								endif;
								
							?>
                            
                    </div>
                	
                    <div class="col-xs-12">
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
