<?php

function xuanmedia_btnc_options_page_html()
{
    $options = (array) get_option('xuanmedia_btnc_options');
    $defaults = [
        'xuanmedia_btnc_zalo' => '',
        'xuanmedia_btnc_zalo_mobile' => '',
        'xuanmedia_btnc_zalo_desktop' => '',
        'xuanmedia_btnc_messenger' => '',
        'xuanmedia_btnc_messenger_mobile' => '',
        'xuanmedia_btnc_messenger_desktop' => '',
        'xuanmedia_btnc_telephone' => '',
        'xuanmedia_btnc_telephone_mobile' => '',
        'xuanmedia_btnc_telephone_desktop' => '',
        'xuanmedia_btnc_maps' => '',
        'xuanmedia_btnc_maps_mobile' => '',
        'xuanmedia_btnc_maps_desktop' => '',
        'xuanmedia_btnc_position_right' => 0,
    ];
    $options = wp_parse_args($options, $defaults);

    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_GET['settings-updated'])) {
        add_settings_error('xuanmedia_btnc_messages', 'xuanmedia_btnc_message', __('Settings Saved', 'xuanmedia-btnc'), 'updated');
    }
    settings_errors('xuanmedia_btnc_messages');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div style="padding-bottom: 20px;">
            <strong>Xuân Media</strong> tự hào là đối tác đáng tin cậy trong lĩnh vực marketing, chuyên cung cấp các giải
            pháp toàn diện như SEO tổng thể, dịch vụ phòng marketing thuê ngoài, và tư vấn xây dựng kênh social (Fanpage,
            TikTok).
            <br />
            Với sứ mệnh tối đa hóa doanh thu và xây dựng thương hiệu bền vững cho khách hàng, chúng tôi cam kết mang lại
            hiệu quả vượt mong đợi qua đội ngũ chuyên gia giàu kinh nghiệm, quy trình bài bản và minh bạch.
            <br />
            Thành công của Xuân Media được minh chứng qua việc triển khai hơn 50+ dự án SEO giúp khách hàng tăng trưởng
            doanh thu từ 30%-50% chỉ trong 6 tháng, xây dựng kênh TikTok đạt hàng ngàn lượt theo dõi và quản lý Fanpage với
            hàng triệu tương tác mỗi tháng. Hãy để Xuân Media đồng hành cùng bạn trên hành trình bứt phá doanh số và nâng
            tầm thương hiệu! <br>
        </div>
        <div style="padding-bottom: 20px;">
            Website:
            <strong style="font-size: 16px">
                <a href="https://xuan.media">Xuân Media</a>
            </strong>
        </div>
        <form action="options.php" method="post">
            <table>
                <tbody>
                    <tr style="padding-bottom: 20px;">
                        <td>
                            <strong>
                                Link Zalo
                            </strong>
                        </td>
                        <td>
                            <input type="text" name="xuanmedia_btnc_options[xuanmedia_btnc_zalo]"
                                value="<?php echo esc_attr($options['xuanmedia_btnc_zalo']); ?>" style="width: 450px;"
                                placeholder="https://zalo.me/...">
                            <?php
                            if (!isset($options['xuanmedia_btnc_zalo_mobile']))
                                $options['xuanmedia_btnc_zalo_mobile'] = '';
                            $html = 'Mobile <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_zalo_mobile]" value="mobile"' . checked('mobile', $options['xuanmedia_btnc_zalo_mobile'], false) . '/>';
                            echo $html;
                            ?>
                            <?php
                            if (!isset($options['xuanmedia_btnc_zalo_desktop']))
                                $options['xuanmedia_btnc_zalo_desktop'] = '';
                            $html = 'Desktop <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_zalo_desktop]" value="desktop"' . checked('desktop', $options['xuanmedia_btnc_zalo_desktop'], false) . '/>';
                            echo $html;
                            ?>
                        </td>

                    </tr>
                    <tr style="padding-bottom: 20px;">
                        <td>
                            <strong>
                                Link Maps
                            </strong>
                        </td>
                        <td>
                            <input type="text" name="xuanmedia_btnc_options[xuanmedia_btnc_maps]"
                                value="<?php echo esc_attr($options['xuanmedia_btnc_maps']); ?>" style="width: 450px;"
                                placeholder="https://goo.gl/maps/...">
                            <?php
                            if (!isset($options['xuanmedia_btnc_maps_mobile']))
                                $options['xuanmedia_btnc_maps_mobile'] = '';
                            $html = 'Mobile <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_maps_mobile]" value="mobile"' . checked('mobile', $options['xuanmedia_btnc_maps_mobile'], false) . '/>';
                            echo $html;
                            ?>
                            <?php
                            if (!isset($options['xuanmedia_btnc_maps_desktop']))
                                $options['xuanmedia_btnc_maps_desktop'] = '';
                            $html = 'Desktop <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_maps_desktop]" value="desktop"' . checked('desktop', $options['xuanmedia_btnc_maps_desktop'], false) . '/>';
                            echo $html;
                            ?>
                        </td>
                    </tr>
                    <tr style="padding-bottom: 20px;">
                        <td>
                            <strong>
                                Link Messenger
                            </strong>
                        </td>
                        <td>
                            <input type="text" name="xuanmedia_btnc_options[xuanmedia_btnc_messenger]"
                                value="<?php echo esc_attr($options['xuanmedia_btnc_messenger']); ?>" style="width: 450px;"
                                placeholder="https://m.me/...">
                            <?php
                            if (!isset($options['xuanmedia_btnc_messenger_mobile']))
                                $options['xuanmedia_btnc_messenger_mobile'] = '';
                            $html = 'Mobile <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_messenger_mobile]" value="mobile"' . checked('mobile', $options['xuanmedia_btnc_messenger_mobile'], false) . '/>';
                            echo $html;
                            ?>
                            <?php
                            if (!isset($options['xuanmedia_btnc_messenger_desktop']))
                                $options['xuanmedia_btnc_messenger_desktop'] = '';
                            $html = 'Desktop <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_messenger_desktop]" value="desktop"' . checked('desktop', $options['xuanmedia_btnc_messenger_desktop'], false) . '/>';
                            echo $html;
                            ?>
                        </td>
                    </tr>
                    <tr style="padding-bottom: 20px;">
                        <td>
                            <strong>
                                Số điện thoại
                            </strong>
                        </td>
                        <td>
                            <input type="text" name="xuanmedia_btnc_options[xuanmedia_btnc_telephone]"
                                value="<?php echo esc_attr($options['xuanmedia_btnc_telephone']); ?>" style="width: 450px;"
                                placeholder="0999999999, 0888888888">
                            <?php
                            if (!isset($options['xuanmedia_btnc_telephone_mobile']))
                                $options['xuanmedia_btnc_telephone_mobile'] = '';
                            $html = 'Mobile <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_telephone_mobile]" value="mobile"' . checked('mobile', $options['xuanmedia_btnc_telephone_mobile'], false) . '/>';
                            echo $html;
                            ?>
                            <?php
                            if (!isset($options['xuanmedia_btnc_telephone_desktop']))
                                $options['xuanmedia_btnc_telephone_desktop'] = '';
                            $html = 'Desktop <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_telephone_desktop]" value="desktop"' . checked('desktop', $options['xuanmedia_btnc_telephone_desktop'], false) . '/>';
                            echo $html;
                            ?>
                        </td>
                    </tr>
                    <tr style="padding-bottom: 10px;">
                        <td>
                            <strong>
                                Đặt bên phải
                            </strong>
                        </td>
                        <td>
                            <?php
                            if (!isset($options['xuanmedia_btnc_position_right']))
                                $options['xuanmedia_btnc_position_right'] = 0;
                            $html = '<input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_position_right]" value="1"' . checked(1, $options['xuanmedia_btnc_position_right'], false) . '/>';
                            echo $html;
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
            settings_fields('xuanmedia-btnc');
            submit_button(__('Save Settings', 'xuanmedia-btnc'));
            ?>
        </form>
        <div>
            <img src="<?php echo plugin_dir_url(XUANMEDIA_BTNC_PLUGIN_BASENAME) . 'assets/images/xuanmedia.webp' ?>" alt="">
        </div>
    </div>
    <?php
}