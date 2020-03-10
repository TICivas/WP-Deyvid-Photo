<?php $additional = get_post_meta( $post->ID, '_ebor_meta_repeat_group', true ); ?>

<div class="meta">
	<?php
		if( get_post_meta( $post->ID, '_ebor_the_client_date', true ) ){
				echo '<span class="date">'.get_post_meta( $post->ID, '_ebor_the_client_date', true ).'</span>';
		}
		if( ebor_the_terms( 'portfolio_category', ', ', 'name' ) ){
			echo '<span>'.ebor_the_terms( 'portfolio_category', ', ', 'name' ).'</span>';
		}
		if( $additional ){
			foreach( $additional as $index => $item ){
				echo '<span>';
				if( isset ( $item['_ebor_the_additional_title'] ) )
					echo wp_specialchars_decode( $item['_ebor_the_additional_title'] );
				echo '</span>';
			}
		}
	?>
</div>