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

$ny_classes = get_post_class( array('rzt-accessory-shortcode') );

echo '<div itemscope itemtype="'.woocommerce_get_product_schema().'" id="product-'.get_the_ID().'" class = "'.implode(" ", $ny_classes).'">';

  echo '<div class = "accContain">';

	$ny_old_id = rzt_get_page_id_from_product_id( $ny_product_id );

	$ny_accessory_title = get_the_title( $ny_old_id );
	$ny_page = get_post( $ny_old_id );

	/*if ( strpos $ny_accessory_title != 'protected' && $ny_accessory_title != 'private') {*/
	// if ( !post_password_required() )

		$ny_accessory_content = apply_filters( 'the_content', $ny_page->post_content );

	/*}*/

	if( is_page(13768) ){	// /travelsafe/

	  echo '
		<style type="text/css">
			.single-product {
				background-image: url('.$src[0] .');
				background-repeat:no-repeat;
				background-position:right top;
			}
		</style>';

	  echo '<div class="accCopy">'.$ny_accessory_content.'</div>';

	} else {

	  echo '<div class="accCopy">';

		  echo '<h1 class="agendabold" style="width:482px; margin-bottom:">';

				echo $ny_accessory_title;
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );


				if(get_field('accessory_for_text', $product_id)) {
					echo '<span class="agendalight" style="font-weight:normal; font-family:Agenda Light; font-size:15px;"><br />',the_field('accessory_for_text', $product_id),'</span>';
				} else {
					// echo '<span class="agendamedium" style="font-size:24px;"><br />This Item is Missing Compatibility Text! content-single-accessory.php</span>';
				}

// 				if(get_field('acc_for_text', $ny_old_id)) {
// 					$myStrollers = get_field('acc_for_text', $ny_old_id);
// 					echo '<span class="agendalight" style="font-weight:normal; font-family:Agenda Light; font-size:15px;"><br /> '.__("for", "uppababy").' '.$myStrollers;
// 				} else {
// 					$myStrollers = get_field('acc_for', $ny_old_id);
//
//
// 					$xy = '';
//
// 					if ( $myStrollers ) {
//
// 						foreach ($myStrollers as $s) {
//
// 							$s=strtolower($s);
//
// 							if($s != 'g-series') {
//
// 								$xy.= $s;
// 								$xy.= ', ';
// 							}
// 						}
// 					}
//
// 					$xy = strtoupper($xy);
//
// 					$xy = substr($xy, 0, -2);
//
// 					$accessory_for_what = str_lreplace2(", ", ' '.__("and", "uppababy").' ', $xy);
//
//
// 					echo '<span class="agendalight" style="font-weight:normal; font-family:Agenda Light; font-size:15px;"><br /> '.__("for", "uppababy").' '.$accessory_for_what;
// }
// 					if( is_page( array( 2569, 2907, 2948 ) )) {
//
// 						echo get_field('productYear', $ny_old_id);
// 					}
// 				echo '</span>';

				if( get_field('text_under_model', $ny_old_id) == 1){

					echo '<br />
					<span class="agendalight" style="font-weight:normal; font-family:Agenda Light; font-size:15px; display:block; margin-top:-9px">';

					echo get_field('text_under_model_txt', $ny_old_id);

					echo '</span>';
				}

		  echo '</h1> <!-- // page title -->';

		  if( get_field('dis', $ny_old_id) == 1) {

			echo '<br /><span style="color:red;font-size:16px;">*Discontinued</span>';
		  }

		  if( get_field('old_acc', $ny_old_id) == 1){

			echo '<div style="overflow:hidden; padding-bottom:8px; height:50px; margin-top:-15px;">
			<a class="link agendabold" href="'.get_field('old_acc_link', $ny_old_id).'">';

			echo get_field('old_acc_text', $ny_old_id);

			echo '</a></div>';
		   }

		  /*
		  if( get_field('hideADD', $ny_old_id) == 1){
				<style>.cartADD {display:none;}</style>
				<script>
					jQuery(function () {
						document.getElementById("findRET").className = "yellowBUY2";
					});
				</script>
		  }
		  */


	  echo $ny_accessory_content.'<br /><br />';
	  echo '<div class="udClear"></div>';

	  /*disable infant car seat base
		if (is_page(4896548)){
		}else{
		<form
	  */


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


	echo '<div class="summary entry-summary" style="float:none; width:355px; padding-top:0px;">';

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

								echo '<div class="woocommerce-variation single_variation" style="position: absolute; top: -15px; right: 25px; text-align: center;"></div>';

								echo '<div class="woocommerce-variation-add-to-cart variations_button">';

									if ( ! $product->is_sold_individually() ) {

										woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );
									}

									echo '<button type="submit" class="single_add_to_cart_button button alt">'.esc_html( $product->single_add_to_cart_text() ).'</button>';

									echo '<input type="hidden" name="add-to-cart" value="'.absint( $product->id ).'" />';

									echo '<input type="hidden" name="product_id" value="'.absint( $product->id ).'" />';

									echo '<input type="hidden" name="variation_id" class="variation_id" value="0" />';
									if( is_page(1162)) {

							        } else {
									echo '<div id="lcly-button-0">
									<a id="lcly-link-0" href="http://www.locally.com" target="_blank"></a>
									</div>';

									echo '<script id="lcly-script-0" src="https://uppababy.locally.com/stores/map.js?company_id=24146&style='.ltrim( $product->get_sku()).'&show_location_switcher=0&show_dealers=0&show_unauthed_dealers=1&no_link=1&button_id=HTML&company_name=UPPAbaby&button_text=FIND+IT+LOCALLY&css=2" async>
									</script>';
									}
								echo '</div>';


								/*
								  Hook : woocommerce_after_single_variation
								 */
								do_action( 'woocommerce_after_single_variation' );

						echo '</div>';

						do_action( 'woocommerce_after_add_to_cart_button' );
					}

					do_action( 'woocommerce_after_variations_form' );

				echo '</form>';


				do_action( 'woocommerce_after_add_to_cart_form' );

			} // End of variable product add to cart
		}

