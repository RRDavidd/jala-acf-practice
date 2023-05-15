<?php
// Client Functions

// Enqueue scripts.
if ( !is_admin() ) {
    function jdf_theme_styles_scripts() {
        // Fonts
        wp_enqueue_style( 'google-fonts1', 'https://fonts.googleapis.com/css?family=Roboto:400,400i,700', false );
        wp_enqueue_style( 'google-fonts2', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap', false );

        // Styles
        wp_enqueue_style( 'styles', get_stylesheet_uri() );
        wp_enqueue_style( 'style', get_template_directory_uri() . '/stylesheets/css/style.css' );
        wp_enqueue_style( 'print', get_template_directory_uri() . '/stylesheets/css/print.css', array(), false, 'print' );

        // JavaScript
        wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js' );
        wp_enqueue_script( 'headhesive', get_template_directory_uri() . '/js/headhesive.min.js', array( 'jquery' ) );
        wp_enqueue_script( 'lockscroll', get_template_directory_uri() . '/js/lockscroll.js', array( 'jquery' ) );
        wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ) );
        wp_enqueue_script( 'slick-lightbox', get_template_directory_uri() . '/js/slick-lightbox.min.js', array( 'jquery' ) );
        wp_enqueue_script( 'general', get_template_directory_uri() . '/js/general-built.js', array ( 'jquery' ) );
    }
    add_action( 'wp_enqueue_scripts', 'jdf_theme_styles_scripts' );
};

// Register menus.
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'main_menu'     => 'Main Menu',
            'footer_menu'   => 'Footer Menu',
        )
    );
}

// Add ACF options page.
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'  => __( 'Options', 'text_domain' ),
			'menu_title'  => __( 'Options', 'text_domain' ),
			'capability'  => 'manage_options',
		)
	);
}

// Register sidebar.
function jdf_widgets_init() {
    register_sidebar(
        array(
            'name' => __( 'Main Sidebar', 'text_domain' ),
            'id' => 'sidebar-1',
            'description' => __( 'These are widgets for the sidebar.', 'text_domain' ),
            'before_widget' => '<section id="%1$s" class="widget entry %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'jdf_widgets_init' );

// Theme Images
function jdf_image_size_setup() {
    //add_image_size( 'thumbnail_medium', 450, 450, true );
    //add_image_size( 'extra_large', 1600 );
    //add_image_size( 'large_medium', 1000 );
    //add_image_size( 'medium_large', 600, 600, true );  // It has been removed in Jala Core Plugin
    add_image_size( 'medium_small', 450 );
}
add_action( 'after_setup_theme', 'jdf_image_size_setup' );

// Disabling WP Auto generated image sizes
function jdf_remove_default_image_sizes( $sizes ) {
    $removed_sizes = array(
        '1536x1536',
        '2048x2048',
        'medium_large'
    );

    // Loop over the sizes and remove the unneeded sizes.
    foreach ( $sizes as $index => $size ) {
        if ( in_array( $size, $removed_sizes ) ) unset( $sizes[ $index ] );
    }

    return $sizes;
}
add_filter( 'intermediate_image_sizes', 'jdf_remove_default_image_sizes' );

function jdf_disable_default_images() {
    remove_image_size( '1536x1536' );
    remove_image_size( '2048x2048' );
    remove_image_size( 'medium_large' );
}
add_action( 'init', 'jdf_disable_default_images' );

// Unregister the "tags" taxonomy from Posts.
function jdf_unregister_tags() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action( 'init', 'jdf_unregister_tags' );

// Modify default excerpt ellipsis.
add_filter( 'excerpt_more', function() {
    return '...';
});