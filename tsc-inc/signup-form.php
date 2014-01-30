<?php global $user_email, $user_login; $redirect_to ?>

			<form method="post" action="<?php echo site_url('register', 'login_post') ?>" data-action="<?php echo site_url("ajax/?_request=register-form") ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username'); ?>: </label>
					<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" />
				</div>
				<div class="password">
					<label for="user_email"><?php _e('Your Email'); ?>: </label>
					<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" />
				</div>
                <div class="password">
					<label for="user_password"><?php _e('Your Password'); ?>: </label>
					<input type="password" name="user_password" value="<?php //echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_password" tabindex="102" />
				</div>
				<div class="login_fields">
					<?php do_action('register_form'); ?>
				<p>	<input type="submit" name="user-submit" value="<?php _e('Sign up!'); ?>" class="user-submit  btn btn-primary" tabindex="103" 
                	style="margin-top:20px;" /> 
                	<br />

                </p>
					<?php $register = $_GET['register']; if($register == true) { echo '<p>Check your email for the password!</p>'; } ?>
					<input type="hidden" name="redirect_to" value="<?php echo !empty($redirect_to)?$redirect_to:site_url()/*$_SERVER['REQUEST_URI']*/; ?>?register=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>