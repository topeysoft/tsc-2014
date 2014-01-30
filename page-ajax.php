<script>
$(function(){
		_init();
});
</script>
<?php
	if(empty($_REQUEST["_request"]))
		return;
	$request=$_REQUEST["_request"];
	if(file_exists(get_template_directory("ajax/".$request.".php"))):
 		
		if($request=="login-form" || $request=="reset-form" || $request=="register-form"){
				if (is_user_logged_in() ) { // If logged in:
					
					?>
       <div class="wrapper">
    	<div class=" overlay-float tsc-ajaxify">
        <i class=" close-btn  fa fa-times fa-lg"></i>
        	<div class="inner-div">
        			
            
              
                    	<div class="message-box card-like row"  style="text-align:center;">
                        	<h3>Welcome, <?php echo $user_identity; ?></h3>
                            <div class="usericon">
                                <?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 60); ?>
                    
                            </div>
                            <div class="userinfo">
                                <p>You&rsquo;re logged in as <strong><?php echo $user_identity; ?></strong></p>
                               
                            </div>
                        	<div>
                    <?php
					wp_loginout( site_url("/login?logged-out=true") ); // Display "Log Out" link.
					echo " | ";
					 if (current_user_can('manage_options')) { 
                                        echo '<a href="' . admin_url() . '">' . __('Admin') . '</a> | '; } //else {echo '<a href="' . admin_url() . 'profile.php">' . __('Profile') . '</a>'; } 
						
						echo '<a class="" href="'.home_url("/my-account/").'" >'.__("My Account", "twentyforteen").'</a>';//wp_register('', ''); // Display "Site Admin" link.
					
					?>	</div>
                    	</div>
                        
                  </div>
               </div>
            </div>
                    <?php
					return ;
				}
		}
 		get_template_part("ajax/".$request);
		
		else:
		?>
		<div class="alert alert-warning alert-dismissible">
        <i type="button" class="close fa fa-times" data-dismiss="alert" aria-hidden="true"></i>
        	<h2><i class="fa fa-warning"></i>404: Not Found</h2>
            <p>The requested content was not found.</p>
        </div>
        
        <?php
		endif;
?>