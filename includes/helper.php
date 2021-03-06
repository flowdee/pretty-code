<?php
/**
 * Helper
 *
 * @package     PrettyCode\Helper
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Public assets folder
 */
function pretty_code_the_assets() {
    echo PRETTY_CODE_URL . 'assets';
}

/**
 * Better debugging
 */
function pretty_code_debug( $args, $title = false ) {

    if ( $title ) {
        echo '<h3>' . $title . '</h3>';
    }

    if ( $args ) {
        echo '<pre>';
        print_r($args);
        echo '</pre>';
    }
}

/**
 * Debug logging
 *
 * @param $message
 */
function pretty_code_debug_log( $message ) {

    if ( WP_DEBUG === true ) {
        if (is_array( $message ) || is_object( $message ) ) {
            error_log( print_r( $message, true ) );
        } else {
            error_log( $message );
        }
    }
}

