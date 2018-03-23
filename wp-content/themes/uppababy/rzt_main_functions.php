<?php
/*
if ( !defined('ABSPATH') || !class_exists( 'WooCommerce' )) {
	exit;
}
*/
//---

if ( defined('RZT_MOBILE_CHECK') && RZT_MOBILE_CHECK === true ) {

	function rzt_header_cart_content( $fragments ) {

		global $woocommerce;

		echo '&nbsp;<a class="cart-contents" href="'.wc_get_checkout_url().'" title="">'

		.$woocommerce->cart->cart_contents_count

		.'&nbsp;&nbsp;</a>';

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;

	}
	add_filter('woocommerce_add_to_cart_fragments', 'rzt_header_cart_content');

} else {

	function rzt_header_cart_content( $fragments ) {

		global $woocommerce;

		echo '&nbsp;<a class="cart-contents" href="'
		.wc_get_checkout_url().'" title="" onclick="rzt_show_the_mini_cart_widget(); return false;">'

		.$woocommerce->cart->cart_contents_count

		.'&nbsp;&nbsp;</a>';

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;

	}
	add_filter('woocommerce_add_to_cart_fragments', 'rzt_header_cart_content');
}

//---

function rzt_remove_item_href( $cart_item_key ) {

	$ny_cart_item_key = explode( '?remove_item=', $cart_item_key );

	$ny_rest = explode( '&amp;_wpnonce', $ny_cart_item_key[1] );

	if ( $ny_rest[0] ) {
		return $ny_rest[0];

	} else {
		return $cart_item_key;
	}
}
add_filter( 'woocommerce_get_remove_url', 'rzt_remove_item_href');

//---
//---


function rzt_run_ajax_to_remove_item() {

	if( $_REQUEST["ny_cart_item_key"] ) {

		$ny_cart_item_key = sanitize_text_field( $_REQUEST["ny_cart_item_key"] );

		$cart_item_key = explode( 'http://', $ny_cart_item_key );

		$cart_item_key = $cart_item_key[1];

		echo "ny found cart item key ".$cart_item_key;

		if ( $cart_item = WC()->cart->get_cart_item( $cart_item_key ) ) {

			WC()->cart->remove_cart_item( $cart_item_key );

			$product = wc_get_product( $cart_item['product_id'] );

			$item_removed_title = apply_filters( 'woocommerce_cart_item_removed_title', $product ? $product->get_title() : __( 'Item', 'woocommerce' ), $cart_item );

			// no undo for out of stock

			if ( $product->is_in_stock() && $product->has_enough_stock( $cart_item['quantity'] ) ) {
				$removed_notice  = sprintf( __( '%s removed.', 'woocommerce' ), $item_removed_title );
				$removed_notice .= ' <a href="' . esc_url( WC()->cart->get_undo_url( $cart_item_key ) ) . '">' . __( 'Undo?', 'woocommerce' ) . '</a>';
			} else {
				$removed_notice = sprintf( __( '%s removed.', 'woocommerce' ), $item_removed_title );
			}

			wc_add_notice( $removed_notice );
		}

	}
	wp_die();
}
add_action( 'wp_ajax_rzt_ajax_to_remove_item', 'rzt_run_ajax_to_remove_item' );
add_action( 'wp_ajax_nopriv_rzt_ajax_to_remove_item', 'rzt_run_ajax_to_remove_item' );

//---

