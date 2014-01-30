<?php

require_once ( get_stylesheet_directory() . '/theme-options.php' );

function sa_layout_view() {
	global $sa_options;
	$settings = get_option( 'sa_options', $sa_options );
	if( $settings['layout_view'] == 'fluid' ) : ?>
<style type="text/css">
#wrapper {
	width: 94%;
	max-width:1140px;
	min-width:940px;
}
#branding, #branding img, #access, #main, #colophon {
	width:100%;
}
</style>
	<?php endif;
}

add_action( 'wp_head', 'sa_layout_view' );