//---
//---	variations color icons and variations descriptions
// function to generate border color using the attribute name

		if ( $product->product_type == 'variable' ) {

			echo '<div id="rzt-variations-icons"> <!-- variations color icons -->';
				echo '<ul>';
				$imgSlot = 1;
				foreach ( $available_variations as $available_variation ) {

					$ny_full_size_image = wp_get_attachment_image_src( get_post_thumbnail_id( $available_variation['variation_id'] ), 'full' );
					$ny_swatch = get_field('color_images'.$imgSlot, $ny_old_id);

					echo '<li class="rzt-variation-icon">';

						echo '<a href="'.$ny_full_size_image[0].'" class="thickbox">';

							echo '<img src="'.$ny_swatch.'" class="rzt-color" rel="about-us" alt="'.$available_variation['variation_description'].'" data-zoom-image="'.$ny_full_size_image[0].'" />';

						echo '</a>';

					echo '</li>';
					$imgSlot++;
				}
				echo '</ul>';
			echo '</div> <!-- // variations color icons -->';
		}

//---  //  variations color icons and descriptions
//---


//--- download manual

		$download_manuel_link = rzt_get_field_with_conditional( 'download_manuel_link', $ny_product_id );
		$config_chart = rzt_get_field_with_conditional( 'config_chart', $ny_product_id );

		echo '<div class="BUYlinks2" style="position: initial !important;"> <!-- assets -->';

			if ( $download_manuel_link ) {

				echo '<div class="BUYlinkBOX2">';

					echo '<a href="'.$download_manuel_link.'" class="BUYlink BUYmanual">'.__("Download manual", "uppababy").'</a>';

				echo '</div>';
			}

			if ( $config_chart ){

				echo '<div class="BUYlinkBOX2">';

					echo '<a href="'.$config_chart.' class="BUYlink BUYbrochure thickbox">'.__("Configuration Chart", "uppababy").'</a>';

				echo '</div>';
			}

		echo '</div> <!-- //assets -->';

	echo '</div> <!-- .summary -->';


