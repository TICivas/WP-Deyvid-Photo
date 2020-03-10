<?php 
	get_header();
	the_post();
	
	get_template_part( 'inc/content-wrapper-dark', 'open' );
	
	$icons = get_post_meta( $post->ID, '_ebor_team_social_icons', true );
	$protocols = array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype' );
?>

<div class="blog row">
	
	<div class="col-sm-5">
		<?php the_post_thumbnail( 'full' ); ?>
	</div>
	
	<div class="col-sm-7 blog-content">
		<div class="blog-posts classic-view">
			<div class="post">
				<div class="box text-center">

					<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
					
					<div class="post-content text-left">
						
						<div class="article-single">
							<?php
								the_content();
								wp_link_pages();
							?>
						</div>
						
						<?php if( is_array($icons) ) : ?>
							<ul class="social">
								<?php 
									foreach( $icons as $key => $icon ){
										if(!( isset( $icon['_ebor_social_icon_url'] ) ))
											continue;
											
										echo '<li><a href="'. esc_url( $icon['_ebor_social_icon_url'], $protocols ) .'" target="_blank"><i class="icon-s-'. esc_attr( $icon['_ebor_social_icon'] ) .'"></i></a></li>';
									}
								?>
							</ul>
						<?php endif; ?>
						
					</div>
				
				</div>
			</div>
		</div>
	</div>

</div>

<?php 
	get_template_part( 'inc/content-wrapper-dark', 'close' );
	
	get_footer();