function rzt_add_to_cart_function() {

	global $woocommerce;

	$product_id 	= intval($_POST['product_id']);
	$variation_id 	= intval($_POST['variation_id']);
	$quantity 		= intval($_POST['quantity']);
	$quantity		= $quantity ? $quantity : 1;

	if($variation_id){

		$attribute_values = wc_get_product_variation_attributes($variation_id);

		$cart_success = $woocommerce->cart->add_to_cart( $product_id, $quantity, $variation_id, $attribute_values );
	}

	elseif($variation_id === 0){

		$cart_success = $woocommerce->cart->add_to_cart( $product_id, $quantity );
	}

	if($cart_success){

		$cart_item_key  = $cart_success;

		$cart_data		= $woocommerce->cart->get_cart();

		$cart_item_data = $cart_data[$cart_item_key];

		$item_cart_qty	= $cart_item_data['quantity'];

		if($variation_id) {

			$product 	= new WC_product_variation($variation_id);
			$attributes = wc_get_formatted_variation($product);
		}
		else {

			$product 	= new WC_product($product_id);
		}

		$product_title 	= $product->get_title();
		$product_price	= $product->get_price();

		$product_image 	= $product->get_image('shop_thumbnail');

		$is_sold_single = $product->is_sold_individually();

		$product_total  =  $product_price * $item_cart_qty;

		$html  = htmlentities( json_encode(array('key' => $cart_item_key, 'pname' => $product_title)) );

		$html .= '<br>'.$product_price.'<br>';

		$html .= $item_cart_qty;

		$html .= '<br>'.$product_total;

		$message = '"'.$product_title.'" added to cart.';

		$message = apply_filters( 'wc_add_to_cart_message', $message, $product_id );

		wc_add_notice( $message );

		//wp_send_json( array('pname' => $product_title , 'cp_html' => "$html" ) );

	} else {

		if(wc_notice_count('error') > 0){

			echo wc_print_notices();
		}
	}
		die();
}
add_action( 'wp_ajax_rzt_add_to_cart_action', 'rzt_add_to_cart_function' );
add_action( 'wp_ajax_nopriv_rzt_add_to_cart_action', 'rzt_add_to_cart_function' );

//---
//---

function rzt_hide_show_shopping_cart() {

	if ( defined('RZT_MOBILE_CHECK') && RZT_MOBILE_CHECK === true ) {

		echo '<script>

				//jQuery("#rzt-cart").css({display:"block"}).stop().animate({opacity:1});

				jQuery( "ul.cart_list > li.mini_cart_item:not(:last-child)" ).hide();

		</script>';
	}

	global $woocommerce;

	if( $woocommerce->cart->cart_contents_count > 0 ) {

		echo '<script>

				jQuery(".upTopNav .upShopping, #rzt-cart-top-icon").show();

		</script>';
	}
}
add_action( 'woocommerce_after_mini_cart', 'rzt_hide_show_shopping_cart');

//---

function rzt_continue_shopping_cart($message, $product_id) {

	$message = str_replace( '<a href="https://uppababy.com/cart/" class="button wc-forward">View Cart</a>', '', $message );

	return $message;
}
add_filter( 'wc_add_to_cart_message', 'rzt_continue_shopping_cart', 10, 2 );

//---

function rzt_shipping_method_label( $label, $method ) {

	if ( is_checkout() ) {

		$label = str_replace($method->get_label(), '', $label);
		$label = str_replace(':', '', $label);

	} else {

		$label = str_replace($method->get_label(), '', $label);
	}

	return $label;
}
add_filter('woocommerce_cart_shipping_method_full_label', 'rzt_shipping_method_label', 30, 2);

//---
//---

function rzt_remove_checkout_fields( $fields ) {

	unset($fields['billing']['billing_company']);
	unset($fields['shipping']['shipping_company']);

	if ( defined('RZT_MOBILE_CHECK') && RZT_MOBILE_CHECK === true ) {
		unset($fields['order']['order_comments']);
	}

	$fields['shipping']['shipping_phone'] = array(

        'label' => __('Phone', 'woocommerce'),
		'placeholder' => _x('Phone', 'placeholder', 'woocommerce'),
		'required' => false,
		'class' => array('form-row-wide'),
		'clear' => true
	);

	return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'rzt_remove_checkout_fields' );

//---

function rzt_checkout_field_admin_display( $order ){

    echo '<p><strong>'.__('Shipping Phone', 'uppababy').':</strong> ' . get_post_meta( $order->id, '_shipping_phone', true ) . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'rzt_checkout_field_admin_display', 10, 1 );

//---
//---

function rzt_get_product_id_by_slug( $product_slug ) {

  global $wpdb;

  $ny_query = $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= 'product' AND post_status = 'publish'", $product_slug );

  $product_id = $wpdb->get_var( $ny_query );

  return (int) $product_id;
}

//---
//---

function rzt_new_footer_menu() {
?>
	<div class="udClear rzt_new_footer_menu" style="clear: both;">

		<p>&nbsp;</p>

		<ul class="udClear rzt-footer-menu">

				<li><a href="https://uppababy.com/ordering-info-and-policy/" target="_blank">Ordering info</a></li>
				<li><a href=" https://uppababy.com/privacy/" target="_blank">Privacy</a></li>
				<li><a href="https://uppababy.com/terms/" target="_blank">Policies</a></li>
				<li><a href="https://uppababy.com/safety-security/" target="_blank">Safety and Security</a></li>
				<li><a href=" https://kibocommerce.com" target="_blank">Who is Kibo?</a></li>
		</ul>

		<div class="udClear"></div>
	</div>

<?php
}

