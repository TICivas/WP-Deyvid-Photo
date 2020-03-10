<div class="ebor-single-post">

	<?php 
		global $post;
		$header_images = get_post_meta( $post->ID, '_ebor_gallery_images', 1 ); 
		
		if( is_array( $header_images ) ) :
	?>
	
	<div class="container inner bp0">
		<div class="basic-slider">
			<?php 
				foreach( $header_images as $id => $content ){
					echo '<div class="item">'. wp_get_attachment_image( $id, 'full' ) .'</div>';
				}
			?>
		</div>
	</div>
	
	<?php endif; ?>
	
	<div class="light-wrapper">
		<?php get_template_part( 'single-portfolio/content' ); ?>	
	</div>

</div>