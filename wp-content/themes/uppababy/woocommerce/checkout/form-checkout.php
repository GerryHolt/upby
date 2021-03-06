<?php
/**
 * Checkout Form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout

if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {

	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<div id="rzt-checkout-left-colum" style="width:333px; float:left;">

		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set" id="customer_details">
				<div class="col-1" style="float: none; width: 100%;">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="col-2" style="float: none; width: 100%;">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>
		
	</div>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); // moved here by rzt ?>


	<div id="rzt-checkout-right-colum" style="float:right;">

		<p id="order_review_heading" class="rzt-checkout-blue-subtitle"><?php _e( '3. Review your order', 'uppababy' ); ?></p>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>	

	</div>

</form>

<?php //do_action( 'rzt_after_checkout_form' ); // for the rzt-footer ?>


<?php echo rzt_new_footer_menu(); ?>