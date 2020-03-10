<div class="ebor-single-post">

	<?php 
		global $post;
		$header_images = get_post_meta( $post->ID, '_ebor_gallery_images', 1 ); 
		
		if( is_array($header_images) ) :
	?>
	
	<div class="light-wrapper">
		<div class="text-center">
			<?php get_template_part( 'single-portfolio/content' ); ?>	
		</div>
	</div>
	
	<div class="container inner tp0">
		<ul class="basic-gallery text-center">
			<?php 
				foreach( $header_images as $id => $content ){
					echo '<li>'. wp_get_attachment_image( $id, 'full' ) .'</li>';
				}
			?>
		</ul>
	</div>
	
	<?php endif; ?>

</div>