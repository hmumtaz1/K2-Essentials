<?php
/**
 * K2 Essentials WordPress Plugin
 *
 * @package K2Essentials
 *
 * Plugin Name: K2 Essentials
 * Description: Everything you need before launching the site. 
 * Author: PookiDevs
 * Author URI: https://pookidevs.com/
 * Version:     1.2
 * Text Domain: k2essentials
 */

define( 'K2_ESSENTIALS', __FILE__ );

/**
 * Include the Elementor_K2blocks class.
 */
require plugin_dir_path( K2_ESSENTIALS ) . 'init.php';
