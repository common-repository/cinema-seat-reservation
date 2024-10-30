<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Add custom fields to product edit page
function csrma_add_custom_fields_to_product() {
    global $post;

    echo '<div class="options_group">';

    // Output nonce field
    echo '<input type="hidden" name="csr_custom_fields_nonce" value="' . esc_attr(wp_create_nonce('csr_custom_fields_nonce_action')) . '" />';

    // Custom Field: Total Seats
    woocommerce_wp_text_input(
        array(
            'id'          => '_total_seats_csrm_plugin',
            'label'       => __('Total SEATS', 'cinema-seat-reservation'),
            'placeholder' => __('Total SEATS', 'cinema-seat-reservation'),
            'desc_tip'    => true,
            'type'        => 'number',
        )
    );

    // Custom Field: Starting Date
    woocommerce_wp_text_input(
        array(
            'id'          => '_starting_date_custom_csrplugin',
            'label'       => __('Starting Date', 'cinema-seat-reservation'),
            'placeholder' => __('Starting Date', 'cinema-seat-reservation'), 
            'desc_tip'    => true,
            'type'        => 'date',
        )
    );

    // Custom Field: Expiry Date
    woocommerce_wp_text_input(
        array(
            'id'          => '_expiry_date_custom_csrplugin',
            'label'       => __('Expiry Date', 'cinema-seat-reservation'),
            'placeholder' => __('Expiry Date', 'cinema-seat-reservation'),
            'desc_tip'    => true,
            'type'        => 'date',
        )
    );

    echo '</div>';

}

add_action('woocommerce_product_options_general_product_data', 'csrma_add_custom_fields_to_product');

// Save custom fields when the product is saved
function csrma_save_custom_fields($post_id) {
    // Verify nonce
    if (
        !isset($_POST['csr_custom_fields_nonce']) ||
        !wp_verify_nonce(wp_unslash(sanitize_text_field($_POST['csr_custom_fields_nonce'])), 'csr_custom_fields_nonce_action')
    ) {
        return $post_id;
    }

    // Custom Fields
    $custom_field = isset($_POST['_total_seats_csrm_plugin']) ? sanitize_text_field($_POST['_total_seats_csrm_plugin']) : '';
    $expiry_date = isset($_POST['_expiry_date_custom_csrplugin']) ? sanitize_text_field($_POST['_expiry_date_custom_csrplugin']) : '';
    $starting_date = isset($_POST['_starting_date_custom_csrplugin']) ? sanitize_text_field($_POST['_starting_date_custom_csrplugin']) : '';

    // Save custom fields
    update_post_meta($post_id, '_total_seats_csrm_plugin', $custom_field);
    update_post_meta($post_id, '_expiry_date_custom_csrplugin', $expiry_date);
    update_post_meta($post_id, '_starting_date_custom_csrplugin', $starting_date);
}

add_action('woocommerce_process_product_meta', 'csrma_save_custom_fields');