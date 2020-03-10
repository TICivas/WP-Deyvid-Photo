<div class="post">
	<div class="box text-center">
		
		<?php 
			get_template_part( 'inc/content-post', 'category' );
			the_title( '<h2 class="post-title"><a href="'. get_permalink() .'">', '</a></h2>' ); 
			get_template_part( 'inc/content-post', 'meta' );
			get_template_part( 'inc/content-format', get_post_format() ); 
		?>
		
		<div class="post-content text-left">
			<?php the_excerpt(); ?>
		</div>
		<div class="post-footer"> 
			<a href="<?php the_permalink(); ?>" class="more pull-left"><?php esc_html_e( 'Continue reading', 'lydia' ); ?></a>
			<?php get_template_part( 'inc/content-post', 'social' ); ?>
		</div>

	</div>
</div>