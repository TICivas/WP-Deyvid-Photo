<?php 

remove_action( 'wp_head', 'ebor_framework_load_favicons' );

/**
 * Add classes to portfolio post nav
 */
if(!( function_exists( 'ebor_prev_post_link_attributes' ) )){ 
	function ebor_prev_post_link_attributes( $output ) {
	    $class = 'class="btn pull-right"';
	    return str_replace( '<a href=', '<a '.$class.' href=', $output );
	}
	add_filter( 'previous_post_link', 'ebor_prev_post_link_attributes' );
}

/**
 * Add classes to portfolio post nav
 */
if(!( function_exists( 'ebor_next_post_link_attributes' ) )){ 
	function ebor_next_post_link_attributes($output) {
	    $class = 'class="btn pull-right"';
	    return str_replace('<a href=', '<a '.$class.' href=', $output);
	}
	add_filter( 'next_post_link', 'ebor_next_post_link_attributes' );
}

/**
 * Scrolling link rewriting
 */
if(!( function_exists( 'ebor_one_page_nav_rewrite' ) )){ 
	function ebor_one_page_nav_rewrite($items, $args) {
		if( 'primary' == $args->theme_location && get_option( 'site_mode', 'multipage' ) == 'single-page'  ){
			global $post;
			
			if(!( isset($post) )){
				return $items;
			} elseif( preg_match( '/in-page-link/', do_shortcode( $post->post_content ) ) ){
				return $items;
			} else {
				return str_replace( 'href="#', 'href="' . esc_url( home_url( '/' ) . '#' ), $items );
			}
		} else {
			return $items;	
		}
	}
	add_filter( 'wp_nav_menu_items', 'ebor_one_page_nav_rewrite', 10,2 );
}

if(!( function_exists( 'ebor_egf_force_styles' ) )){ 
	function ebor_egf_force_styles( $force_styles ) {
	    return true;
	}
	add_filter( 'tt_font_force_styles', 'ebor_egf_force_styles' );
}

/**
 * Add a clearfix to the end of the_content()
 */
if(!( function_exists( 'ebor_add_clearfix' ) )){ 
	function ebor_add_clearfix( $content ) { 
		if( is_single() )
	   		$content = $content .= '<div class="clearfix"></div>';
	    return $content;
	}
	add_filter( 'the_content', 'ebor_add_clearfix' ); 
}

if(!( function_exists( 'ebor_excerpt_more' ) )){
	function ebor_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'ebor_excerpt_more' );
}

if(!( function_exists( 'ebor_excerpt_length' ) )){
	function ebor_excerpt_length( $length ) {
		return 15;
	}
	add_filter( 'excerpt_length', 'ebor_excerpt_length', 999 );
}

/**
 * Remove leading whitespace from the_excerpt
 */
if(!( function_exists( 'ebor_ltrim_excerpt' ) )){
	function ebor_ltrim_excerpt( $excerpt ) {
	    return preg_replace( '~^(\s*(?:&nbsp;)?)*~i', '', $excerpt );
	}
	add_filter( 'get_the_excerpt', 'ebor_ltrim_excerpt' );
}

/**
 * Add additional settings to gallery shortcode
 */
if(!( function_exists( 'ebor_add_gallery_settings' ) )){ 
	function ebor_add_gallery_settings(){
	?>
	
		<script type="text/html" id="tmpl-lydia-gallery-setting">
			<h3>lydia Theme Gallery Settings</h3>
			<label class="setting">
				<span><?php esc_html_e('Gallery Layout', 'lydia'); ?></span>
				<select data-setting="layout">
					<option value="default">Default Layout</option>
					<option value="slider">Lydia Slider</option>        
					<option value="lightbox">Lydia Lightbox Gallery</option>
				</select>
			</label>
		</script>
	
		<script>
			jQuery(document).ready(function(){
				jQuery.extend(wp.media.gallery.defaults, { layout: 'default' });
				
				wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
					template: function(view){
					  return wp.media.template('gallery-settings')(view)
					       + wp.media.template('lydia-gallery-setting')(view);
					}
				});
			});
		</script>
	  
	<?php
	}
	add_action( 'print_media_templates', 'ebor_add_gallery_settings' );
}


/**
 * Custom gallery shortcode
 *
 * Filters the standard WordPress gallery shortcode.
 *
 * @since 1.0.0
 */
