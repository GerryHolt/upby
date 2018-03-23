<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$ny_product_id = get_the_ID();

/**
 * hook : woocommerce_before_single_product
 * @hooked wc_print_notices   #10
 */

// do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

$ny_classes = get_post_class( array('span-20', 'rzt-stroller-shortcode') );

echo '<div itemscope itemtype="'.woocommerce_get_product_schema().'" id="product-'.get_the_ID().'" class = "'.implode(" ", $ny_classes).'">';

	/**
	 * hook : woocommerce_before_single_product_summary
	 */
	// do_action( 'woocommerce_before_single_product_summary' );


	//---
	// Single Product Sale Flash		function woocommerce_show_product_sale_flash #10
	// sale-flash.php

	if ( $product->is_on_sale() ) {

		echo apply_filters(
				'woocommerce_sale_flash',
				'<span class="onsale rzt_sale_promo_image">' . __( 'ON SALE TODAY', 'uppababy' ) . '</span>',
				$post,
				$product
			);
	}

	//---
	// Single Product Image		function woocommerce_show_product_images #20
	// product-image.php

	echo '<div class="images span-12">';

		if ( has_post_thumbnail() ) {

			$attachment_count = count( $product->get_gallery_attachment_ids() );
			$gallery = $attachment_count > 0 ? '[product-gallery]' : '';

			$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );

			$image = get_the_post_thumbnail(
				$post->ID,
				apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ),
				array(
					'title'	 => $props['title'],
					'alt'    => $props['alt'],
				)
			);

			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
					esc_url( $props['url'] ),
					esc_attr( $props['caption'] ),
					$gallery,
					$image
				),
				$post->ID
			);
		} else {
			echo apply_filters(
					'woocommerce_single_product_image_html',
					sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ),
					$post->ID
				);
		}

		do_action( 'woocommerce_product_thumbnails' );

	echo '</div>';

	//---

	echo '<div class="summary entry-summary" style="margin-right: 22px; padding-left: 55px; width: 400px!important;">';

		/**
		 * hook : woocommerce_single_product_summary
		 */
		//do_action( 'woocommerce_single_product_summary' );


		//---
		// Single Product title		function woocommerce_template_single_title  5
		// title.php

		//the_title( '<h1 itemprop="name" class="product_title entry-title">', '</h1>' );

		//---
		// Single Product Price, including microdata for SEO	function woocommerce_template_single_price  10
		// price.php

		echo '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">';

			echo '<p class="price agendabold">'.$product->get_price_html().'</p>';

			echo '<meta itemprop="price" content="'.esc_attr( $product->get_display_price() ).'" />';

			echo '<meta itemprop="priceCurrency" content="'.esc_attr( get_woocommerce_currency() ).'" />';

			echo '<link itemprop="availability" href="http://schema.org/'.$product->is_in_stock() ? " " : "OutOfStock".'" />';

		echo '</div>';

		//---
		// Add to cart		function woocommerce_template_single_add_to_cart  30
		// do_action( 'woocommerce_' . $product->product_type . '_add_to_cart' );

		if ( $product->is_purchasable() ) {

			if ( $product->product_type == 'simple') {

				// Simple product add to cart
				// add-to-cart/simple.php

				// Availability
				$availability = $product->get_availability();

				$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

				echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );

				if ( $product->is_in_stock() ) {

					do_action( 'woocommerce_before_add_to_cart_form' );

					echo '<form class="cart" method="post" enctype="multipart/form-data">';

						do_action( 'woocommerce_before_add_to_cart_button' );

						if ( ! $product->is_sold_individually() ) {

							woocommerce_quantity_input( array(

								'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),

								'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),

								'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
							) );
						}

						echo '<input type="hidden" name="add-to-cart" value="'.esc_attr( $product->id ).'" />';

						echo '<button type="submit" class="single_add_to_cart_button button alt">'.esc_html( $product->single_add_to_cart_text() ).'</button>';

						echo '<div id="lcly-button-0">
						<a id="lcly-link-0" href="http://www.locally.com" target="_blank"></a>
						</div>';

						echo '<script id="lcly-script-0" src="https://uppababy.locally.com/stores/map.js?company_id=24146&style='.ltrim( $product->get_sku()).'&show_location_switcher=0&show_dealers=0&show_unauthed_dealers=1&no_link=1&button_id=HTML&company_name=UPPAbaby&button_text=FIND+IT+LOCALLY&css=2" async>
						</script>';

						do_action( 'woocommerce_after_add_to_cart_button' );

					echo '</form>';

				 	/*echo '<div style="position:absolute; right:150px;top:265px;"><a href="/warranty/"><img style="width:135px;height:135px;" src="http://uppababy.com/wp-content/uploads/2016/01/ubExtend.png"></a></div>';
					*/

					do_action( 'woocommerce_after_add_to_cart_form' );

				} else {

					echo '<form class="cart">';

						echo '<button type="submit" class="single_add_to_cart_button button alt disabled out-of-stock">Out of Stock</button>';

					echo '</form>';
				}

			} else {

				// Variable product add to cart
				// function woocommerce_variable_add_to_cart() + add-to-cart/variable.php

				// Enqueue variation scripts
				wp_enqueue_script( 'wc-add-to-cart-variation' );

				// Get Available variations?
				$get_variations = sizeof( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

				// Load the template
				//wc_get_template( 'rzt-single-variable.php', array(

				$available_variations = $get_variations ? $product->get_available_variations() : false;

				$attributes = $product->get_variation_attributes();
				$selected_attributes = $product->get_variation_default_attributes();

				$attribute_keys = array_keys( $attributes );

				do_action( 'woocommerce_before_add_to_cart_form' );

				echo '<form class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="'.absint( $product->id ).'" data-product_variations="'.htmlspecialchars( json_encode( $available_variations )) .'">';

					do_action( 'woocommerce_before_variations_form' );

					if ( empty( $available_variations ) && false !== $available_variations ) {

						echo '<p class="stock out-of-stock">'.__( "This product is currently out of stock and unavailable.", "woocommerce" ).'</p>';

					} else {
						echo '<table class="variations" cellspacing="0">
							<tbody>';

								foreach ( $attributes as $attribute_name => $options ) {

									echo '<tr>

										<!--
										<td class="label"><label for="'.sanitize_title( $attribute_name ).'">'.wc_attribute_label( $attribute_name ).'</label></td>
										-->

										<td class="value">';

											$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ?

											wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] )) :

											$product->get_variation_default_attribute( $attribute_name );

											wc_dropdown_variation_attribute_options( array(
												'options' => $options,
												'attribute' => $attribute_name,
												'product' => $product,
												'selected' => $selected,
												'show_option_none' => __('Please choose a color', 'uppababy'),
												)
											);

											/*echo end( $attribute_keys ) === $attribute_name ?
											apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#" title="reset">&nbsp;X&nbsp;</a>' ) :
											'';*/

										echo '</td>';
									echo '</tr>';
								}
							echo '</tbody>';
						echo '</table>';

						do_action( 'woocommerce_before_add_to_cart_button' );

						if ( ! $product->is_in_stock() ) {

							echo '<button type="submit" class="single_add_to_cart_button button alt disabled out-of-stock">Out of Stock</button>';

						} else {

						    echo '<div class="single_variation_wrap">';

								/*
								  Hook : woocommerce_before_single_variation
								 */
								do_action( 'woocommerce_before_single_variation' );

								/*
								  Hook : woocommerce_single_variation .
								 	to output the cart button and placeholder for variation data.

								  @hooked function : woocommerce_single_variation #10 (Empty div for variation data).

								  @hooked function : woocommerce_single_variation_add_to_cart_button #20 (Qty and cart button).
								 */
								//do_action( 'woocommerce_single_variation' );

								if ( strpos( $product->post_name, 'cruz' ) != false ) {

									$ny_css_for_color_name = 'position: absolute; top: 83px; left: 395px; text-align: center;';

								} else {

									$ny_css_for_color_name = 'position: absolute; top: 83px; left: 395px; text-align: center;';
								}

								echo '<div class="woocommerce-variation single_variation" style="'.$ny_css_for_color_name.'"></div>';

								echo '<div class="woocommerce-variation-add-to-cart variations_button">';

									if ( ! $product->is_sold_individually() ) {

										woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );
									}

									echo '<button type="submit" class="single_add_to_cart_button button alt">'.esc_html( $product->single_add_to_cart_text() ).'</button>';

									echo '<input type="hidden" name="add-to-cart" value="'.absint( $product->id ).'" />';

									echo '<input type="hidden" name="product_id" value="'.absint( $product->id ).'" />';

									echo '<input type="hidden" name="variation_id" class="variation_id" value="0" />';

									echo '<div id="lcly-button-0">
									<a id="lcly-link-0" href="http://www.locally.com" target="_blank"></a>
									</div>';

									echo '<script id="lcly-script-0" src="https://uppababy.locally.com/stores/map.js?company_id=24146&style='.ltrim( $product->get_sku()).'&show_location_switcher=0&show_dealers=0&show_unauthed_dealers=1&no_link=1&button_id=HTML&company_name=UPPAbaby&button_text=FIND+IT+LOCALLY&css=2" async>
									</script>';

								echo '</div>';

								/*
								  Hook : woocommerce_after_single_variation
								 */
								do_action( 'woocommerce_after_single_variation' );

						    echo '</div>';
						}

						do_action( 'woocommerce_after_add_to_cart_button' );
					}

					do_action( 'woocommerce_after_variations_form' );

				echo '</form>';

				/*echo '<div style="position:absolute; right:150px;top:265px;"><a href="/warranty/"><img style="width:135px;height:135px;" src="http://uppababy.com/wp-content/uploads/2016/01/ubExtend.png"></a></div>';
				*/

				do_action( 'woocommerce_after_add_to_cart_form' );

			} // End of variable product add to cart
		} else {

			echo '
			<div id="lcly-button-0">
				<a id="lcly-link-0" href="http://www.locally.com" target="_blank"></a>
			</div>

			<script id="lcly-script-0" src="https://uppababy.locally.com/stores/map.js?company_id=24146&style='.$product->get_sku().'&show_location_switcher=0&show_dealers=0&show_unauthed_dealers=1&no_link=1&button_id=HTML&company_name=UPPAbaby&button_text=FIND+IT+LOCALLY&css=2" async>
			</script>
			';

		} // End of is_purchasable


