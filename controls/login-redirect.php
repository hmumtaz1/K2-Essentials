<?php
/**
 * Redirect login page functionality
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */

//Checkbox and input field
function login_redirect_checkbox() {
    $options = get_option('plugin_options');
    if($options['login_redirect_check']=='on' && !empty($options['text_string'])) { 
		$checked = ' checked="checked" '; 
    }
	echo "<div class='k2_essentials_setting_toggle'>
	<div class='k2_essentials_redirect_url_div2'>
		<label class='k2_essenetials_switch'>
			<input ".$checked." id='k2e_login_redirect' name='plugin_options[login_redirect_check]' type='checkbox' />
			<span class='k2_essenetials_slider k2_essenetials_round'></span>
		</label>
	</div>
	
	<div class='k2_essentials_redirect_url_div2'>
		<p>Page Slug</p> 
	</div>
	
	<div class='k2_essentials_redirect_url_div3' >
		<input id='plugin_text_string' name='plugin_options[text_string]' size='40' type='text' value='{$options['text_string']}' />	
	</div>
	
	</div>
				
    ";
//    
}


//Action
function k2e_prevent_wp_login() {

    // WP tracks the current page - global the variable to access it
     global $pagenow;
     $options = get_option('plugin_options');
     // Check if a $_GET['action'] is set, and if so, load it into $action variable
     $action = (isset($_GET['action'])) ? $_GET['action'] : '';

     // Check if we're on the login page, and ensure the action is not 'logout'
     if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
         // Load the home page url
         $page = $options['text_string'];
         // Redirect to the home page
         wp_redirect($page);
         // Stop execution to prevent the page loading for any reason
         exit();
     }
}