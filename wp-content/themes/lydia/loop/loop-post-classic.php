<div class="blog row">
	<div class="col-sm-8 blog-content col-sm-offset-2">
	
		<div class="blog-posts classic-view">
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part( 'loop/content-post', 'magazine' );
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part( 'loop/content', 'none' );
					
				endif;
			?>
		</div>
		
		<?php
			/**
			* Post pagination, use ebor_pagination() first and fall back to default
			*/
			echo function_exists( 'ebor_pagination' ) ? ebor_pagination() : posts_nav_link();
		?>
	
	</div>
</div>