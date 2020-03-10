<?php if( is_single() ) : ?>

	<figure class="main">
		<?php the_post_thumbnail( 'large' ); ?>
	</figure>
	
<?php else : ?>
	
	<figure class="main">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>
	</figure>
	
<?php endif;