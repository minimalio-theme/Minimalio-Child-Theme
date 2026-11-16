<?php

// Minimalio Child


//Add Minimalio default styles
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 97 );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; 
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css',
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );

}

//Add child styles
add_action( 'wp_enqueue_scripts', 'my_child_add_stylesheet', 99 );
function my_child_add_stylesheet() {
    wp_enqueue_style( 'my-child-style', get_stylesheet_directory_uri() . '/style.css', false, '1.0', 'all' );
}


//Add child custom styles
add_action( 'wp_enqueue_scripts', 'my_child_add_custom_stylesheet', 98 );
function my_child_add_custom_stylesheet() {
    wp_enqueue_style( 'my-child-custom-style', get_stylesheet_directory_uri() . '/assets/child-styles.css', false, '1.0', 'all' );
}


//Add custom scripts to child theme
add_action( 'wp_enqueue_scripts', 'my_scripts_child_theme' );
function my_scripts_child_theme() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/assets/child-script.js',
        array( 'jquery' )
    );
}

//Allow SVG
function enable_svg_upload( $upload_mimes ) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload', 10, 1 );