<?php
/**
 * Plugin Name:       Admin Pretty (Đã Đại Tu)
 * Plugin URI:        https://justsayeasy.com
 * Description:       Một plugin đơn giản để làm đẹp giao diện admin và trang đăng nhập WordPress.
 * Version:           4.0.0 (Đã đại tu theo yêu cầu)
 * Author:            justsayeasy.com
 * Author URI:        https://justsayeasy.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       admin-pretty
 */

// Chặn truy cập trực tiếp vào file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Tải file CSS cho khu vực Bảng điều khiển (Admin Dashboard).
 *
 * Hook: admin_enqueue_scripts
 */
function ap_enqueue_admin_styles() {
    
    // Đặt tên file mới là 'admin-dashboard.css' cho rõ ràng
    wp_enqueue_style(
        'admin-pretty-dashboard-style', // Tên định danh (handle) mới
        plugin_dir_url( __FILE__ ) . 'admin-dashboard.css', // Đường dẫn tới file css dashboard
        array(), // Không phụ thuộc file nào
        '4.0.0' // Phiên bản mới
    );
}
// Móc (hook) vào khu vực admin
add_action( 'admin_enqueue_scripts', 'ap_enqueue_admin_styles' );


/**
 * Tải file CSS cho trang Đăng nhập (Login Page).
 *
 * Hook: login_enqueue_scripts
 * Đây là chức năng mới được thêm vào theo yêu cầu.
 */
function ap_enqueue_login_styles() {
    
    // Đặt tên file mới là 'admin-login.css'
    wp_enqueue_style(
        'admin-pretty-login-style', // Tên định danh (handle) mới
        plugin_dir_url( __FILE__ ) . 'admin-login.css', // Đường dẫn tới file css login
        array(), // Không phụ thuộc file nào
        '4.0.0' // Phiên bản mới
    );
}
// Móc (hook) vào khu vực đăng nhập
add_action( 'login_enqueue_scripts', 'ap_enqueue_login_styles' );