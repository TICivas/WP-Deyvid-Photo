<?php if( 'yes' == $wp_query->show_filters ) { ?>
<div id="sticky-filter" class="sticky-filter dark-wrapper container">
	<ul>
		<?php
			$cats = get_categories( 'taxonomy=portfolio_category' );
			
			if(is_array($cats)){
				foreach($cats as $cat){
					echo '<li><a href="#'. esc_attr( $cat->slug ) .'">'. $cat->name .'</a></li> ';
				}
			}
		?>
	</ul>
</div>
<?php } ?>

<?php
	$i = 0;
	if(is_array($cats)) :
		foreach($cats as $cat) :
			$i++;
			$class = (!( $i % 2 == 0 )) ? 'light-wrapper' : 'dark-wrapper';
			$filter = $cat->term_id;
			
			if( function_exists( 'icl_object_id' ) ){
				$filter = (int)icl_object_id( $filter, 'portfolio_category', true);
			}
			$args = array(
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' 	=> 'portfolio_category',
						'field' 	=> 'id',
						'terms' 	=> $filter
					)
				)
			);
			
			$cat_query = new WP_Query($args);
?>

			<section id="<?php echo esc_attr( $cat->slug ); ?>" class="<?php echo esc_attr( $class ); ?>">
				<div class="container inner">
				
					<h3 class="section-title text-center"><?php echo esc_html( $cat->name ); ?></h3>
					<p class="text-center"><?php echo esc_html( $cat->description ); ?></p>
					
					<div class="divide20"></div>
					
					<div class="cbp-panel">
						<div class="cbp cbp-onepage-grid">
							<?php 
								if ( $cat_query->have_posts() ) : while ( $cat_query->have_posts() ) : $cat_query->the_post();
									
									/**
									 * Get blog posts by blog layout.
									 */
									get_template_part( 'loop/content-portfolio', 'onepage' );
								
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
					
				</div>
			</section>
			
<?php 
		endforeach;
	endif;
	
	wp_reset_postdata();