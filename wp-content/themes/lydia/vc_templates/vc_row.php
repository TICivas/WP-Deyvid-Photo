<?php

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $full_width = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();

//Lydia Stuff
$css_classes[] = $lydia_layout .' ';

if ( ! empty( $full_height ) ) {
	$css_classes[] = ' vc_row-o-full-height';
	if ( ! empty( $content_placement ) ) {
		$css_classes[] = ' vc_row-o-content-' . $content_placement;
	}
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$css_classes[] = ' vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="3"'; // parallax speed
	$css_classes[] = 'inverse-wrapper vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if( $lydia_mp4 && $lydia_webm ){

	$parallax_bg_img = wp_get_attachment_url($parallax_image);
	if(!isset($parallax_bg_img)) {
		$parallax_bg_img = '';
	}

	$output = '		
		<div id="' . esc_attr( $el_id ) . '" class="outer-wrap inverse-wrapper">
			<div id="video-wrap" class="video-wrap">
				<video preload="metadata" autoplay loop id="video-office" style="background-image: url('.$parallax_bg_img.');">
					<source src="'. esc_url($lydia_mp4) .'" type="video/mp4">
					<source src="'. esc_url($lydia_webm) .'" type="video/webm">
				</video>
				<div class="content-overlay container">
					'. wpb_js_remove_wpautop( $content ) .'
				</div>
			</div>
		</div>
	';

}  elseif( 'half' == $lydia_layout ){
	
	//Capture background image if set
	preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $css, $image);
	if(!( isset($image[0][0]) ))
		$image[0][0] = false;

	$output = '	
		<div id="' . esc_attr( $el_id ) . '" class="light-wrapper">
			<div class="col-image">
			
				<div class="bg-wrapper col-md-6">
					<div class="bg-holder" style="background-image: url('. esc_url($image[0][0]) .');"></div>
				</div>
		
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-md-offset-7 inner-col">
							'. wpb_js_remove_wpautop( $content ) .'
						</div>
					</div>
				</div>
		
			</div>
		</div>
	';
	
} else {
	
	// build attributes for wrapper
	if ( ! empty( $el_id ) ) {
		$output .= '<section id="' . esc_attr( $el_id ) . '">';
	}

	//Lydia stuff
	if(!( 'stretch_row' == $full_width )){
		$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '><div class="container">';
	} else {
		$output .= '<div data-full-width="yes" ' . implode( ' ', $wrapper_attributes ) . '>';
	}
	
	$output .= '<div class="row">';
	$output .= wpb_js_remove_wpautop( $content );
	$output .= '</div>';
	
	//Lydia stuff
	if(!( 'stretch_row' == $full_width )){
		$output .= '</div></div>';
	}  else {
		$output .= '</div>';	
	}
	
	$output .= $after_output;
	
	//Lydia Stuff
	if( 'yes-bottom-border' == $lydia_bottom_border ){
		$output .= '<div class="container"><div class="border-row"><hr /></div></div>';	
	}
	
	// build attributes for wrapper
	if ( ! empty( $el_id ) ) {
		$output .= '</section>';
	}

}

echo ( false == $output ) ? false : $output;
