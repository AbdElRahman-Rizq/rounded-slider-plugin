<?php
/*
Plugin Name: Rounded Image Slider
Description: This plugin creates a slider with rounded images dynamically.
Version: 1.0
Author: Your Name
*/

// Enqueue necessary scripts and styles
function rounded_image_slider_scripts() {
    wp_enqueue_style('slick-slider-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-slider-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    wp_enqueue_script('slick-slider-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '', true);
    wp_enqueue_style('rounded-image-slider-style', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('wp_enqueue_scripts', 'rounded_image_slider_scripts');

function register_rounded_image_slider_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/widget-elementor.php' );


	$widgets_manager->register_widget_type( new \Rounded_Image_Slider_Widget() );

}
add_action( 'elementor/widgets/widgets_registered', 'register_rounded_image_slider_widget' );
// Shortcode for rounded image slider
function rounded_image_slider_shortcode($atts) {
    ob_start();
    // Your slider code here
    ?>
    <div class="rounded-image-slider">
        <!-- Slider images will be dynamically generated here -->
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('.rounded-image-slider').slick({
                // Slider configurations
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('rounded_image_slider', 'rounded_image_slider_shortcode');
?>
