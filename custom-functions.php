<?php
/**
 * The custom function file added to prevent direct edit of template function file
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 function custom_theme_setup(){
	 
register_nav_menus( array(
		'top-logged-in-left'   => __( 'Top menu logged in left', 'twentyfourteen' ),
		'top-logged-out-left' => __( 'Top menu logged out left', 'twentyfourteen' ),
		'top-logged-in-right'   => __( 'Top menu logged in right', 'twentyfourteen' ),
		'top-logged-out-right' => __( 'Top menu logged out right', 'twentyfourteen' ),
	) );
	//add_theme_support( 'woocommerce' );

 }
 add_action( 'after_setup_theme', 'custom_theme_setup' );
class Child_Wrap extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth)
    {
        $indent = str_repeat("\t", $depth);
		
        $output .= "<!--<i class=\"fa fa-angle-down\"></i>-->\n$indent<div class=\"custom-sub\"><ul class=\"sub-menu\">\n";
    }
    function end_lvl(&$output, $depth)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }} 
	
	class Dropdown_Wrap extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth)
    {
        $indent = str_repeat("\t", $depth);
		
        $output .= "<!--<i class=\"fa fa-angle-down\"></i><div class=\"custom-sub\">-->\n$indent<ul class=\"dropdown-menu\">\n";
    }
    function end_lvl(&$output, $depth)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul><!--</div>-->\n";
    }} 
	add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     //if(is_single() && $item->title == "Blog"){ //Notice you can change the conditional from is_single() and $item->title
             $classes[] = "dropdown";
    // }
     return $classes;
}


function tsc_custom_scripts() {
	

	wp_enqueue_script( 'tsc_boostrap-script', "//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js#", array( 'jquery' ), '20131209', true );
	wp_enqueue_script( 'snap-menu-script', get_template_directory_uri() . '/js/snap.min.js', array( 'jquery' ), '20131209', true );
	//wp_enqueue_script( 'jquery-ui-script', 'http://code.jquery.com/ui/1.10.3/jquery-ui.js', array( 'jquery' ), '20131209', true );
	wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20131209', true );
	
	//if(is_admin()){
	//	wp_enqueue_script( 'tsc-admin-script', get_template_directory_uri() . 'admin/js/function.js', array( 'jquery' ), '20131209', true );	
	//}

	

}
add_action( 'wp_enqueue_scripts', 'tsc_custom_scripts' );

function tsc_admin_custom_scripts() {
		if ( 'appearance_page_theme_options' == get_current_screen() -> id ) {
			wp_enqueue_script( 'tsc-admin-script', get_template_directory_uri() . '/admin/js/function.js', array( 'jquery','jquery-ui-core','jquery-ui-tabs' ), '20131209', true );
		wp_enqueue_style( 'jquery-ui-style', "//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" );
		
	wp_register_script( 'tsc-theme-upload', get_template_directory_uri() .'/wptuts-options/js/wptuts-upload.js', array('jquery','media-upload','thickbox') );

	

		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');

		wp_enqueue_script('media-upload');
		wp_enqueue_script('tsc-theme-upload');

	}



}
add_action( 'admin_enqueue_scripts', 'tsc_admin_custom_scripts' );
// Cart preview widget
function tsc_custom_widgets_init() {
	//require get_template_directory() . '/inc/widgets.php';
	//register_widget( 'Twenty_Fourteen_Ephemera_Widget' );
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget tsc-widget %2$s sidebar-menu">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget tsc-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget tsc-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Cart preview', 'twentyfourteen' ),
		'id'            => 'cart-preview',
		'description'   => __( 'To be used for displaying cart preview.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget tsc-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Mega Menu (Shop By)', 'twentyfourteen' ),
		'id'            => 'shop-by-mega',
		'description'   => __( 'To be used for displaying mega menu for shop by ...', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget tsc-widget tsc-mega-menu-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'tsc_custom_widgets_init' );

	
	add_action( 'wp_enqueue_scripts', 'load_touch_punch_js' , 35 );
function load_touch_punch_js() {
	global $version;
	//wp_enqueue_style( 'custom-animation', get_stylesheet_directory_uri() . "/css/animate.min.css", "", $version, true );

	wp_enqueue_script( 'jquery-ui-position' );
	wp_enqueue_script( 'jquery-effects' );
	wp_enqueue_script( 'jquery-effects-highlight' );
	wp_enqueue_script( 'jquery-effects-slide' );
	wp_enqueue_script( 'jquery-ui-widget' );
	wp_enqueue_script( 'jquery-ui-mouse' );
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_register_script( 'woo-jquery-touch-punch', get_stylesheet_directory_uri() . "/js/jquery.ui.touch-punch.min.js", array('jquery'), $version, true );

	wp_enqueue_script( 'woo-jquery-touch-punch' );
}

// Create special post type for slideshow
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'tsc-slides',
		array(
			'labels' => array(
				'name' => __( 'Slides' ),
				'singular_name' => __( 'Slide' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
}


// Add a read more link to the exerpt
function excerpt_read_more_link($output) {
 global $post;
 return $output . '<a class="btn btn-lg btn-primary" href="'.esc_url(get_permalink($post->ID)).'">'.__(' Read More <i class="fa fa-ellipsis-h"></i>','twentyfourteen' ).'</a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

function tsc_retrieve_password($user_login) { // My own version of retrieve_password function ( added a prefix to it)
    global $wpdb, $current_site;
	
	 
    if ( empty( $user_login) ) {
       
		
		return new WP_Error("reset error",'Please enter your Username or E-mail address</span>');
		//exit();
		// return false;
	
    } else if ( strpos( $user_login, '@' ) ) {
        $user_data = get_user_by( 'email', trim( $user_login ) );
        if ( empty( $user_data ) )
           return false;
    } else {
        $login = trim($user_login);
        $user_data = get_user_by('login', $login);
    }

    //do_action('lostpassword_post');


    if ( !$user_data ) return false;

    // redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;

   // do_action('retreive_password', $user_login);  // Misspelled and deprecated
    do_action('retrieve_password', $user_login);

    $allow = apply_filters('allow_password_reset', true, $user_data->ID);

    if ( ! $allow )
        return false;
    else if ( is_wp_error($allow) )
        return false;

    $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
    if ( empty($key) ) {
        // Generate something random for a key...
        $key = wp_generate_password(20, false);
        do_action('retrieve_password_key', $user_login, $key);
        // Now insert the new md5 key into the db
        $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
    }
    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
    $message .= network_home_url( '/' ) . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

    if ( is_multisite() )
        $blogname = $GLOBALS['current_site']->site_name;
    else
        // The blogname option is escaped with esc_html on the way into the database in sanitize_option
        // we want to reverse this for the plain text arena of emails.
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf( __('[%s] Password Reset'), $blogname );

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    if ( $message && !wp_mail($user_email, $title, $message) ){
        return new WP_Error("reset error", __('The e-mail could not be sent.')) ; //. "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );
	}else{
    	return true;
	}
}


function passVar($var){
	return $var;
}
// redirect away from wp-login page to the custom login page
function is_login_page(){
	return ( in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) );
}
function no_wp_login(){
	
	if(is_login_page()){
			if(isset($_GET["action"]) && $_GET["action"]=="lostpassword"){
				wp_redirect(home_url("/lost-password")); exit;
			}
			if(isset($_GET["action"]) && $_GET["action"]=="register"){
				wp_redirect(home_url("/register")); exit;
			}
		wp_redirect(home_url("/login")); exit;
	}
	
}
add_action( 'init', 'no_wp_login' );

/* Disable WordPress Admin Bar for all users but admins. */
  show_admin_bar(false);
  get_template_part("admin/theme-options");
require( 'tsc-inc/third-party/include.php' );
//include  "admin/class-fire-admin_init.php";
//new TC_admin_init();
//require( 'tsc-custom-plugins/include.php' );
?>