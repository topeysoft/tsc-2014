<?php
//$fb=new Third_Party_Facebook();
	// Login or logout url will be needed depending on current user state.
global $tsc_fb;
if (!$tsc_fb->tsc_fb_is_authorized_app()){
		$param=array(
			  'redirect_uri' => home_url("third-party?_vendor=_facebook"),
			  'scope'         => 'email'
		);
  $fb_login_url = $tsc_fb->tsc_fb_login_url($param);
}else{
	$fb_login_url = home_url("third-party?_vendor=_facebook");
}
?>
<a href="<?php echo $fb_login_url;  ?>" class="btn login-button facebook-login"><i class="fa fa-facebook fa-lg"></i> facebook</a>
<!-- <a href="#login-twitter" class="btn login-button twitter-login"><i class="fa fa-twitter fa-lg"></i>twitter</a>
<a href="#login-google" class="btn login-button google-login"><i class="fa fa-google-plus  fa-lg"></i>Google</a> -->
