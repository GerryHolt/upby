<?php
	/**
	 * Mini-cart
	 * Contains the markup for the mini-cart, used by the cart widget.
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	wc_print_notices();

	do_action( 'woocommerce_before_mini_cart' );

?>

<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );

					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>

					<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">

						<table class="rzt-mini-cart-widget">

						<tr style="line-height: 0px; height: 0px;">
							<td style="">&nbsp;</td> 
							<td style="width: 55px;">&nbsp;</td> 
							<td style="width: 55px;">&nbsp;</td>
						</tr>

						<tr>
							<td colspan="3" class="rzt-cart-product-image">
							  <center class="rzt-cart-position-relative" style="position:relative;">

								<?php if ( ! $_product->is_visible() || $product_permalink == '' ) : ?>

									<a>
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
									</a>

								<?php else : ?>

									<a href="<?php echo esc_url( $product_permalink ); ?>">

										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
									</a>
								<?php
									endif;

									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>
							  </center>
							</td>
						</tr>

						<tr>
							<td colspan="3" class="rzt-cart-product-name">

								<span class="rzt-cart-span-product-name">

									<?php if ( ! $_product->is_visible() || $product_permalink == '' ) : ?>

										<?php echo $product_name; ?>

									<?php else : ?>

										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo $product_name; ?>
										</a>
									<?php endif; ?>

								</span>

							</td>
						</tr>

						<tr>
							<td colspan="2" class="rzt-cart-product-name">
								<?php

									$ny_color_attribute = WC()->cart->get_item_data( $cart_item, true );

									if( ! $ny_color_attribute && isset($cart_item["variation"]["attribute_uppababy-color"]) ) {
										$ny_color_attribute = $cart_item["variation"]["attribute_uppababy-color"];
									}

									$ny_color_attribute = str_replace( 'uppababy-color', '', $ny_color_attribute );
									$ny_color_attribute = str_replace( ':', '', $ny_color_attribute );

									if( $ny_color_attribute ) {
										echo '<span class="rzt-cart-span-product-color">Color: '.$ny_color_attribute.'</span>';
									}

									if( get_field( 'compatibility_information', $product_id) ) {

										echo '<p style="font-size:14px;" class="rzt-cart-accessory-for-what">';

											echo get_field( 'compatibility_information', $product_id );

										echo '</p>';
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

							<td class="rzt-cart-remove-item" style="">

								<?php
									//echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key );

									echo '<span class="quantity">' . $product_price . '</span>';
								?>

							</td>
						</tr>
						</table>
					</li>
					<?php
				}
			}
		?>

	<?php else : ?>

		<li class="empty"><?php // _e( 'No products in the cart.', 'woocommerce' ); ?></li>

	<?php endif; ?>

</ul> <!-- end product list -->

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<p class="total"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons">
		<!--
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><?php // _e( 'View Cart', 'woocommerce' ); ?></a>
		-->
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
	</p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
