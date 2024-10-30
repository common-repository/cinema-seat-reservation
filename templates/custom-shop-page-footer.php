<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 if(!isset($i)){
    $i ='';
}
?>
</div>
  </div>
</main>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var checkbox = document.getElementById('checkbox_<?php echo esc_attr($i); ?>');
    var label = document.querySelector('label[for="checkbox_<?php echo esc_attr($i); ?>"]');

    if (checkbox && label) {
      label.addEventListener('click', function () {
        checkbox.checked = !checkbox.checked; // Toggle checkbox state
      });
    } else {
      //console.error('Checkbox or label not found in the DOM.');
    }
  });
  jQuery(function($) {
$('.button').on('click', function(e) {
  var custom_quantity = parseInt($(".custom_quantity").val());

        if(custom_quantity == 0){
            alert("Please book at least one seat for yourself. Thank you");
        }
});


 $('.checkbox_id').change(function () {
        // Get the value of the checkbox
        var booking_yes = $(this).attr("booking");
        if(booking_yes == 'yes'){
          //alert("alread booking this seat");
        }
        else{
        var realpro_price = parseInt($("#product_price_hidden_value").val());
        var id = $(this).attr("data");
        var custom_quantity = parseInt($(".custom_quantity").val());        
        var checkboxValue = $(this).prop('checked') ? '1' : '0';
        if(checkboxValue == 1){
        	var plus = custom_quantity + 1;
        	var x = realpro_price + <?php echo esc_js($product_price);?>;
        	$("#product_price_hidden_value").val(x);
        	$("#total_val_span").text(x);
        	
        	//console.log(x);
        	$(".custom_quantity").val(plus);
        	$(".woo_check_out_from_custom").append("<input type='hidden' value="+id+" id='hidden_set_append"+id+"' name='hidden_set_append[]'>");
        }
        else{
        	var minx = custom_quantity - 1;
        	var x = realpro_price - <?php echo esc_js($product_price);?>;
        	$("#product_price_hidden_value").val(x);
        	$("#total_val_span").text(x);
        	$(".custom_quantity").val(minx);
        	$("#hidden_set_append"+id+"").remove();
        }
}

    });
//alert("hello");
});
</script>
<div class="overlay">
  <div class="popup-container" id="popup">
    <div class="popup-content">
      <div>
        <span class="close-popup" id="close-popup">&times;</span>
      </div>
      <div style="margin-top: 10px;">
          <p class="pop_seat_book_num_p"></p>
      </div>
    </div>
  </div>
</div>

  <style type="text/css">
  .overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
  z-index: 999;
}

  .book {
  cursor: pointer;
  padding: 10px;
  background-color: #3498db;
  color: #fff;
  text-align: center;
}

.popup-container {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  font-size: 30px;
}

.popup-content {
  position: relative;
}

.close-popup {
 position: absolute;
    top: -29px;
    right: -5px;
    font-size: 20px;
    cursor: pointer;
    color: red;
}
  </style>

  <script>
 jQuery(function($) {
  // Open pop-up on click
  $('.book').click(function() {
  $('#popup').fadeIn();
    var pop_seat_book_num_p = $(this).attr("no");
  $('.pop_seat_book_num_p').text('Seat No: '+pop_seat_book_num_p+'  This seat is already book!');
  $('.overlay').css({
  'visibility': 'visible',
  'opacity': 1
  });
     $('body').css('overflow', 'hidden');
  });

  // Close pop-up on close button click
  $('#close-popup').click(function() {
    //$('#popup').fadeOut();
       $('.overlay').css({
    'visibility': 'hidden',
    'opacity': 0
  });
       $('body').css('overflow', 'auto');
  });

  // Close pop-up on overlay click
  
});

  </script>