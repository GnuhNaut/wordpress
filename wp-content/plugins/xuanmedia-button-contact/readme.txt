


// function xuanmedia_btnc_position_right_cb() {
//     $options = get_option( 'xuanmedia_btnc_options' );    
//     if( !isset( $options['xuanmedia_btnc_position_right'] ) ) $options['xuanmedia_btnc_position_right'] = 0;
//     $html = '<input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_position_right]" value="1"' . checked( 1, $options['xuanmedia_btnc_position_right'], false ) . '/>';
//     echo $html;
// }

// function xuanmedia_btnc_zalo_cb( $args ) {
//     $options = get_option( 'xuanmedia_btnc_options' );
//     ?>
//     <input type="text" name="xuanmedia_btnc_options[xuanmedia_btnc_zalo]" value="<?php echo str_replace('"', '&quot;', $options['xuanmedia_btnc_zalo']); ?>" style="width: 450px;" placeholder="https://zalo.me/...">
//     <?php   
//     if( !isset( $options['xuanmedia_btnc_zalo_mobile'] ) ) $options['xuanmedia_btnc_zalo_mobile'] = '';
//     $html = 'mobile <input type="checkbox" name="xuanmedia_btnc_options[xuanmedia_btnc_zalo_mobile]" value="mobile"' . checked( 'mobile', $options['xuanmedia_btnc_zalo_mobile'], false ) . '/>';
//     echo $html;
// }
// function xuanmedia_btnc_messenger_cb( $args ) {
//     $options = get_option( 'xuanmedia_btnc_options' );
//     ?>
//     <input type="text" name="xuanmedia_btnc_options[xuanmedia_btnc_messenger]" value="<?php echo str_replace('"', '&quot;', $options['xuanmedia_btnc_messenger']); ?>" style="width: 450px;" placeholder="https://m.me/...">
//     <?php
// }
// function xuanmedia_btnc_telephone_cb( $args ) {
//     $options = get_option( 'xuanmedia_btnc_options' );
//     ?>
//     <input type="text" name="xuanmedia_btnc_options[xuanmedia_btnc_telephone]" value="<?php echo str_replace('"', '&quot;', $options['xuanmedia_btnc_telephone']); ?>" style="width: 450px;" placeholder="0999999999">
//     <?php
// }
function xuanmedia_btnc_setting_section_cb( $args ) {
    ?>
   <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( '1. Install your favorite contact form plugin. Tested with Contact Form 7, Ninja Forms & Caldera Forms.', 'xuanmedia-btnc' ); ?></p>
   <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( '2. Generate a form and entering the shortcode into the field. This form will shown in the modal, when the Floating Contact Button is clicked.', 'xuanmedia-btnc' ); ?></p>
   <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( '3. Change the main color of the button (default value: #ff0000).', 'xuanmedia-btnc' ); ?></p>
   <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( '4. Please change the integration mode if there are problems with the theme you are using.', 'xuanmedia-btnc' ); ?></p>
   <?php
}