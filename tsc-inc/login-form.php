<?php global $redirect_to, $reset_link;

?><form method="post" action="<?php echo  site_url('/login') ?>" data-action="<?php echo site_url("ajax/?_request=login-form") ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username or Email'); ?>: </label>
					<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" />
				</div>
				<div class="password">
					<label for="user_pass"><?php _e('Password'); ?>: </label>
					<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />
				</div>
				<div class="login_fields">
					<div class="rememberme">
						<label for="rememberme">
							<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Remember me
						</label>
					</div>
					<?php do_action('login_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Login'); ?>" tabindex="14" class="user-submit btn btn-primary" />
                    <?php echo !empty($reset_link)?$reset_link:'<a href="#'.site_url("ajax/?_request=register-form").'"  
                     data-type="ajax" data-source="'.site_url("ajax/?_request=reset-form").'" >
                            	<i class="fa fa-question-circle fa-lg"></i> Forgot password</a>'; ?> 
					<input id="redirect_to" type="hidden" name="redirect_to" value="<?php echo !empty($redirect_to)?$redirect_to:site_url("/login"); ?>" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>