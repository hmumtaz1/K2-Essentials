<?php
/**
 * Disable of Wordpress Default Image Compressor functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */

// CHECKBOX - For disable of Wordpress Default Image Compressor
function disable_image_compression_checkbox() {
	$options = get_option('plugin_options');
	if($options['disable_image_compression_checkbox']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
				<label class='k2_essenetials_switch'>
					<input ".$checked." id='k2e_disable_image_compressor' name='plugin_options[disable_image_compression_checkbox]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
				</label>
		</div>
	";
}