<?php

// Create special post type for apps

add_action( 'init', 'create_apps_post_type' );
function create_apps_post_type() {
	$labels = array(
    'name'               => 'Apps',
    'singular_name'      => 'App',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New App',
    'edit_item'          => 'Edit App',
    'new_item'           => 'New App',
    'all_items'          => 'All Apps',
    'view_item'          => 'View App',
    'search_items'       => 'Search Apps',
    'not_found'          => 'No apps found',
    'not_found_in_trash' => 'No apps found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Apps'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'apps' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
	'menu_icon'	=>'dashicons-screenoptions',
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-thumbnails' )
  );

  register_post_type( 'tsc-apps', $args );

	// Register taxonomies here
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'App Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'App Categories', 'taxonomy singular name' ),
		'search_items'      => __( 'Search App Categories' ),
		'all_items'         => __( 'All App Categories' ),
		'parent_item'       => __( 'Parent App Category' ),
		'parent_item_colon' => __( 'Parent App Categories:' ),
		'edit_item'         => __( 'Edit App Category' ),
		'update_item'       => __( 'Update App Category' ),
		'add_new_item'      => __( 'Add New App Category' ),
		'new_item_name'     => __( 'New App Category Name' ),
		'menu_name'         => __( 'App Categories' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'app-cat' ),
	);

	register_taxonomy( 'tsc-app-cat', array( 'tsc-apps' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Platforms', 'taxonomy general name' ),
		'singular_name'              => _x( 'Platform', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Platforms' ),
		'popular_items'              => __( 'Popular Platforms' ),
		'all_items'                  => __( 'All Platforms' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Platform' ),
		'update_item'                => __( 'Update Platform' ),
		'add_new_item'               => __( 'Add New Platform' ),
		'new_item_name'              => __( 'New Platform Name' ),
		'separate_items_with_commas' => __( 'Separate platforms with commas' ),
		'add_or_remove_items'        => __( 'Add or remove platforms' ),
		'choose_from_most_used'      => __( 'Choose from the most used platforms' ),
		'not_found'                  => __( 'No platforms found.' ),
		'menu_name'                  => __( 'Platforms' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'platform' ),
	);

	register_taxonomy( 'tsc-app-platforms', 'tsc-apps', $args );
	//register_taxonomy_for_object_type( "category", "tsc-apps" );
}
/**
 * Calls the class on the post edit screen.
 */
function call_tsc_app_box_class() {
    new Tsc_app_box_class();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_tsc_app_box_class' );
    add_action( 'load-post-new.php', 'call_tsc_app_box_class' );
}

/** 
 * The Class.
 */
class Tsc_app_box_class {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public $tsc_oauth2=NULL;
	 
	public function __construct() {
		global $tsc_oauth2;
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		$this->tsc_oauth2=$tsc_oauth2;
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type="tsc-apps" ) {
            $post_types = array('tsc-apps');     //limit meta box to certain post types
            if ( in_array( $post_type, $post_types )) {
		add_meta_box(
			'tsc_app_credentials_box'
			,__( 'Application Credetials', 'tsc_apps_textdomain' )
			,array( $this, 'render_meta_box_content' )
			,$post_type
			,'normal'
			,'high'
		);
		
		add_meta_box(
			'tsc_app_media_box'
			,__( 'Application Media', 'tsc_apps_textdomain' )
			,array( $this, 'render_media_meta_box_content' )
			,$post_type
			,'side'
			,'high'
		);
            }
	}
	

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		


		// Check if our nonce is set.
		if ( ! isset( $_POST['tsc_apps_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['tsc_apps_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'tsc_apps_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		/*// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		//$mydata = sanitize_text_field( $_POST['tsc_apps_new_field'] );
		$client=$this->tsc_oauth2->get_client($post_id);
		if($client){
			$app_id=$client->client_id; //get_post_meta( $post_id, '_tsc_app_id', true );
			$app_secret=$client->client_secret;// get_post_meta( $post_id, '_tsc_app_secret', true );
		}
		// Check if user click generate credentials
		if (  isset( $_POST['tsc_apps_credentials'] ) ){
			//$arg=array("len"=>32,'special_chars'=>false);
			//if(empty($app_id))
			 $app_id=md5($post_id);
			//if(empty($app_secret)) 
			$app_secret=sha1(wp_generate_password());
			// INSERT INTO oauth_clients (client_id, client_secret, redirect_uri) VALUES ("testclient", "testpass", "http://fake/");
			$data=array('client_id'=>$app_id,'client_secret'=>$app_secret);
			$this->tsc_oauth2->_install_data("oauth_clients",$data);
			update_post_meta( $post_id, '_tsc_app_id', $app_id );
			update_post_meta( $post_id, '_tsc_app_secret', $app_secret );
		}
		// Update the meta field.
		// Sanitize the user input.
		$app_icon = sanitize_text_field( $_POST['tsc_apps_app_icon'] );
		update_post_meta( $post_id, '_tsc_app_icon', $app_icon );
		//update_post_meta( $post_id, '_tsc_app_icon', $app_id );
		
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_media_meta_box_content( $post ) {
		$post_id=$post->ID;
			$app_icon_id=get_post_meta( $post_id, '_tsc_app_icon', true );//$client->client_id; //
			$app_image=get_post_meta( $post_id, '_tsc_app_image', true );//$client->client_secret;// 
		
		//var_dump($client);
		
	
		if(empty($app_icon_id)){
			 $app_icon='<i class=" dashicons dashicons-format-image" style="color:#ddd;" ></i>';
		}else{
			$default_attr = array(
									//'src'	=> $src,
									 'id'=>'tsc_app_icon_preview',
									'class'	=> "img-responsive",
									//'alt'	=> trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt )),
								);
			$app_icon=wp_get_attachment_image( $app_icon_id, "tsc_icon_large",false, $default_attr ); 
		}
		if(empty($app_image)) $app_image='<i class=" dashicons dashicons-format-image" style="color:#ddd;" ></i>';//wp_generate_password($arg);
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'tsc_apps_inner_custom_box', 'tsc_apps_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		//$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

		// Display the form, using the current value.
		if(!get_option('tsc_oauth2_db_version_int',false)) $this->tsc_oauth2->_install();
		echo '
		<style>
			.well{
				background-color: #f8f8f8;
				border: 1px solid #eee;
				-webkit-border-radius: 2px;
				color: #4e5665;
				font-size: 14px;
				height: 30px;
				line-height: 30px;
				padding: 0 4px 0 8px;	
			}
		</style>
		
		<p><strong>';
		_e( 'App Icon:', 'tsc_apps_textdomain' );
		echo '</strong> 
		
		<div class="thumbnail" style="color:#bbb; text-align:center; vertical-align:middle; margin:2px;">
			'.$app_icon.'
		</div>
		<input type="hidden" value="' . esc_attr( $app_icon_id ) . '" name="tsc_apps_app_icon" id="tsc_app_icon_id" size="25" />
		</p><input type="button" class="button button-default button-small" id="tsc_upload_app_icon_button" name="tsc_apps_credentials" value="Set icon" />';
		/*
		<input id="upload_icon_button" type="button" class="button" value="<?php _e( 'Upload Icon', 'topeysoft' ); ?>" /> 
                <input id="tsc_icon_url" name="sa_options[site_icon]" type="text" value="<?php  esc_attr_e($settings['site_icon']); ?>" />
                <br>

                <img id="tsc_icon_preview" src="<?php  esc_attr_e($settings['site_icon']); ?>" style="max-height:20px" />
		echo '<p><strong>
			';
		//echo '<input type="submit" class="button button-primary button-large" id="tsc_gen_apps_credentials" name="tsc_apps_credentials" value="Generate New Secret" />';
                echo '<input type="hidden" value="' . esc_attr( $app_icon_id ) . '" name="tsc_apps_app_icon" id="tsc_icon_url" size="25" />';
		_e( 'App Image:', 'tsc_apps_textdomain' );
		echo '</strong><input type="button" class="button button-default button-small" id="tsc_gen_apps_credentials" name="tsc_apps_credentials" value="Set image" /> 
		<div class="thumbnail" style="color:#bbb; text-align:center; vertical-align:middle; margin:2px;">
			'.$app_image.'
		</div>
		</p>';
		*/
		
	}
	
	public function render_meta_box_content( $post ) {
		$client=$this->tsc_oauth2->get_client($post->ID);
		if($client){
			$app_id=$client->client_id; //get_post_meta( $post_id, '_tsc_app_id', true );
			$app_secret=$client->client_secret;// get_post_meta( $post_id, '_tsc_app_secret', true );
		}
		//var_dump($client);
		$post_id=$post->ID;
	
		if(empty($app_id)) $app_id=md5($post_id);
		if(empty($app_secret)) $app_secret="&lt;not set&gt;";//wp_generate_password($arg);
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'tsc_apps_inner_custom_box', 'tsc_apps_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		//$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

		// Display the form, using the current value.
		if(!get_option('tsc_oauth2_db_version_int',false)) $this->tsc_oauth2->_install();
		echo '
		<style>
			.well{
				background-color: #f8f8f8;
				border: 1px solid #eee;
				-webkit-border-radius: 2px;
				color: #4e5665;
				font-size: 14px;
				height: 30px;
				line-height: 30px;
				padding: 0 4px 0 8px;	
			}
		</style>
		
		<p><strong>';
		_e( 'App ID:', 'tsc_apps_textdomain' );
		echo '</strong> 
		<div class="well" >
			'.$app_id.'
		</div>
		</p>';
		echo '<p><strong>';
		_e( 'App Secret:', 'tsc_apps_textdomain' );
		echo '</strong> 
		<div class="well" >
			'.$app_secret.'
		</div>
		</p>';
		echo '<input type="submit" class="button button-primary button-large" id="tsc_gen_apps_credentials" name="tsc_apps_credentials" value="Generate New Secret" />';
                //echo ' value="' . esc_attr( $value ) . '" size="25" />';
	}
}
?>