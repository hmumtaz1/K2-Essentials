<?php
/**
 * Controls class.
 *
 * @category   Class
 * @package    K2Essentials
 * @subpackage WordPress
 * @author     PookiDevs
 * @since      1.0.0
 * php version 7.3.9
 */

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Class Plugin
 *
 * Main Plugin class
 *
 * @since 1.0.0
 */
class Controls {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
    private static $instance = null;
    
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
        
        $this->include_control_files();
        add_action( 'admin_menu', array($this, 'add_k2e_sidebar' ));
        add_action('admin_init', array($this, 'k2e_init' ));
        add_action( 'admin_enqueue_scripts', array($this, 'load_admin_styles' ));
        add_action('init', array($this, 'k2e_perform_checked_snippets'));
    }

    private function include_control_files() {
        require_once 'controls/login-redirect.php';
        require_once 'controls/block-gutenberg.php';
        require_once 'controls/disable-admin-bar.php';
        require_once 'controls/maintenance-mode.php';
        require_once 'controls/hide-update.php';
        require_once 'controls/disable-image-compressor.php';
    }
    
    // Section HTML, displayed before the first option
    public static function  k2e_section_text_fn() {
        echo '<div>
            <p>Here, you can enable/disable fields that are needed before deployment</p>
        
        </div>';
    }
    
    // Add a new top level menu link to the ACP
    public function add_k2e_sidebar()
    {
        add_menu_page(
            'K2 Essentials', // Title of the page
            'K2 Essentials', // Text to show on the menu link
            'manage_options', // Capability requirement to see the link
            'k2-essentials', // The 'slug' - file to display when clicking the link
            array ($this, 'k2_essentials_options_page_fn')
        );
    }
    

    public function k2e_init (){
        
        register_setting('plugin_options', 'plugin_options', array($this, 'k2e_plugin_options_validate' ));
        add_settings_section('main_section', '<div class="k2_essentials_Setting_Tab_Title">General Settings</div>', array($this, 'k2e_section_text_fn'), __FILE__);


        add_settings_field('k2e_login_redirect', '<div class="k2_essentials_setting_label">Enable to redirect login url</div>', 'login_redirect_checkbox', __FILE__, 'main_section');
        add_settings_field('k2e_block_gutenberg_editor', '<div class="k2_essentials_setting_label">Disable for classic gutenberg editor</div>', 'block_gutenberg_editor_checkbox', __FILE__, 'main_section');
        add_settings_field('k2e_disable_admin_bar', '<div class="k2_essentials_setting_label">Disable admin bar</div>', 'disable_admin_bar_checkbox', __FILE__, 'main_section');
        add_settings_field('k2e_maintaince_mode', '<div class="k2_essentials_setting_label">Put Site Under Maintaince</div>', 'maintenance_mode_checkbox', __FILE__, 'main_section');        
        add_settings_field('k2e_hide_update_message', '<div class="k2_essentials_setting_label">Hide Wordpress Update Notice for Clients</div>', 'hide_update_checkbox', __FILE__, 'main_section');
        add_settings_field('k2e_disable_image_compressor', '<div class="k2_essentials_setting_label">Disable Wordpress Default Image Compressor</div>','disable_image_compression_checkbox', __FILE__, 'main_section');
        
/*        
        add_settings_section('Woo_Section', '<div class="k2_essentials_Setting_Tab_Title">Woocommerce Settings</div>', 'k2_essentials_woo_commerce_settings', __FILE__);
        
        add_settings_field('k2_essentials_Bypass_add_to_cart', '<div class="k2_essentials_setting_label">Bypass Add to Cart</div>','k2_essentials_Setting_Bypass_add_to_cart', __FILE__, 'Woo_Section');
        
        add_settings_field('k2_essentials_Product_Already_In_Cart', '<div class="k2_essentials_setting_label">Display “product already in cart” instead of “add to cart” button</div>','k2_essentials_Setting_Product_Already_In_Cart', __FILE__, 'Woo_Section');
        
        add_settings_field('k2_essentials_Minumin_Order_Amount', '<div class="k2_essentials_setting_label">Set minimum order amount</div>','k2_essentials_Setting_Minumin_Order_Amount', __FILE__, 'Woo_Section');

        add_settings_field('k2_essentials_Keep_Last_Item_In_Cart', '<div class="k2_essentials_setting_label">Keep Last Item in Cart</div>','k2_essentials_Keep__Setting_Last_Item_In_Cart', __FILE__, 'Woo_Section');

        add_settings_field('k2_essentials_Remove_Password_Strenght_Check', '<div class="k2_essentials_setting_label">Remove Woocommerce Password Strenght Check</div>','k2_essentials_Remove_Setting_Password_Strenght_Check', __FILE__, 'Woo_Section');

        add_settings_field('k2_essentials_Replace_out_of_stock', '<div class="k2_essentials_setting_label">Replace Out of Stock Text</div>','k2_essentials_Replace_out_Setting_of_stock', __FILE__, 'Woo_Section');

    }
    */
    }

    function k2e_perform_checked_snippets(){
        $options = get_option('plugin_options');
        
        if($options['login_redirect_check']=='on') { 
            add_filter('login_redirect', 'k2e_prevent_wp_login', 999999999, 3);
        }
        if($options['block_gutenberg_check']=='on') { 
            add_filter('use_block_editor_for_post', '__return_false', 10);
        }
        if($options['admin_bar_check']=='on') { 
            add_filter( 'show_admin_bar', '__return_false' );
        }   
            
        if($options['maintenance_check']=='on') { 
            add_action('get_header', 'k2e_wp_maintenance_mode');
        }
            
        if($options['hide_update_check']=='on') { 
            add_action('admin_menu','wphidenag');	
        }
        
        if ($options['disable_image_compression_checkbox']=='on'){
            add_filter( 'big_image_size_threshold', '__return_false' );
        }
        
        /*
        // WooCommerce if Options
        // 
        
        if ($options['k2_essentials_Bypass_add_to_cart_Checkbox']=='on'){
            add_filter('woocommerce_add_to_cart_redirect', 'k2_essentials_Bypass_Cart_Function');
        }
    
        if ($options['k2_essentials_Setting_Product_Already_In_Cart_Checkbox']=='on'){
            add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
            add_filter( 'add_to_cart_text', 'woo_archive_custom_cart_button_text' );
    
        }
        if ($options['k2_essentials_Minumin_Order_Amount_Checkbox']=='on'){
            add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
            add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' );	
        }
        
        if($options['k2_essentials_Keep__Setting_Last_Item_In_Cart_CheckBox'] == 'on'){
            add_filter( 'woocommerce_add_to_cart_validation', 'remove_cart_item_before_add_to_cart', 20, 3 );
        }
        
        if($options['k2_essentials_Remove_Password_Strenght_Check_CheckBox']=='on'){
            add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );
        }
        
        if ($options['k2_essentials_Replace_out_Setting_of_stock_CheckBox']=='on'){
    add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
    
        }*/
    }

    public function load_admin_styles() {
        wp_enqueue_style( 'admin_css_foo', plugin_dir_url(__FILE__) . '/assets/css/styles.css', false, '1.0.0' );
    }  

    // Display the admin options page
    public function k2_essentials_options_page_fn() {
        ?>
        <div class="k2_essentials_parent_Class">
            <div class="wrap">
                <div class="icon32" id="icon-options-general"><br></div>
                <div class="K2_essentials_welcome_message_parent">
                    <h2 class="K2_essentials_welcome_message">Welcome to K2 Essentials</h2>
                </div>
                <div class="k2_essentials_divider_parent">
                    <hr class="k2_essentials_divider">
                </div>
                <form action="options.php" method="post">
                            <?php
                                if ( function_exists('wp_nonce_field') ) 
                                    wp_nonce_field('plugin-name-action_' . "yep"); 
                                ?>
                <?php settings_fields('plugin_options'); ?>
                <?php do_settings_sections(__FILE__); ?>
                <p class="submit">
                    <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
                </p>
                </form>
            </div>
        </div>
        <?php
    }

    public function k2e_plugin_options_validate($input) {
        // Check our textbox option field contains no HTML tags - if so strip them out
        return $input; // return validated input
    }
        
}

Controls::instance();


    /*
    function k2_essentials_woo_commerce_settings(){
        echo '<div>
                <p>Here, you can enable/disable fields that are needed before deployment</p>
            </div>';	
    }
    */
