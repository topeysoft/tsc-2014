<?php
/**
 * Loop-shop (deprecated)
 *
 * Outputs a product loop
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 * @deprecated 	1.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

_deprecated_file( basename(__FILE__), '1.6', '', 'Use your own loop code, as well as the content-product.php template. loop-shop.php will be removed in WC 2.1.' );
?>
<div id="main-content" class="main-content col-xs-12 col-sm-9 col-md-10">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
     <div class="row">
            <div id="primary" class="content-area col-xs-12 col-sm-12 col-md-10">
                <div id="content" class="site-content" role="main">
        
                <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
        
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
        
                        endwhile;
                        // Previous/next post navigation.
                        twentyfourteen_paging_nav();
        
                    else :
                        // If no content, include the "No posts found" template.
                        get_template_part( 'content', 'none' );
        
                    endif;
                ?>
        
                </div><!-- #content -->
            </div><!-- #primary -->
        <div class="right-sidebar col-xs-12 col-sm-12 col-md-2">
        <?php get_sidebar( 'content' ); ?>
        </div>
    </div>
</div><!-- #main-content -->

<?php if ( have_posts() ) : ?>

	<?php do_action('woocommerce_before_shop_loop'); ?>

	<?php woocommerce_product_loop_start(); ?>

		<?php woocommerce_product_subcategories(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php woocommerce_product_loop_end(); ?>

	<?php do_action('woocommerce_after_shop_loop'); ?>

<?php else : ?>

	<?php if ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

		<p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>

	<?php endif; ?>

<?php endif; ?>

<div class="clear"></div>