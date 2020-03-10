<?php 
	global $post;
	$icons = get_post_meta( $post->ID, '_ebor_team_social_icons', true );
	$protocols = array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype' );
?>

<div class="col-sm-3 text-center">

	<figure>
		<?php the_post_thumbnail( 'square' ); ?>
	</figure>
	
	<?php
		the_title( '<h4 class="post-title"><a href="'. get_permalink() .'">', '</a></h4><div class="meta">'. get_post_meta( $post->ID, '_ebor_the_job_title', 1 ) .'</div> ');
		the_excerpt();
	?>
	
	<?php if( is_array($icons) ) : ?>
		<ul class="social naked bigger text-center">
			<?php 
				foreach( $icons as $key => $icon ){
					if(!( isset( $icon['_ebor_social_icon_url'] ) )) {
						continue;
					}
						
					echo '<li><a href="'. esc_url( $icon['_ebor_social_icon_url'], $protocols ) .'" target="_blank"><i class="icon-s-'. esc_attr( $icon['_ebor_social_icon'] ) .'"></i></a></li>';
				}
			?>
		</ul>
	<?php endif; ?>

</div>