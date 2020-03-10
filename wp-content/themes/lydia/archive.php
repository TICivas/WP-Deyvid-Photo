<?php 
	get_header();
	
	$term = get_queried_object();
	
	get_template_part( 'inc/content-wrapper-dark', 'open' );
?>

	<div class="thin">
		<h3 class="section-title text-center"><?php echo esc_html__( 'Posts In: ', 'lydia' ) . $term->name; ?></h3>
		<p class="text-center"><?php echo esc_html( strip_tags( $term->description ) ); ?></p>
	</div>
	<div class="divide30"></div>
	      
<?php
	get_template_part( 'loop/loop-post', get_option( 'blog_layout', 'grid-sidebar' ) );
	
	get_template_part( 'inc/content-wrapper-dark', 'close' );
	
	get_footer();