//---
//--- // download manual



	  /* end disable infant car seat base  */


	  echo '</div> <!-- // .accCopy -->';


	} // if( 13768 )  /travelsafe

	//---
	//---
	//---

	echo '<div class = "rzt-accessory-image-second-div">';

		//---
		// Single Product Image		function woocommerce_show_product_images #20
		// product-image.php

		// if not product page (ex : travelsafe), just add the background image from get_field('')

		echo '<div class="images_">';

			if ( has_post_thumbnail() ) {

				the_post_thumbnail('full');

				// $attachment_count = count( $product->get_gallery_attachment_ids() );
				// $gallery = $attachment_count > 0 ? '[product-gallery]' : '';
				//
				// $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
				//
				// $image = get_the_post_thumbnail(
				// 	$post->ID,
				// 	apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ),
				// 	array(
				// 		'title'	 => $props['title'],
				// 		'alt'    => $props['alt'],
				// 		'class'	 => "rzt-zoom",
				// 	)
				// );
				//
				// $ny_image_zoom = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				//
				// echo apply_filters(
				// 	'woocommerce_single_product_image_html',
				// 	sprintf(
				// 		'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s" data-zoom-image="%s">%s</a>',
				// 		esc_url( $props['url'] ),
				// 		esc_attr( $props['caption'] ),
				// 		$gallery,
				// 		$ny_image_zoom[0],
				// 		$image
				// 	),
				// 	$post->ID
				// );
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
		//---acc_2nd_img

		 if ( is_page(651981651) ) {

					echo do_shortcode( '[rzt-image-with-text]');
		} else {

			$acc_2nd_img = rzt_get_field_with_conditional( 'acc_2nd_img', $ny_product_id );

			if ( $acc_2nd_img ) {

				echo '<div class="rzt-accPIC2">';
					echo '<img src="'.$acc_2nd_img.'" />';
				echo '</div>';
			}
		}

		//--- //acc_2nd_img


	echo '</div> <!-- // .rzt-accessory-image-second-div -->';

	//---

	echo '<div class="udClear"></div>';


  echo '</div> <!-- // .accContain -->';

//---
//---bottom_image_1 - 3

	if(is_page(2359)){

		echo '</div>';
		echo '<div style="overflow:hidden;padding-left:20px;margin-bottom:40px">';
	}

	$bottom_image_1 = rzt_get_field_with_conditional( 'bottom_image_1', $ny_product_id );
	$image_description1 = rzt_get_field_with_conditional( 'image_description1', $ny_product_id );

	$bottom_image_2 = rzt_get_field_with_conditional( 'bottom_image_2', $ny_product_id );
	$image_description2 = rzt_get_field_with_conditional( 'image_description2', $ny_product_id );

	$bottom_image_3 = rzt_get_field_with_conditional( 'bottom_image_3', $ny_product_id );
	$image_description3 = rzt_get_field_with_conditional( 'image_description3', $ny_product_id );


	if ( $bottom_image_2 || $bottom_image_3 || is_page(1032) ) {

	 echo '<table cellpadding="0" cellspacing="0" style="margin-top:15px;">';

		echo '<tr valign="top">';

			echo '<td '.((is_page(1032))? 'width="300"' : "").'>';

				if ( $bottom_image_1 ) {
					echo '<img src="'.$bottom_image_1.'" class="hero-image hero1" style="margin-right:30px; margin-bottom:6px" alt="'.bloginfo( 'name' ).'" />';
				}
			echo '</td>';
			echo '<td>';

				if ( $bottom_image_2 ){
					echo '<img src="'.$bottom_image_2.'" class="hero-image hero2" style="margin-right:30px; margin-bottom:6px" />';
				}

			echo '</td>';
			echo '<td>';

				if ( $bottom_image_3 ){
					echo '<img src="'.$bottom_image_3.'" class="hero-image hero3" style="" />';
				}
			echo '</td>';

		echo '</tr>';
		echo '<tr>';

			echo '<td>';
				if ( $image_description1 ){
					echo '<div align="left"  style="font-size:13px; width:300px; margin-bottom:5px;">' .$image_description1.'</div>';
				}
			echo '</td>';
			echo '<td>';

				if ( $image_description2 ){
					echo '<div align="left"  style="font-size:13px; width:300px">' .$image_description2.'</div>';
				}
			echo '</td>';
			echo '<td>';

				echo '<div '
				.((is_page( 1032 ))? "align='right' " : "align='left' ")
				.((is_page( 1032 ))? "style='width:auto; margin-right:45px; font-size:13px'" : "style='font-size:13px; width:300px'").'>';

					 echo $image_description3;

				echo '</div>';
			echo '</td>';

		echo '</tr>';
	  echo '</table>';

	}


	/**
	 * hook : woocommerce_after_single_product_summary
	 */
	//do_action( 'woocommerce_after_single_product_summary' );


// end div lavabe udclear misy background image  na atao     margin-left: -53px;
echo '</div> <!-- div lavabe udclear -->';


	//---
	// similar
	// Single Product Up-Sells		function woocommerce_upsell_display  15
	// up-sells.php

	global $woocommerce_loop;

	if ( !$upsells = $product->get_upsells() ) {

		echo '<div class="span-21 overview last" style="margin-left:-52px;">';
			echo '<div class="prepend-1 udClear advice" style="padding-top:25px;padding-bottom:25px;/*padding-left:0px;*/">';

				echo '<h2 style="font-size:13px; margin-bottom:9px">'.__( 'You may also be interested in', 'uppababy' ).'</h2>';

				$posts = get_field('products_sim', $ny_old_id);

				if( $posts ) {

					echo '<ul class="udClear" style="margin-bottom:5px;">';

						foreach( $posts as $post) {
							setup_postdata($post);

								echo '<li>';
									echo '<a href="'.get_permalink().'" >';

										echo '<div align="center">';
											echo '<img src="'.get_field('hero_thumbnail').'" width="120" alt="'.get_the_title().'">';
										echo '</div>';

									echo '</a>';

									echo '<div align="center" style="line-height:15px;">';
										echo '<a href="'.get_permalink().'">'.get_the_title().'</a>';
								    echo '</div>';

								echo '</li>';
						}

					echo '</ul>';
					wp_reset_postdata();
				}

			echo '</div>';
		echo '</div>';

	} else {

		$args = array(
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1,
			'posts_per_page'      => 5,
			'orderby'             => 'rand',
			'post__in'            => $upsells,
			'post__not_in'        => array( $product->id ),
			'meta_query'          => WC()->query->get_meta_query()
		);

		$products                    = new WP_Query( $args );
		$woocommerce_loop['name']    = 'up-sells';
		$woocommerce_loop['columns'] = 5;

		if ( $products->have_posts() ) {

			echo '<div class="up-sells upsells products">';

				echo '<h2>'.__( 'You may also be interested in', 'uppababy' ).'</h2>';

				woocommerce_product_loop_start();

					while ( $products->have_posts() ) {

						$products->the_post();

						wc_get_template_part( 'content', 'product' );  // Template for products in loops
					}
				woocommerce_product_loop_end();

			echo '</div>';
		}
		wp_reset_postdata();
	}

//---

	echo '<meta itemprop="url" content="'.get_the_permalink().'" />';

echo '</div> <!-- #product-'.get_the_ID().' -->';

do_action( 'woocommerce_after_single_product' );

//---

//---
