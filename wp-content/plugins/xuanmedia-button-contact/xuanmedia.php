<?php
/*
Plugin Name: Xuân Media Button Contact
Plugin URI: https://xuan.media
Description: Plugin hiển thị các nút liên hệ (Hotline, Zalo, Messenger) một cách chuyên nghiệp. Phát triển bởi Xuân Media.
Version: 1.1.0
Author: Xuân Media
Author URI: https://xuan.media
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: xuanmedia-button-contact
*/

// Ngăn chặn truy cập trực tiếp vào file. Một biện pháp bảo mật cơ bản và quan trọng.
if (!defined('ABSPATH')) {
    die('Invalid request.');
}

// ===================================================================================
// ĐỊNH NGHĨA HẰNG SỐ (CONSTANTS)
// Việc này giúp code sạch sẽ hơn, dễ quản lý và tránh việc lặp lại các đường dẫn.
// ===================================================================================
define('XUANMEDIA_BTNC_PLUGIN_FILE', __FILE__);
define('XUANMEDIA_BTNC_PLUGIN_BASENAME', plugin_basename(XUANMEDIA_BTNC_PLUGIN_FILE));
define('XUANMEDIA_BTNC_PLUGIN_DIR', untrailingslashit(dirname(XUANMEDIA_BTNC_PLUGIN_FILE)));
define('XUANMEDIA_BTNC_PLUGIN_URL', untrailingslashit(plugins_url('', XUANMEDIA_BTNC_PLUGIN_FILE)));


// ===================================================================================
// GỌI CÁC ACTION HOOKS CỦA WORDPRESS
// Đây là cách chúng ta "gắn" code của mình vào các thời điểm thực thi của WordPress.
// ===================================================================================
add_action('wp_enqueue_scripts', 'xuanmedia_btnc_enqueue_styles');
add_action('wp_footer', 'xuanmedia_btnc_render_html');


// ===================================================================================
// HIỂN THỊ HTML CỦA CÁC NÚT BẤM RA NGOÀI GIAO DIỆN (FRONT-END)
// ===================================================================================
/**
 * Render HTML cho các nút liên hệ và gắn vào footer của trang.
 *
 * @since 1.0.0
 * @version 1.1.0 - Tái cấu trúc, sử dụng wp_parse_args và vòng lặp để tối ưu.
 */
