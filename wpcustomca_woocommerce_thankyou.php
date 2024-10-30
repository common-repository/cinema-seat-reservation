<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Display custom fields on the "Order Received" page
function csrma_display_custom_fields_on_thankyou($order_id) {
    global $wpdb;

    // Define table name
    $order_table_name = $wpdb->prefix . 'wc_orders_meta';

    // Fetch 'YourSeats' meta data from database
    $your_seats = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT meta_value FROM {$order_table_name} WHERE order_id = %d AND meta_key = %s",
            $order_id,
            'YourSeats'
        )
    );

    // If 'YourSeats' meta data exists, display it
    if (!empty($your_seats)) {
        ?>
        <hr>
        <div class="ticket">
            <div class="ticket--center--col">
                <span>Your Seats:</span>
                <strong>
                    <?php
                    // Output sanitized and comma-separated seats
                    echo esc_html(implode(',', array_map('esc_html', $your_seats)));
                    ?>
                </strong>
            </div>
            <!-- Add more sections as needed -->
        </div>
        <button onclick="window.print()" class="onclick_window_print_print_ticket">PRINT TICKET</button>
        <?php
    }
}

// Hook the function to 'woocommerce_thankyou' action
add_action('woocommerce_thankyou', 'csrma_display_custom_fields_on_thankyou', 10, 1);
?>