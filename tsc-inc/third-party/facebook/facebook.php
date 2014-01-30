<?php
require( 'src/facebook.php' );
class Third_Party_Facebook extends Facebook{
	public $facebook;
	public $user;
	public $e_codes;
	
	function __construct(){
		// Create our Application instance (replace this with your appId and secret).
		$param = array(
		  'appId'  => '509850882434204', // TopeySoft Computers
		  'secret' => 'c1b5e8a14174c6574ef9b50770ca8966',
		);
		$this->e_codes=new stdClass();
		$this->e_codes->not_authorized=101;
		$this->e_codes->already_authorized=101;
		parent::__construct($param);
		$user = $this->getUser();
	}
	function  tsc_fb_is_authorized_app(){
		// Get User ID
		
		//var_dump($user);
		if (!$this->user) {
			return false;
		} else {
			return true;	
		}
		
	}
	
	function tsc_fb_fetch_user_info(){
		if (! $this->tsc_fb_is_authorized_app()){
			
			throw new Exception ("App is not authorized",$this->e_codes->not_authorized);
			
		}
		return $this->api('/me');	
	}
	function tsc_fb_login_url($param){
		if ( $this->tsc_fb_is_authorized_app()) {
			throw new Exception ("App is already authorized. You may request the profile",$this->e_codes->already_authorized);
			
		}
			return $this->getLoginUrl($param);
	}
}

global $tsc_fb;
$tsc_fb=new Third_Party_Facebook();

/*
// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    //error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $statusUrl = $facebook->getLoginStatusUrl();
  $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
$profile = $facebook->api('/loveytopey');
//var_dump($user_profile); 
//$access_token = $facebook->getAccessToken();
//var_dump($user); 
?>

<?php
//echo '<a href="'.$statusUrl.'">Status</a> | ';
?>
<?php
echo '<a href="'.$loginUrl.'">Login with facebook</a> | ';
?>
<?php
//echo '<a href="'.$logoutUrl.'">Logout now facebook</a>';
?>
*/