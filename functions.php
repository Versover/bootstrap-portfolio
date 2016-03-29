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
 * 2. Theme Setup
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

/**
 * 3. Get post meta
 */
if ( ! function_exists( 'versover_post_meta' ) ) {
    function versover_post_meta() {
        if ( get_post_type() === 'post' ) {
            /* Post author */
            echo '<p class="post-meta">';
            _e( 'by ', 'versover' );
            printf( '<a href="%1$s">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
            _e( ' on ', 'versover' );
            echo ' <span>' . get_the_date() . '</span></p>';
        }
    }
}

/**
 * 4. Numbered pagination
 */
if ( ! function_exists( 'versover_numbered_pagination' ) ) {
    function versover_numbered_pagination() {
        $args = array(
            'prev_next' => false,
            'type'      => 'array',
        );

        echo '<div class="col-md-12">';
        $pagination = paginate_links( $args );

        if ( is_array( $pagination ) ) {
            echo '<ul class="nav nav-pills">';

            foreach ( $pagination as $page ) {
                if ( strpos( $page, 'current') ) {
                    echo '<li class="active"><a href="#">' . $page . '</a></li>';
                } else {
                    echo '<li>'. $page . '</li>';
                }
            }

            echo '</ul>';
        }

        echo '</div>';
    }
}

/**
 * 5. Register widget areas
 */
if ( ! function_exists( 'versover_widget_init' ) ) {
    function versover_widget_init() {
        if ( function_exists( 'register_sidebar' ) ) {
            register_sidebar( array(
                'name'          => __( 'Main Widget Areas', 'versover' ),
                'id'            => 'main-sidebar',
                'description'   => __( 'Areas in the blog pages.', 'versover' ),
                'before_widget' => '<div id="%1$s" class="%2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2>',
                'after_title'   => '</h2>',
            ) );
        }
    }

    add_action( 'widgets_init', 'versover_widget_init' );
}

/**
 * 6. Scripts
 */
if ( ! function_exists( 'versover_scripts' ) ) {
    function versover_scripts() {
        /* Register scripts */
        wp_register_script( 'modernizr-js', JS . '/vendor/modernizr-2.6.2.min.js', false, false, false );
        wp_register_script( 'bootstrap-js', THEMEROOT . '/bower_components/bootstrap/dist/js/bootstrap.min.js', array( 'jquery' ), false, true );
        wp_register_script( 'isotope-js', THEMEROOT . '/bower_components/isotope/dist/isotope.pkgd.min.js', false, false, true );
        wp_register_script( 'plugins-js', JS . '/plugins.js', false, false, true );
        wp_register_script( 'main-js', JS . '/main.js', false, false, true );

        /* Load custom scripts */
        wp_enqueue_script( 'modernizr-js' );
        wp_enqueue_script( 'bootstrap-js' );
        wp_enqueue_script( 'isotope-js' );
        wp_enqueue_script( 'plugins-js' );
        wp_enqueue_script( 'main-js' );

        /* Load stylesheets */
        wp_enqueue_style( 'bootstrap-css', THEMEROOT  . '/bower_components/bootstrap/dist/css/bootstrap.min.css' );
        wp_enqueue_style( 'main-css', THEMEROOT  . '/css/style.css' );
    }

    add_action( 'wp_enqueue_scripts', 'versover_scripts' );
}

/**
 * 7. Widgets
 */
require_once get_template_directory() . '/include/widgets/widget-recent-projects.php';
