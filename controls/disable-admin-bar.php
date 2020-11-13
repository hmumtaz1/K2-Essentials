<?php
/**
 * Disable admin bar functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */





// CHECKBOX - For disable of admin bar
function disable_admin_bar_checkbox() {
	$options = get_option('plugin_options');
	if($options['admin_bar_check']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
				<label class='k2_essenetials_switch'>
					<input ".$checked." id='k2e_disable_admin_bar' name='plugin_options[admin_bar_check]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
				</label>
		</div>
	";
}