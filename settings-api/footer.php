<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

<?php 
	global $sa_options;
	$sa_settings = get_option( 'sa_options', $sa_options );
?>
   
			<div id="site-info">
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php echo $sa_settings['footer_copyright']; ?>
				</a>
			</div><!-- #site-info -->

			<div id="site-generator">
				<?php do_action( 'twentyten_credits' ); ?>
                <?php if( $sa_settings['author_credits'] ) : ?>
				<a href="<?php echo esc_url( __('http://wordpress.org/', 'twentyten') ); ?>"
						title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'twentyten'); ?>" rel="generator">
					<?php printf( __('Proudly powered by %s.', 'twentyten'), 'WordPress' ); ?>
				</a>
                <?php endif; ?>
			</div><!-- #site-generator -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