function xuanmedia_btnc_render_html()
{
    // Lấy tùy chọn từ database. (array) để đảm bảo luôn là mảng, tránh lỗi nếu option chưa có.
    $options_from_db = (array) get_option('xuanmedia_btnc_options');

    // Định nghĩa các giá trị mặc định. Đây là "best practice" để tránh lỗi "Undefined array key".
    $defaults = [
        'xuanmedia_btnc_telephone' => '',
        'xuanmedia_btnc_telephone_mobile' => '',
        'xuanmedia_btnc_telephone_desktop' => '',
        'xuanmedia_btnc_zalo' => '',
        'xuanmedia_btnc_zalo_mobile' => '',
        'xuanmedia_btnc_zalo_desktop' => '',
        'xuanmedia_btnc_messenger' => '',
        'xuanmedia_btnc_messenger_mobile' => '',
        'xuanmedia_btnc_messenger_desktop' => '',
        'xuanmedia_btnc_maps' => '',
        'xuanmedia_btnc_maps_mobile' => '',
        'xuanmedia_btnc_maps_desktop' => '',
    ];

    // Hợp nhất giá trị từ DB và giá trị mặc định bằng hàm chuẩn của WordPress.
    $opts = wp_parse_args($options_from_db, $defaults);

    // Cấu trúc lại dữ liệu để tránh lặp code (nguyên tắc DRY) và dễ mở rộng.
    $contacts = [
        'telephone' => [
            'value' => $opts['xuanmedia_btnc_telephone'],
            'href' => 'tel:' . preg_replace('/\D/', '', $opts['xuanmedia_btnc_telephone']), // Chỉ lấy ký tự số
            'title' => __('Số Hotline', 'xuanmedia-button-contact'), // Hỗ trợ đa ngôn ngữ
            'rel' => '',
            'target' => '',
            'classes' => $opts['xuanmedia_btnc_telephone_mobile'] . ' ' . $opts['xuanmedia_btnc_telephone_desktop'],
            'icon' => 'assets/images/telephone.svg',
        ],
        'zalo' => [
            'value' => $opts['xuanmedia_btnc_zalo'],
            'href' => $opts['xuanmedia_btnc_zalo'],
            'title' => __('Chat Zalo', 'xuanmedia-button-contact'),
            'rel' => 'nofollow noopener', // Thêm noopener để tăng bảo mật
            'target' => '_blank',
            'classes' => $opts['xuanmedia_btnc_zalo_mobile'] . ' ' . $opts['xuanmedia_btnc_zalo_desktop'],
            'icon' => 'assets/images/zalo.svg',
        ],
        'messenger' => [
            'value' => $opts['xuanmedia_btnc_messenger'],
            'href' => $opts['xuanmedia_btnc_messenger'],
            'title' => __('Chat Messenger', 'xuanmedia-button-contact'),
            'rel' => 'nofollow noopener',
            'target' => '_blank',
            'classes' => $opts['xuanmedia_btnc_messenger_mobile'] . ' ' . $opts['xuanmedia_btnc_messenger_desktop'],
            'icon' => 'assets/images/messenger.svg',
        ],
        'maps' => [
            'value' => $opts['xuanmedia_btnc_maps'],
            'href' => $opts['xuanmedia_btnc_maps'],
            'title' => __('Chỉ đường', 'xuanmedia-button-contact'),
            'rel' => 'nofollow noopener',
            'target' => '_blank',
            'classes' => $opts['xuanmedia_btnc_maps_mobile'] . ' ' . $opts['xuanmedia_btnc_maps_desktop'],
            'icon' => 'assets/images/maps.svg',
        ],
    ];

    echo '<div class="xuanmedia_btnc_contact-btn">';

    foreach ($contacts as $key => $data) {
        // Chỉ hiển thị nếu có giá trị (số điện thoại, link zalo...).
        if (!empty($data['value'])) {
            if ($key === 'telephone') {
                $telephones = explode(',', $data['value']);
                $telephones = array_map('trim', $telephones);
                $telephones = array_filter($telephones);

                if (count($telephones) > 1) {
                    // Render multiple phones
                    printf(
                        '<div class="xuanmedia_btnc_item-contact xuanmedia_btnc_telephone_multi %1$s">
                            <a href="javascript:void(0);" title="%3$s" class="xuanmedia_btnc_toggle_phone">
                                <img src="%6$s" alt="%3$s" class="xuanmedia_btnc_wave"/>
                            </a>
                            <ul class="xuanmedia_btnc_phone_list">',
                        esc_attr(trim($data['classes'])),
                        '',
                        esc_attr($data['title']),
                        '',
                        '',
                        esc_url(XUANMEDIA_BTNC_PLUGIN_URL . '/' . $data['icon'])
                    );

                    foreach ($telephones as $phone) {
                        $phone_href = 'tel:' . preg_replace('/\D/', '', $phone);
                        printf(
                            '<li><a href="%1$s"><img src="%3$s" alt="phone" style="width: 18px; height: 18px; margin-right: 10px; vertical-align: middle;" /> %2$s</a></li>',
                            esc_url($phone_href),
                            esc_html($phone),
                            esc_url(XUANMEDIA_BTNC_PLUGIN_URL . '/assets/images/phone-item.svg')
                        );
                    }

                    echo '</ul></div>';
                    continue; // Skip default rendering
                }
            }

            // Dùng printf để code sạch hơn và esc_* để bảo mật.
            printf(
                '<div class="xuanmedia_btnc_item-contact %1$s">
                    <a href="%2$s" title="%3$s" %4$s %5$s>
                        <img src="%6$s" alt="%3$s" class="xuanmedia_btnc_wave"/>
                    </a>
                </div>',
                esc_attr(trim($data['classes'])),
                esc_url($data['href']),
                esc_attr($data['title']),
                $data['rel'] ? 'rel="' . esc_attr($data['rel']) . '"' : '',
                $data['target'] ? 'target="' . esc_attr($data['target']) . '"' : '',
                esc_url(XUANMEDIA_BTNC_PLUGIN_URL . '/' . $data['icon']) // Sử dụng hằng số đã định nghĩa
            );
        }
    }

    echo '</div>';
}


// ===================================================================================
// THÊM CSS (STYLING) VÀO TRANG
// ===================================================================================
/**
 * Thêm các đoạn CSS inline để tùy chỉnh hiển thị của các nút bấm.
 *
 * @since 1.0.0
 * @version 1.1.0 - Tối ưu hóa việc lấy options.
 */
