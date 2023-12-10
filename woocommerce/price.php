<?php
								// Get the product
								$product_id = get_the_ID();
								$product = wc_get_product($product_id);

								// Check if the product exists
								if ($product) {
    								// Get the prices
    								$regular_price = $product->get_regular_price();
    								$sale_price = $product->get_sale_price();

    								// Display the prices
   									echo '<div class="product-prices">';
    								echo '<p>Regular Price: ' . wc_price($regular_price) . '</p>';
    
    								if ($sale_price) {
        								echo '<p>Sale Price: ' . wc_price($sale_price) . '</p>';
    								}

    								echo '</div>';
								} else {
									echo 'Product not found';
								}
							?>