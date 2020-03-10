<?php 
	get_header();
	
	global $wp_query;
	$total_results = $wp_query->found_posts;
	$items = ( $total_results == '1' ) ? esc_html__( ' Item', 'lydia' ) : esc_html__( ' Items', 'lydia' ); 
	
	get_template_part( 'inc/content-wrapper-dark', 'open' );
?>

	<div class="thin">
		<h3 class="section-title text-center"><?php echo get_search_query(); ?></h3>
		<p class="text-center"><?php echo esc_html__( 'Found ' , 'lydia' ) . $total_results . $items; ?></p>
	</div>
	<div class="divide30"></div>
	      
<?php
	get_template_part( 'loop/loop-post', get_option( 'blog_layout', 'grid-sidebar' ) );
	
	get_template_part( 'inc/content-wrapper-dark', 'close' );
	
	get_footer();