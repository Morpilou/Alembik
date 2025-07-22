<?php
//--------------------------------------------------------------
//* Load script 
//--------------------------------------------------------------

function load_theme_scripts() {
  // CSS
  wp_register_style('style.css', get_stylesheet_uri() );
  wp_register_style('theme', get_template_directory_uri() . '/dist/theme.css' );
  wp_register_style('tailwind-output', get_template_directory_uri() . '/src/output.css' );
  wp_register_style('custom-login', get_stylesheet_directory_uri() . '/app/components/style-login.css' );

  wp_enqueue_style('style.css');
  wp_enqueue_style('theme');
  wp_enqueue_style('tailwind-output');
  wp_enqueue_style('custom-login');

  // JS
  wp_register_script('plugins', get_template_directory_uri() . '/app/js/plugins.js', array(), '1.0.0', true );
  wp_register_script('scripts', get_template_directory_uri() . '/app/js/scripts.js', array('jquery'), '1.0.0', true );
  
  wp_enqueue_script ('plugins' ); 
  wp_enqueue_script ('scripts' );
}

add_action( 'wp_enqueue_scripts', 'load_theme_scripts' );


//--------------------------------------------------------------
//* Add Page Slug Body Class 
//--------------------------------------------------------------

function add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


//--------------------------------------------------------------
//* Add Feature image support
//--------------------------------------------------------------

add_theme_support( 'post-thumbnails' );
add_image_size( 'project-thumbnail', 530, 145, true); //project cropped image
add_image_size( 'main-project-thumbnail', 530, 680, true); //main project cropped image

add_filter( 'image_size_names_choose', 'my_custom_image_sizes' );

function my_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
      'project-thumbnail' => __( 'Projects thumbnail' ),
      'main-project-thumbnail' => __( 'Main project thumbnail' ),
    ) );
}

//--------------------------------------------------------------
//* Allow excerpt to pages
//--------------------------------------------------------------

add_post_type_support( 'page', 'excerpt' );

//--------------------------------------------------------------
//* Custom logo
//--------------------------------------------------------------



function custom_logo_setup() {
  $defaults = array(
  'height'      => 100,
  'width'       => 250,
  'flex-height' => true,
  'flex-width'  => true,
  'header-text' => array( 'site-title', 'site-description' ),
  );
  add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'custom_logo_setup' );

//--------------------------------------------------------------
//* Remove Comments
//--------------------------------------------------------------

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

//--------------------------------------------------------------
//* Register Menus 
//--------------------------------------------------------------

function register_site_menus() {
    register_nav_menus(
      array(
        'main-menu' => __( 'Full navigation')
      )
    );
  }
  add_action( 'init', 'register_site_menus' );


//--------------------------------------------------------------
//* Allow shortcodes into widgets
//--------------------------------------------------------------
  
add_filter( 'widget_text', 'do_shortcode' );

//--------------------------------------------------------------
//* Allow SVG uploads
//--------------------------------------------------------------

function autoriser_upload_svg($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'autoriser_upload_svg');


//----------------------------------------------------------------------------------------------------------------------------------------------
//* Custom Post Type Functions
//----------------------------------------------------------------------------------------------------------------------------------------------

