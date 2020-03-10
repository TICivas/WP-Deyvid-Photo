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
		
	$size = esc_html( get_post_meta( $post->ID, '_ebor_masonry_layout', 1 ) );
	if( '' == $size || false == $size || !(isset($size)) ) {
		$size = 'normal';
	}
	
	if( 'normal' == $size ){
		$image = aq_resize($url[0], '280','190',1);
	} elseif( 'width2' == $size ) {
		$image = aq_resize($url[0], '560','190',1);
	} elseif( 'height2' == $size ) {
		$image = aq_resize($url[0], '280','380',1);
	} elseif( 'width2 height2' == $size ) {
		$image = aq_resize($url[0], '560','380',1);
	}
	
	if(!( $image )) {
		$image = $url[0];
	}
?>

<div class="cbp-item <?php echo ebor_the_terms( 'portfolio_category', ' ', 'slug' ); ?>"> 
	<a class="cbp-caption" href="<?php the_permalink(); ?>">
	
		<div class="cbp-caption-defaultWrap"> 
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title(); ?>" />
		</div>
		
		<div class="cbp-caption-activeWrap">
			<div class="cbp-l-caption-alignCenter">
				<div class="cbp-l-caption-body">
					<?php the_title( '<div class="cbp-l-caption-title">', '</div>' ); ?>
				</div>
			</div>
		</div>
		
	</a> 
</div>