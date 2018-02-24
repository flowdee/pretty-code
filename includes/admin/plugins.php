<?php
/**
 * Settings
 *
 * @package     PluginName\Admin\Plugins
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Plugins row action links
 *
 * @param array $links already defined action links
 * @param string $file plugin file path and name being processed
 * @return array $links
 */
function pretty_code_action_links( $links, $file ) {

    $settings_link = '<a href="' . admin_url( 'options-general.php?page=pretty_code' ) . '">' . esc_html__( 'Settings', 'pretty-code' ) . '</a>';

    if ( $file == 'pretty-code/pretty-code.php' )
        array_unshift( $links, $settings_link );

    return $links;
}
add_filter( 'plugin_action_links', 'pretty_code_action_links', 10, 2 );

/**
 * Plugin row meta links
 *
 * @param array $input already defined meta links
 * @param string $file plugin file path and name being processed
 * @return array $input
 */
function pretty_code_row_meta( $input, $file ) {

    if ( $file != 'pretty-code/pretty-code.php' )
        return $input;

    $custom_link = esc_url( add_query_arg( array(
            'utm_source'   => 'plugins-page',
            'utm_medium'   => 'plugin-row',
            'utm_campaign' => 'Pretty Code',
        ), 'https://pretty-code.com/' )
    );

    $links = array(
        '<a href="' . $custom_link . '">' . esc_html__( 'Example Link', 'plugin-name' ) . '</a>',
    );

    $input = array_merge( $input, $links );

    return $input;
}
add_filter( 'plugin_row_meta', 'pretty_code_row_meta', 10, 2 );