function xuanmedia_btnc_enqueue_styles()
{
    // Tương tự hàm trên, dùng wp_parse_args để lấy tùy chọn vị trí một cách an toàn.
    $options = (array) get_option('xuanmedia_btnc_options');
    $defaults = ['xuanmedia_btnc_position_right' => ''];
    $opts = wp_parse_args($options, $defaults);

    // Đăng ký một "style handle" rỗng để có thể đính kèm CSS inline vào đó.
    wp_register_style('xuanmedia-btnc-style', false);
    wp_enqueue_style('xuanmedia-btnc-style');

    $is_right = !empty($opts['xuanmedia_btnc_position_right']);
    $position = $is_right ? 'right: 20px;' : 'left: 20px;';

    // Xử lý vị trí popup dựa trên vị trí nút (Trái hoặc Phải)
    if ($is_right) {
        $popup_pos = 'right: 0; left: auto; transform: translateY(10px);';
        $popup_hover = 'transform: translateY(0);';
        $arrow_pos = 'right: 17px; left: auto; transform: none;'; // 50px/2 - 8px = 17px
    } else {
        $popup_pos = 'left: 0; right: auto; transform: translateY(10px);';
        $popup_hover = 'transform: translateY(0);';
        $arrow_pos = 'left: 17px; right: auto; transform: none;';
    }

    // Toàn bộ CSS inline, giúp người dùng không cần chỉnh sửa file CSS.
    $custom_css = "
        @keyframes button-contact-animate {
            0% { transform: rotate(0) scale(1); }
            10% { transform: rotate(-25deg) scale(1); }
            20% { transform: rotate(25deg) scale(1); }
            30% { transform: rotate(-25deg) scale(1); }
            40% { transform: rotate(25deg) scale(1); }
            50% { transform: rotate(0) scale(1); }
            100% { transform: rotate(0) scale(1); }
        }
        @keyframes xuanmedia_btnc_pulse_animate {
            0% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.3); }
            70% { box-shadow: 0 0 0 15px rgba(0, 123, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0); }
        }
        .xuanmedia_btnc_contact-btn {
            position: fixed;
            bottom: 25px;
            {$position}
            z-index: 999;
        }
        .xuanmedia_btnc_item-contact {
            margin-top: 15px;
            /* animation: button-contact-animate 1.5s ease-in-out infinite; */
        }
        .xuanmedia_btnc_item-contact a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            position: relative; /* Để định vị ::before */
        }
        .xuanmedia_btnc_item-contact a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            z-index: -1;
            animation: xuanmedia_btnc_pulse_animate 2s infinite;
        }
        .xuanmedia_btnc_wave {
            width: 30px;
            height: 30px;
            /* animation: xuanmedia_btnc_wave_animate 1s linear infinite; */
        }

        /* Logic hiển thị trên Desktop và Mobile */
        .xuanmedia_btnc_contact-btn .xuanmedia_btnc_item-contact { display: none; }
        .xuanmedia_btnc_contact-btn .xuanmedia_btnc_item-contact.desktop { display: block; }
        
        @media (max-width: 767px) {
            .xuanmedia_btnc_contact-btn .xuanmedia_btnc_item-contact { display: none !important; }
            .xuanmedia_btnc_contact-btn .xuanmedia_btnc_item-contact.mobile { display: block !important; }
            .xuanmedia_btnc_contact-btn { bottom: 15px; }
        }

        /* Styles for multiple phone numbers */
        .xuanmedia_btnc_telephone_multi {
            position: relative;
        }
        .xuanmedia_btnc_phone_list {
            width: max-content;
            visibility: hidden;
            opacity: 0;
            position: absolute;
            bottom: 70px;
            {$popup_pos}
            background: #fff;
            padding: 0; /* Bỏ padding để overflow hidden hoạt động tốt với border-radius */
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
            list-style: none;
            margin: 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            overflow: hidden; /* Bo góc cho các item bên trong */
        }
        /* Tạo cầu nối trong suốt */
        .xuanmedia_btnc_phone_list::before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            height: 20px;
            background: transparent;
        }
        /* Mũi tên chỉ xuống */
        .xuanmedia_btnc_phone_list::after {
            content: '';
            position: absolute;
            bottom: -8px;
            {$arrow_pos}
            border-width: 8px 8px 0;
            border-style: solid;
            border-color: #fff transparent transparent transparent;
        }
        .xuanmedia_btnc_telephone_multi:hover .xuanmedia_btnc_phone_list {
            visibility: visible;
            opacity: 1;
            {$popup_hover}
        }
        .xuanmedia_btnc_phone_list li {
            margin: 0;
            border-bottom: 1px solid #f5f5f5;
        }
        .xuanmedia_btnc_phone_list li:last-child {
            border-bottom: none;
        }
        .xuanmedia_btnc_phone_list li a {
            display: block;
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            padding: 12px 15px;
            width: 100% !important;
            height: auto !important;
            background: #fff !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            animation: none !important;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }
        .xuanmedia_btnc_phone_list li a:hover {
            background: #f0f7ff !important;
            color: #007bff;
        }
    ";

    // Gắn CSS vào handle đã đăng ký ở trên.
    wp_add_inline_style('xuanmedia-btnc-style', $custom_css);
}

// ===================================================================================
// NẠP FILE QUẢN LÝ TRONG ADMIN
// Chỉ nạp code cho trang admin khi thực sự cần thiết, giúp tối ưu hiệu suất.
// ===================================================================================
if (is_admin()) {
    require_once(XUANMEDIA_BTNC_PLUGIN_DIR . '/admin/admin.php');
}