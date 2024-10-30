<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('CSR_NONCE_FIELD_NAME', '_nonce_field_name');
define('CSR_NONCE_ACTION_NAME', 'nonce_action_name');

function csrma_add_custom_fields_to_cart_item($cart_item_data, $product_id, $variation_id, $quantity) {
    $home = home_url();
    global $wpdb;
    $table_name = $wpdb->prefix . 'wpcustom_booking_seat';
    
if (
    !isset($_POST[CSR_NONCE_FIELD_NAME]) ||
    !wp_verify_nonce(wp_unslash(sanitize_text_field($_POST[CSR_NONCE_FIELD_NAME])), CSR_NONCE_ACTION_NAME) ||
    !isset($_POST['add-to-cart'])
) {
    wp_redirect($home.'/shop');
    exit;
}
    $hidden_set_append = isset($_POST['hidden_set_append']) ? array_map('sanitize_text_field', (array)$_POST['hidden_set_append']) : array();

foreach ($hidden_set_append as $value) {
    
    if (is_numeric($value) && !empty(trim($value))) {
        
    } else {
        wp_redirect($home.'/shop');
        exit;
    }
}
    $count_hidden_set_append = count($hidden_set_append);
    $custom_field2 = sanitize_text_field($_POST['date_input_available_seat'] ?? '');
    $custom_field3 = sanitize_text_field($_POST['add-to-cart'] ?? '');
    $quantity = sanitize_text_field($_POST['quantity'] ?? '');

    $total_seats = get_post_meta($custom_field3, '_total_seats_csrm_plugin', true);

    foreach ($hidden_set_append as $value) {
    if ($value > $total_seats) {
        wp_redirect($home.'/shop');
        exit;
    }
}

$booking_date = $custom_field2;
$pro_id = $custom_field3; 
$query = $wpdb->prepare("
    SELECT DISTINCT pro_value
    FROM $table_name
    WHERE booking_date = %s
    AND pro_id = %d
", $booking_date, $pro_id);

$results = $wpdb->get_col($query);

if (!empty($results)) {

    $results = array_map('trim', explode(' ', implode(' ', $results)));

    $new_values = array_diff($results, $hidden_set_append);
    if (empty($new_values)) {

        wp_redirect($home.'/shop');
        exit;

    } else {
    
        $existing_values = array_intersect($results, $hidden_set_append);
        if (!empty($existing_values)) {
           
            wp_redirect($home.'/shop');
            exit;
        }

        $hidden_set_append = array_merge($hidden_set_append, $new_values);
           
    }
} 
    if(empty($quantity)){
        wp_redirect($home.'/shop');
        exit;
    }
    else{
        if($count_hidden_set_append == $quantity ){
            $arrayAsString = isset($_POST['hidden_set_append']) && is_array($_POST['hidden_set_append'])
            ? implode(' ', array_map('sanitize_text_field', $_POST['hidden_set_append']))
            : '';
    
        $cart_item_data['hidden_set_append'] = $arrayAsString;
        $cart_item_data['date_input_available_seat'] = $custom_field2;
        $cart_item_data['add-to-cart'] = $custom_field3;
        return $cart_item_data;
        }
        else{
            WC()->cart->remove_cart_item($cart_item_key);
            wp_redirect($home.'/shop');
            exit;
        }
    }

}

add_action('woocommerce_add_cart_item_data', 'csrma_add_custom_fields_to_cart_item', 10, 4);

// Display custom fields in the cart
function csrma_display_custom_fields_in_cart($item_data, $cart_item) {
    if (isset($cart_item['hidden_set_append'])) {
        $item_data[] = array(
            'key'   => 'Your Seats',
            'value' => $cart_item['hidden_set_append']
        );
    }

    return $item_data;
}

add_filter('woocommerce_get_item_data', 'csrma_display_custom_fields_in_cart', 10, 2);

// Save custom fields to order
function csrma_save_custom_fields_to_order($item, $cart_item_key, $values, $order) {
    if (isset($values['hidden_set_append'])) {
        $order->add_meta_data('YourSeats', $values['hidden_set_append']);
    }

    if (isset($values['add-to-cart'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'wpcustom_booking_seat';

        // Validate data before insertion
        $pro_id = sanitize_text_field($values['add-to-cart']);
        $pro_value = sanitize_text_field($values['hidden_set_append']);
        $booking_date = sanitize_text_field($values['date_input_available_seat']);

        // Insert data into the database
        $data_to_insert = array(
            'pro_id'        => $pro_id,
            'pro_value'     => $pro_value,
            'booking_date'  => $booking_date,
        );

        $wpdb->insert($table_name, $data_to_insert);

        // Check for insertion errors
        if ($wpdb->last_error) {
            // Handle the error, log it, or display a user-friendly message
        }
    }
}

add_action('woocommerce_checkout_create_order_line_item', 'csrma_save_custom_fields_to_order', 10, 4);