<?php
/**
 * Block Gutenberg editor functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */


// CHECKBOX - For Block Editor Gutenberg
function block_gutenberg_editor_checkbox() {
	$options = get_option('plugin_options');
	if($options['block_gutenberg_check']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>

			<div class='k2_essentials_setting_label'>Disable for classic gutenberg editor</div>

			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2e_block_gutenberg_editor' name='plugin_options[block_gutenberg_check]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>

			<div class='break'></div>
		  </div>
	";
}