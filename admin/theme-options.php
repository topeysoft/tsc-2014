<?php

// Default options values
$sa_options = array(
	'footer_copyright' => '&copy; ' . date('Y') . ' ' . get_bloginfo('name'),
	'intro_text' => '',
	'site_logo' => '//topeysoft.com/_global/images/logo.png',
	'site_icon' => '//topeysoft.com/_global/images/icon.png',
	'featured_cat' => '',
	'layout_view' => 'fixed',
	'author_credits' => true,
	'google_analytics'=>'',
	'google_adsense'=>''
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function sa_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'tsc_theme_options', 'sa_options', 'sa_validate_options' );
}

add_action( 'admin_init', 'sa_register_settings' );

// Store categories in array
$sa_categories[0] = array(
	'value' => 0,
	'label' => ''
);
$sa_cats = get_categories(); $i = 1;
foreach( $sa_cats as $sa_cat ) :
	$sa_categories[$sa_cat->cat_ID] = array(
		'value' => $sa_cat->cat_ID,
		'label' => $sa_cat->cat_name
	);
	$i++;
endforeach;

// Store layouts views in array
global $sa_layouts;
$sa_layouts = array(
	'fixed' => array(
		'value' => 'fixed',
		'label' => 'Fixed Layout'
	),
	'fluid' => array(
		'value' => 'fluid',
		'label' => 'Fluid Layout'
	),
);

function tsc_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'tsc_theme_options_page' );
}

add_action( 'admin_menu', 'tsc_theme_options' );

// Function to generate options page
function tsc_theme_options_page() {
	global $sa_options, $sa_categories, $sa_layouts;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'sa_options', $sa_options ); ?>
	
	<?php settings_fields( 'tsc_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>
	<div ><?php settings_errors(); ?></div>
	<div class="tsc-tabs">
      <ul>
        <li><a href="#tabs-1">General</a></li>
        <li><a href="#tabs-2">Adds and Tracking</a></li>
        <li><a href="#tabs-3">Aenean lacinia</a></li><li><i class="submit"><input type="submit" class="button-primary" value="Save Options" /></i></li>
      </ul>
      <div id="tabs-1">
        
            <?php include("general.php"); ?> 
     </div>
      <div id="tabs-2">
        <?php include("analytics.php"); ?> 
      </div>
      <div id="tabs-3">
        <?php //include("analytics.php"); ?> 
      </div>
    </div>
 


	
	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function sa_validate_options( $input ) {
	global $sa_options, $sa_categories, $sa_layouts;

	$settings = get_option( 'sa_options', $sa_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['footer_copyright'] = wp_filter_nohtml_kses( $input['footer_copyright'] );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['intro_text'] = wp_filter_post_kses( $input['intro_text'] );
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['featured_cat'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['featured_cat'], $sa_categories ) )
		$input['featured_cat'] = $prev;
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['layout_view'];
	// We verify if the given value exists in the layouts array
	if ( !array_key_exists( $input['layout_view'], $sa_layouts ) )
		$input['layout_view'] = $prev;
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['author_credits'] ) )
		$input['author_credits'] = null;
	// We verify if the input is a boolean value
	$input['author_credits'] = ( $input['author_credits'] == 1 ? 1 : 0 );
	
	return $input;
}

endif;  // EndIf is_admin()