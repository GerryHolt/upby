<?php
/**
 * Checkout billing information form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">

	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<p class="rzt-checkout-blue-subtitle"><?php _e( '1. Billing address', 'uppababy' ); ?></p>

	<?php else : ?>

		<p class="rzt-checkout-blue-subtitle"><?php _e( '1. Billing address', 'uppababy' ); ?></p>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">

	<?php 
	
		$fields = $checkout->get_checkout_fields( 'billing' );
	
		foreach ( $fields as $key => $field ) {

			if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {

				$field['country'] = $checkout->get_value( $field['country_field'] );
			}

			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
	?>
	</div>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>

<div class="woocommerce-account-fields">

	<?php if ( ! $checkout->is_registration_required() ) : ?>

		<p class="form-row form-row-wide create-account">
			<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
		</p>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

	<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

		<div class="create-account">

			<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p>

			<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>

				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

			<?php endforeach; ?>

			<div class="clear"></div>

		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

</div>

<?php endif; ?>