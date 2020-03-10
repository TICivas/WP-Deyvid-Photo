<?php 
	get_header();
	the_post();
	
	$sidebar = ( is_active_sidebar( 'primary' ) && get_post_meta( $post->ID, '_ebor_disable_sidebar', true ) !=='on' ) ? true : false;
	$class = ( $sidebar ) ? 'col-sm-8' : 'col-sm-8 col-sm-offset-2';
	
	get_template_part( 'inc/content-wrapper-dark', 'open' );
?>

<div class="blog row">

	<div class="<?php echo esc_attr( $class ); ?> blog-content">
	
		<div class="blog-posts classic-view">
		
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<div class="box text-center">

					<?php 
						get_template_part( 'inc/content-post', 'category' );
						the_title( '<h1 class="post-title">', '</h1>' ); 
						get_template_part( 'inc/content-post', 'meta' );
						get_template_part( 'inc/content-format', get_post_format() ); 
					?>
					
					<div class="post-content text-left article-single">
						<?php
							the_content();
							wp_link_pages();
						?>
					</div>
	
					<div class="post-footer">
						<?php 
							the_tags( '<div class="meta tags pull-left">', ', ', '</div>' );
							get_template_part( 'inc/content-post', 'social' );
						?>
					</div>
				
				</div>
			
			</div>
			
			<?php 
				get_template_part( 'inc/content-post', 'author' ); 
				
				if (get_option( 'disable_comments', 'no' ) == 'no') {	
					if( comments_open() ) {
						comments_template();
					}
				}

			?>
		
		</div>
	
	</div>
	
	<?php 
		if( $sidebar ) {
			get_sidebar(); 
		}
	?>

</div>

<?php 
	get_template_part( 'inc/content-wrapper-dark', 'close' );
	
	get_footer();