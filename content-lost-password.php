<?php 
	
 ?>
    	<div class="wrapper">
    	<div class=" tsc-ajaxify1">
        
        	<div class="inner-div">
        			
            
              <div class="panel-body">
                <div class="row">
                	<div class="col-xs-12" >
                    	<div class=" hidden-xs message-box  card-like">
                            <p>Please enter your username or email address. You will receive a link to create a new password via email.</p>
                            
                        </div>
                    </div>
                	<div class="col-xs-12 col-sm-6">
                    	<div class="message-box card-like" >
                        	<div class="third-party-login-div" style="text-align:center">
                            
                        	<?php
							global $redirect_to;
								$redirect_to=site_url();
								get_template_part( "tsc-inc/lost-password-form"); 
							?> 
                        
                       
                       </div>
                        
                        </div>
                     </div>
                    <div class="col-xs-12 col-sm-6">
                    	<div class="message-box card-like">
                       <h4>Do you have an account with us?</h4>
                       <a href="<?php echo site_url('/login'); ?>" data-source="<?php echo site_url("ajax/?_request=login-form") ?>"  class="btn btn-info ">
                            	<i class="fa fa-plus fa-lg"></i> Login here</a>
                       <h4>New user?</h4>
                       <a href="<?php echo site_url('/register'); ?>" data-source="<?php echo site_url("ajax/?_request=login-form") ?>"  class="btn btn-success">
                            	<i class="fa fa-plus fa-lg"></i> Register here</a>
                        
                        </div><!-- /.message-box -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.panel-body -->
            
            
           </div>
  		</div><!-- /.login-float -->
  	</div><!-- /.wrapper -->
