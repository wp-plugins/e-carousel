<?php

/*
Plugin Name: E-Carousel  
Description: Its a nice carousel plugin which is easy to use in your wordpress side.
Version: 1.1
Author: Hassan Kibria
Author URI: http://webegenius.es
Plugin URI: http://plugins.webegenius.es/our-plugins/

*/

/**
 * Define some useful constants
 **/
define('e_carousel_VERSION', '1.1');
define('e_carousel_DIR', plugin_dir_path(__FILE__));
define('e_carousel_URL', plugin_dir_url(__FILE__));

/*Some Set-up*/ 

wp_enqueue_script('e-carousel-js-id', e_carousel_URL.'assets/js/eslick.min.js', array('jquery'));
wp_enqueue_script('e-main-car', e_carousel_URL.'assets/js/emain.js', array('jquery')); 

wp_enqueue_style('e-font-awesome-id', e_carousel_URL.'assets/css/font-awesome.min.css'); 
wp_enqueue_style('e-carousel-css-id', e_carousel_URL.'assets/css/eslick.css');


include_once( 'includes/efunctions.php' );
// Hooks your functions into the correct filters
function my_e_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'e_add_tinymce_plugin' );
        add_filter( 'mce_buttons', 'my_e_register_mce_button' );
    }
}
add_action('admin_head', 'my_e_mce_button');

// Declare script for new button
function e_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['egenius_mce_button'] = e_carousel_URL.'assets/js/e-button.js';
    return $plugin_array;
}

// Register new button in the editor
function my_e_register_mce_button( $buttons ) {
    array_push( $buttons, 'egenius_mce_button' );
    return $buttons;
}
// only admin can see our option 
if (is_admin()) :?>
<?php

    function e_custom_post() { 

    register_post_type( 'e-carousel',

        array(

            'labels' => array(

                'name' => __( 'E-carousel' ),

                'singular_name' => __( 'carousel' ),

                               'all_items' => __( 'All carousel list', 'music_thm' ),

                                'add_new_item' => __( 'Add new carousel', 'music_thm' ),

                            'edit' => __( 'Editar', 'music_thm' ),

                            'edit_item' => __( 'Edit carousel', 'music_thm' ),

                            

                            

                'description'   => 'Add a carousel in post or content', 'music_thm',

                                'menu_position' => 1,

                               

                                'add_new_item' => __( 'Add new carousel slider', 'music_thm' )

            ),

                    'show_ui' => true,

                    'show_ui' => true,

                   

                          'show_in_menu'       => true,

            'public' => true,
            'menu_icon' => 'dashicons-format-gallery',

            'supports' => array('thumbnail', 'title','editor','custom-fields'),

            'has_archive' => 'false',

            'rewrite' => array('slug' => 'carousel'),

        )

    );   
        

}//end custom post

    add_action('init', 'e_custom_post');
  endif;   // EndIf is_admin() 