<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . "/custom-shop-page-header.php");

if (have_posts()) :
    while (have_posts()) : the_post();
        $product_id = get_the_ID();
        $product_title = get_the_title();
        $product_description = get_the_content();
        $product_price = get_post_meta($product_id, '_price', true);
        $_total_seats_csrm_plugin = get_post_meta($product_id, '_total_seats_csrm_plugin', true);
        $_starting_date_custom_csrplugin = get_post_meta($product_id, '_starting_date_custom_csrplugin', true);
        $_expiry_date_custom_csrplugin = get_post_meta($product_id, '_expiry_date_custom_csrplugin', true);
        $minDate = $_starting_date_custom_csrplugin;  // Current date
        $maxDate = $_expiry_date_custom_csrplugin;
        $product_image = get_the_post_thumbnail(get_the_ID(), 'active', array('data-image' => 'red'));
?>
<main class="container_csrmplugin">
  <div class="left-column_csrmplugin">
<?php
if ($product_image) {
    echo wp_kses_post($product_image);
}
else{
  echo '<img fetchpriority="high" width="418" height="590" src="'.esc_attr($logo_image_not_ava).'" class="attachment-active size-active wp-post-image" alt="" data-image="red">';
}
?>
  </div>
  <div class="right-column_csrmplugin">
    <div class="product-description_csrmplugin">
      <h1 style="color:#000;"><?php echo  esc_html(get_the_title());?></h1>
      <p style="color:#000;"><?php echo esc_html($product_description);?></p>
    </div>
    <div class="product-configuration_csrmplugin" id="specificDiv">

      <?php
      if(isset($_POST['available_seat_button'])){
        $date_input_available_seat = sanitize_text_field($_POST['date_input_available_seat']);
      }  
      ?>
      <div class="cable-config_csrmplugin">

      	<form action="#" method="post">

      	<h3>Select Your Date</h3>

        <?php wp_nonce_field('cser_select_you_data_form_action', 'cser_select_you_data_form_nonce'); ?>

        <input 
        type="date" 
        name="date_input_available_seat" 
        value="<?php if(isset($date_input_available_seat)) { echo esc_attr($date_input_available_seat); } ?>" 
        class="date_input_available_seat" 
        min="<?php echo esc_attr($minDate); ?>" 
        max="<?php echo esc_attr($maxDate); ?>">

        <input 
        type="submit"
        name="available_seat_button"
        value="Check Available Seats"
        class="available_seat_button">

      	</form>

      	<?php

if (isset($_POST['available_seat_button'])) {
    if (isset($_POST['cser_select_you_data_form_nonce']) && wp_verify_nonce(wp_unslash(sanitize_text_field($_POST['cser_select_you_data_form_nonce'])), 'cser_select_you_data_form_action')) {
        // Nonce verification successful
        $date_input_available_seat = isset($_POST['date_input_available_seat']) ? sanitize_text_field($_POST['date_input_available_seat']) : '';
        // Perform further processing as needed
    } else {
        // Nonce verification failed, handle accordingly
        wp_redirect($home . '/shop');
        exit;
    }
}

        if(empty($_starting_date_custom_csrplugin)){
          echo '';
        }
        else{
          echo'
          <div> 
          <span style="color:green; font-weight: bold;">
          Starting From: '.esc_html($_starting_date_custom_csrplugin)."</span>
          </div>";
        }

        if(empty($_expiry_date_custom_csrplugin)){
          echo '';
        }
        else{
          echo'
          <div> 
          <span style="color:red; font-weight: bold;"> 
          End From: '.esc_html($_expiry_date_custom_csrplugin)."</span> 
          </div>";
        }
        ?>
      
<h3>Book Seats</h3>
       <hr style="margin-top: 30px;">

 <?php 
 if (isset($_POST['date_input_available_seat'])) {
    $nonce = isset($_POST['cser_select_you_data_form_nonce']) ? sanitize_text_field($_POST['cser_select_you_data_form_nonce']) : '';

    if (isset($_POST['cser_select_you_data_form_nonce']) && wp_verify_nonce(wp_unslash($nonce), 'cser_select_you_data_form_action')) {
 
  ?>
        <div class="cable-choose_csrmplugin">
<?php
if(empty($_POST['date_input_available_seat'])){

}else{
global $wpdb;
$table_name = $wpdb->prefix . 'wpcustom_booking_seat';
$pro_id = get_the_ID(); // Assuming this is inside the loop, and it will give you the current post ID
$booking_date = sanitize_text_field($_POST['date_input_available_seat']);

// Define your SELECT query with conditions
$query = $wpdb->prepare(
    "SELECT pro_value FROM {$table_name} WHERE pro_id = %d AND booking_date = %s",
    $pro_id,
    $booking_date
);

// Execute the query and get the results as a multidimensional array
$results = $wpdb->get_results($query, ARRAY_A);
$combined_values = implode(' ', array_column($results, 'pro_value'));
$selected_idsarray = $combined_values;
$selected_ids = (explode(" ",$selected_idsarray));

for ($i=1; $i < $_total_seats_csrm_plugin; $i++) { 
      $is_selected = in_array($i, $selected_ids);
?>
       	<input type="checkbox" id="checkbox_<?php echo esc_attr($i); ?>" class="checkbox_id" data="<?php echo esc_attr($i); ?>" <?php echo $is_selected ? 'booking=yes' : ''; ?>  >
<?php
if($is_selected){
  echo "<div class='book' no=".esc_attr($i)." >".esc_attr($i)."</div>"; 
}
else{
?>
<label for="checkbox_<?php echo esc_attr($i); ?>"><?php echo esc_html($is_selected) ? '<div>'.esc_html($i).'</div>' : esc_html($i); ?>
</label>
<?php
}}
?>
</div>
<?php 
}
}
else{
   wp_redirect($home.'/shop');
}
} 
require_once(dirname(__FILE__) . "/custom-shop-page-tabel.php");
require_once(dirname(__FILE__) . "/custom-shop-page-add-to_cart.php");
require_once(dirname(__FILE__) . "/custom-shop-page-footer.php");
endwhile;
endif;
get_footer();
?>