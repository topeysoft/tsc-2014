	<div class="wrapper">
    	<div class=" tsc-ajaxify1">
        
        	<div class="inner-div">
        			
            
              <div class="panel-body">
                <div class="row">
                	<div class="col-xs-12" >
                    	
                    </div>
                	<div class="col-xs-12 col-sm-6 col-lg-7" style="border-right:1px solid #eee;">
                    	<div class="message-box" >
                        	<div class="third-party-login-div" style="text-align:center">
                            <h4 style="text-align:center">You may login using: </h4>
                        	<?php
								get_template_part( "tsc-inc/login-third-party"); 
							?> 
                        
                        <h4>New user?</h4>
                       <a href="<?php echo site_url('/register'); ?>"   data-source="<?php echo site_url("ajax/?_request=register-form") ?>"  class="btn btn-info">
                            	<i class="fa fa-plus fa-lg"></i> Register now</a>
                        <?php
								//get_template_part( "tsc-inc/signup-form"); 
							?> 
                       
                        	
                       </div>
                        <div class="self-login-div" style="display:none;">
                        	<a href="#login-topeysoft" class="btn btn-info login-button topeysoft-login self-login-button">
                            	<i class="fa tsc-icon color-blue fa-lg"><img height="25" src="//topeysoft.com/_global/images/icon_white.png" /></i>Use TopeySoft login form</a>
                       		 <a href="#login-topeysoft" class="btn btn-default login-button  third-party-login-buttons">
                            	<i class="fa fa-lock fa-lg"></i>Use third party logins</a>
                           </div>
                        </div>
                     </div>
                    <div class="col-xs-12 col-sm-6 col-lg-5">
                    	<div class="message-box ">
                      		<?php
								global $redirect_to,$reset_link;
								$redirect_to=site_url('my-account');
								$reset_link='<a href="'.site_url('lost-password').'" ><i class="fa fa-question-circle fa-lg"></i> '.__("Forgot password").'</a>';
								get_template_part( "tsc-inc/login-form");
							?> 
                           <div style="text-align:center">
                           
                       		</div>
                        
                        
                        </div><!-- /.message-box -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.panel-body -->
           </div>
  		</div><!-- /.login-float -->
  	</div><!-- /.wrapper -->
