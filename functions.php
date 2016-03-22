<?php
/**
 * functions.php
 *
 * The themes function's
 */

/**
 * 1. Constants
 */
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/img' );
define( 'JS', THEMEROOT . '/js' );

/**
 * 1. Theme Setup
 */
if ( ! function_exists( 'versover_theme_setup' ) ) {
    function versover_theme_setup() {
        // make theme available for translation
        $lang_dir = THEMEROOT . '/languages';
        load_theme_textdomain( 'versover', $lang_dir );

        // add support for automatic feed links
        add_theme_support( 'automatic-feed-links' );

        // add support for post thumbnails
        add_theme_support( 'post-thumbnails' );

        // register nav menus
        register_nav_menus( array(
            'main-menu' => __( 'Main menu', 'versover' )
        ) );
    }

    add_action( 'after_setup_theme',  'versover_theme_setup');
}
