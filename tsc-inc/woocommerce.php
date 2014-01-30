<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area  col-xs-12 col-sm-10 col-md-8">
		<div id="content" class="site-content" role="main">

			<?php
				// Start the Loop.
				$content;
				ob_start();
					woocommerce_content(); 
					$content = ob_get_contents();
				ob_end_clean();
				$content=str_replace(
							'<p class="woocommerce-result-count">',
							'<div class="gently-raised panel">
								<div class="panel-body">
								<p class="woocommerce-result-count">',
							$content);
							
				$content=str_replace(
				'<div itemscope',
				'<div class="">
					<div class="">
					<div itemscope',
				$content);
				$content=str_replace(
				'product type-product',
				'product type-product row',
				$content);
				
				$content=str_replace(
				'<div class="images"',
				'<div class="images card-like"',
				$content);
				
				$content=str_replace(
				'<div class="summary ',
				'<div class=" col-xs-12 col-sm-6 ',
				$content);
				
				$content=str_replace(
				'<h1 itemprop',
				'<h4 itemprop',
				$content);
				
				$content=str_replace(
				'</h1><div itemprop',
				'</h4>
					<div class="panel panel-primary card-like">
						<div class="panel-body">
							<div itemprop
',
				$content);
				
				$content=str_replace(
				'</div><div class="clear"></div>    <script',
				'</div>
				</div>
				</div><div class="clear"></div>    <script
				',
				$content);
				
				$content=str_replace(
				'<form class="woocommerce-ordering"',
				'<div class="display-type-holder pull-left row" style="margin-left:20px;"> 
				<div class="btn-group"><button id="show-list"><i class="fa fa-th-list"></i></button> 
				 <button id="show-large"><i class="fa fa-th-large"></i></button></div></div><form class="woocommerce-ordering"
				',
				$content);
				
				
				
							echo $content;
			?>
           		<?php echo do_shortcode( '[fblike]' ); ?>
                </div><!-- /.panel-body -->
            </div><!-- /.panel --> 

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
