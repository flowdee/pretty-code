<?php
/**
 * Scripts
 *
 * @package     PrettyCode\Scripts
 * @since       1.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Load admin scripts
 *
 * @since       1.0.0
 * @global      string $post_type The type of post that we are editing
 * @return      void
 */
function pretty_code_admin_scripts( $hook ) {

    // Use minified libraries if SCRIPT_DEBUG is turned off
    $suffix = ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ) ? '' : '.min';

    /**
     *	Settings page only
     */
    $screen = get_current_screen();

    if ( ! empty( $screen->base ) && ( $screen->base == 'settings_page_pretty_code' || $screen->base == 'widgets' ) ) {

        wp_enqueue_script( 'pretty_code_admin_js', PRETTY_CODE_URL . '/assets/js/admin' . $suffix . '.js', array( 'jquery' ), PRETTY_CODE_VER );
        wp_enqueue_style( 'pretty_code_admin_css', PRETTY_CODE_URL . '/assets/css/admin' . $suffix . '.css', false, PRETTY_CODE_VER );
    }
}
add_action( 'admin_enqueue_scripts', 'pretty_code_admin_scripts', 100 );

/**
 * Load frontend scripts
 *
 * @since       1.0.0
 * @return      void
 */
function pretty_code_scripts( $hook ) {

    // Use minified libraries if SCRIPT_DEBUG is turned off
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    //wp_enqueue_script( 'pretty_code_scripts', PRETTY_CODE_URL . 'assets/js/scripts' . $suffix . '.js', array( 'jquery' ), PRETTY_CODE_VER, true );
    //wp_enqueue_style( 'pretty_code_styles', PRETTY_CODE_URL . 'assets/css/styles' . $suffix . '.css', false, PRETTY_CODE_VER );

    wp_enqueue_style( 'pretty_code_cdn_styles', 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css', false, PRETTY_CODE_VER );

    wp_enqueue_script( 'pretty_code_cdn_scripts', 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js', array( 'jquery' ), PRETTY_CODE_VER, true );

}
add_action( 'wp_enqueue_scripts', 'pretty_code_scripts' );