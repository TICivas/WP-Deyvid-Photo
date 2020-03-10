<?php
	global $post;
	$cats = wp_get_post_categories( $post->ID );
	
	foreach( $cats as $c ){
		$cat = get_category( $c );
		echo '<div class="category cat'. $c .'"><span><a href="'. get_category_link( $c ) .'">'. $cat->name .'</a></span></div>';
	}