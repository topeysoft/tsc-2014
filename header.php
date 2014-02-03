<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 global $home_slider,
 $navbar_has_border;
 if(empty($navbar_has_border)){
	 
	$navbar_has_border  =true;
 }
$tsc_settings = get_option( 'sa_options' ); 

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php if ( wp_is_mobile() ) { ?>
	<meta name="viewport" content="width=device-width  initial-scale=1.0, maximum-scale=1.0, user-scalable=0'">
	<?php }else{ ?>
	<meta name="viewport" content="width=device-width ">
	<?php } ?>
    
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-custom.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css#" rel="stylesheet">
<link rel="icon" type="image/png" href="<?php echo $tsc_settings["site_icon"]; ?>"/>
<!-- Optional theme 
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
-->
<!-- Latest compiled and minified JavaScript -->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> style="position:relative; height:100%">
	<?php //get_template_part('tsc-inc/login-float') ?>
<input type="hidden" value="<?php echo site_url("/ajax/");?>" id="ajax_url" />
<input type="hidden" value="<?php echo site_url();?>" id="site_url" />

<?php include("tsc-inc/top-bar.php"); ?>
    
    <!--<div class="container">
		<div class="row <?php echo !empty($home_slider)? "hide":"" ?>">
        	<div class="site-title col-xs-12 col-sm-4 col-md-3 col-lg-3" style="min-height:100px;">
           <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		   <?php 
		    $logo_png=get_template_directory()."/images/logo.png";

				 if(file_exists($logo_png)){

					 ?>

                     <img  style="max-height:60px; margin:0; padding:0;"  class="img.responsive" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo $tsc_settings["site_logo"]; ?>" />

                     

                     <?php

				}else{

					?>

				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>

				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

                <?php

				}

				?></a>
             </div>
             <div class="site-title hidden-xs  col-xs-12 col-sm-4 col-md-6 col-lg-6" >
             	<?php //echo $tsc_settings["google_adsense"]; ?>
             </div>
        
 <!--   <div id="search-container " class="hidden-xs show search-box-wrapper col-xs-12 col-sm-4 col-md-3">
		
        	<div class="search-box">
				<?php //get_search_form(); ?>
			</div>
       
		</div> 
        </div>
  	 </div>-->
     <div style="margin-top:5px"></div>
	<? // get_template_part("tsc-inc/masthead") ?>

	<div id="main" class="site-main container">
    	<div class="row">
       
        	<div class="hidden-xs_1 col-sm-3 col-md-3 tsc-left-menu">
            <img  style="max-height:60px; margin:0; padding:0;" 
             class="img-responsive" alt="<?php bloginfo( 'name' ); ?>" 
             src="<?php echo $tsc_settings["site_logo"]; ?>" />

       			<?php dynamic_sidebar( 'sidebar-1' ); ?>
       		</div>
             <div class="tsc-menu-overlay"></div>
    	
