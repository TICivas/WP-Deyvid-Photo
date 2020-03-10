<?php 
	get_header();
	
	get_template_part( 'inc/content-wrapper-dark', 'open' );
	
	get_template_part( 'loop/loop-post', get_option( 'blog_layout', 'grid-sidebar' ) );
	
	get_template_part( 'inc/content-wrapper-dark', 'close' );
	
	get_footer();