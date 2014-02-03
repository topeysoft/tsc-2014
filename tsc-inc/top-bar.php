<?php

global $current_user;

 if ( wp_is_mobile() ) { ?>
<div class="snap-drawers">
            
<?php //include('snap-menu-left.php') ?>

</div>
<?php }?>

	

<div id="wrap" class="hfeed site">
<?php //if ( get_header_image() ) : ?>
	<div id="site-header" class="top-nav navbar navbar-default yamm navbar-fixed-top navbar-with-drop-shadow-1 <?php echo $navbar_has_border?" border-bottom-3":""; ?> border-blue">
		<!--<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
		</a>--->
        <div class="container">
            <div class="navbar-header">
             <button class="navbar-toggle" data-toggle="collapse" data-target=".menu-collapse" >
                    <span  class="screen-reader-text sr-only"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></span>
                    <i class="fa fa-bars color-blue"></i>
            </button>
            <button class="navbar-toggle" data-toggle="collapse" data-target=".search-box">
                    <span  class="screen-reader-text sr-only"><?php _e( 'Search', 'twentyfourteen' ); ?></span>
                    <i class="fa fa-search color-blue"></i>
            </button>
            <button class="navbar-toggle  snap-left pull-left"   data-target="_false" >
                    <span  class="screen-reader-text sr-only"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></span>
                    <i class="fa fa-chevron-right color-blue"></i><i class="fa fa-bars color-blue"></i>
            </button>
          <!-- <a class="visible-xs  mini-logo navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"> 
           <img style="max-height:20px; margin:0; padding:0;" class="img.responsive" alt="<?php bloginfo( 'name' ); ?>" 
           			src="<?php //echo apply_filters( 'tc_logo_src' , esc_url ( tc__f( '__get_option' , 'tc_logo_upload') ) ) ; ?>" /></a> -->
            
           
           <a class="visible-xs  navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"> 
           <img style="max-height:20px; margin:0; padding:0;" class="img.responsive" alt="<?php bloginfo( 'name' ); ?>" 
           	src="<?php echo $tsc_settings["site_logo"]; ?>" />
</a>
            </div>
            <div class="navbar-collapse collapse search-box">
            	<div class="panel hide visible-xs" >
				<?php get_search_form(); ?>
                </div>
			</div>
            <div class="navbar-collapse collapse menu-collapse">
				<?php
				// cart badge
				$badge='<span class="badge ">42</span>';
				// Cart preview
				ob_start();
				dynamic_sidebar('cart-preview');
				$sidebar = ob_get_contents();
				ob_end_clean();
				$cart_preview='<div class="dropdown-menu" style="width:300px; width:100%" >
					'.$sidebar.'
				</div>';
				$shop_by_menu='<a href="#" class="dropdown-toggle"  data-toggle="dropdown">Shop by <span class="caret"></span></a>';
				$my_account_menu='<span class="">'.get_avatar( $current_user->ID, 20 ).'</span><span class="caret"></span>';
				$log_in_menu='<a href="#" class="dropdown-toggle"  data-toggle="dropdown"><span class="fa fa-lock"></span> Login / Register <span class="caret"></span></a>';
				$cart_menu='<a href="#" class="dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-gear"></i><i class="caret"></i></a>
				'.$cart_preview;
				$the_menu="";
				$login_url=!is_user_logged_in()?'<li class=""><a href="#login-topeysoft" data-type="ajax" data-source="'.home_url("/ajax/?_request=login-form").'"  class="">
                            	<i class="fa fa-lock fa-lg"></i> Login here</a></li>':'';
					$the_menu=wp_nav_menu( 
						array( 
							'theme_location' => 'primary',//'top-logged-in-left',
							"container"=>false, 
							'menu_class' => 'top-menu nav navbar-nav hidden-sm',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s'.$login_url.'</ul>',
							"walker"=>new Dropdown_Wrap(),
							"echo"=>false
							) 
						);
						
						//=ob_get_contents();
               $the_menu= str_replace(
					'<a href="#">{shop_by}</a>',
					$shop_by_menu,
					$the_menu
				);
				$the_menu= str_replace(
					'active',
					"",
					$the_menu
				);
				
				echo $the_menu;
				?>
                <div class="navbar-form navbar-left hidden-xs" style="width:400px;" >
				<?php get_search_form(); ?>
                </div>
                <?php
                if ( is_user_logged_in() ) {
                    $menu= wp_nav_menu( array( 'theme_location' => 'top-logged-in-right',"echo"=>false, 'menu_class' => 'top-menu nav navbar-nav navbar-right', "walker"=>new Dropdown_Wrap() ) );
                  
					$menu=str_replace(
					'{my_account}',
					$my_account_menu,
					$menu
					);  
                } else {
					$menu= wp_nav_menu( array( 'theme_location' => 'top-logged-out-right',"echo"=>false, 'menu_class' => 'top-menu nav navbar-nav navbar-right', "walker"=>new Dropdown_Wrap() ) );
                  
					$menu=str_replace(
					'<a href="#">{my_account_login}</a>',
					$log_in_menu,
					$menu
					);  
                }
				$menu=str_replace(
					'<a href="#">{cart}</a>',
					$cart_menu,
					$menu
					);
				$menu= str_replace(
					'active',
					"",
					$menu
				);
				echo $menu;
                ?>
            </div>
            
        </div>
       <?php echo !$navbar_has_border?'<div class="moving-border"></div>':""; ?> 

	</div>
	<?php //endif; 
	
		if(!empty($home_slider)) echo $home_slider;
	?>