//--- uploads and assets

		echo '<div class="BUYlinks"> <!-- assets -->';

			  echo '<div class="BUYlinkBOX"><a class="BUYlink BUYmanual" href="'.rzt_get_field_with_conditional( 'download_manuel_link', $ny_product_id ).'">'.__( 'manual', 'uppababy' ).'</a></div>';

			  echo '<div class="BUYlinkBOX"><a class="BUYlink BUYvideos thickbox" href="http://www.youtube.com/embed/9a7mCy8ixPw?autoplay=1&vq=hd720&rel=0&TB_iframe=true">'.__( 'Video', 'uppababy' ).'</a></div>';

			  echo '<div class="BUYlinkBOX"><a class="BUYlink BUYbrochure" href="'.rzt_get_field_with_conditional( 'productSpecs', $ny_product_id ).'">'.__( 'spec sheet', 'uppababy' ).'</a></div>';

			  echo '<div class="BUYlinkBOX"><a class="BUYlink BUYbrochure" href="'.rzt_get_field_with_conditional( 'brochure', $ny_product_id ).'">'.__( 'brochure', 'uppababy' ).'</a></div>';

			  echo '<div class="BUYlinkBOX"><a class="BUYlink BUYcompare" href="/stroller-comparison/">'.__( 'Compare', 'uppababy' ).'</a></div>';

			  $ny_old_model_url = get_field( 'old_model_url', $ny_product_id );

			  if ( $ny_old_model_url ) {

				echo '<div class="BUYlinkBOX">

					<a class="BUYlink BUY-older-versions" href="'.$ny_old_model_url.'">Older Models</a>

				</div>
				<style>
					.rzt-stroller-shortcode .rzt-arranty-badge > a {
						right: 70px !important;
						top: -30px !important;
					}
				</style>
				';
			  }

			  echo '<div class="clear"></div>';
			  echo '<div class="dropLOW"></div>';

		echo '</div> <!-- //assets -->';

//--- Warranty badge

		echo '<div style="position:absolute; top:392px; right:152px; width:204px;"  class="rzt-arranty-badge">
		<a href="/warranty/" style="position: absolute; right: 70px; top: -75px;">
		<img src="http://uppababy.com/wp-content/uploads/2016/01/ubExtend.png" /></a>
		</div>';

//---


	echo '</div> <!-- .summary -->';


//---

	echo '<meta itemprop="url" content="'.get_the_permalink().'" />';

echo '</div><!-- #product-'.get_the_ID().' -->';

do_action( 'woocommerce_after_single_product' );
