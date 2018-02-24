<?php
/**
 * Helper
 *
 * @package     PluginName\Helper
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Public assets folder
 */
function pretty_code_the_assets() {
    echo PRETTY_CODE_URL . 'assets';
}

/*
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

