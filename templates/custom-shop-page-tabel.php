<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
</div>
</div>
<div class="product-price_csrmplugin" >
<table>
<tbody>
<tr>
<td><span>Price Per Seat:</span></td>
<td>
	<span><?php echo esc_html($product_price);?></span> 
	<input type="hidden" id="product_price_hidden_value" value="0">
</td>
</tr>
<tr>
<td>Total Price</td>
<td><span id="total_val_span"></span></td>
</tr>
</tbody>
</table> 
</div>
<div style="margin-top: 10px;">