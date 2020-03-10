<div class="ebor-single-post">

	<?php 
		global $post;
		$videos = get_post_meta( $post->ID, '_ebor_the_oembed', true );
		
		if($videos){
			echo '<div class="container inner bp0"><figure class="player">' . wp_oembed_get( esc_url( $videos ) ) . '</figure></div>';
		}
	?>
	
	<div class="light-wrapper">
		<?php get_template_part( 'single-portfolio/content' ); ?>	
	</div>

</div>