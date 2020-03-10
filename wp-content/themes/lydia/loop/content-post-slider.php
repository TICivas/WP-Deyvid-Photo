<?php
	$layout = esc_html( get_post_meta( $post->ID, '_ebor_slider_layout', 1 ) );
	if( '' == $layout || false == $layout || !(isset($layout)) ) {
		$layout = 'bottom-left';
	}
?>

<div class="item caption-overlay">

	<?php the_post_thumbnail( 'full' ); ?>
	
	<div class="caption <?php echo esc_attr( $layout ); ?>">
		<div class="layer box">
			<?php 
				get_template_part( 'inc/content-post', 'category' );
				the_title( '<h4 class="post-title"><a href="'. get_permalink() .'">', '</a></h4>' );
				get_template_part( 'inc/content-post', 'meta' );
			?>
		</div>
	</div>
	
</div>