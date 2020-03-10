<?php 

/**
 * Build theme metaboxes
 * Uses the cmb metaboxes class found in the ebor framework plugin
 * More details here: https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists( 'ebor_custom_metaboxes' ) )){
	function ebor_custom_metaboxes( $meta_boxes ) {
		
		/**
		 * Setup variables
		 */
		$prefix = '_ebor_';
		$social_options = ebor_get_social_icons();
		$header_options = ebor_get_header_layouts();
		
		$header_overrides['none'] = 'Do Not Override Header Option On This Page';
		foreach( $header_options as $key => $value ){
			$header_overrides[$key] = 'Override Header: ' . $value; 	
		}
		
		/**
		 * Portfolio Settings Metabox
		 */
		$meta_boxes[] = array(
			'id' => 'portfolio_meta_metabox',
			'title' => esc_html__( 'Additional Portfolio Settings', 'lydia' ),
			'object_types' => array( 'portfolio' ),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name' => 'Masonry Gallery Layout',
					'description' => 'Using the "Masonry" portfolio type? Set how this items featured image should be sized.',
					'id' => $prefix . 'masonry_layout',
					'type' => 'select',
					'options' => array(
						array( 'name' => 'Normal Width, Normal Height (280x190px)', 'value' => 'normal' ),
						array( 'name' => 'Double Width, Normal Height (560x190px)', 'value' => 'width2' ),
						array( 'name' => 'Normal Width, Double Height (280x380px)', 'value' => 'height2' ),
						array( 'name' => 'Double Width, Double Height (560x380px)', 'value' => 'width2 height2' ),
					),
					'std' => 'normal'
				),
				array(
					'name' => esc_html__( 'Project Date', 'lydia' ),
					'desc' => esc_html__( "(Optional) Add the Date this Project Took Place?", 'lydia' ),
					'id'   => $prefix . 'the_client_date',
					'type' => 'text_date',
				),
				array(
				    'id'          => $prefix . 'meta_repeat_group',
				    'type'        => 'group',
				    'description' => esc_html__( 'Additional Meta Titles & Descriptions', 'lydia' ),
				    'options'     => array(
				        'add_button'    => esc_html__( 'Add Another Entry', 'lydia' ),
				        'remove_button' => esc_html__( 'Remove Entry', 'lydia' ),
				        'sortable'      => true, // beta
				    ),
				    'fields'      => array(
						array(
							'name' => esc_html__( 'Additional Item Title', 'lydia' ),
							'desc' => esc_html__( "Title of your Additional Meta", 'lydia' ),
							'id'   => $prefix . 'the_additional_title',
							'type' => 'text'
						)
				    ),
				),
			)
		);
		
		/**
		 * Testimonial Options
		 */
		$meta_boxes[] = array(
			'id' => 'testimonial_metabox',
			'title' => esc_html__( 'Testimonial Details', 'lydia' ),
			'object_types' => array( 'testimonial' ), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__( 'Job Title', 'lydia' ),
					'desc' => '(Optional) Enter a Job Title for this testimonial',
					'id'   => $prefix . 'the_job_title',
					'type' => 'text',
				),
			)
		);
		
		/**
		 * Portfolio Items Gallery Metabox
		 */
		$meta_boxes[] = array(
			'id' => 'portfolio_metabox',
			'title' => esc_html__( 'Photo Gallery Settings', 'lydia' ),
			'object_types' => array( 'portfolio' ),
			'context' => 'side',
			'priority' => 'low',
			'show_names' => true,
			'fields' => array(
				array(
					'name' => 'Post Gallery Type',
					'id' => $prefix . 'gallery_type',
					'type' => 'select',
					'options' => array(
						array( 'name' => 'Carousel', 'value' => 'carousel' ),
						array( 'name' => 'Slider', 'value' => 'slider' ),
						array( 'name' => 'Image Feed', 'value' => 'gallery' ),
						array( 'name' => 'Video', 'value' => 'video' )
					),
					'std' => 'carousel'
				),
				array(
					'name' => 'Upload Gallery Images',
					'desc' => 'Min Height 550px, Max 1400px, Drag & Drop to Reorder',
					'id' => $prefix . 'gallery_images',
					'type' => 'file_list',
				),
				array(
					'name' => 'oEmbed',
					'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
					'id'   => $prefix . 'the_oembed',
					'type' => 'oembed',
				),
			)
		);
		
		/**
		 * Social Icons for Team Members
		 */
		$meta_boxes[] = array(
			'id' => 'team_social_metabox',
			'title' => esc_html__( 'Team Member Details', 'lydia' ),
			'object_types' => array( 'team' ), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__( 'Job Title', 'lydia' ),
					'desc' => '(Optional) Enter a Job Title for this Team Member',
					'id'   => $prefix . 'the_job_title',
					'type' => 'text',
				),
				array(
				    'id'          => $prefix . 'team_social_icons',
				    'type'        => 'group',
				    'options'     => array(
				        'add_button'    => esc_html__( 'Add Another Icon', 'lydia' ),
				        'remove_button' => esc_html__( 'Remove Icon', 'lydia' ),
				        'sortable'      => true
				    ),
				    'fields' => array(
						array(
							'name' => 'Social Icon',
							'desc' => 'What icon would you like for this team members first social profile?',
							'id' => $prefix . 'social_icon',
							'type' => 'select',
							'options' => $social_options
						),
						array(
							'name' => esc_html__( 'URL for Social Icon', 'lydia' ),
							'desc' => esc_html__( "Enter the URL for Social Icon 1 e.g www.google.com", 'lydia' ),
							'id'   => $prefix . 'social_icon_url',
							'type' => 'text_url',
						),
				    ),
				),
			)
		);
		
		/**
		 * Client options
		 */
		$meta_boxes[] = array(
			'id' => 'clients_metabox',
			'title' => esc_html__( 'Client URL', 'lydia' ),
			'object_types' => array( 'client' ), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__( 'URL for this client (optional)', 'lydia' ),
					'desc' => esc_html__( "Enter a URL for this client, if left blank, client logo will open into a lightbox.", 'lydia' ),
					'id'   => $prefix . 'client_url',
					'type' => 'text',
				),
			),
		);
		
		/**
		 * Social Icons for Users
		 */
		$meta_boxes[] = array(
			'id' => 'social_metabox',
			'title' => esc_html__( 'Social Icons: Click To Add More', 'lydia' ),
			'object_types' => array( 'user' ), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
				    'id'          => $prefix . 'user_social_icons',
				    'type'        => 'group',
				    'options'     => array(
				        'add_button'    => esc_html__( 'Add Another Icon', 'lydia' ),
				        'remove_button' => esc_html__( 'Remove Icon', 'lydia' ),
				        'sortable'      => true
				    ),
				    'fields' => array(
						array(
							'name' => 'Social Icon',
							'desc' => 'What icon would you like for this team members first social profile?',
							'id' => $prefix . 'social_icon',
							'type' => 'select',
							'options' => $social_options
						),
						array(
							'name' => esc_html__( 'URL for Social Icon', 'lydia' ),
							'desc' => esc_html__( "Enter the URL for Social Icon 1 e.g www.google.com", 'lydia' ),
							'id'   => $prefix . 'social_icon_url',
							'type' => 'text',
						),
				    ),
				),
			)
		);
		
		$meta_boxes[] = array(
			'id' => 'post_layout_metabox',
			'title' => esc_html__( 'Post Layout Options', 'lydia' ),
			'object_types' => array( 'post' ), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Post Slider Caption Location',
					'id' => $prefix . 'slider_layout',
					'type' => 'select',
					'options' => array(
						array( 'name' => 'Bottom Left', 'value' => 'bottom-left' ),
						array( 'name' => 'Bottom Center', 'value' => 'center' ),
						array( 'name' => 'Bottom Right', 'value' => 'bottom-right' ),
					),
					'std' => 'bottom-left'
				),
				array(
					'name' => esc_html__( 'Disable Post Sidebar', 'lydia' ),
					'desc' => esc_html__( "Check to disable the sidebar on this post.", 'lydia' ),
					'id'   => $prefix . 'disable_sidebar',
					'type' => 'checkbox',
				),
				array(
					'name' => 'Upload Gallery Images',
					'desc' => 'Min Height 550px, Max 1400px, Drag & Drop to Reorder',
					'id' => $prefix . 'gallery_images',
					'type' => 'file_list',
				),
				array(
					'name' => 'oEmbed',
					'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
					'id'   => $prefix . 'the_oembed',
					'type' => 'oembed',
				),
			)
		);
		
		/**
		 * Post & Portfolio Header Images
		 */
		$meta_boxes[] = array(
			'id' => 'post_header_metabox',
			'title' => esc_html__( 'Page Overrides', 'lydia' ),
			'object_types' => array( 'page', 'team', 'post', 'portfolio' ), // post type
			'context' => 'normal',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name'         => esc_html__( 'Override Header?', 'lydia' ),
					'desc'         => esc_html__( 'Header Layout is set in "appearance" -> "customise". To override this for this page only, use this control.', 'lydia' ),
					'id'           => $prefix . 'header_override',
					'type'         => 'select',
					'options'      => $header_overrides,
					'std'          => 'none'
				)
			)
		);
		
		return $meta_boxes;
	}
	add_filter( 'cmb2_meta_boxes', 'ebor_custom_metaboxes' );
}