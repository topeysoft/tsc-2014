<!--<div id="masthead" class="site-header-1 navbar-wrapper" role="banner">
    	<div class="<?php echo !empty($home_slider)? "":"container" ?>">
			<div class=" navbar navbar-default navbar-static-top">
                <div class="header-main container">
                
            
                
    
                    <nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
                        <h1 class="menu-toggle sr-only"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></h1>
                        <a class="sr-only screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
                        
                        <?php 
						
						ob_start();
				dynamic_sidebar('shop-by-mega');
				$shop_by_content = ob_get_contents();
				ob_end_clean();
				$shop_by_mega='<div class="tsc-menu" style="" >
					'.$shop_by_content.'
				</div>';
				$shop_by_menu='<a href="#" class="dropdown-toggle"  data-toggle="dropdown">Shop by <span class="caret"></span></a>'.$shop_by_mega;
					
					$the_menu="";
					$the_menu=wp_nav_menu( 
						array( 
							'theme_location' => 'primary',
							"container"=>false, 
							'menu_class' => 'top-menu nav navbar-nav',
							"walker"=>new Dropdown_Wrap(),
							'items_wrap'      => '<ul id="%1$s" class="%2$s"><li class="tsc-mega-menu-li">'.$shop_by_menu.'</li>%3$s</ul>',
							"echo"=>false
							) 
						);
						
						//=ob_get_contents();
             /*  $the_menu= str_replace(
					'<a href="#">{shop_by}</a>',
					$shop_by_menu,
					$the_menu
				);
				*/
				echo $the_menu;
						//wp_nav_menu( array( 'theme_location' => 'primary',"container"=>false, 'menu_class' => 'main-menu nav-menu nav navbar-nav', "walker"=>new Child_Wrap() ) ); ?>
                    </nav>
                </div>
            </div>
		</div>

		
	</div><!-- #masthead -->