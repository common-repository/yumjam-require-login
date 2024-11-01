<?php
/**
 * YumJam Require Login Always
 *
 * @package     YumJamRequireLogin
 * @author      Matt Burnett
 * @copyright   2016 YumJam
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: YumJam Require Login
 * Plugin URI: http://www.yumjam.co.uk/yumjam-wordpress-plugins/require-login/
 * Description: Disable the public site functionality, always prompt for a login before showing content, make wordpress and intranet style site
 * Version: 1.1.5
 * Author: YumJam
 * Author URI: http://www.yumjam.co.uk
 * Text Domain: require-login
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Tags: comments
 * Requires at least: 4.0
 * Tested up to: 5.4.1
 * Stable tag: 1.1.5
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('YumJamRequireLogin')) {

    class YumJamRequireLogin {

        public function __construct() {
            define('YJRL_PLUGIN_PATH', __DIR__);
            define('YJRL_PLUGIN_URL', plugin_dir_url(__FILE__));

            //Frontend Scripts
            add_action('wp_enqueue_scripts', array($this, 'rl_frontend_scripts'));

            //Admin 
            if (is_admin()) {
                $this->admin_hooks();
            }

            //install and uninstall
            register_activation_hook(__FILE__, array($this, 'rl_activate'));
            register_deactivation_hook(__FILE__, array($this, 'rl_deactive'));

            //Do plugin actions
            add_action( 'init', array( $this, 'hooks' ) );
        }

        public function admin_hooks() {
            if (is_admin()) {
                add_action('admin_init', array($this, 'rl_admin_init'));
                add_action('admin_enqueue_scripts', array($this, 'rl_backend_scripts'));
                add_action('admin_menu', array($this, 'rl_register_menu_page'));
                add_action('admin_enqueue_scripts', array($this, 'load_wp_media_files'));
            }
        }

        public function load_wp_media_files() {
            wp_enqueue_media();
        }

        public function hooks() {
            if (get_option('rl_enable') == 1) {
                add_action('template_redirect', array($this, 'template_redirect'));
                add_filter('robots_txt', array($this, 'disable_robots'), 0, 2);
                add_filter('option_ping_sites', array($this, 'disable_ping_backs'), 0, 1);
            }
            
            if (get_option('rl_red_aft_log') == 1) {
                add_filter('login_redirect', array($this, 'redirect_after_login'), 10, 3);
            }
            
            if (get_option('rl_cust_log_form') == 1) {
                add_action('login_enqueue_scripts', array($this, 'replace_login_logo'));
                add_filter('login_headerurl', array($this, 'replace_login_url'));
                add_filter('login_headertitle', array($this, 'replace_login_title'));
                if (get_option('rl_cust_log_disable_pw_reset') == 1) {
                    add_action('login_init', array($this, 'disable_lost_password'));
                    add_action('login_enqueue_scripts', array($this, 'hide_lost_password_link'));
                }
                if (get_option('rl_cust_log_disable_link') == 1) {
                    add_action('login_enqueue_scripts', array($this, 'hide_blog_link'));
                }                
            }
            
            if (is_user_logged_in() && get_option('rl_disable_admin_bar') == 1) {
                if ( $this->rl_admin_bar_hidden( wp_get_current_user() ) ) {
                    add_action( 'admin_init', array( $this, 'rl_prevent_admin_access' ) );
                    add_filter( 'show_admin_bar', '__return_false' );
                }
            }
        }
        
        public function rl_prevent_admin_access() {
            if (get_option('rl_prevent_admin_access') == 1) {
                wp_safe_redirect( home_url() );
                exit;
            }
        }
        
        public function rl_admin_bar_hidden( $user ) {
            $roles = get_option( 'rl_disable_admin_bar_roles' );
            if ( is_array($roles) && array_intersect( $user->roles, $roles ) ) {
                return true;
            }
            return false;            
        }

        public function disable_lost_password() {
            if (isset($_GET['action'])) {
                if (in_array($_GET['action'], array('lostpassword', 'retrievepassword'))) {
                    wp_redirect(wp_login_url(), 301);
                    exit;
                }
            }
        }

        public function hide_lost_password_link() {
            ?>
                <style type="text/css">
                    p#nav {
                        display:none !important;
                    }
                </style>
            <?php
        }
        
        public function hide_blog_link() {
            ?>
                <style type="text/css">
                    p#backtoblog {
                        display:none !important;
                    }
                </style>
            <?php
        }
        
        /*
         * Check user logged in before any template is called
         * 
         */
        public function template_redirect() {
            if (get_option('rl_enable') != 1 || strstr($_SERVER['REQUEST_URI'], 'wp-activate.php') || strstr($_SERVER['REQUEST_URI'], 'robots.txt')) {
                return;
            }

            if (is_user_logged_in()) {
                $user = wp_get_current_user();
                if (is_multisite()) {
                    //multisite network not supported
                    die();
                } else {
                    if (empty($user->roles)) {
                        wp_logout();
                        wp_die('<h3>' . esc_html('You do not have permission to view this site. please contact the site administrator.') . '</h3>');
                    }
                }
            } else {
                //check the user is logged in, if not it redirect to the login page.
                auth_redirect();
            }
        }

        public function redirect_after_login($to, $req_to, $user) {
            if (!empty($user->user_login)) {
                if (get_option('rl_red_aft_log') == 1) {
                    return get_option('rl_red_aft_log_url');
                }
            }
            return $to;
        }

        public function disable_robots($output, $public) {
            return "User-agent: *\nDisallow: /\n";
        }

        public function disable_ping_backs($sites) {
            return '';
        }

        /**
         * WordPress Login form replace with custom logo
         */
        public function replace_login_logo() {
            $logo_type = get_option('rl_cust_logo_radio');
        
            switch ($logo_type) {
                case 'custom':
                    $this->custom_login_image();
                    break;
                case 'nologo':
                    $this->no_login_image();
                    break;
            }

        }

        private function custom_login_image() {
            $attach_id = get_option('rl_cust_logo');
            $width = get_option('rl_cust_logo_width');
            $height = get_option('rl_cust_logo_height');
            
            if (!empty($attach_id)) {
                !empty($width)?:$width=200;
                !empty($height)?:$height=100;
                ?>
                <style type="text/css">
                    .login h1 a {
                        background-image: url(<?php echo esc_attr($attach_id) ?>) !important;
                        background-size: <?php echo esc_attr($width) ?>px !important;
                        height: <?php echo esc_attr($height) ?>px !important;
                        width: <?php echo esc_attr($width) ?>px !important;
                    }
                </style>
                <?php
            }            
            
        }
        
        private function no_login_image() {
                ?>
                <style type="text/css">
                    .login h1 a {
                        background-image: url(<?php YJRL_PLUGIN_URL . '/1px.png' ?>) !important;
                        background-size: 1px !important; height: 1px !important; width: 1px !important;
                    }
                </style>
                <?php            
        }


        /**
         * WordPress Login form replace logo url with custom link
         */
        public function replace_login_url() {
            $url = get_option('rl_cust_logo_link');
            if (!empty($url)) {
                return $url;
            }
        }

        /**
         * WordPress Login form replace logo hover title with custom text
         */
        public function replace_login_title() {
            $title = get_option('rl_cust_logo_title');
            if (!empty($title)) {
                return $title;
            }
        }

        /**
         * Doing admin stuff - initialise
         */
        public function rl_admin_init() {
            $this->configure_settings_options();
            add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'plugin_action_links'));
        }

        /**
         * Add extra links to plugins page, by active/deactivate link
         * @param type $links
         * @return string
         */
        public function plugin_action_links($links) {
            $links[] = '<a href="' . esc_url(get_admin_url(null, 'options-general.php?page=rl_options')) . '">Settings</a>';
            $links[] = '<a href="https://www.yumjam.co.uk" target="_blank">More by YumJam</a>';

            return $links;
        }

        public function configure_settings_options() {
            $prefix = 'rl_';
            $section = array('id' => $prefix . 'options_group1', 'name' => 'Configurable Settings');

            /* Array of Setting to add to the settings page */
            $settings = array(
                array('id' => $prefix . 'enable', 'type' => 'checkbox', 'name' => 'Enable YumJam Require Login'),
                array('id' => $prefix . 'red_aft_log', 'type' => 'checkbox', 'name' => 'Enable Redirect After Login'),
                array('id' => $prefix . 'red_aft_log_url', 'type' => 'textbox', 'name' => 'Redirect URL'),
                array('id' => $prefix . 'cust_log_form', 'type' => 'checkbox', 'name' => 'Enable Customised Login Page'),
                array('id' => $prefix . 'cust_logo_radio', 'type' => 'radio', 'name' => 'Logo Type', 'values' => array('nologo' => 'No Logo', 'custom' => 'Custom Image')),
                array('id' => $prefix . 'cust_logo', 'type' => 'media-select', 'name' => 'Custom Logo'),
                array('id' => $prefix . 'cust_logo_width', 'type' => 'textbox', 'name' => 'Custom Logo Width (px)'),
                array('id' => $prefix . 'cust_logo_height', 'type' => 'textbox', 'name' => 'Custom Logo Height (px)'),
                array('id' => $prefix . 'cust_logo_title', 'type' => 'textbox', 'name' => 'Logo Title'),
                array('id' => $prefix . 'cust_logo_link', 'type' => 'textbox', 'name' => 'Logo Link'),
                array('id' => $prefix . 'cust_log_disable_pw_reset', 'type' => 'checkbox', 'name' => 'Disable Password Reset'),
                array('id' => $prefix . 'cust_log_disable_link', 'type' => 'checkbox', 'name' => 'Hide Link Back to Website'),
                array('id' => $prefix . 'break', 'type' => 'break', 'name' => ''),
                array('id' => $prefix . 'disable_admin_bar', 'type' => 'checkbox', 'name' => 'Disable the admin bar for specific roles'),
                array('id' => $prefix . 'disable_admin_bar_roles', 'type' => 'multi-select', 'name' => 'Admin Bar Disabled for', 'values' => 'callback' ),
                array('id' => $prefix . 'prevent_admin_access', 'type' => 'checkbox', 'name' => 'Also prevent wp-admin access for these roles'),                
            );

            add_settings_section($section['id'], $section['name'], '', $prefix . 'options');
            foreach ($settings as $s) {
                register_setting($section['id'], $s['id']);
                add_settings_field($s['id'], $s['name'], array($this, $prefix . 'output_settings_field'), $prefix . 'options', $section['id'], array('id' => $s['id'], 'type' => $s['type'], 'values' => (!empty($s['values'])?$s['values']:false)) );
            }
        }

        /**
         * Output the HTML to genterate setting/options input boxes
         * @param type $args
         */
        public function rl_output_settings_field($args) {
            if (!empty($args['values'])) {
                if ($args['values'] == 'callback') {
                    $values = call_user_func(array($this, $args['id'] . '_values'));
                } else if (is_array($args['values'])) {
                    $values = $args['values'];
                }
            }            
            
            switch ($args['type']) {
                case 'break':
                    $html = "<hr />";
                    break;
                case 'textbox':
                    $html = "<input type='text' id='{$args['id']}' name='{$args['id']}' value='" . get_option($args['id']) . "' />";
                    break;
                case 'checkbox':
                    $html = "<input type='checkbox' id='{$args['id']}' name='{$args['id']}' value='1'" . checked(1, get_option($args['id']), false) . "/>";
                    //$html .= "<label for='{$args['id']}'></label>";                    
                    break;
                case 'radio':
                    $option = get_option($args['id']);
                    if (is_array($values)) {
                        $html = '';
                        foreach ($values as $value => $label) {
                            $html .= "<div id='radio-{$value}' class='{$args['id']}'> <input type='radio' id='{$args['id']}-{$value}' name='{$args['id']}' value='{$value}' " . checked($option, $value, false) . " />{$label}</div>";
                        }
                    }
                    break;
                case 'media-select':
                    $html = "<input type='text' id='{$args['id']}' name='{$args['id']}' value='" . get_option($args['id']) . "' class='regular-text' />";
                    $html .= "<input type='button' name='rl_media_select' id='rl_media_select' class='button-secondary' value='Choose Logo' / >";
                    break;
                case 'multi-select':
                    if (is_array($values)) {
                        $html = "<select multiple='true' class='chosen' id='{$args['id']}' name='{$args['id']}[]' style='width:200px;'>";
                        $options = get_option($args['id']);
                        foreach ($values as $value) {
                            $selected = '';
                            if (!empty($options) && is_array($options)) {
                                $selected = in_array($value, $options) ? ' selected="selected"' : '';
                            }
                            $html .= "<option value='{$value}'{$selected}>".ucfirst($value)."</option>";
                        }
                        $html .= "</select>";
                    }
                    break;                
            }
            echo $html;
        }
        
        public function rl_disable_admin_bar_roles_values() {
            global $wp_roles;
            $roles = array();
            foreach( $wp_roles->role_names as $role => $name ) {
                $roles[] = $role;
            }
            
            return $roles;
        }
        
        /**
         * Plugin activated perform installation and setup 
         */
        function rl_activate() {
            //populte for each setting/option that requires a default
            add_option('rl_enable', '1');
            add_option('rl_red_aft_log', '');
            add_option('rl_red_aft_log_url', '');
            add_option('rl_cust_log_form', '');
        }

        /**
         * Plugin deactivated perform de-activation tasks
         */
        public function rl_deactive() {
            $prefix = 'rl_';
            //tidy up options
            $settings = array(
                array('id' => $prefix . 'enable'), 
                array('id' => $prefix . 'red_aft_log'),
                array('id' => $prefix . 'red_aft_log_url'), 
                array('id' => $prefix . 'cust_log_form'),
                array('id' => $prefix . 'cust_logo'),
                array('id' => $prefix . 'cust_logo_title'),
                array('id' => $prefix . 'cust_logo_link'),
                array('id' => $prefix . 'cust_logo_height'),
                array('id' => $prefix . 'cust_logo_width'),
                array('id' => $prefix . 'cust_log_disable_pw_reset'),
                array('id' => $prefix . 'cust_log_disable_link'),
            );            
            foreach ($settings as $option) {
                delete_option($option['id']);
            }
        }

        /**
         * Load plugins CSS and JSS on site frontend view
         */
        public function rl_frontend_scripts() {
            wp_enqueue_style('rl-front-style', YJRL_PLUGIN_URL . 'css/front.css');
            wp_enqueue_script('rl-front', YJRL_PLUGIN_URL . 'js/front.js', array('jquery'), '1.0.0', true);
        }

        /**
         * Load plugins CSS and JSS on site backend/admin view
         * 
         * @param type $hook
         * @return type
         */
        public function rl_backend_scripts($hook) {
            wp_enqueue_media();
            
            if (wp_style_is( 'chosen', 'registered' )) {
                //remove old chosen style
                wp_deregister_style('chosen');
            }
            
            wp_register_style('chosen', YJRL_PLUGIN_URL . 'lib/chosen/chosen.css');
            wp_enqueue_style('chosen');
            
            wp_enqueue_style('rl-back-style', YJRL_PLUGIN_URL . 'css/admin.css');
            wp_enqueue_script('rl-front', YJRL_PLUGIN_URL . 'js/admin.js', array('jquery'), '1.0.0', true);
			wp_enqueue_script('yj-chosen', YJRL_PLUGIN_URL . 'lib/chosen/chosen.jquery.js', array('jquery', 'wp-color-picker', 		'jquery-ui-core', 'jquery-ui-slider'), '1.5.1', true);			
        }

        /**
         * register new setting page under Dashboard->Settings->
         */
        public function rl_register_menu_page() {
            add_options_page(
                    __('YumJam Require Login', 'textdomain'), __('YumJam Require Login', 'textdomain'), 'manage_options', 'rl_options', array($this, 'rl_options')
            );
        }

        /**
         * include the setting page
         * 
         */
        public function rl_options() {
            if (current_user_can('manage_options')) {
                include(YJRL_PLUGIN_PATH . '/options.php');
            }
        }

    }

}

return new YumJamRequireLogin();
