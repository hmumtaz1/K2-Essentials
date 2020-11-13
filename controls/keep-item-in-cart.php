<?php
/**
 * WooCommerce - Keep Last item in cart  functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */



// Keep Last item in cart checkbox
function k2e_keep_item_in_cart_checkbox() {
	$options = get_option('plugin_options');
	
	if($options['k2e_keep_item_in_cart_check']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2e_keep_item_in_cart' name='plugin_options[k2e_keep_item_in_cart_check]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}

function k2e_remove_cart_item( $passed, $product_id, $quantity ) {
    if( ! WC()->cart->is_empty() )
        WC()->cart->empty_cart();
    return $passed;
}
