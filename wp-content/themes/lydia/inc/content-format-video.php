<?php 
	global $post;
	$videos = get_post_meta( $post->ID, '_ebor_the_oembed', true );
	
	if($videos){
		echo '<figure class="media-wrapper player main">' . wp_oembed_get( esc_url( $videos ) ) . '</figure>';
	}