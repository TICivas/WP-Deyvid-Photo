<div class="col-sm-12 col-md-6">
	<div class="quote">
	
		<div class="icon text-center"> 
		
			<?php the_post_thumbnail( 'full' ); ?>
			
			<div class="author">
				<?php the_title( '<h4 class="post-title">', '</h4><span class="meta">'. get_post_meta( $post->ID, '_ebor_the_job_title', 1 ) .'</span>' ); ?>
			</div>
			
		</div>
		
		<div class="box">
			<blockquote>
				<?php echo wpautop( get_the_content() ); ?>
			</blockquote>
		</div>
	
	</div>
</div>