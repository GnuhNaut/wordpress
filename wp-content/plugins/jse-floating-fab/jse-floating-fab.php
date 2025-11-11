<?php
/**
 * Plugin Name: Floating Contact Button
 * Plugin URI:  https://justsayeasy.com/floating-contact-button/
 * Description: A lightweight, animated floating contact button plugin. Supports Phone, Zalo, Messenger, WhatsApp, Telegram with custom visibility settings per channel.
 * Version:     1.1.0
 * Author:      Just Say Easy
 * Author URI:  https://justsayeasy.com
 * Text Domain: jse-floating-fab
 * License:     GPL v2 or later
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'JSE_FAB_PATH', plugin_dir_path( __FILE__ ) );
define( 'JSE_FAB_URL', plugin_dir_url( __FILE__ ) );

require_once JSE_FAB_PATH . 'includes/class-jse-admin.php';
require_once JSE_FAB_PATH . 'includes/class-jse-frontend.php';

function jse_fab_init() {
    new JSE_FAB_Admin();
    new JSE_FAB_Frontend();
}
add_action( 'plugins_loaded', 'jse_fab_init' );
function jse_fab_add_settings_link( $links ) {
    // Tạo link trỏ đến trang settings của plugin
    // Lưu ý: 'options-general.php' là parent slug vì mình dùng add_options_page
    // 'jse-fab-settings' là menu slug mình đã khai báo trong class admin
    $settings_link = '<a href="options-general.php?page=jse-fab-settings">' . __( 'Settings', 'jse-floating-fab' ) . '</a>';
    
    // Đẩy link Settings lên đầu mảng để nó hiển thị trước nút Deactivate
    array_unshift( $links, $settings_link );
    
    return $links;
}

$plugin_basename = plugin_basename( __FILE__ );
add_filter( 'plugin_action_links_' . $plugin_basename, 'jse_fab_add_settings_link' );