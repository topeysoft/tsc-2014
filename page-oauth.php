<?php

	$req=$_REQUEST['action'];
	global $tsc_oauth2; //=new Tsc_oauth2();
	switch($req){
		case "request_token":
		try{
			$tsc_oauth2->token();
			//require_once(_GLOBALPATH."/OAuth2_client/token.php");
			
		}catch(Exception $e){
			
			
		}
		break;
	}
?>