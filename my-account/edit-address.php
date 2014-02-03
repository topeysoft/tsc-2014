 <?php
 global $errors;
 ?>
    	
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
                       		 <h4>Billing Address </h4>
                        	
                           
                        	<?php
								get_template_part( "tsc-inc/login-third-party"); 
							?> 
                        	<h4>Shipping Address </h4>
                       	
                       </div><!-- /.message-box -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
          
