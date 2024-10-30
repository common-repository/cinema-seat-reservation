<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function csrma_change_add_to_cart_link($link, $product) {
    // Get the product ID
    $product_id = $product->get_id();
    $product_permalink = get_permalink($product_id);
    $link = $product_permalink;
    return "<a href=".esc_attr($link).">Book Now</a>";
}
add_filter('woocommerce_loop_add_to_cart_link', 'csrma_change_add_to_cart_link', 10, 2);