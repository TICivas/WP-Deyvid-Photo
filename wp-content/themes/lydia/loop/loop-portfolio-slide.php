<div class="divide30"></div>

<div id="slide-portfolio" class="image-grid col3">
	<div class="items-wrapper">
		<ul class="isotope items">
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part( 'loop/content-portfolio', 'slide' );
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part( 'loop/content', 'none' );
					
				endif;
			?>
		</ul>
	</div>
</div>

<?php 
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		
		/**
		 * Get blog posts by blog layout.
		 */
		get_template_part( 'loop/content-portfolio', 'slide-content' );
	
	endwhile;	
	else : 
		
		/**
		 * Display no posts message if none are found.
		 */
		get_template_part( 'loop/content', 'none' );
		
	endif;
?>