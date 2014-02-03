<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 $settings = get_option( 'sa_options' ); 
	?>
    <div class="col-xs-12  go-to-top-parent"> 
		
        <div class="go-to-top card-like">
			<i class="fa fa-arrow-up fa-lg"></i>
			
		</div>
        
	</div>
   			 <div class="hidden-sm hidden-md hidden-lg  col-xs-12" >
             	<?php echo $settings["google_adsense"]; ?>
             </div>
	</div><!-- /.row -->
			</div><!-- #page -->

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
			<?php get_sidebar( 'footer' ); ?>

			<div class="site-info tsc-credits">
				<?php do_action( 'twentyfourteen_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://topeysoft.com/', 'twentyfourteen' ) ); ?>"><?php printf( __( '&copy; '.date('Y').' By %s', 'twentyfourteen' ), 'TopeySoft Computers' ); ?></a>
			</div><!-- .site-info -->
            </div>
		</footer><!-- #colophon -->
	

	<?php wp_footer(); ?>
    <?php echo $settings["google_analytics"]; ?>
</body>
</html>