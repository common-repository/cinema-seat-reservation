<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function csrma_wpcustom_cinema_seat_reservation_enqueue_frontend_styles() {
	
    wp_enqueue_style('csr_wpcustom_cinema_seat_reservation_frontend_style',
    plugins_url('assets/css/frontend_style_css.css', __FILE__));

    wp_enqueue_script('frontendajax-custom-js',
    plugins_url('assets/js/frontend_javascript.js',
    __FILE__), array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'csrma_wpcustom_cinema_seat_reservation_enqueue_frontend_styles', PHP_INT_MAX);

function csrma_wpcustom_cinema_seat_reservation_enqueue_admin_scripts() {
    
    wp_register_script('csr_wpcustom_cinema_seat_reservation_admin_custom_js', 
    plugins_url('assets/js/admin_javascript.js', __FILE__), 
    array('jquery'), '1.0.0', true);
    
    wp_enqueue_script('csr_wpcustom_cinema_seat_reservation_admin_custom_js');
    
    wp_enqueue_style('csr_wpcustom_cinema_seat_reservation_admin_style_css',
    plugins_url('assets/css/admin_style_css.css',
    __FILE__));
}
add_action('admin_enqueue_scripts', 'csrma_wpcustom_cinema_seat_reservation_enqueue_admin_scripts');

