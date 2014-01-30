<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
            
            	<?php
                	global $sa_options;
					$sa_settings = get_option( 'sa_options', $sa_options );
				?>
                
                <?php if( $sa_settings['intro_text'] != '' ) : ?>
				
                <div class="intro">
				
				<?php echo $sa_settings['intro_text']; ?>
				
                </div>
				
				<?php endif; ?>
                
                
           
           		<?php if ( $sa_settings['featured_cat'] ) : ?>
            
            	<?php query_posts( 'cat=' . $sa_settings['featured_cat'] ); ?>
            
            	<?php if ( have_posts() ) : ?>
                
                <div class="featured">
            
				<h1 class="page-title author"><?php _e( 'Featured Posts' ); ?></h1>
                
                <?php while ( have_posts() ) : the_post(); ?>
                
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                
                <?php endwhile; ?>
                
                </div>
                
                <?php endif;
				
				/* Since we called the_post() and query_posts() above, we need to
	 		 	* reset the query and rewind the loop back to the beginning that way
	 		 	* we can run the loop properly, in full.
	 		 	*/
			 	rewind_posts(); wp_reset_query();
			 
			 	endif; ?>
                
                

			<?php
			
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
