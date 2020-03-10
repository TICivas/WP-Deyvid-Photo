<?php 
	global $post;
	$header_images = get_post_meta( $post->ID, '_ebor_gallery_images', 1 ); 
	
	if( is_array( $header_images ) ) :
	
	$i = 0;
?>

<div class="gallery-wrapper main">
	<div class="cbp-panel">
		<div id="js-grid-mosaic" class="cbp">
			
			<?php foreach( $header_images as $id => $content ) : ?>
			
				<?php  
					$i++;
					
					$url = wp_get_attachment_image_src( $id, 'full');
					
					if( $i == 1 ){
						$image = aq_resize($url[0], '560','380',1);
					} elseif( $i == 2 ) {
						$image = aq_resize($url[0], '280','380',1);
					} else {
						$image = aq_resize($url[0], '280','190',1);
					}
					
					if( $i == 8 )
						$i = 0;
					
					if(!( $image ))
						$image = $url[0];
				?>

				<div class="cbp-item print"> 
					<a class="cbp-caption fancybox-media" data-rel="post-<?php the_ID(); ?>" href="<?php echo esc_url( $url[0] ); ?>">
					
						<div class="cbp-caption-defaultWrap"> 
							<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title(); ?>" /> 
						</div>
						
						<div class="cbp-caption-activeWrap">
							<div class="cbp-l-caption-alignCenter">
								<div class="cbp-l-caption-body">
									<div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
								</div>
							</div>
						</div>
					
					</a> 
				</div>
			
			<?php endforeach; ?>
		
		</div>
	</div>
</div>

<?php endif;