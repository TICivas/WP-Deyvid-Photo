<?php
	get_header();
	
	get_template_part( 'inc/content-wrapper-light', 'open' );
?>
	
	<div class="text-center">
		<h1><?php esc_html_e( '404', 'lydia' ); ?></h1>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-lg"><?php esc_html_e( '&larr; Head Home', 'lydia' ); ?></a>
	</div>
	
<?php	
	get_template_part( 'inc/content-wrapper-light', 'close' );
	
	get_footer();