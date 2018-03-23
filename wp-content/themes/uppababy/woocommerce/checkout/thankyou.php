<?php
/**
 * Thankyou page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $order ) : 

	$ny_order_id = $order->get_id();

	if ( $order->has_status( 'failed' ) ) : 
	
	?>
		<p class="woocommerce-thankyou-order-failed">
		
		<?php 
			_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); 
		?>
		
		</p>

		<p class="woocommerce-thankyou-order-failed-actions">

			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay">
			<?php _e( 'Pay', 'woocommerce' ) ?>
			</a>

			<?php if ( is_user_logged_in() ) : ?>

				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay">
				<?php _e( 'My Account', 'woocommerce' ); ?>
				</a>

			<?php endif; ?>

		</p>

	<?php else : 
	
		if ( get_post_meta($ny_order_id, 'shopatron_order_ID', true) ) {
		
			$ny_shopatron_order_ID = get_post_meta($ny_order_id, 'shopatron_order_ID', true);
			$ny_strpos = strpos($ny_shopatron_order_ID, "_");
		}

		if ( $ny_shopatron_order_ID && $ny_strpos !== false ) {

			$ny_post_and_order_ids = explode( "_", $ny_shopatron_order_ID );

			$ny_shopatron_order_ID = $ny_post_and_order_ids[1];

		} else {
		
			$ny_shopatron_order_ID = $order->get_order_number();
		
		}

	?>

		<p class="woocommerce-thankyou-order-received">
		<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you! Your order has been received.', 'woocommerce' ), $order ); ?>
		</p>

		<ul class="woocommerce-thankyou-order-details order_details">

			<li class="order">
				<?php _e( 'Order Number:', 'woocommerce' ); ?>
				<strong><?php echo $ny_shopatron_order_ID; ?></strong>
			</li>

			<li class="date">
				<?php _e( 'Date:', 'woocommerce' ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->get_date_paid() ) ); ?></strong>
			</li>

			<li class="total">
				<?php _e( 'Total:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_formatted_order_total(); ?></strong>
			</li>

			<?php if ( $order->get_payment_method_title() ) : ?>

			<li class="method">
				<?php _e( 'Payment Method:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_payment_method_title(); ?></strong>
			</li>

			<?php endif; ?>
		</ul>

		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $ny_order_id ); ?>

	<?php do_action( 'woocommerce_thankyou', $ny_order_id ); ?>

<?php else : ?>

	<p class="woocommerce-thankyou-order-received">
	<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?>
	</p>

<?php endif; ?>