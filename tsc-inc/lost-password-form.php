<?php global $user_email, $user_login; $redirect_to ?>
<!-- <h3>Lost password?</h3>
			<p>Please enter your username or email address. You will receive a link to create a new password via email.</p> -->
			<form method="post" action="<?php echo home_url('lost-password') ?>" 
             data-action="<?php echo site_url("ajax/?_request=reset-form") ?>"
             class="wp-user-form">
				<div class="username">
                
					<div class="" style="text-align:left;">
                    <label for="user_login" class=""><?php _e('Username or Email'); ?>: </label>
                    </div>
					<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
                    <input type="hidden" name="action" value="tsc_pwd_reset" />
					<input type="hidden" name="tsc_pwd_nonce" value="<?php echo wp_create_nonce("tsc_pwd_nonce"); ?>" />
				</div>
				<div class="login_fields">
					<?php do_action('login_form', 'resetpass'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Reset my password'); ?>" class="user-submit btn btn-primary" tabindex="1002" style="margin-top:20px;" />
					<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
					<input type="hidden" name="redirect_to" value="<?php echo !empty($redirect_to)?$redirect_to:site_url("/lost-password")/*$_SERVER['REQUEST_URI']*/; ?>?reset=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>