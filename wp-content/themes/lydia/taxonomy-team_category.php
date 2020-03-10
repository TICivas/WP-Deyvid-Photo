<?php 
	get_header();
	
	get_template_part( 'inc/content-wrapper-dark', 'open' );
	
	get_template_part( 'loop/loop-team', get_option( 'team_layout','grid' ) );
	
	get_template_part( 'inc/content-wrapper-dark', 'close' );
	
	get_footer();