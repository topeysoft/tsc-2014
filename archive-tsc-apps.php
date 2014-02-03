<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="main-content" class="main-content col-xs-12 col-sm-9 col-md-9">
 <div class="row">
<section id="primary" class="content-area col-xs-12 col-sm-12 col-md-10">
		<div id="content" class="site-content" role="main">
			
			<?php if ( have_posts() ) : ?>
			
			<header class="page-header">
				<h2 class="page-title">
				<?php
						
							_e( 'Apps By TopeySoft', 'twentyfourteen' );

					?></h2>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						//printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->
				<div class="list-group">
			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					?>
                    
  					<a href="<?php echo  esc_url( get_permalink() )?>" class="list-group-item">
						<div class="row">
                        	<div class="col-xs-3 col-sm-2">
                            	<div class="thumbnail" style="color:#bbb; text-align:center; vertical-align:middle; margin:2px;">
                            	<?php 
								if(has_post_thumbnail()){
								$default_attr = array(
									//'src'	=> $src,
									'class'	=> "img-responsive",
									//'alt'	=> trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt )),
								);
								the_post_thumbnail( "thumbnail", $default_attr ); 
								}else{
									?>
                                    
                                    <i class="fa fa-camera fa-2x" style="color:#e8e8e8;" ></i><br />
									
                                    
                                    <?php	
								}
								?> 
                                </div>
                            </div>
                            <div class="col-xs-9 col-sm-10">
                            	<h4 class="list-group-item-heading"><?php the_title(); ?></h4>
    							<p class="list-group-item-text"><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                        
                    </a>
    
  
  

                    
                    <?php

					endwhile;
					// Previous/next page navigation.
					twentyfourteen_paging_nav();
				?>
                </div>
				<?php
                else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->
    <div class="right-sidebar col-xs-12 col-sm-12 col-md-2 col-lg-2">
        <?php get_sidebar( 'content' ); ?>
        
        </div>
    </div>
</div><!-- #main-content -->


<?php
//get_sidebar( 'content' );
//get_sidebar();
get_footer();
