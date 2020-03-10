<?php  
	global $post;
	
	/**
	 * Next, we need to grab the featured image URL of this post, so that we can trim it to the correct size for the chosen size of this post.
	 */
	$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
	
	/**
	 * Leave this portfolio item out if we didn't find a featured image.
	 */
	if(!( $url[0] )) {
		return false;
	}
		
	$videos = get_post_meta( $post->ID, '_ebor_the_oembed', true );
	if($videos) {
		$url[0] = $videos;
	}
?>

<div class="cbp-item <?php echo ebor_the_terms( 'portfolio_category', ' ', 'slug' ); ?>"> 
	<a class="cbp-caption fancybox-media" data-rel="portfolio" href="<?php echo esc_url( $url[0] ); ?>">
	
		<div class="cbp-caption-defaultWrap"> 
			<?php the_post_thumbnail( 'grid' ); ?>
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