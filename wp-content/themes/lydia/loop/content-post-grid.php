<div class="col-sm-6 col-md-4 grid-view-post">
	<div class="post">
		
		<?php if( has_post_thumbnail() ) : ?>
			<figure class="main">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'grid' ); ?>
				</a>
			</figure>
		<?php endif; ?>
		
		<div class="box text-center">
			<?php
				get_template_part( 'inc/content-post', 'category' );
				the_title( '<h4 class="post-title"><a href="'. get_permalink() .'">', '</a></h4>' );
				get_template_part( 'inc/content-post', 'meta' );
				the_excerpt();
			?>
		</div>
		
	</div>
</div>