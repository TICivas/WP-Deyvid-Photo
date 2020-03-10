<?php 

/**
 * Build theme options
 * Uses the Ebor_Options class found in the ebor-framework plugin
 * Panels are WP 4.0+!!!
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if( class_exists('Ebor_Options') ){
	$ebor_options = new Ebor_Options;
	
	//Vars
	$theme = wp_get_theme();
	$theme_name = $theme->get( 'Name' );
	$footer_default = '*copy* *current_year* Lydia. By <a href="http://www.tommusrhodus.com">TommusRhodus</a>';
	$portfolio_layouts = array_flip(ebor_get_portfolio_layouts());
	$blog_layouts = array_flip(ebor_get_blog_layouts());
	$team_layouts = array_flip(ebor_get_team_layouts());
	$header_layouts = ebor_get_header_layouts();
	$social_options = ebor_get_social_icons();
	
	/**
	 * Default stuff
	 * 
	 * Each of these is a default option that appears in each theme, demo data, favicons and a custom css input
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	$ebor_options->add_panel( $theme_name . ': Demo Data', 5, '');
	$ebor_options->add_panel( $theme_name . ': Styling Settings', 205, 'All of the controls in this section directly relate to the styling page of ' . $theme_name);
	$ebor_options->add_section('demo_data_section', 'Import Demo Data', 10, $theme_name . ': Demo Data', '<strong>Please read this before importing demo data via this control:</strong><br /><br />The demo data this will install includes images from my demo site with <strong>heavy blurring applied</strong> this is due to licensing restrictions. Simply replace these images with your own.<br /><br />Note that this process can take up to 15mins on slower servers, go make a cup of tea. If you havn\'t had a notification in 30mins, use the fallback method outlined in the written documentation.<br /><br />');
	$ebor_options->add_section('custom_css_section', 'Custom CSS', 40, $theme_name . ': Styling Settings');
	$ebor_options->add_setting('demo_import', 'demo_import', 'Import Demo Data', 'demo_data_section', '', 10);
	$ebor_options->add_setting('textarea', 'custom_css', 'Custom CSS', 'custom_css_section', '', 30);
	
	$ebor_options->add_section('footer_settings_section', 'Footer Settings', 30, false);
	
	/**
	 * Panels
	 * 
	 * add_panel($name, $priority, $description)
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	$ebor_options->add_panel( $theme_name . ': Header Settings', 215, 'All of the controls in this section directly relate to the header and logos of ' . $theme_name);
	
	//Header Settings
	$ebor_options->add_section('header_layout_section', 'Header Layout', 5, $theme_name . ': Header Settings', 'This setting controls the theme header site-wide. If you need to you can override this setting on specific posts and pages from within that posts edit screen.');
	$ebor_options->add_section('logo_settings_section', 'Logo Settings', 10, $theme_name . ': Header Settings');
	$ebor_options->add_section('header_icons_section', 'Header Icon Settings', 15, $theme_name . ': Header Settings');
	
	//Colours
	$ebor_options->add_setting('color', 'colour_text', 'Text Colour', 'colors', '#5b5b5b', 5);
	$ebor_options->add_setting('color', 'colour_headings', 'Headings Colour', 'colors', '#3b3b3b', 10);
	$ebor_options->add_setting('color', 'colour_highlight', 'Highlight Colour', 'colors', '#70aed2', 15);
	$ebor_options->add_setting('color', 'colour_highlight_hover', 'Highlight Hover Colour', 'colors', '#62a3c8', 20);
	$ebor_options->add_setting('color', 'colour_meta', 'Meta Colour', 'colors', '#999999', 25);
	
	//Category highlight colour selectors
	$cats = get_categories('hide_empty=0');
	foreach( $cats as $cat ){
		$ebor_options->add_setting('color', 'cat_'. $cat->term_id .'_colour', $cat->name . ' Category Colour', 'colors', '#4aa2d1', $cat->term_id + 100);
	}
	
	//Portfolio options
	$ebor_options->add_section('portfolio_layout_section', 'Portfolio Layout', 320, false);
	$ebor_options->add_setting('select', 'portfolio_layout', 'Portfolio Archives Layout', 'portfolio_layout_section', 'mosaic', 30, $portfolio_layouts);
	
	//team options
	$ebor_options->add_section('team_layout_section', 'Team Layout', 330, false);
	$ebor_options->add_setting('select', 'team_layout', 'Team Archives Layout', 'team_layout_section', 'grid', 30, $team_layouts);
	
	//Blog Settings
	$ebor_options->add_section('blog_layout_section', 'Blog Layout', 310, false);
	$ebor_options->add_setting('input', 'disqus_username', 'Disqus Shortname (enables Disqus Comments)', 'blog_layout_section', '', 15);
	$ebor_options->add_setting('select', 'disable_comments', 'Disable WP Comments? (use when using Disqus Comments)', 'blog_layout_section', 'no', 20, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('input', 'author_details_title', 'About Author Title', 'blog_layout_section', 'About the author', 25);

	$ebor_options->add_setting('select', 'blog_layout', 'Blog Archives Layout', 'blog_layout_section', 'grid-sidebar', 10, $blog_layouts);
	
	//Footer Options
	$ebor_options->add_setting('textarea', 'copyright', 'Copyright Message - Here you can use *copy* to show a copyright symbol, as well as *current_year* to display the current year.', 'footer_settings_section', $footer_default, 20);
	
	//Header Options
	$ebor_options->add_setting('select', 'header_layout', 'Global Header Layout', 'header_layout_section', 'solid-dark', 5, $header_layouts);
	
	//Logo Options
	$ebor_options->add_setting('image', 'custom_logo', 'Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo.png', 5);
	$ebor_options->add_setting('image', 'custom_logo_retina', 'Retina Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo@2x.png', 10);
	$ebor_options->add_setting('image', 'custom_logo_dark', 'Dark Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo-dark.png', 15);
	$ebor_options->add_setting('image', 'custom_logo_dark_retina', 'Dark Retina Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo-dark@2x.png', 20);
	
	//Header Icons
	for( $i = 1; $i < 5; $i++ ){
		$ebor_options->add_setting('select', 'header_social_icon_' . $i, 'Header Social Icon ' . $i, 'header_icons_section', 'none', 20 + $i + $i, $social_options);
		$ebor_options->add_setting('input', 'header_social_url_' . $i, 'Header Social URL ' . $i, 'header_icons_section', '', 21 + $i + $i);
	}
	
	//Google Maps Options
	$ebor_options->add_panel( $theme_name . ': Google Maps Settings', 315, 'All of the controls in this section directly relate to google maps area of ' . $theme_name);
	$ebor_options->add_section('gmaps_api_section', 'Google Maps API Key', 310,  $theme_name . ': Google Maps Settings', '<strong>Please Enter Your Maps API Key</strong><br />If you do not have a key, you will need to register for one. You can do so by following our article by <a href="https://tommusrhodus.ticksy.com/article/7769">clicking here</a>.');
	$ebor_options->add_setting('input', 'ebor_gmap_api', 'Google Maps API Key', 'gmaps_api_section', '', 15);
	
}