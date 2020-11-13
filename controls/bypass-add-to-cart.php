<?php
/**
 * Bypass add to cart functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */


//CHECKBOX - Bypass add to cart
function bypass_add_to_cart_checkbox() {
	$options = get_option('plugin_options');
	
	if($options['add_to_cart_check']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2e_bypass_add_to_cart' name='plugin_options[add_to_cart_check]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}

//Bypass add to cart in WooCommerce
function k2e_bypass_cart_function() {
    global $woocommerce;
    $checkout_url = wc_get_checkout_url();
    return $checkout_url;
}
   