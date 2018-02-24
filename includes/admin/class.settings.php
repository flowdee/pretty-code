<?php
/**
 * Settings
 *
 * Source: https://codex.wordpress.org/Settings_API
 *
 * @package     PluginName\Settings
 * @since       1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;


if (!class_exists('Pretty_Code_Settings')) {

    class Pretty_Code_Settings
    {
        public $options;

        public function __construct()
        {
            // Options
            $this->options = get_option('pretty_code');

            // Initialize
            add_action('admin_menu', array( &$this, 'add_admin_menu') );
            add_action('admin_init', array( &$this, 'init_settings') );
        }

        function add_admin_menu()
        {
            /*
             * Source: https://codex.wordpress.org/Function_Reference/add_options_page
             */
            add_options_page(
                'Pretty Code', // Page title
                'Pretty Code', // Menu title
                'manage_options', // Capabilities
                'pretty_code', // Menu slug
                array( &$this, 'options_page' ) // Callback
            );

        }

        function init_settings()
        {
            register_setting(
                'pretty_code',
                'pretty_code',
                array( &$this, 'validate_input_callback' )
            );

            // SECTION ONE
            add_settings_section(
                'pretty_code_section_one',
                __('Section One', 'pretty-code'),
               false,
                'pretty_code'
            );

            add_settings_field(
                'pretty_code_text_field_01',
                __('Text Field', 'pretty-code'),
                array(&$this, 'text_field_01_render'),
                'pretty_code',
                'pretty_code_section_one',
                array('label_for' => 'pretty_code_text_field_01')
            );

            add_settings_field(
                'pretty_code_select_field_01',
                __('Select Field', 'pretty-code'),
                array(&$this, 'select_field_01_render'),
                'pretty_code',
                'pretty_code_section_one',
                array('label_for' => 'pretty_code_select_field_01')
            );

            add_settings_field(
                'pretty_code_checkbox_field_01',
                __('Checkbox Field', 'pretty-code'),
                array(&$this, 'checkbox_field_01_render'),
                'pretty_code',
                'pretty_code_section_one',
                array('label_for' => 'pretty_code_checkbox_field_01')
            );

            // SECTION TWO
            add_settings_section(
                'pretty_code_section_two',
                __('Section Two', 'pretty-code'),
                array( &$this, 'section_two_render' ), // Optional you can output a description for each section
                'pretty_code'
            );

            add_settings_field(
                'pretty_code_text_field_02',
                __('Text Field', 'pretty-code'),
                array(&$this, 'text_field_02_render'),
                'pretty_code',
                'pretty_code_section_two',
                array('label_for' => 'pretty_code_text_field_02')
            );

        }

        function validate_input_callback( $input ) {

            /*
             * Here you can validate (and manipulate) the user input before saving to the database
             */

            return $input;
        }

        function section_two_render() {
            ?>

            <p>Section two description...</p>

            <?php
        }

        function text_field_01_render() {

            $text = ( ! empty($this->options['text_01'] ) ) ? esc_attr( trim($this->options['text_01'] ) ) : ''

            ?>
            <input type="text" name="pretty_code[text_01]" id="pretty_code_text_field_01" value="<?php echo esc_attr( trim( $text ) ); ?>" />
            <?php
        }

        function select_field_01_render() {

            $select_options = array(
                '0' => __('Please select...', 'pretty-code'),
                '1' => __('Option One', 'pretty-code'),
                '2' => __('Option Two', 'pretty-code'),
                '3' => __('Option Three', 'pretty-code')
            );

            $selected = ( isset ( $this->options['select_01'] ) ) ? $this->options['select_01'] : '0';

            ?>
            <select id="pretty_code_select_field_01" name="pretty_code[select_01]">
                <?php foreach ( $select_options as $key => $label ) { ?>
                    <option value="<?php echo $key; ?>" <?php selected( $selected, $key ); ?>><?php echo $label; ?></option>
                <?php } ?>
            </select>
            <?php
        }

        function checkbox_field_01_render() {

            $checked = ( isset ( $this->options['checkbox_01'] ) && $this->options['checkbox_01'] == '1' ) ? 1 : 0;
            ?>

                <input type="checkbox" id="pretty_code_checkbox_field_01" name="pretty_code[checkbox_01]" value="1" <?php echo($checked == 1 ? 'checked' : ''); ?> />
                <label for="pretty_code_checkbox_field_01"><?php _e('Activate in order to do some cool stuff.', 'pretty-code'); ?></label>
            <?php
        }

        function text_field_02_render() {

            $text = ( ! empty($this->options['text_02'] ) ) ? esc_attr( trim($this->options['text_02'] ) ) : ''

            ?>
            <input type="text" name="pretty_code[text_02]" id="pretty_code_text_field_02" value="<?php echo esc_attr( trim( $text ) ); ?>" />
            <?php
        }

        function options_page() {
            ?>

            <div class="wrap">
                <?php screen_icon(); ?>
                <h2><?php _e('Pretty Code', 'pretty-code'); ?></h2>

                <?php
                settings_fields( 'pretty_code' );
                do_settings_sections( 'pretty_code' );
                ?>

                <p><?php submit_button( 'Save Changes', 'button-primary', 'submit', false ); ?></p>
            </div>
            <?php
        }
    }
}

new Pretty_Code_Settings();