//---
//---

function rzt_cart_thumbnail( $product_get_image, $cart_item, $cart_item_key ) {

	$ny_hero_thumbnail_id = get_post_meta( $cart_item['variation_id'], 'ny_hero_thumbnail_id', true );

	if ( $ny_hero_thumbnail_id ) {

		$ny_hero_thumbnail = wp_get_attachment_image_src( $ny_hero_thumbnail_id )[0];

		$product_get_image = '<img src="'.$ny_hero_thumbnail.'" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="" />';

		return $product_get_image;
	}

	$ny_product = wc_get_product( $cart_item['product_id'] );

	$ny_attachment_ids = $ny_product->get_gallery_attachment_ids();

	if ( count($ny_attachment_ids) > 0 ) {

		  $ny_classes = array( "class" => "attachment-shop_thumbnail size-shop_thumbnail wp-post-image" );

		  // wp_get_attachment_image( $ny_attachment_ids[0], array('187', '172'), "", $ny_classes );

		 $product_get_image = wp_get_attachment_image( $ny_attachment_ids[0], "", "", $ny_classes );
	}

	return $product_get_image;
}
add_filter( 'woocommerce_cart_item_thumbnail', 'rzt_cart_thumbnail', 10, 3 );

//---
//---

function rzt_force_add_to_cart_twice( $cart_item_data, $product_id ) {

	  $unique_cart_item_key = md5( microtime().rand()."rzt_cart" );

	  $cart_item_data['unique_key'] = $unique_cart_item_key;

	  return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data','rzt_force_add_to_cart_twice', 10, 2 );

//---

function rzt_add_to_cart_text_for_out_of_stock( $ny_add_to_cart_text, $ny_product ) {

	if( ! $ny_product->is_in_stock() ) {

		$ny_add_to_cart_text = 'Out of Stock';
	}

	return $ny_add_to_cart_text;
}
add_filter( 'woocommerce_product_add_to_cart_text','rzt_add_to_cart_text_for_out_of_stock', 10, 2 );

//---
//---

if ( ! function_exists( 'rzt_get_product_colors' ) ) {

	function rzt_get_product_colors( $ny_attribute ) {

		switch ( $ny_attribute ) {

			case 'ALX':				return '#dc885a';				break;

			case 'ani':				return '#F6892D';				break;

			case 'ani-orange':		return '#F6892D';				break;

			case 'austin':			return '#1A452E';				break;

			case 'BSL':				return '#327974';				break;

			case 'carbon':			return '#636466';				break;

			case 'CLN':				return '#818f84';				break;

			case 'COL':				return '#5a6a82';				break;

			case 'dennison':		return '#5F2A3A';				break;

			case 'denny':			return '#D93440';				break;

			case 'denny-red':		return '#D93440';				break;

			case 'DRW':				return '#dd733f';				break;

			case 'ella':			return '#008C7A';				break;

			case 'ella-jade':		return '#008C7A';				break;

			case 'BLK':				return '#231F20';				break;

			case 'SDL':				return '#774d2f';				break;
                
            case 'Jordan':		return '#696c73';				break;
   
            case 'JOR':		return '#696c73';				break;

			case 'espresso':		return '#473d3b';				break;

			case 'grey':			return '#989896';				break;

			case 'georgie':			return '#00B4ED';				break;

			case 'georgie-marine-blue':		return '#00B4ED';		break;

			case 'gregory':			return '#7D97A4';				break;

			case 'henry':			return '#7399B1';				break;

			case 'henry-bluemarl':	return '#7399B1';				break;

			case 'henry-coming-soon':		return '#7399B1';		break;

			case 'henry-bluemarel':	return '#7399B1';				break;

			case 'imagination-red':	return '#D93440';				break;

			case 'jake':			return '#231F20';				break;

			case 'black':			return '#231F20';				break;

			case 'jade-black':		return '#231F20';				break;

			case 'jake-black':		return '#231F20';				break;

			case 'KYL':				return '#cac745';				break;

			case 'loic':			return '#EEEDE8';				break;

			case 'lindsey':			return '#DDD2BA';				break;

			case 'maeve':			return '#b7a9c2';				break;

			case 'makena':			return '#982c6a';				break;

			case 'MAY':				return '#ddc772';				break;

			case 'maya':			return '#F2CD14';				break;

			case 'MCA':				return '#C9CACC';				break;

			case 'MYL':				return '#80abcb';				break;

			case 'OLV':				return '#c23883';				break;

			case 'pascal':			return '#C6CBCC';				break;

			case 'pascal-grey':		return '#C6CBCC';				break;

			case 'uppahaus-raspberry-purple':	return '#ba5284';	break;

			case 'sabrina':			return '#D6A5C2';				break;

			case 'saddle':			return '#4c3328';				break;

			case 'samantha':		return '#B04891';				break;

			case 'sebby':			return '#3388a4';				break;

			case 'SDY':				return '#f6d145';				break;

			case 'silver':			return '#C9CACC';				break;

			case 'taylor':			return '#003F70';				break;
                
            case 'taylor-indigo':			return '#003F70';				break;

			case 'TYL':				return '#b6cad5';				break;

			case 'white':			return '#f1eee7';				break;

			default:				return '';
		}
	}
}

//---

if ( ! function_exists( 'rzt_color_box_for_rebuild' ) ) {

	function rzt_color_box_for_rebuild( $product ) {

		// to generate color boxes using the attribute names

		if ( ! $product->get_type() == 'variable' ) {
			return;
		}

			// for variations

		$ny_hide_or_show_js_object = "";

		$available_variations = $product->get_available_variations();

		foreach ( $available_variations as $available_variation ) {

			$ny_variation_object = new WC_Product_variation( $available_variation['variation_id'] );

			$ny_variation_stock = absint( $ny_variation_object->get_stock_quantity() );

			print_r($available_variation);

			$ny_variation_color = $available_variation['attributes']['attribute_pa_uppababy-color'];

			$ny_hide_or_show_js_object .= 'ny_hide_or_show_per_variation["'.$ny_variation_color.'"] = '.$ny_variation_stock.';';
		}

		echo '<script>

			var ny_hide_or_show_per_variation = {};'
			.$ny_hide_or_show_js_object.'

		</script>';

			// for attributes

		$attributes = $product->get_variation_attributes();

		//$selected_attributes = $product->get_default_attributes();

		$attribute_keys = array_keys( $attributes );

		echo '<div id="rzt-color-boxes" class="product-colors"> <!-- variations color icons -->';

			echo '<ul class="color-select-radio-wrap">';

			foreach ( $attributes as $attribute_name => $options ) {

				foreach ( $options as $sub_attribute_name => $sub_option ) {

					$ny_product_color_code = rzt_get_product_colors( $sub_option );

					$ny_id = 'color-'.$sub_option;
			?>
					<li 
					class="rzt-color-box <?php echo $sub_option; ?>" 
					
					id="<?php echo $ny_id; ?>" 
					
					onclick="rzt_set_selected_color('<?php echo $sub_option."','".$ny_product_color_code."','#".$ny_id; ?>');">

					</li>
			<?php
				}
			}
			echo '</ul>';
		echo '</div> <!-- // variations color icons -->';

		?>
		<script>

			function rzt_set_selected_color(ny_attribute_key,ny_color_code,ny_id) {

				jQuery(".summary p.price.product-price").hide();

				jQuery('#pa_uppababy-color').val(ny_attribute_key.trim());

				//jQuery('#pa_uppababy-color').trigger('change');
				jQuery('#pa_uppababy-color').change();

				jQuery('form.variations_form').trigger('reload_product_variations');
				//jQuery('#pa_uppababy-color').trigger('chosen:updated');

				jQuery('#rzt-color-boxes input+label').css('box-shadow', '');
				jQuery(ny_id+'+label').css('box-shadow', '0 0 0 1px '+ny_color_code);


				if( ny_hide_or_show_per_variation[ny_attribute_key] == 1 ) {

					jQuery('.retailer-btn,#lcly-button-0').addClass('full');
					jQuery('.single_add_to_cart_button').hide();

				} else {

					jQuery('.retailer-btn,#lcly-button-0').removeClass('full');
					jQuery('.single_add_to_cart_button').show();
				}

			}
		</script>
		<?php
	}
}

//---


//---


//---
/**/
?>