<?php
if (!defined('ABSPATH')) {
    die('Invalid request.');
}

require_once(XUANMEDIA_BTNC_PLUGIN_DIR . '/includes/regex.php');
require_once(XUANMEDIA_BTNC_PLUGIN_DIR . '/admin/view.php');

add_action('admin_init', 'xuanmedia_btnc_settings_init');
add_action('admin_menu', 'xuanmedia_btnc_options_page');

function xuanmedia_btnc_settings_init()
{
    register_setting('xuanmedia-btnc', 'xuanmedia_btnc_options', [
        'sanitize_callback' => 'xuanmedia_btnc_sanitize_options',
    ]);
    add_settings_section('xuanmedia_btnc_setting_section', __('Xuân Media Plugin Settings', 'xuanmedia-btnc'), null, 'xuanmedia-btnc');
    // Link zalo
    add_settings_field('xuanmedia_btnc_zalo_field_id', 'Link Zalo', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_zalo',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // link messenger
    add_settings_field('xuanmedia_btnc_messenger_field_id', 'Link Messenger', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_messenger',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // link maps
    add_settings_field('xuanmedia_btnc_maps_field_id', 'Link Maps', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_maps',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // Số điện thoại
    add_settings_field('xuanmedia_btnc_telephone_field_id', 'Số điện thoại', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_telephone',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // vị trí bên phải
    add_settings_field('xuanmedia_btnc_position_field_id', 'Đặt bên phải', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_position_right',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // Hiển thị zalo trên điện thoại
    add_settings_field('xuanmedia_btnc_zalo_mobile_field_id', 'Zalo mobile', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_zalo_mobile',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // hiện thị zalo trên máy tính
    add_settings_field('xuanmedia_btnc_zalo_desktop_field_id', 'Zalo desktop', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_zalo_desktop',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // hiển thị Messenger trên điện thoại
    add_settings_field('xuanmedia_btnc_messenger_mobile_field_id', 'Messenger mobile', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_messenger_mobile',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // hiển thị messenger trên máy tính
    add_settings_field('xuanmedia_btnc_messenger_desktop_field_id', 'Messenger desktop', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_messenger_desktop',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // hiển thị maps trên điện thoại
    add_settings_field('xuanmedia_btnc_maps_mobile_field_id', 'Maps mobile', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_maps_mobile',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // hiển thị maps trên máy tính
    add_settings_field('xuanmedia_btnc_maps_desktop_field_id', 'Maps desktop', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_maps_desktop',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // hiển thị số điện thoại trên điện thoại
    add_settings_field('xuanmedia_btnc_telephone_mobile_field_id', 'Telephone mobile', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_telephone_mobile',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
    // hiển thị số điện thoại trên điện thoại 
    add_settings_field('xuanmedia_btnc_telephone_desktop_field_id', 'Telephone desktop', null, 'xuanmedia-btnc', 'xuanmedia_btnc_setting_section', [
        'label_for' => 'xuanmedia_btnc_telephone_desktop',
        'class' => 'xuanmedia_btnc_row',
        'xuanmedia_btnc_custom_data' => 'custom',
    ]);
}

function xuanmedia_btnc_options_page()
{
    add_menu_page('Xuân Media Button Contact', 'Xuân Media', 'manage_options', 'xuanmedia-btnc', 'xuanmedia_btnc_options_page_html', plugin_dir_url(XUANMEDIA_BTNC_PLUGIN_BASENAME) . 'assets/images/logo.png', 99);
}
