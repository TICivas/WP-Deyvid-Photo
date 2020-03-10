<?php
	$displays = get_option( 'ebor_cpt_display_options' );
	$slug = ( $displays['portfolio_slug'] ) ? $displays['portfolio_slug'] : 'portfolio';
?>	

<div class="dark-wrapper">
	<div class="container inner2 navigation"> 
		<a href="<?php echo esc_url( home_url( $slug ) ); ?>" class="btn pull-left"><?php esc_html_e( 'Back to Portfolio', 'lydia' ); ?></a> 
		<?php
			next_post_link( '%link', esc_html__( 'Next Post', 'lydia' ) );
			previous_post_link( '%link', esc_html__( 'Prev Post', 'lydia' ) );
		?>
	</div>
</div>