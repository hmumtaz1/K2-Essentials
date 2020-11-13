<?php
/**
 * Change add to cart text functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */



function k2e_product_in_cart_checkbox() {
	$options = get_option('plugin_options');
	
	if($options['k2e_product_in_cart_check']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2e_product_already_in_cart' name='plugin_options[k2e_product_in_cart_check]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}

function k2e_woo_cart_button_text() {

	global $woocommerce;
	
	foreach($woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		$_product = $values['data'];
	
		if( get_the_ID() == $_product->id ) {
			return __('Already in cart - Add Again?', 'woocommerce');
		}
	}
	
	return __('Add to cart', 'woocommerce');
}

function k2e_woo_archive_cart_button_text() {

	global $woocommerce;
	
	foreach($woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		$_product = $values['data'];
	
		if( get_the_ID() == $_product->id ) {
			return __('Already in cart', 'woocommerce');
		}
	}
	
	return __('Add to cart', 'woocommerce');
}
