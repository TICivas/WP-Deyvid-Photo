<div class="divide20"></div>

<div class="cbp-panel">

	<?php if( 'yes' == $wp_query->show_filters ) { ?>
	<div id="js-filters-mosaic" class="cbp-filter-container text-center">
		<div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> <?php esc_html_e( 'All', 'lydia' ); ?> </div>
		<?php
			$cats = get_categories( 'taxonomy=portfolio_category' );
			
			if(is_array($cats)){
				foreach($cats as $cat){
					echo '<div data-filter=".'. esc_attr( $cat->slug ) .'" class="cbp-filter-item"> '. $cat->name .' </div> ';
				}
			}
		?>
	</div>
	<?php } ?>
	
	<div id="js-grid-mosaic" class="cbp ebor-load-more">
		<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part( 'loop/content-portfolio', 'mosaic' );
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part( 'loop/content', 'none' );
				
			endif;
		?>
	</div>

</div>

<div class="divide30"></div>

<?php echo ebor_load_more(); ?>