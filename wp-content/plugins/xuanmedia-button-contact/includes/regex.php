<?php

function xuanmedia_btnc_sanitize_options($input)
{
    $output = [];

    if (isset($input['xuanmedia_btnc_telephone'])) {
        $telephones = explode(',', $input['xuanmedia_btnc_telephone']);
        $valid_telephones = [];
        $regex = '/^(0|\+84)((3|5|7|8|9)\d{8}|2\d{9})$/';

        foreach ($telephones as $telephone) {
            $telephone = trim($telephone);
            if (empty($telephone))
                continue;

            if (preg_match($regex, $telephone)) {
                $valid_telephones[] = sanitize_text_field($telephone);
            } else {
                add_settings_error(
                    'xuanmedia_btnc_messages',
                    'invalid_telephone',
                    sprintf(__('Số điện thoại %s không hợp lệ. Vui lòng nhập đúng định dạng.', 'xuanmedia-btnc'), $telephone),
                    'error'
                );
            }
        }
        $output['xuanmedia_btnc_telephone'] = implode(', ', $valid_telephones);
    }

    if (isset($input['xuanmedia_btnc_zalo'])) {
        $output['xuanmedia_btnc_zalo'] = sanitize_text_field($input['xuanmedia_btnc_zalo']);
    }

    if (isset($input['xuanmedia_btnc_position_right'])) {
        $output['xuanmedia_btnc_position_right'] = sanitize_text_field($input['xuanmedia_btnc_position_right']);
    }

    if (isset($input['xuanmedia_btnc_messenger'])) {
        $output['xuanmedia_btnc_messenger'] = sanitize_text_field($input['xuanmedia_btnc_messenger']);
    }

    if (isset($input['xuanmedia_btnc_zalo_mobile'])) {
        $output['xuanmedia_btnc_zalo_mobile'] = sanitize_text_field($input['xuanmedia_btnc_zalo_mobile']);
    }
    if (isset($input['xuanmedia_btnc_zalo_desktop'])) {
        $output['xuanmedia_btnc_zalo_desktop'] = sanitize_text_field($input['xuanmedia_btnc_zalo_desktop']);
    }
    if (isset($input['xuanmedia_btnc_messenger_mobile'])) {
        $output['xuanmedia_btnc_messenger_mobile'] = sanitize_text_field($input['xuanmedia_btnc_messenger_mobile']);
    }
    if (isset($input['xuanmedia_btnc_messenger_desktop'])) {
        $output['xuanmedia_btnc_messenger_desktop'] = sanitize_text_field($input['xuanmedia_btnc_messenger_desktop']);
    }
    if (isset($input['xuanmedia_btnc_telephone_mobile'])) {
        $output['xuanmedia_btnc_telephone_mobile'] = sanitize_text_field($input['xuanmedia_btnc_telephone_mobile']);
    }
    if (isset($input['xuanmedia_btnc_telephone_desktop'])) {
        $output['xuanmedia_btnc_telephone_desktop'] = sanitize_text_field($input['xuanmedia_btnc_telephone_desktop']);
    }
    if (isset($input['xuanmedia_btnc_maps'])) {
        $output['xuanmedia_btnc_maps'] = sanitize_text_field($input['xuanmedia_btnc_maps']);
    }
    if (isset($input['xuanmedia_btnc_maps_mobile'])) {
        $output['xuanmedia_btnc_maps_mobile'] = sanitize_text_field($input['xuanmedia_btnc_maps_mobile']);
    }
    if (isset($input['xuanmedia_btnc_maps_desktop'])) {
        $output['xuanmedia_btnc_maps_desktop'] = sanitize_text_field($input['xuanmedia_btnc_maps_desktop']);
    }

    return $output;
}
