<?php
/*
 * Created on Thu Aug 10 2023
 * Author: Connor Doman
 */

/**
 * Block init code provided by:
 * https://iamtimsmith.com/blog/custom-gutenberg-blocks-with-react-and-wordpress-part-1/
 */

/**
 * Enqueue custom blocks
 */
function custom_block_scripts()
{
    wp_enqueue_script(
        'custom-block-scripts',
        get_template_directory_uri() . '/dist/js/blocks.js',
        [
            'wp-blocks',
            'wp-components',
            'wp-element',
            'wp-i18n',
            'wp-editor'
        ],
        '1.0.0',
        true
    );

    // Inform WordPress that we're registering a block
    register_block_type('csek-rebrand/blocks', [
        'editor_script' => 'custom-block-scripts',
    ]);
}
add_action('enqueue_block_assets', 'custom_block_scripts');
