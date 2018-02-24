<?php
/**
 * Shortcodes
 *
 * @package     PrettyCode\Shortcodes
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Empty paragraph fix for certain shortcodes
 */
function pretty_code_cleanup_shortcode_output( $content ) {

    // array of custom shortcodes requiring the fix
    $block = join("|",array(
        'code', 'pretty_code',
    ) );

    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

    return $rep;
}
add_filter("the_content", 'pretty_code_cleanup_shortcode_output' );

/**
 * Register Shortcode
 *
 * @param $atts
 * @param string $content
 * @return string
 */
function pretty_code_add_shortcode( $atts, $content = "" ) {

    $lang = ( ! empty( $atts['lang'] ) ) ? sanitize_text_field( $atts['lang'] ) : false;

    //$content = str_replace( array( '<p></p>', '' ), '', $content );
    //$content = str_replace( array( '<p><code>', '<code>' ), '', $content );
    //$content = str_replace( array( '</code></p>', '</code>' ), '', $content );

    $code_opening_tag = ( $lang ) ? '<code class="' . esc_html( $lang ) . '">' : '<code>';
    $code_closing_tag = '</code>';

    $wrapper_opening_tag = '<pre>';
    $wrapper_closing_tag = '</pre>';

    return $wrapper_opening_tag . $code_opening_tag . $content . $code_closing_tag . $wrapper_closing_tag;
}
add_shortcode( 'pretty_code', 'pretty_code_add_shortcode' );
add_shortcode( 'code', 'pretty_code_add_shortcode' );


add_shortcode( 'pretty_code_dev', function() {

    ob_start();

    ?>
    <code>
        @font-face {
            font-family: Chunkfive; src: url('Chunkfive.otf');
        }

        body, .usertext {
            color: #F0F0F0; background: #600;
            font-family: Chunkfive, sans;
        }

        @import url(print.css);

        @media print {
            a[href^=http]::after {
            content: attr(href)
        }
        }
    </code>
    <?php
    $str = ob_get_clean();

    return $str;
});