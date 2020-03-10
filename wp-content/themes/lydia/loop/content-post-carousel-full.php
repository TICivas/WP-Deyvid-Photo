<div class="item caption-overlay">

	<?php the_post_thumbnail( 'carousel' ); ?>
	
	<div class="caption bottom-left">
		<div class="layer box">
			<?php
				get_template_part( 'inc/content-post', 'category' );
				the_title( '<h4 class="post-title"><a href="'. get_permalink() .'">', '</a></h4>' );
				get_template_part( 'inc/content-post', 'meta' );
			?>
		</div>
	</div>

</div>