if(!( function_exists( 'ebor_post_gallery' ) )){
	function ebor_post_gallery( $output, $attr ) {
		
		global $post, $wp_locale;
	
	    static $instance = 0;
	    $instance++;
	
	    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	    if ( isset( $attr['orderby'] ) ) {
	        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	        if ( !$attr['orderby'] )
	            unset( $attr['orderby'] );
	    }
	
	    extract(shortcode_atts(array(
	        'order'      => 'ASC',
	        'orderby'    => 'menu_order ID',
	        'id'         => $post->ID,
	        'itemtag'    => 'div',
	        'icontag'    => 'dt',
	        'captiontag' => 'dd',
	        'columns'    => 3,
	        'size'       => 'large',
	        'include'    => '',
	        'exclude'    => '',
	        'layout'     => ''
	    ), $attr));
	
	    $id = intval($id);
	    if ( 'RAND' == $order ) {
	        $orderby = 'none';
	    }
	
	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    }
	
	    if ( empty($attachments) ) {
	        return '';
	    }
	
	    if ( is_feed() ) {
	        $output = "\n";
	        foreach ( $attachments as $att_id => $attachment )
	            $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
	        return $output;
	    }
	    
	    /**
	     * Return Lightbox Layout
	     */
	    if( $layout == 'lightbox' ){
		    if( $columns == 1 ){
		    	$columns = 12;
		    } elseif( $columns == 2 ){
		    	$columns = 6;
		    } elseif( $columns == 3 ){
		    	$columns = 4;
		    } elseif( $columns == 4 ){
		    	$columns = 3;
		    } elseif( $columns == 5 || $columns == 6 ){
		    	$columns = 2;
		    } else {
		    	$columns = 1;
		    }
		
		    $unique = wp_rand( 0, 10000 );
		    $title = get_the_title();
		    
		    $output = "<div class='row ebor-blog-gallery' id='gallery" . $unique ."'>";
		
		    foreach ( $attachments as $id => $attachment ) {
		        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url( $id, 'full', false, false ) : wp_get_attachment_url( $id, 'full', true, false );
		        $crop = aq_resize($link, '440', '295', 1);
		        
		        if(!( $crop )) {
		        	$crop = $link;
		        }
		
		        $output .= "<{$itemtag} class='item col-sm-$columns'>";
		        
		        $output .= '<figure class="icon-overlay lightbox">
		        				<a href="'. $link .'" class="fancybox-media" data-rel="portfolio" title="'.$attachment->post_excerpt.'">
		        					<span class="icn-more"></span>
		        					<img src="'. esc_url( $crop ) .'" alt="'. $title .'" />
		        				</a>
		        			</figure>';
		        
		        $output .= "</{$itemtag}>";
		    }
		    
		    $output .= '
		    <script type="text/javascript">
		    	jQuery(window).load(function () {
		        var $container = jQuery("#gallery'. $unique .'");
		            $container.isotope({
		                itemSelector: ".item"
		            });
		    
		        jQuery(window).on("resize", function () {
		            jQuery("#gallery'. $unique .'").isotope("layout")
		        });
		    });
		    </script>';
		
		    $output .= "</div>\n";
		    return $output;
	    }
	    
	    /**
	     * Return Slider Layout
	     */
	    if( $layout == 'slider' ){
	    	$output = '<div class="blog-slider-wrapper"><div class="basic-slider">';
	    		foreach ( $attachments as $id => $attachment ) {
	    		    $output .= '<div class="item">'. wp_get_attachment_image( $id, 'large' ) .'</div>';
	    		} 
	    	$output .= '</div></div>';
	    	return $output;
	    }
	    
	}
	add_filter( 'post_gallery', 'ebor_post_gallery', 10, 2 );
}

/**
 * OCDI filters
 */
if( class_exists( 'OCDI_Plugin' ) ){
    
    function ebor_ocdi_plugin_intro_text( $default_text ) {
        $default_text .= '
            <div class="ocdi__intro-text">
                <h3>Read this before importing demo data!</h3>
                <p>We have prepared full written & video documentation to make your life with Lydia much more easy. It is worth spending a few minutes with this to familiarise yourself with the theme & its plugins before jumping in with your demo data, so <a href="https://tommusrhodus.ticksy.com/articles/" target="_blank">please read the theme documentation</a> before importing the demo data.</p>
                <hr />
            </div>
        ';
    
        return $default_text;
    }
    add_filter( 'pt-ocdi/plugin_intro_text', 'ebor_ocdi_plugin_intro_text' );
    
    function ebor_ocdi_confirmation_dialog_options ( $options ) {
        return array_merge( $options, array(
            'width'       => 600,
            'dialogClass' => 'wp-dialog',
            'resizable'   => false,
            'height'      => 'auto',
            'modal'       => true,
        ) );
    }
    add_filter( 'pt-ocdi/confirmation_dialog_options', 'ebor_ocdi_confirmation_dialog_options', 10, 1 );
    
    //Setup basic demo import
    function ebor_import_files() {
        
        $import_notice_vc = '
            <h3>Ready to Import Lydia Demo Data?</h3>
            <p>Please ensure all required plugins in "appearance => install plugins" are installed before running this demo importer.</p>
        ';
                
        return array(
            array(
                'import_file_name'             => 'Lydia Demo Data',
                'import_file_url'              => get_theme_file_uri( '/admin/demo-data/demo-data.xml' ),
                'import_widget_file_url'       => get_theme_file_uri( '/admin/demo-data/widgets.wie' ),
                'import_customizer_file_url'   => get_theme_file_uri( '/admin/demo-data/customizer.dat' ),
                'import_preview_image_url'     => get_theme_file_uri( '/screenshot.png' ),
                'import_notice'                => $import_notice_vc,
            ),
        );
        
    }
    add_filter( 'pt-ocdi/import_files', 'ebor_import_files' );
    
    //Setup front page and menus
    function ebor_after_import_setup() {
        
        // Assign menus to their locations.
        $main_menu = get_term_by( 'name', 'Standard Menu', 'nav_menu' );
    
        set_theme_mod( 'nav_menu_locations', array(
                'primary'  => $main_menu->term_id,
            )
        );
    
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Dark Header' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
    
    }
    add_action( 'pt-ocdi/after_import', 'ebor_after_import_setup' );
    
    //Remove Branding
    add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
    
    //Save customize options
    add_action( 'pt-ocdi/enable_wp_customize_save_hooks', '__return_true' );
    
    //Stop thumbnail generation
    add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
    
}