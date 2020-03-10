<div class="cbp-item <?php echo ebor_the_terms( 'portfolio_category', ' ', 'slug' ); ?>"> 
	<a href="<?php the_permalink(); ?>" class="cbp-caption cbp-singlePageInline">
	
		<div class="cbp-caption-defaultWrap"> 
			<?php the_post_thumbnail( 'grid' ); ?>
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