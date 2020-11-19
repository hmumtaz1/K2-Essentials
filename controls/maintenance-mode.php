<?php
/**
 * Enabling maintenance mode functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */


// CHECKBOX - For putting site under maintaince
function maintenance_mode_checkbox() {
	$options = get_option('plugin_options');
	if($options['maintenance_check']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>

			<div class='k2_essentials_setting_label'>Put Site Under Maintaince</div>
			
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2e_maintaince_mode' name='plugin_options[maintenance_check]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}


//Enabling maintenance mode
function k2e_wp_maintenance_mode(){
	if(!current_user_can('edit_themes') || !is_user_logged_in()){
		wp_die('This website is undergoing Maintenance, please come back soon.', 'This website is undergoing Maintenance - please come back soon.', array('response' => '503'));
	}
}
