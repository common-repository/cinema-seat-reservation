<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (isset($_POST['date_input_available_seat'])) {
    $date_input_available_seat = isset($_POST['date_input_available_seat']) ? sanitize_text_field($_POST['date_input_available_seat']) : '';
    $nonce = isset($_POST['cser_select_you_data_form_nonce']) ? sanitize_text_field($_POST['cser_select_you_data_form_nonce']) : '';

    if (wp_verify_nonce(wp_unslash($nonce), 'cser_select_you_data_form_action')) {
        echo '<form class="woo_check_out_from_custom" action="' . esc_url(wc_get_cart_url()) . '" method="post" class="cart">';
        echo '<input type="hidden" name="_nonce_field_name" value="' . esc_attr(wp_create_nonce('nonce_action_name')) . '" />';
        echo '<input type="hidden" name="add-to-cart" value="' . esc_attr($product_id) . '" />';
        echo '<input type="hidden" name="date_input_available_seat" value="' . esc_attr($date_input_available_seat) . '" />';
        echo '<input type="number" class="custom_quantity" name="quantity" value="0" min="1" />';
        echo '<button type="submit" class="button">Add to Cart</button>';
        echo '</form>';
    } else {
        wp_redirect($home.'/shop');
        exit;
    }
}

?>

