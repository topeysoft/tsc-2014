<?php global $user_email, $user_login; $redirect_to ?>
<form name="resetpassform" id="resetpassform" action="<?php echo esc_url(home_url('reset-password?key=' . urlencode( $_GET['key'] ) . '&login=' . urlencode( $_GET['login'] )) ); ?>" method="post" 
autocomplete="off">
	<input type="hidden" id="user_login" value="<?php echo esc_attr( $_GET['login'] ); ?>" autocomplete="off" />

	<p>
		<label for="pass1"><?php _e('New password') ?><br />
		<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" /></label>
	</p>
	<p>
		<label for="pass2"><?php _e('Confirm new password') ?><br />
		<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" /></label>
	</p>

	<div id="pass-strength-result" class="password-strength-indicator hide-if-no-js"><?php _e('Strength indicator'); ?></div>
	<p class="description indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).'); ?></p>

	<br class="clear" />
    				<input type="hidden" name="action" value="tsc_pwd_reset" />
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large  btn btn-primary" value="<?php esc_attr_e('Reset Password'); ?>" /></p>
</form>