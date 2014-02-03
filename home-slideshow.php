<?php
/**
 * The Slideshow for the main homepage
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div id="tsc_home_carousel" class="carousel slide" data-ride="carousel" style="margin-top:-20px; width:100%; "><!-- tsc_home_carousel -->
  
  
  <?php 
  	$args = array( 'post_type' => 'tsc-slides', 'posts_per_page' => 10 );
	$slide_loop = new WP_Query( $args );
	
	$slide_count=0;
	$slides="";
	ob_start();
	while ( $slide_loop->have_posts() ) : $slide_loop->the_post();
		$slide_active=$slide_count<1?"active":" ";
		?>
		<div class="item vert-scrolling-bg <?php echo $slide_active?>" style="background-image:url('<?php echo get_template_directory_uri()?>/images/smoke.png'); background-color:#006699;min-height:400px; ">
			<div class="entry-content container ">
		
		
        	<!--<div class="pull-left bounce-in bounce-out" style="top: -500px;">
            	<a href="http://192.168.1.4/topeysoft/wp-content/uploads/2014/01/tps_logo_new_300_by_921.png">
                	<img class="alignnonesize-medium wp-image-31" alt="tps_logo_new_300_by_92" 
                    	src="http://192.168.1.4/topeysoft/wp-content/uploads/2014/01/tps_logo_new_300_by_921-300x77.png" width="300" height="77" />
                </a>
            </div>-->
            <div class="carousel-caption">
            	<h3><?php the_title() ?></h3>
                <p class="fadein"><?php the_excerpt() ?></p>
                <?php echo edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="btn btn-default btn-xs edit-link">', '</span>' )?>
			</div>
           
        
				
			</div><!-- entry-content -->
		</div><!-- item -->
		
		
            
		<?php
		
		$slide_count++;
	endwhile;
	$slides=ob_get_contents();
	ob_end_clean();
	$indicators='<ol class="carousel-indicators">';
	for($i=0;$i<$slide_count;$i++){
		$active=$i<1?"active":" ";
		$slide_to=$i<$slide_count?($slide_count+1):"0";
	$indicators.='<li data-target="#tsc_home_carousel" data-slide-to="'.$slide_to.'" class="'.$active.'" >';
	$indicators.='</li>';
	}
	$indicators.='</ol>';
	echo $indicators;
  ?>
    
   

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <?php echo $slides ?>
   
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#tsc_home_carousel" data-slide="prev">
    <span class=" glyphicon-chevron-left fa fa-long-arrow-left  fa-lg"></span>
  </a>
  <a class="right carousel-control" href="#tsc_home_carousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right fa fa-long-arrow-right fa-lg"></span>
  </a>

</div><!-- #secondary 
<style>
	.site-main {
		background-color:#f1f1f1;
		z-index:5000;
	}
</style>
<div style="margin-top:500px; height:10px; background:#900; position:relative;"  ></div>
-->