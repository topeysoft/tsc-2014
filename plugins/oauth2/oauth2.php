<?php
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
if ( !defined('_GLOBALPATH') )
	define('_GLOBALPATH',ABSPATH."_global/");
	
	$req=$_REQUEST['action'];
	
	
	class Tsc_oauth2{
		public $server;
		function __construct(){
			require_once(_GLOBALPATH."/OAuth2/tsc_server.php");
			$this->server=$server;
		}
		function token(){
			$this->server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();

		}
		function _install () {
				/*
				CREATE TABLE oauth_clients (client_id VARCHAR(80) NOT NULL, client_secret VARCHAR(80) NOT NULL, redirect_uri VARCHAR(2000) NOT NULL, grant_types VARCHAR(80), scope VARCHAR(100), user_id VARCHAR(80), CONSTRAINT client_id_pk PRIMARY KEY (client_id));
				CREATE TABLE oauth_access_tokens (access_token VARCHAR(40) NOT NULL, client_id VARCHAR(80) NOT NULL, user_id VARCHAR(255), expires TIMESTAMP NOT NULL, scope VARCHAR(2000), CONSTRAINT access_token_pk PRIMARY KEY (access_token));
				CREATE TABLE oauth_authorization_codes (authorization_code VARCHAR(40) NOT NULL, client_id VARCHAR(80) NOT NULL, user_id VARCHAR(255), redirect_uri VARCHAR(2000), expires TIMESTAMP NOT NULL, scope VARCHAR(2000), CONSTRAINT auth_code_pk PRIMARY KEY (authorization_code));
				CREATE TABLE oauth_refresh_tokens (refresh_token VARCHAR(40) NOT NULL, client_id VARCHAR(80) NOT NULL, user_id VARCHAR(255), expires TIMESTAMP NOT NULL, scope VARCHAR(2000), CONSTRAINT refresh_token_pk PRIMARY KEY (refresh_token));
				CREATE TABLE oauth_users (username VARCHAR(255) NOT NULL, password VARCHAR(2000), first_name VARCHAR(255), last_name VARCHAR(255), CONSTRAINT username_pk PRIMARY KEY (username));
				CREATE TABLE oauth_scopes (scope TEXT, is_default BOOLEAN);
				CREATE TABLE oauth_jwt (client_id VARCHAR(80) NOT NULL, subject VARCHAR(80), public_key VARCHAR(2000), CONSTRAINT client_id_pk PRIMARY KEY (client_id));
				*/
		   global $wpdb;
		   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		   echo "<h3>Instaling Oauth 2.0 Database:</h3>";
		   $sql="CREATE TABLE oauth_clients (
		   		client_id VARCHAR(80) NOT NULL,
				client_secret VARCHAR(80) NOT NULL,
				redirect_uri VARCHAR(2000) NOT NULL,
				grant_types VARCHAR(80),
				scope VARCHAR(100),
				user_id VARCHAR(80),
				CONSTRAINT client_id_pk PRIMARY KEY  (client_id)
				);
				";
			dbDelta( $sql );
			 echo "<p>Installed: <em>oauth_clients</em></p>";
			
			$sql="CREATE TABLE oauth_access_tokens (
				access_token VARCHAR(40) NOT NULL,
				client_id VARCHAR(80) NOT NULL,
				user_id VARCHAR(255),
				expires TIMESTAMP NOT NULL,
				scope VARCHAR(2000),
				CONSTRAINT access_token_pk PRIMARY KEY  (access_token)
				);
				";
			dbDelta( $sql );
			 echo "<p>Installed: <em>oauth_access_tokens</em></p>";
			
			$sql="CREATE TABLE oauth_authorization_codes (
				authorization_code VARCHAR(40) NOT NULL,
				client_id VARCHAR(80) NOT NULL,
				user_id VARCHAR(255),
				redirect_uri VARCHAR(2000),
				expires TIMESTAMP NOT NULL,
				scope VARCHAR(2000),
				CONSTRAINT auth_code_pk PRIMARY KEY  (authorization_code)
				);
				";
			dbDelta( $sql );
			 echo "<p>Installed: <em>oauth_authorization_codes</em></p>";
			
			$sql = "CREATE TABLE oauth_refresh_tokens (
				refresh_token VARCHAR(40) NOT NULL, 
				client_id VARCHAR(80) NOT NULL,
				user_id VARCHAR(255),
				expires TIMESTAMP NOT NULL,
				scope VARCHAR(2000),
				CONSTRAINT refresh_token_pk PRIMARY KEY  (refresh_token)
				);
				";
			dbDelta( $sql );
			 echo "<p>Installed: <em>oauth_refresh_tokens</em></p>";
			
			$sql = "CREATE TABLE oauth_users (
				username VARCHAR(255) NOT NULL,
				password VARCHAR(2000), 
				first_name VARCHAR(255), 
				last_name VARCHAR(255), 
				CONSTRAINT username_pk PRIMARY KEY  (username)
				);
				";
			dbDelta( $sql );
			 echo "<p>Installed: <em>oauth_users</em></p>";
			
			$sql = "CREATE TABLE oauth_scopes (
				_id mediumint(9) NOT NULL AUTO_INCREMENT,
				scope TEXT, 
				is_default BOOLEAN,
				UNIQUE KEY _id (_id)
				);
				";
			dbDelta( $sql );
			 echo "<p>Installed: <em>oauth_scopes</em></p>";
			
			$sql = "CREATE TABLE oauth_jwt (
				client_id VARCHAR(80) NOT NULL, 
				subject VARCHAR(80), 
				public_key VARCHAR(2000), 
				CONSTRAINT client_id_pk PRIMARY KEY  (client_id)
				);
				";
			dbDelta( $sql );
			 echo "<p>Installed: <em>oauth_jwt</em></p>";
			 
			add_option( "tsc_oauth2_db_version", "1.0" );
			add_option( "tsc_oauth2_db_version_int", "1" );
			 echo "<p>Databse Version: <em>".get_option('tsc_oauth2_db_version')."</em></p>";
			
			
		   
		}
		function _install_data($table_name,$data=array()) {
			
			// array( 'client_id' => current_time('mysql'), 'name' => $welcome_name, 'text' => $welcome_text ) 
		   global $wpdb;
		   //$app = "Mr. WordPress";
		   //$welcome_text = "Congratulations, you just completed the installation!";
		   //$table_name = "oauth_clients"; //$wpdb->prefix . "liveshoutbox";
		   $rows_affected = $wpdb->replace( $table_name, $data);
		}
		
		function get_client($_id){
			global $wpdb;
			// $_id comes from the post id and it is not hashed, to use it 
			// we have to hash it first
			$client_id=md5($_id);
			$client=$wpdb->get_results( 
				$wpdb->prepare( 
					"
							SELECT * FROM oauth_clients
					 WHERE client_id = %d
					",
						"$client_id"
					)
			);	
			if(count($client)>0){
				return $client[0];
			}else{
				return false;	
			}
		}
	}
	global $tsc_oauth2;
	$tsc_oauth2=new Tsc_oauth2();
?>