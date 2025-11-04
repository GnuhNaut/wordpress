<?php
/**
 * Plugin Name:       Admin Pretty (Đã Đại Tu)
 * Plugin URI:        https://justsayeasy.com
 * Description:       Một plugin đơn giản để làm đẹp giao diện admin và trang đăng nhập WordPress.
 * Version:           5.0.0 (Đã tích hợp Light/Dark Mode)
 * Author:            justsayeasy.com
 * Author URI:        https://justsayeasy.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       admin-pretty
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Tải file CSS cho khu vực Bảng điều khiển (Admin Dashboard).
 *
 * Hook: admin_enqueue_scripts
 */
function ap_enqueue_admin_styles() {
    
    wp_enqueue_style(
        'admin-pretty-dashboard-style', 
        plugin_dir_url( __FILE__ ) . 'admin-dashboard.css', 
        array(), 
        '5.0.0' 
    );
}
add_action( 'admin_enqueue_scripts', 'ap_enqueue_admin_styles' );


/**
 * Tải file CSS cho trang Đăng nhập (Login Page).
 *
 * Hook: login_enqueue_scripts
 */
function ap_enqueue_login_styles() {
    
    wp_enqueue_style(
        'admin-pretty-dashboard-style', 
        plugin_dir_url( __FILE__ ) . 'admin-dashboard.css', 
        array(), 
        '5.0.0' 
    );

    wp_enqueue_style(
        'admin-pretty-login-style', 
        plugin_dir_url( __FILE__ ) . 'admin-login.css', 
        array('admin-pretty-dashboard-style'), 
        '5.0.0' 
    );
}
add_action( 'login_enqueue_scripts', 'ap_enqueue_login_styles' );