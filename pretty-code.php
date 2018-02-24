<?php
/**
 * Plugin Name:     Pretty Code
 * Plugin URI:      https://pretty-code.com
 * Description:     Plugin Description.
 * Version:         1.0.0
 * Author:          Your Name
 * Author URI:      https://your-name.com
 * Text Domain:     pretty-code
 *
 * @package         PluginName
 * @author          Your Name
 * @copyright       Copyright (c) Your Name
 *
 *
 * WordPress Plugin Boilerplate
 * Source: https://github.com/flowdee/wordpress-plugin-boilerplate
 *
 * Copyright (c) 2016 - flowdee ( https://twitter.com/flowdee )
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'Pretty_Code' ) ) {

    /**
     * Main Pretty_Code class
     *
     * @since       1.0.0
     */
    class Pretty_Code {

        /**
         * @var         Pretty_Code $instance The one true Pretty_Code
         * @since       1.0.0
         */
        private static $instance;


        /**
         * Get active instance
         *
         * @access      public
         * @since       1.0.0
         * @return      object self::$instance The one true Pretty_Code
         */
        public static function instance() {
            if( !self::$instance ) {
                self::$instance = new Pretty_Code();
                self::$instance->setup_constants();
                self::$instance->includes();
                self::$instance->load_textdomain();
            }

            return self::$instance;
        }


        /**
         * Setup plugin constants
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function setup_constants() {

            // Plugin name
            define( 'PRETTY_CODE_NAME', 'Pretty Code' );

            // Plugin version
            define( 'PRETTY_CODE_VER', '1.0.0' );

            // Plugin path
            define( 'PRETTY_CODE_DIR', plugin_dir_path( __FILE__ ) );

            // Plugin URL
            define( 'PRETTY_CODE_URL', plugin_dir_url( __FILE__ ) );
        }
        
        /**
         * Include necessary files
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function includes() {

            // Basic
            require_once PRETTY_CODE_DIR . 'includes/helper.php';
            require_once PRETTY_CODE_DIR . 'includes/scripts.php';

            // Admin only
            if ( is_admin() ) {
                require_once PRETTY_CODE_DIR . 'includes/admin/plugins.php';
                require_once PRETTY_CODE_DIR . 'includes/admin/class.settings.php';
            }

            // Anything else
            require_once PRETTY_CODE_DIR . 'includes/functions.php';
        }

        /**
         * Internationalization
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function load_textdomain() {
            // Set filter for language directory
            $lang_dir = PRETTY_CODE_DIR . '/languages/';
            $lang_dir = apply_filters( 'pretty_code_languages_directory', $lang_dir );

            // Traditional WordPress plugin locale filter
            $locale = apply_filters( 'plugin_locale', get_locale(), 'pretty-code' );
            $mofile = sprintf( '%1$s-%2$s.mo', 'pretty-code', $locale );

            // Setup paths to current locale file
            $mofile_local   = $lang_dir . $mofile;
            $mofile_global  = WP_LANG_DIR . '/pretty-code/' . $mofile;

            if( file_exists( $mofile_global ) ) {
                // Look in global /wp-content/languages/pretty-code/ folder
                load_textdomain( 'pretty-code', $mofile_global );
            } elseif( file_exists( $mofile_local ) ) {
                // Look in local /wp-content/plugins/pretty-code/languages/ folder
                load_textdomain( 'pretty-code', $mofile_local );
            } else {
                // Load the default language files
                load_plugin_textdomain( 'pretty-code', false, $lang_dir );
            }
        }
    }
} // End if class_exists check

/**
 * The main function responsible for returning the one true Pretty_Code
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \Pretty_Code The one true Pretty_Code
 *
 */
function pretty_code_load() {
    return Pretty_Code::instance();
}
add_action( 'plugins_loaded', 'pretty_code_load' );

/**
 * The activation hook
 */
function pretty_code_activation() {
    // Create your tables here
}
register_activation_hook( __FILE__, 'pretty_code_activation' );

/**
 * The deactivation hook
 */
function pretty_code_deactivation() {
    // Cleanup your tables, transients etc. here
}
register_deactivation_hook(__FILE__, 'pretty_code_deactivation');