<?php
/**
 * Plugin Name:       Admin Pretty
 * Plugin URI:        https://justsayeasy.com
 * Description:       Một plugin để làm đẹp toàn diện giao diện admin và trang đăng nhập WordPress, hỗ trợ Chế độ Sáng/Tối.
 * Version:           6.0.0
 * Author:            justsayeasy.com (Đại tu bởi Trợ lý Wordpress)
 * Author URI:        https://justsayeasy.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       admin-pretty
 */

// Chặn truy cập trực tiếp vào file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// === Định nghĩa hằng số cho plugin ===
define( 'AP_VERSION', '6.0.0' );
define( 'AP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Tải file CSS cho khu vực Bảng điều khiển (Admin Dashboard).
 *
 * Hook: admin_enqueue_scripts
 */
function ap_enqueue_admin_styles() {
    wp_enqueue_style(
        'admin-pretty-dashboard-style',
        AP_PLUGIN_URL . 'admin-dashboard.css',
        array(),
        AP_VERSION
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
        'admin-pretty-login-style',
        AP_PLUGIN_URL . 'admin-login.css',
        array(),
        AP_VERSION
    );
}
add_action( 'login_enqueue_scripts', 'ap_enqueue_login_styles' );


// === PHẦN NÂNG CẤP: TẠO MENU CÀI ĐẶT CHO CHẾ ĐỘ SÁNG/TỐI ===

/**
 * Thêm trang cài đặt vào menu "Settings"
 */
function ap_add_settings_page() {
    add_options_page(
        'Admin Pretty Settings',      // Tiêu đề trang
        'Admin Pretty',               // Tên menu
        'manage_options',             // Quyền truy cập
        'admin-pretty-settings',      // Slug
        'ap_render_settings_page'     // Hàm callback để render trang
    );
}
add_action( 'admin_menu', 'ap_add_settings_page' );

/**
 * Đăng ký cài đặt (setting) của plugin
 */
function ap_register_settings() {
    register_setting(
        'ap_settings_group',          // Tên nhóm setting
        'ap_color_mode',              // Tên option
        array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => 'light',
        )
    );
}
add_action( 'admin_init', 'ap_register_settings' );

/**
 * Render giao diện trang cài đặt
 */
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
                    <th scope="row">Chế độ Giao diện</th>
                    <td>
                        <select name="ap_color_mode">
                            <option value="light" <?php selected( get_option( 'ap_color_mode' ), 'light' ); ?>>
                                ☀️ Chế độ Sáng (Mặc định)
                            </option>
                            <option value="dark" <?php selected( get_option( 'ap_color_mode' ), 'dark' ); ?>>
                                🌙 Chế độ Tối
                            </option>
                        </select>
                        <p class="description">Chọn giao diện bạn muốn sử dụng cho khu vực quản trị.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button( 'Lưu thay đổi' ); ?>
        </form>
    </div>
    <?php
}

/**
 * Thêm class vào thẻ <body> của admin
 * Đây là chìa khóa để kích hoạt Dark Mode
 */
function ap_add_body_class( $classes ) {
    $color_mode = get_option( 'ap_color_mode', 'light' );
    
    if ( $color_mode === 'dark' ) {
        $classes .= ' admin-pretty-dark-mode';
    }
    
    return $classes;
}
add_filter( 'admin_body_class', 'ap_add_body_class' );