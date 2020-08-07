<?php


    function load_stylesheets() {

        wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css', array(), 'all');
        wp_enqueue_style('bootstrap');

        wp_register_style('style', get_template_directory_uri() . '/css/style.css', array(), 'all');
        wp_enqueue_style('style');

        wp_register_style('cafe_style', get_template_directory_uri() . '/css/cafe_style.css', array(), 'all');
        wp_enqueue_style('cafe_style');

        wp_register_style('custom', get_template_directory_uri() . '/custom.css', array(), 'all');
        wp_enqueue_style('custom');
    }
    add_action('wp_enqueue_scripts', 'load_stylesheets');


/*
    ============================================================================
        LOAD SCRIPTS
    ============================================================================
*/
    function load_scripts() {
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', array(), 1, 1, 1);
        wp_enqueue_script('jquery');

        wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), 1, 1, 1);
        wp_enqueue_script('popper');

        wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', array(), 1, 1, 1);
        wp_enqueue_script('bootstrap');

        wp_register_script('main', get_template_directory_uri() . '/js/main.js', array(), 1, 1, 1);
        wp_enqueue_script('main');

        wp_register_script('cafe_main', get_template_directory_uri() . '/js/cafe_main.js', array(), 1, 1, 1);
        wp_enqueue_script('cafe_main');

        wp_register_script('custom', get_template_directory_uri() . '/custom.js', array(), 1, 1, 1);
        wp_enqueue_script('custom');
    }
    add_action('wp_enqueue_scripts', 'load_scripts');



/*
    ============================================================================
        ADD SUPPORTS
    ============================================================================
*/

    // MENU
    add_theme_support('menus');

    register_nav_menus(
        array(
            'top_menu' => __('Top Menu', 'irimas'),
            'main_menu' => __('Main Menu', 'irimas'),
            'footer_menu' => __('Footer Menu', 'irimas'),
        )
    );


    // LOGO
    // add_theme_support('custom-logo');

    function themename_custom_logo_setup() {
        $defaults = array(
        'height'      => 40,
        'flex-height' => false,
        'flex-width'  => true,
        );
        add_theme_support( 'custom-logo', $defaults );
    }
    add_action( 'after_setup_theme', 'themename_custom_logo_setup' );


    // THUMBNAILS
    add_theme_support('post-thumbnails'); 






/*
    ============================================================================
        INCLUDE WALKER
    ============================================================================
*/

    require get_template_directory() . '/inc/walker.php';






?>