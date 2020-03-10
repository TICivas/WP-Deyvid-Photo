<?php 
	get_header();
	
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	
	get_template_part( 'inc/content-wrapper-dark', 'open' );
?>

	<div class="thin">
		<h3 class="section-title text-center"><?php echo esc_html__( 'Posts By: ', 'lydia' ) . $author->display_name; ?></h3>
	</div>
	<div class="divide30"></div>
	      
<?php
	get_template_part( 'loop/loop-post', get_option( 'blog_layout', 'grid-sidebar' ) );
	
	get_template_part( 'inc/content-wrapper-dark', 'close' );
	
	get_footer();