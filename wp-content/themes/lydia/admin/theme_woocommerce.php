<?php 

if(!( function_exists( 'ebor_cart_icon' ) )){
	function ebor_cart_icon() {
		global $woocommerce;
		return '<li><a href="'. esc_url($woocommerce->cart->get_cart_url()) .'"><i class="icon-basket-1"></i></a></li>';
	}
}

// Change number or products per row to 3
add_filter( 'loop_shop_columns', 'loop_columns' );
if (!function_exists( 'loop_columns' )) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}