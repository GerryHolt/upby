<?php		// Checkout Payment Section
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>

<div id="payment" class="woocommerce-checkout-payment">

	<p class="rzt-checkout-blue-subtitle"><?php _e( '2. Payment method', 'uppababy' ); ?></p>

	<div id="rzt-cards-logo">
		<ul>
			<li><img src="https://cdn.shptrn.com/media/mfg/639/design_content/0//cc_mastercard.png" alt="Mastercard" title="Mastercard" width="46" height="25"></li>

			<li><img src="https://cdn.shptrn.com/media/mfg/639/design_content/0//cc_visa.png" alt="Visa" title="Visa" width="46" height="25"></li>

			<li><img src="https://cdn.shptrn.com/media/mfg/639/design_content/0//cc_amex.png" alt="American Express" title="American Express" width="46" height="25"></li>

			<li><img src="https://cdn.shptrn.com/media/mfg/639/design_content/0//cc_discover.png" alt="Discover" title="Discover" width="46" height="25"></li>

			<!-- <li><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/pp-acceptance-small.png" alt="Buy now with PayPal"></li> -->
		</ul>
	</div>

	<?php if ( WC()->cart->needs_payment() ) : ?>
		<ul class="wc_payment_methods payment_methods methods">
			<?php
				if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<li>' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_country() ? __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : __( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>';
				}
			?>
		</ul>
	<?php endif; ?>
	<div class="form-row place-order">
		<noscript>
			<?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?>
			<br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>" />
		</noscript>

		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt rzt-place-order-new" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>
	</div>
</div>
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
