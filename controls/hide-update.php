<?php
/**
 * Hide update message functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */


// CHECKBOX - Hide Update Messages
function hide_update_checkbox() {
	$options = get_option('plugin_options');
	if($options['hide_update_check']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2e_hide_update_message' name='plugin_options[hide_update_check]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}