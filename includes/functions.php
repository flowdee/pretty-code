<?php
/**
 * Functions
 *
 * @package     PluginName\Functions
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get options
 *
 * return array options or empty when not available
 */
function pretty_code_get_options() {
    return get_option( 'pretty_code', array() );
}

/**
 * Example function which uses your settings
 */
function pretty_code_my_first_function() {

    // Using the plugin option on any place
    $options = pretty_code_get_options();

    if ( isset( $options['select_01'] ) ) {
        echo $options['select_01'];
    }
}