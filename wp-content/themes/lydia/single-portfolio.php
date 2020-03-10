<?php
	get_header();
	the_post();
	
	$layout = get_post_meta( $post->ID, '_ebor_gallery_type', 1 );
	if( '' == $layout || false == $layout || !(isset($layout)) ) {
		$layout = 'carousel';
	}
		
	get_template_part( 'single-portfolio/content', $layout );

	get_template_part( 'single-portfolio/content', 'nav' );
	
	get_footer();