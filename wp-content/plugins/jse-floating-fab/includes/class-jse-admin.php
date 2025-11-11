<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

class JSE_FAB_Admin {

    private $option_name = 'jse_fab_options';

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    public function add_plugin_page() {
        add_options_page(
            'Floating Button Settings', 
            'Floating Button (JSE)', 
            'manage_options', 
            'jse-fab-settings', 
            array( $this, 'create_admin_page' )
        );
    }

    public function create_admin_page() {
        ?>
        <div class="wrap">
            <h1>Floating Contact Button Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'jse_fab_option_group' );
                do_settings_sections( 'jse-fab-settings' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function page_init() {
        register_setting(
            'jse_fab_option_group', 
            $this->option_name, 
            array( $this, 'sanitize' ) 
        );

        add_settings_section(
            'jse_fab_main_section',
            'Contact Channels & Configuration',
            array( $this, 'section_info' ),
            'jse-fab-settings'
        );

        // List fields with label and placeholder
        $fields = [
            'phone'     => ['label' => 'Phone Number', 'placeholder' => 'e.g. +84987...', 'type' => 'tel'],
            'zalo'      => ['label' => 'Zalo Link',    'placeholder' => 'https://zalo.me/...', 'type' => 'url'],
            'messenger' => ['label' => 'Messenger Link','placeholder' => 'https://m.me/...', 'type' => 'url'],
            'whatsapp'  => ['label' => 'WhatsApp Link','placeholder' => 'https://wa.me/...', 'type' => 'url'],
            'telegram'  => ['label' => 'Telegram Link','placeholder' => 'https://t.me/...', 'type' => 'url'],
        ];

        foreach ( $fields as $key => $info ) {
            add_settings_field(
                $key, 
                $info['label'], 
                array( $this, 'render_contact_input' ), 
                'jse-fab-settings', 
                'jse_fab_main_section',
                ['key' => $key, 'placeholder' => $info['placeholder'], 'type' => $info['type']]
            );
        }

        // Position Setting
        add_settings_field(
            'position', 
            'Position', 
            array( $this, 'render_position' ), 
            'jse-fab-settings', 
            'jse_fab_main_section'
        );
    }

    public function sanitize( $input ) {
        $new_input = array();
        $keys = ['phone', 'zalo', 'messenger', 'whatsapp', 'telegram'];
        
        foreach ( $keys as $key ) {
            // Sanitize Value
            if( isset( $input[$key] ) ) $new_input[$key] = sanitize_text_field( $input[$key] );
            
            // Sanitize Visibility setting for this key
            $vis_key = $key . '_vis';
            if( isset( $input[$vis_key] ) ) {
                $new_input[$vis_key] = in_array($input[$vis_key], ['all', 'mobile', 'desktop']) ? $input[$vis_key] : 'all';
            } else {
                $new_input[$vis_key] = 'all';
            }
        }

        $new_input['position'] = ( isset($input['position']) && in_array($input['position'], ['left', 'right']) ) ? $input['position'] : 'right';
        
        return $new_input;
    }

    public function section_info() {
        echo 'Enter your contact details below. Leave a field empty to hide the button. You can also choose where each button should appear.';
    }

    // Render Helper: Combines Input + Visibility Select
    public function render_contact_input( $args ) {
        $options = get_option( $this->option_name );
        $key = $args['key'];
        $value = isset( $options[$key] ) ? $options[$key] : '';
        
        // Visibility Value
        $vis_key = $key . '_vis';
        $vis_val = isset( $options[$vis_key] ) ? $options[$vis_key] : 'all';

        ?>
        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <input type="<?php echo $args['type']; ?>" 
                   name="<?php echo $this->option_name . '[' . $key . ']'; ?>" 
                   value="<?php echo esc_attr( $value ); ?>" 
                   class="regular-text" 
                   placeholder="<?php echo $args['placeholder']; ?>">
            
            <select name="<?php echo $this->option_name . '[' . $vis_key . ']'; ?>" style="max-width: 150px;">
                <option value="all" <?php selected( $vis_val, 'all' ); ?>>Show on All</option>
                <option value="mobile" <?php selected( $vis_val, 'mobile' ); ?>>Mobile Only</option>
                <option value="desktop" <?php selected( $vis_val, 'desktop' ); ?>>Desktop Only</option>
            </select>
        </div>
        <p class="description">Select device visibility for this icon.</p>
        <?php
    }

    public function render_position() {
        $options = get_option( $this->option_name );
        $val = isset( $options['position'] ) ? $options['position'] : 'right';
        ?>
        <select name="<?php echo $this->option_name; ?>[position]">
            <option value="right" <?php selected( $val, 'right' ); ?>>Bottom Right</option>
            <option value="left" <?php selected( $val, 'left' ); ?>>Bottom Left</option>
        </select>
        <?php
    }
}