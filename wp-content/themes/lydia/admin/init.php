<?php 

/**
 * Load standard areas of the theme-side framework
 * These should be loaded at all times.
 */
require_once ( trailingslashit( get_template_directory() ) . 'admin/theme_menus_widgets.php' );
require_once ( trailingslashit( get_template_directory() ) . 'admin/theme_functions.php' );
require_once ( trailingslashit( get_template_directory() ) . 'admin/theme_scripts.php' );
require_once ( trailingslashit( get_template_directory() ) . 'admin/theme_filters.php' );
require_once ( trailingslashit( get_template_directory() ) . 'admin/theme_support.php' );
require_once ( trailingslashit( get_template_directory() ) . 'admin/theme_options.php' );

/**
 * Some parts of the framework only need to run on admin views.
 * These would be those.
 * Calling these only on admin saves some operation time for the theme, everything in the name of speed.
 */
if( is_admin() ){
	if (!( class_exists( 'TGM_Plugin_Activation' ) ))
		require_once ( trailingslashit( get_template_directory() ) . 'admin/class-tgm-plugin-activation.php' );
	
	require_once ( trailingslashit( get_template_directory() ) . 'admin/theme_metaboxes.php' );
}

/**
 * If WPML exists, let's load in our custom functions.
 */
if( function_exists( 'icl_get_languages' ) ){
	require_once ( trailingslashit( get_template_directory() ) . 'admin/theme_wpml.php' );
}

/**
 * If WooCommerce exists, let's load in our custom functions.
 */
if( class_exists( 'Woocommerce' ) ){
	get_template_part( 'admin/theme_woocommerce' );
}