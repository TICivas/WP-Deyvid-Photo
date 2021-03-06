<?php 

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( function_exists( 'vc_set_as_theme' ) ){
	function ebor_vcSetAsTheme() {
		vc_set_as_theme(true);
	}
	add_action( 'vc_before_init', 'ebor_vcSetAsTheme' );
}

if(!( function_exists( 'ebor_custom_css_classes_for_vc_row_and_vc_column' ) )){
	function ebor_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string );
		}
		return $class_string; // Important: you should always return modified or original $class_string
	}
	add_filter( 'vc_shortcodes_css_class', 'ebor_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
}

/**
 * Add additional functions to certain blocks.
 * vc_map runs before custom post types and taxonomies are created, so this function is used
 * to add custom taxonomy selectors to VC blocks, a little annoying, but works perfectly.
 */
if(!( function_exists( 'ebor_vc_add_att' ) )){
	function ebor_vc_add_attr(){
		
		$attributes = array(
			'type' 			=> 'dropdown',
			'heading' 		=> "Section Layout",
			'param_name' 	=> 'lydia_layout',
			'value' => array_flip(array(
				'light-wrapper' => 'Light Background',
				'dark-wrapper' 	=> 'Dark Background',
				'half' 			=> 'Half Image, Half Text'
			)),
			'description' 	=> "Choose a Background For This Row"
		);
		vc_add_param( 'vc_row', $attributes );
		
		$attributes = array(
			'type' 			=> 'dropdown',
			'heading' 		=> "Add dividing border to bottom of row?",
			'param_name' 	=> 'lydia_bottom_border',
			'value' => array_flip(array(
				'no-bottom-border' 	=> 'No',
				'yes-bottom-border' => 'Yes'
			))
		);
		vc_add_param( 'vc_row', $attributes );
		
		$attributes = array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Self Hosted Video Background?, .webm extension", 'lydia' ),
			"param_name" 	=> "lydia_webm",
			"value" 		=> '',
			"description" 	=> esc_html__( 'Please fill all extensions', 'lydia' )
		);
		vc_add_param( 'vc_row', $attributes );
		
		$attributes = array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Self Hosted Video Background?, .mp4 extension", 'lydia' ),
			"param_name" 	=> "lydia_mp4",
			"value" 		=> '',
			"description" 	=> esc_html__( 'Please fill all extensions', 'lydia' )
		);
		vc_add_param( 'vc_row', $attributes );
		
		vc_remove_param( 'vc_row', 'video_bg' );
		vc_remove_param( 'vc_row', 'video_bg_url' );
		vc_remove_param( 'vc_row', 'video_bg_parallax' );
		
		/**
		 * Add team category selectors
		 */
		$team_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'team_category'
		);
		$team_cats = get_categories( $team_args );
		$final_team_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists( 'team_category' ) ){
			if( is_array($team_cats) ){
				foreach( $team_cats as $cat ){
					$final_team_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' 			=> 'dropdown',
			'heading' 		=> "Show Specific Team Category?",
			'param_name' 	=> 'filter',
			'value' 		=> $final_team_cats
		);
		vc_add_param( 'lydia_team', $attributes );
		
		/**
		 * Add portfolio category selectors
		 */
		$portfolio_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'portfolio_category'
		);
		$portfolio_cats = get_categories( $portfolio_args );
		$final_portfolio_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists( 'portfolio_category' ) ){
			if( is_array($portfolio_cats) ){
				foreach( $portfolio_cats as $cat ){
					$final_portfolio_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' 			=> 'dropdown',
			'heading' 		=> "Show Specific Portfolio Category?",
			'param_name' 	=> 'filter',
			'value' 		=> $final_portfolio_cats
		);
		vc_add_param( 'lydia_portfolio', $attributes );
		
		/**
		 * Add blog category selectors
		 */
		$blog_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'category'
		);
		$blog_cats = get_categories( $blog_args );
		$final_blog_cats = array( 'Show all categories' => 'all' );
		
		if( is_array($blog_cats) ){
			foreach( $blog_cats as $cat ){
				$final_blog_cats[$cat->name] = $cat->term_id;
			}
		}
		
		$attributes = array(
			'type' 			=> 'dropdown',
			'heading' 		=> "Show Specific blog Category?",
			'param_name' 	=> 'filter',
			'value' 		=> $final_blog_cats
		);
		vc_add_param( 'lydia_blog', $attributes );
		
		/**
		 * Add client category selectors
		 */
		$client_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'client_category'
		);
		$client_cats = get_categories( $client_args );
		$final_client_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists( 'client_category' ) ){
			if( is_array($client_cats) ){
				foreach( $client_cats as $cat ){
					$final_client_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' 			=> 'dropdown',
			'heading' 		=> "Show Specific client Category?",
			'param_name' 	=> 'filter',
			'value' 		=> $final_client_cats
		);
		vc_add_param( 'lydia_client', $attributes );
		
		/**
		 * Add testimonial category selectors
		 */
		$testimonial_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'testimonial_category'
		);
		$testimonial_cats = get_categories( $testimonial_args );
		$final_testimonial_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists( 'testimonial_category' ) ){
			if( is_array($testimonial_cats) ){
				foreach( $testimonial_cats as $cat ){
					$final_testimonial_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' 			=> 'dropdown',
			'heading' 		=> "Show Specific testimonial Category?",
			'param_name' 	=> 'filter',
			'value' 	=> $final_testimonial_cats
		);
		vc_add_param( 'lydia_testimonial', $attributes );
		
	}
	add_action( 'init', 'ebor_vc_add_attr', 999 );
}

/**
 * Redirect page template if vc_row shortcode is found in the page.
 * This lets us use a dedicated page template for Visual Composer pages
 * without the need for on page checks, or custom page templates.
 * 
 * It's buyer-proof basically.
 */
if(!( function_exists( 'ebor_vc_page_template' ) )){
	function ebor_vc_page_template( $template ){
		global $post;
		
		if( is_archive() || is_404() || is_home() ) {
			return $template;
		}
		
		if(!( isset($post->post_content) ) || is_search()) {
			return $template;
		}
			
		if( has_shortcode($post->post_content, 'vc_row') ){
			
			$new_template = locate_template( array( 'page_visual_composer.php' ) );
				
			if (!( '' == $new_template )){
				return $new_template;
			}
			
		}
		return $template;
	}
	add_filter( 'template_include', 'ebor_vc_page_template', 99 );
}
