<?php
/**
 * WooCommerce - Set minimum order amount  functionality.
 *
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */




// Set Minimum Order Amount
function minumin_order_checkbox() {
	$options = get_option('plugin_options');
	
	if($options['k2e_min_order_check']=='on' &&  !empty($options['min_amount_input']) ) { 
		$checked = ' checked="checked" '; 
	}
	
    echo "<div class='k2_essentials_setting_toggle'>
    
            <div class='k2_essentials_setting_label'>Set minimum order amount</div>


			<div class='k2_essentials_redirect_url_div2'>
				<label class='k2_essenetials_switch'>
					<input ".$checked." id='k2e_min_order' name='plugin_options[k2e_min_order_check]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
				</label>
			</div>
        <div class='break'></div>

			<div class='k2_essentials_redirect_input_label'>
				<p>Order Amount</p> 
			</div>

			<div class='k2_essentials_redirect_url_div3' >
				<input id='k2_min_amount_input' name='plugin_options[min_amount_input]' size='40' type='number' value='{$options['min_amount_input']}' />	
			</div>

		</div>";
}


// Set the variable to specify a minimum order value from the input taken from the user
function k2e_woo_minimum_order_amount() {

    $options = get_option('plugin_options');

    $minimum = $options['min_amount_input'];

    if ( WC()->cart->total < $minimum ) {

        if( is_cart() ) {

            wc_print_notice( 
                sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order. ' , 
                    wc_price( WC()->cart->total ), 
                    wc_price( $minimum )
                ), 'error' 
            );

        } else {

            wc_add_notice( 
                sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order.' , 
                    wc_price( WC()->cart->total ), 
                    wc_price( $minimum )
                ), 'error' 
            );

        }
    }
}