<?php
	get_header();
	
	$layout = get_option( 'portfolio_layout', 'mosaic' );
	
	if(!( 'onepage' == $layout || 'full' == $layout )){
		get_template_part( 'inc/content-wrapper-dark', 'open' );	
	}
	
	get_template_part( 'loop/loop-portfolio', $layout );
	
	if(!( 'onepage' == $layout || 'full' == $layout )){
		get_template_part( 'inc/content-wrapper-dark', 'close' );	
	}
	
	get_footer();