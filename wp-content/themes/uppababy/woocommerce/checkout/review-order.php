<?php		// Review order table

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<table class="shop_table woocommerce-checkout-review-order-table">
  <!--
	<thead>
		<tr>
			<th class="product-name"></th>
			<th class="product-total"></th>
		</tr>
	</thead>
  -->
  <tbody>
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

					?>

					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-name" width="83%">

							<p class="product-thumbnail" style="width: 100px;">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo $thumbnail;
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
									}
								?>
							</p>

							<span class="rzt-span-product-name">
								<?php
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
								?>
							</span>

							<?php //echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>

							<?php
								$ny_color_attribute = WC()->cart->get_item_data( $cart_item, true );

								if( ! $ny_color_attribute && isset($cart_item["variation"]["attribute_uppababy-color"]) ) {
									$ny_color_attribute = $cart_item["variation"]["attribute_uppababy-color"];
								}

								if( $ny_color_attribute ) {
									echo '<span class="rzt-span-product-color"><br>Color : '.str_replace( 'uppababy-color', '', $ny_color_attribute ).'</span>';
								}

								if(get_field('compatibility_information', $product_id)) {

									echo '<br><span class="rzt-span-acc-for" style="font-size:14px;">'.get_field('compatibility_information', $product_id).'</span>';

								}

								if ( get_post_meta($product_id, 'additional_information_simple', true) ) {

									$ny_additional_info = get_post_meta( $product_id, 'additional_information_simple', true );
								
									if ( isset($ny_additional_info) && $ny_additional_info != 'Array' ) {		
										echo '<p class="rzt-cart-additional-info">';

											echo $ny_additional_info;

										echo '</p>';
									}
								}
							?>

						</td>

						<td class="product-total" width="12%">
							<span class="rzt-checkout-price">
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
							</span>

							<span class="rzt-checkout-delete product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
							</span>
						</td>

						<td class="product-margin" width="5%">
							&nbsp;
						</td>
					</tr>

					<tr class="rzt-checkout-divider-row">
						<td colspan="2" class="rzt-checkout-divider-td">&nbsp;</td><td>&nbsp;</td>
					</tr>

					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
	<tfoot>

		<tr class="cart-subtotal">
			<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
			<td class="right-side"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>


		<tr class="rzt-how-shipping-calculated">
			<td><a href="<?php site_url(); ?>/legal-docs/ordering-info-policy/" target="_blank">How is shipping calculated?</a></td>
		</tr>

		<tr class="rzt-checkout-divider-row">
			<td colspan="2" class="rzt-checkout-divider-td">&nbsp;</td><td>&nbsp;</td>
		</tr>

		<tr class="order-total">
			<th><?php _e( 'Grand Total', 'woocommerce' ); ?></th>
			<td class="right-side"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<tr class="rzt-tax-notice">
			<td colspan="2"><p class="rzt-checkout-subtitle">Taxes may be added after order is placed depending on fulfillment retailer's location.</p></td>
		</tr>

		<tr class="rzt-privacy-notice">
			<td colspan="2"><p class="rzt-privacy">By placing an order, you have read and agreed to our <a href="<?php site_url(); ?>/legal-docs/ordering-info-policy/" target="_blank">return policy</a>.</p></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>