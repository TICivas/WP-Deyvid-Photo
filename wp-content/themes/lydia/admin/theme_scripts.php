<?php 

/**
 * Here is all the custom colours for the theme.
 * $handle is a reference to the handle used with wp_enqueue_style()
 */	
if (class_exists( 'WPLessPlugin' )){
    $less = WPLessPlugin::getInstance();
    $less->setVariables(
        array(
			'text'             => get_option( 'colour_text', '#5b5b5b' ),
			'highlight'        => get_option( 'colour_highlight', '#70aed2' ),
			'highlight_hover'  => get_option( 'colour_highlight_hover', '#62a3c8' ),
			'headings'         => get_option( 'colour_headings', '#3b3b3b' ),
			'meta'             => get_option( 'colour_meta', '#999999' )
        )
    );
    
}

/*
Register Fonts
*/
if(!( function_exists( 'ebor_fonts_url' ) )){
	function ebor_fonts_url(){
	    $font_url = '';
	    
	    /*
	    	Translators: If there are characters in your language that are not supported
	   		by chosen font(s), translate this to 'off'. Do not translate into your own language.
	     */
	    if ( 'off' !== _x( 'on', 'Google font: on or off', 'lydia' ) ) {
	        $font_url = add_query_arg( 'family', urlencode( 'Montserrat:400,700|Karla:400,400italic,700,700italic' ), "//fonts.googleapis.com/css" );
	    }
	    return $font_url;
	}
}

/**
 * Ebor Load Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * @since version 1.0
 * @author TommusRhodus
 */ 
if(!( function_exists( 'ebor_load_scripts' ) )){
	function ebor_load_scripts() {
			
		//Enqueue Styles
		wp_enqueue_style( 'ebor-google-font', ebor_fonts_url(), array(), '1.0.0' );
		wp_enqueue_style( 'ebor-bootstrap', EBOR_THEME_DIRECTORY . 'style/css/bootstrap.min.css' );
		wp_enqueue_style( 'ebor-plugins', EBOR_THEME_DIRECTORY . 'style/css/plugins.css' );
		wp_enqueue_style( 'ebor-theme-styles', EBOR_THEME_DIRECTORY . 'style/css/theme.less' );
		wp_enqueue_style( 'ebor-style', get_stylesheet_uri() );
		wp_enqueue_style( 'ebor-fonts', EBOR_THEME_DIRECTORY . 'style/type/icons.css' );
		
		//Enqueue Scripts
		$sslPrefix = ( is_ssl() ) ? 'https://maps-api-ssl.google.com' : 'http://maps.googleapis.com';
		$key = ( get_option('ebor_gmap_api') ) ? '?key=' . get_option('ebor_gmap_api') : false;
		wp_enqueue_script('googlemapsapi', $sslPrefix . '/maps/api/js' . $key, array( 'jquery' ), false, true);
		
		wp_enqueue_script( 'ebor-bootstrap', EBOR_THEME_DIRECTORY . 'style/js/bootstrap.min.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-classie', EBOR_THEME_DIRECTORY . 'style/js/classie.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-bg-video-parallax', EBOR_THEME_DIRECTORY . 'style/js/bg-video-parallax.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-bootstrap-dropdown', EBOR_THEME_DIRECTORY . 'style/js/bootstrap-dropdown.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-cube-portfolio', EBOR_THEME_DIRECTORY . 'style/js/cube-portfolio.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-easytabs', EBOR_THEME_DIRECTORY . 'style/js/easytabs.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-fancybox', EBOR_THEME_DIRECTORY . 'style/js/fancybox.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-fitvids', EBOR_THEME_DIRECTORY . 'style/js/fitvids.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-flickr', EBOR_THEME_DIRECTORY . 'style/js/flickr.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-isotope', EBOR_THEME_DIRECTORY . 'style/js/isotope.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-imagesloaded', EBOR_THEME_DIRECTORY . 'style/js/imagesloaded.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-instafeed', EBOR_THEME_DIRECTORY . 'style/js/instafeed.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-js-maps', EBOR_THEME_DIRECTORY . 'style/js/js-maps.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-localscroll', EBOR_THEME_DIRECTORY . 'style/js/localscroll.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-owl-carousel', EBOR_THEME_DIRECTORY . 'style/js/owl-carousel.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-picturefill', EBOR_THEME_DIRECTORY . 'style/js/picturefill.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-slide-portfolio', EBOR_THEME_DIRECTORY . 'style/js/slide-portfolio.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-stickyfilter', EBOR_THEME_DIRECTORY . 'style/js/stickyfilter.js', array('jquery'), false, true  );
		wp_enqueue_script( 'jquery-swiper', EBOR_THEME_DIRECTORY . 'style/js/swiper.js', array('jquery'), false, true  );
		wp_enqueue_script( 'ebor-scripts', EBOR_THEME_DIRECTORY . 'style/js/scripts.js', array('jquery'), false, true  );
		
		//Enqueue Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		$cats_css = false;
		
		$cats = get_categories( 'hide_empty=0' );
		foreach( $cats as $cat ){
			$colour = get_option( 'cat_'. $cat->term_id .'_colour', '#70aed2' );
			$cats_css .= '
				.cat'. $cat->term_id .' span a { background-color: rgba('. ebor_hex2rgb( $colour ) .', 0.9); }
				.cat'. $cat->term_id .'span a:hover { background-color: '. $colour .'; }
			';
		}
		
		wp_add_inline_style( 'ebor-style', $cats_css . get_option( 'custom_css' ) );
	}
	add_action('wp_enqueue_scripts', 'ebor_load_scripts', 110);
}

/**
 * Ebor Load Admin Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * 
 * @since version 1.0
 * @author TommusRhodus
 */
if(!( function_exists('ebor_admin_load_scripts') )){
	function ebor_admin_load_scripts(){
		wp_enqueue_style( 'ebor-theme-admin-css', EBOR_THEME_DIRECTORY . 'admin/ebor-theme-admin.css' );
		wp_enqueue_script( 'ebor-theme-admin-js', EBOR_THEME_DIRECTORY . 'admin/ebor-theme-admin.js', array('jquery'), false, true  );
		wp_enqueue_style( 'ebor-fonts', EBOR_THEME_DIRECTORY . 'style/type/icons.css' );
	}
	add_action( 'admin_enqueue_scripts', 'ebor_admin_load_scripts', 200 );
}