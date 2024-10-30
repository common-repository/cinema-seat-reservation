<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once(dirname(__FILE__) . "/wpcustomca_include_wp_enqueue_style.php");
require_once(dirname(__FILE__) . "/wpcustomca_template_include.php");
require_once(dirname(__FILE__) . "/wpcustomca_add_custom_fields_to_product.php");
require_once(dirname(__FILE__) . "/wpcustom_add_custom_fields_to_cart_item.php");
require_once(dirname(__FILE__) . "/wpcustomca_woocommerce_thankyou.php");
require_once(dirname(__FILE__) . "/wpcustomca_woocommerce_loop_add_to_cart_link.php");
add_filter('woocommerce_cart_item_quantity', '__return_false');
?>