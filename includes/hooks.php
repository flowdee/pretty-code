<?php
/**
 * Hooks
 *
 * @package     PrettyCode\Hooks
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Init code plugin functionality
 */
function pretty_code_load_base_styles() {

    ?>
    <style type="text/css">
        pre { padding: 0; border: none; outline: none; box-shadow: none; }
    </style>
    <?php
}
add_action( 'wp_head', 'pretty_code_load_base_styles' );

/**
 * Init code plugin functionality
 */
function pretty_code_init() {


    ?>
    <script type="text/javascript">

        jQuery(document).ready(function($) {

            hljs.configure( { useBR: false } );

            $('code').each(function(i, block) {
                hljs.highlightBlock(block);
            });

        });

        //hljs.initHighlightingOnLoad();
    </script>
    <?php
}
add_action( 'wp_footer', 'pretty_code_init', 100 );