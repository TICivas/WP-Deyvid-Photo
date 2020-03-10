<?php
	get_header();
	the_post();
	
	get_template_part( 'inc/content-wrapper-light', 'open' );
	
	the_title( '<h1 class="post-title">', '</h1>' );
	
	echo '<div class="article-single">';
	
	the_content();
	wp_link_pages();
	
	echo '</div>';
	
	if (get_option( 'disable_comments', 'no' ) == 'no') {	
		if( comments_open() ){
			echo '<div class="divide40"></div>';
			comments_template();
		}
	}
	
	get_template_part( 'inc/content-wrapper-light', 'close' );
	
	get_footer();