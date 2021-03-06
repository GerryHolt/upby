<?php // Email Order Items

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

foreach ( $items as $item_id => $item ) :

	$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );

	$item_meta    = new WC_Order_Item_Meta( $item, $_product );

	if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
		?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tbody>

		<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>" style="    background: white;">

			<td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word; width: 27%;">
			
			<?php

				// Show title/image etc

				if ( $show_image ) {

					echo apply_filters( 'woocommerce_order_item_thumbnail', '<div style="margin-bottom: 5px; text-align:center;"><img src="' . ( $_product->get_image_id() ? current( wp_get_attachment_image_src( $_product->get_image_id(), 'thumbnail') ) : wc_placeholder_img_src() ) .'" alt="' . esc_attr__( 'Product Image', 'woocommerce' ) . '" height="' . esc_attr( $image_size[1] ) . '" width="' . esc_attr( $image_size[0] ) . '" style="vertical-align:middle; margin-right: 10px;" /></div>', $item );
				}
			?>
			</td>

			<td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word; width: 50%; padding-left: 10px;">

			<?php

				// Product name

				echo '<strong>'.apply_filters( 'woocommerce_order_item_name', $item['name'], $item, false ).'</strong>';

				// SKU

				if ( $show_sku && is_object( $_product ) && $_product->get_sku() ) {
					echo ' (#' . $_product->get_sku() . ')';
				}

				// allow other plugins to add additional product information here

				do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text );

				// Variation

				if ( ! empty( $item_meta->meta ) ) {
					echo '<br/><small>' . nl2br( $item_meta->display( true, true, '_', "\n" ) ) . '</small>';
				}

				// File URLs

				if ( $show_download_links ) {
					$order->display_item_downloads( $item );
				}

				// allow other plugins to add additional product information here

				do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text );

			?>
			</td>
			
			<!-- td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"><?php echo apply_filters( 'woocommerce_email_order_item_quantity', $item['qty'], $item ); ?>
			</td -->
			
			<td class="td" style="text-align:right; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; width: 23%; padding-right: 15px;"><?php echo $order->get_formatted_line_subtotal( $item ); ?>
			</td>
		</tr>
	  </tbody>
	</table>

		<?php
	}

	if ( $show_purchase_note && is_object( $_product ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) : ?>

		<!-- tr>
			<td colspan="3" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?>
			</td>
		</tr -->

	<?php endif; ?>

<?php endforeach; ?>