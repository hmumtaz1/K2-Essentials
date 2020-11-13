<?php
/**
 * WooCommerce - Replace out of stock  functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */




// CHECKBOX - Replace Out of Stock Text 
function k2e_replace_out_of_stock_checkbox() {
	$options = get_option('plugin_options');
	
	if($options['k2e_replace_out_of_stock_check']=='on' && !empty($options['k2e_replace_out_of_stock_input'])) { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<div class='k2_essentials_redirect_url_div2'>
				<label class='k2_essenetials_switch'>
					<input ".$checked." id='k2e_replace_out_of_stock' name='plugin_options[k2e_replace_out_of_stock_check]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
				</label>
			</div>

			<div class='k2_essentials_redirect_url_div2'>
				<p>New Text</p> 
			</div>

			<div class='k2_essentials_redirect_url_div3' >
				<input id='k2e_replace_out_of_stock_input' name='plugin_options[k2e_replace_out_of_stock_input]' size='40' type='text' value='{$options['k2e_replace_out_of_stock_input']}' />	
			</div>

			</div>";
}


function k2e_woo_get_availability( $availability, $_product ) {
  
	$options = get_option('plugin_options');

    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __($options['k2e_replace_out_of_stock_input'], 'woocommerce');
    }
    return $availability;
}