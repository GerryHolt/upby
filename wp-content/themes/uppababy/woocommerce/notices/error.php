<?php  // Show error messages  // theme/woocommerce/notices/error.php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	if ( ! $messages ){
		return;
	}

    //if ( is_page('checkout') ) {
    if ( 1==1 ) {
?>
<style type="text/css">
	.TB_modal {
		max-width: 95% !important;
	}
	#TB_window {
		top: 30% !important;
	}
</style>
<script>

	var ny_image_popup = '<div id="TB_overlay" class="TB_overlayBG" onclick="close_this_popup()"></div>';

	ny_image_popup += '<div id="TB_window" class="TB_Transition TB_imageContent TB_captionBottom TB_singleLine" style="margin-left: -256px; width: 512px; margin-top: 7px; display: block;">';

	ny_image_popup += '<a onclick="close_this_popup()" id="TB_ImageOff" title="Close">';

	ny_image_popup += '<div class="rzt_checkout_message" id="rzt_checkout_error_message">';

	ny_image_popup += '<ul class="woocommerce-error" style="border-top-color: #fff !important;">';

	ny_image_popup += '<p id="rzt-close-popup" onclick="self.parent.tb_remove();" style="float:right; cursor:pointer;">';

	ny_image_popup += '<img src="/wp-content/themes/uppababy/images/removefromcart.svg" width="17" height="17" border="0" alt="Close" title="Close">';

	ny_image_popup += '</p>';

	<?php 
		
		foreach ( $messages as $message ) {
		
			echo 'ny_image_popup += "<li>* '.wp_kses_post( $message ).'</li>";';
		}
	?>

	ny_image_popup += '<p>&nbsp;</p><p>Please correct and resubmit order.</p>';

	ny_image_popup += '</ul>';

	ny_image_popup += '</div>';

	ny_image_popup += '</a>';

	ny_image_popup += '<div id="TB_caption">';
	ny_image_popup += '<div id="TB_secondLine"></div>';
	ny_image_popup += '</div>';

	ny_image_popup += '<div id="TB_closeWindow">';
	ny_image_popup += '<a onclick="close_this_popup()" id="TB_closeWindowButton" title="Close">';
	ny_image_popup += '<img src="/wp-content/themes/uppababy/images/tb-close.png">';
	ny_image_popup += '</a>';
	ny_image_popup += '</div>';


	ny_image_popup += '</div>';
	
	ny_image_popup += '';

	jQuery("body").append(ny_image_popup);

	function close_this_popup() {

		jQuery("#TB_overlay").hide();
		jQuery("#TB_window").hide();

		jQuery("#TB_overlay").remove();
		jQuery("#TB_window").remove();
	}

	jQuery('#TB_overlay, #TB_window, #TB_closeWindow').on( 'click', function(){
		close_this_popup();
	});

</script>

<?php } else { ?>

	<ul class="woocommerce-error">
		<?php foreach ( $messages as $message ) : ?>

			<li>*
				<?php echo wp_kses_post( $message ); ?>
			</li>

		<?php endforeach; ?>
	</ul>

<?php } ?>