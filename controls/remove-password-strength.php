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


 
// Remove Password Strength Check
function k2e_remove_password_strength_checkbox() {
	$options = get_option('plugin_options');
	
	if($options['k2e_remove_password_strength_check']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>

			<div class='k2_essentials_setting_label'>Remove Woocommerce Password Strenght Check</div>
			
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2e_remove_password_strength' name='plugin_options[k2e_remove_password_strength_check]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}	


function k2e_remove_password_strength()
{ 
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) 
		{
			wp_dequeue_script( 'wc-password-strength-meter' ); 
		} 

}