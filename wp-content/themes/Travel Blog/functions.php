<?php
    
    
    function mazil_scripts() {
    	wp_enqueue_style( 'blog', get_template_directory_uri() . '/main.css', array(), '0.0.30', false );
        
        wp_enqueue_script( 'min', get_template_directory_uri() . '/js/jquery.min.js',array ( 'jquery' ), 3.3, true);
        wp_enqueue_script( 'transform', get_template_directory_uri() . '/js/jquery.transform2d.js', array ( 'jquery' ), 3.3, true);
        wp_enqueue_script( 'jTinder', get_template_directory_uri() . '/js/jquery.jTinder.js', array ( 'jquery' ), 3.3, true);
        wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array ( 'jquery' ), 3.3, true);
        wp_enqueue_script( 'photos', get_template_directory_uri() . '/js/photos.js', array(), 1.0, true);
        
        wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    }

    add_action( 'wp_enqueue_scripts', 'mazil_scripts' );


  function mazil_google_fonts() {
    wp_register_style('Ubuntu', 'https://fonts.googleapis.com/css?family=Indie+Flower|Ubuntu');
    wp_enqueue_style( 'Ubuntu');
    		}

    add_action('wp_print_styles', 'mazil_google_fonts');


add_theme_support( 'title-tag' );


function my_extra_gallery_fields( $args, $attachment_id, $field ){
    $args['alt'] = array('type' => 'text', 'label' => 'Altnative Text', 'name' => 'alt', 'value' => get_field($field . '_alt', $attachment_id) ); // Creates Altnative Text field
    $args['class'] = array('type' => 'text', 'label' => 'Custom Classess', 'name' => 'class', 'value' => get_field($field . '_class', $attachment_id) ); // Creates Custom Classess field
    return $args;
}


add_filter( 'acf_photo_gallery_image_fields', 'my_extra_gallery_fields', 10, 3 );

add_filter( 'acf_photo_gallery_caption_from_attachment', '__return_true' );

