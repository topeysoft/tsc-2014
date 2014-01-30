    	<div class="wrapper">
    	<div class=" overlay-float tsc-ajaxify">
        <i class=" close-btn  fa fa-times fa-lg"></i>
        	<div class="inner-div">
        			
            
              <div class="panel-body">
                <div class="row">
                	<div class="col-xs-12" >
                    	<div class=" hidden-xs message-box  card-like">
                            <h4>Reset Your Password</h4>
                            
                        </div>
                    </div>
                	<div class="col-xs-12 col-sm-6">
                    	<div class="message-box card-like" >
                        	<div class="third-party-login-div" style="text-align:center">
                            
                        	<?php
							global $redirect_to;
								$redirect_to=site_url();
								get_template_part( "tsc-inc/reset-password-form"); 
							?> 
                        
                       
                       </div>
                        
                        </div>
                     </div>
                    <div class="col-xs-12 col-sm-6">
                    	<div class="message-box card-like">
                       <h4>Do you have an account with us?</h4>
                       <a href="#login-topeysoft" data-type="ajax" data-source="<?php echo site_url("ajax/?_request=login-form") ?>"  class="btn btn-info login-button  third-party-login-buttons">
                            	<i class="fa fa-plus fa-lg"></i> Login here</a>
                       <h4>New user?</h4>
                       <a href="#login-topeysoft" data-type="ajax" data-source="<?php echo site_url("ajax/?_request=login-form") ?>"  class="btn btn-success login-button  third-party-login-buttons">
                            	<i class="fa fa-plus fa-lg"></i> Register here</a>
                        
                        </div><!-- /.message-box -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.panel-body -->
           </div>
  		</div><!-- /.login-float -->
  	</div><!-- /.wrapper -->
