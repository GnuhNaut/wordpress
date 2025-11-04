<?php
/**
 * Plugin Name:       Admin Pretty
 * Plugin URI:        https://justsayeasy.com
 * Description:       A plugin to completely beautify WordPress admin interface and login page, supports Light/Dark Mode.
 * Version:           1.0.0
 * Author:            justsayeasy.com 
 * Author URI:        https://justsayeasy.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       admin-pretty
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'AP_VERSION', '6.0.0' );
define( 'AP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function ap_enqueue_admin_styles() {
    wp_enqueue_style(
        'admin-pretty-dashboard-style',
        AP_PLUGIN_URL . 'admin-dashboard.css',
        array(),
        AP_VERSION
    );
}
add_action( 'admin_enqueue_scripts', 'ap_enqueue_admin_styles' );

function ap_enqueue_login_styles() {
    wp_enqueue_style(
        'admin-pretty-login-style',
        AP_PLUGIN_URL . 'admin-login.css',
        array(),
        AP_VERSION
    );
}
add_action( 'login_enqueue_scripts', 'ap_enqueue_login_styles' );

function ap_add_settings_page() {
    add_options_page(
        'Admin Pretty Settings',      
        'Admin Pretty',              
        'manage_options',           
        'admin-pretty-settings',     
        'ap_render_settings_page' 
    );
}
add_action( 'admin_menu', 'ap_add_settings_page' );

function ap_register_settings() {
    register_setting(
        'ap_settings_group',         
        'ap_color_mode',             
        array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => 'light',
        )
    );
}
add_action( 'admin_init', 'ap_register_settings' );

function ap_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'ap_settings_group' );
            do_settings_sections( 'admin-pretty-settings' );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Theme</th>
                    <td>
                        <select name="ap_color_mode">
                            <option value="light" <?php selected( get_option( 'ap_color_mode' ), 'light' ); ?>>
                                ☀️ Light Mode (Default)
                            </option>
                            <option value="dark" <?php selected( get_option( 'ap_color_mode' ), 'dark' ); ?>>
                                🌙 Dark Mode
                            </option>
                        </select>
                        <p class="description">Change your admin theme.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button( 'Save Theme' ); ?>
        </form>
    </div>
    <?php
}

function ap_add_body_class( $classes ) {
    $color_mode = get_option( 'ap_color_mode', 'light' );
    
    if ( $color_mode === 'dark' ) {
        $classes .= ' admin-pretty-dark-mode';
    }
    
    return $classes;
}
add_filter( 'admin_body_class', 'ap_add_body_class' );