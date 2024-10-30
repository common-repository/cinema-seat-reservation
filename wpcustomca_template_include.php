<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_filter('template_include', 'csrma_custom_single_product_template',11);
function csrma_custom_single_product_template($template) {
    if (is_product()) {
        $custom_template = plugin_dir_path(__FILE__) . '/templates/custom-shop-page.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}