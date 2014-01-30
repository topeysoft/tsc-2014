<?php
	if(empty($_REQUEST["_vendor"]))
		wp_redirect(site_url("404"));
	// if(empty($_REQUEST["_request"]))
	//	return;
	
	global $tsc_fb; 
	$e_code=$tsc_fb->e_codes;
	$vendor=$_REQUEST["_vendor"];
	function tsc_perform_login($userID,$user_login){
				
				wp_set_current_user( $userID, $user_login );
				wp_set_auth_cookie( $userID, true, false );
				do_action( 'wp_login', $user_login );
				if ( is_user_logged_in() ){
						
					wp_redirect(site_url("/my-account"));
					exit;
					
					}
					}
					
	switch($vendor){
		case "_facebook":
		try{
			$user_ar=$tsc_fb->tsc_fb_fetch_user_info();
			//var_dump($user_ar);
				$email=sanitize_email( $user_ar["email"]);
				$id=email_exists( $email );
				
			if(!$id ) { 
				
				$user_obj=(object) $user_ar;
					$userdata = new stdClass();
					$x_userdata = new stdClass();
					
					if(isset($user_obj->username)){
						$user_obj->username=sanitize_user( $user_obj->username);
						if ( !username_exists( $user_obj->username ) ){
							$userdata->user_login=$user_obj->username;
						}else{
							$userdata->user_login=$user_obj->id;
						}
						
					}
					$userdata->user_email=sanitize_email( $user_obj->email);
					$userdata->first_name=sanitize_text_field( $user_obj->first_name);
					$userdata->last_name=sanitize_text_field($user_obj->last_name);
					$userdata->display_name=sanitize_text_field($user_obj->name);
					$userdata->user_url=$user_obj->link;
					
					// X_USERDATA
					if(isset($user_obj->quote)){
						$x_userdata->quote=$user_obj->quote;
					}
					$x_userdata->middle_name=isset($user_obj->middle_name)?$user_obj->middle_name:"";
					$x_userdata->gender=isset($user_obj->gender)?$user_obj->gender:"";
					$x_userdata->timezone=isset($user_obj->timezone)?$user_obj->timezone:"";
					$x_userdata->locale=isset($user_obj->locale)?$user_obj->locale:"";
					
					$user_id = wp_insert_user( $userdata ) ;
					
					$user_password=strtoupper(substr(md5(rand()),0,8));	
							
					//On success
					if( !is_wp_error($user_id) ) {
						wp_set_password( $user_password, $user_id );
						wp_new_user_notification( $user_id, $user_password );
						$x_userdata->ID=$user_id;
						wp_update_user( $x_userdata ) ;
						
						tsc_perform_login($user_id, $userdata->user_email);
						
					}else{
						echo $user_id->get_error_message();
					}
			}else{ // User's data is aready in the database, skip registration.
				tsc_perform_login($id, $email);
					
			}
			//wp_update_user( array ( 'ID' => $user_id, 'user_url' => $website ) ) ;
			/*
			//echo "<h3>FACEBOOK DATA</h3>";
			foreach($user_obj as $key=>$value){
				
				//echo "<strong>$key</strong>: $value <br>"; 	
			}
			//echo "<h3>WORDPRESS-READY DATA</h3>";
			foreach($userdata as $key=>$value){
			//	echo "<strong>$key</strong>: $value <br>"; 	
			}
			
			//echo "<h3>WORDPRESS-READY METADATA</h3>";
			foreach($x_userdata as $key=>$value){
			//	echo "<strong>$key</strong>: $value <br>"; 	
			}
			*/
			

		}catch(Exception $e){
			if($e->getCode()==$e_code->not_authorized){
					wp_redirect($tsc_fb->getLoginUrl()); exit;
				
			}
			echo $e->getMessage();
		}
		
		break;
		
		
		default:
			
		break;	
	}
	
	
?>