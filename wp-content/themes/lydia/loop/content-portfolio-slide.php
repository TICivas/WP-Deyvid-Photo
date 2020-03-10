<li class="item">

	<figure class="icon-overlay">
		<a href="#0" data-type="slide-portfolio-item-<?php the_ID(); ?>">
			<?php the_post_thumbnail( 'grid' ); ?>
		</a>
	</figure>
	
	<?php the_title( '<div class="slide-portfolio-item-info box"><h4 class="post-title">', '</h4></div>' ); ?>
	
</li>