<?php
/*
   Template Name: Spare Parts
*/

get_header();
the_post();

//--- temporary CSS

if ( isset( $_SERVER['REQUEST_URI'] ) ) {

	$ny_strpos = strpos( $_SERVER['REQUEST_URI'], 'spare-parts' );
}


$pageBannerImage = get_field('top_banner');
$global_rows = get_field('default_accessories_banner', 'options'); // get all the rows
$rand_global_row = $global_rows[ array_rand( $global_rows ) ]; // get a random row
$rand_global_row_image = $rand_global_row['accessories_banner' ]; // get the sub field value

if($pageBannerImage) {
?>
    <section id="hero-banner" style="background-image:url('<?php echo $pageBannerImage['sizes']['hero-banner']; ?>'); background-size:cover;  background-repeat:no-repeat;">

<?php } elseif($rand_global_row_image) { ?>

    <section id="hero-banner" style="background-image:url('<?php echo $rand_global_row_image['sizes']['hero-banner']; ?>'); background-size:cover;  background-repeat:no-repeat;">
<?php } ?>

</section>

<section id="sub-nav">
    <?php
        $subNav = get_field('select_sub_nav');
        wp_nav_menu(
            array(
                'menu' => $subNav,
                'container' => ''
            )
        );
    ?>
</section>

<section id="accessories-list">

    <div class="acc-logo">

        <?php $prodLogo = get_field('product_family_logo'); ?>
        <img src="<?php echo $prodLogo['url']; ?>" alt=""/>
    </div>

    <?php
		the_field('product_category_heading');

        if(get_field('category_list')) {

            while( have_rows('category_list') ) {

				the_row();

                $prodCat = get_sub_field('category_slug');
                $prodSlug = $prodCat->slug;
                $prodLabel = $prodCat->name;

                $args = array(
					'posts_per_page' => '-1',
					'product_cat' => $prodSlug,
					'post_type' => 'product',
					'orderby' => 'menu_order',
				);
	?>

	<div class="acc-section">

		<h2><?php echo $prodLabel; ?></h2>

		<?php

		$query = new WP_Query( $args );

		if( $query->have_posts() ) {

			while( $query->have_posts() ) {

				$query->the_post();
		?>
				<div class="item spare-part">

					<?php $accIMG = get_field('hero_thumbnail');?>

					<img src="<?php echo $accIMG['sizes']['acc-list-img'];?>" alt="" />

					<h4 class="title"><?php the_title(); ?></h4>

				<?php

					$ny_product_id = $product->get_id();

					if ( get_post_meta($ny_product_id, 'additional_information_simple', true) ) {

						$ny_additional_info = get_post_meta( $ny_product_id, 'additional_information_simple', true );
					
						if ( isset($ny_additional_info) && $ny_additional_info != 'Array' ) {		
							echo '<p class="rzt-cart-additional-info">';

								echo $ny_additional_info;

							echo '</p>';
						}
					}

					echo '<p class="price">';

						echo $product->get_price_html();

					echo '</p>';

						$ny_product_type = $product->get_type();

					if ( $ny_product_type == 'variable' ) {

						//wp_enqueue_script( 'wc-add-to-cart-variation' );

						$ny_color_attributes_js_object = "";
						$ny_dropdown_html_options = "";

						$available_variations = $product->get_available_variations();

						foreach ( $available_variations as $available_variation ) {

							$ny_variation_object = new WC_Product_variation( $available_variation['variation_id'] );


							if( $ny_variation_object->is_purchasable() && $ny_variation_object->is_in_stock() ) {

								$ny_add_to_cart_text_conditional = ""; //__( 'Add to cart', 'woocommerce' )

							} else {
								$ny_add_to_cart_text_conditional = "_"; //__( 'Backorder', 'woocommerce' );
							}

							if ( isset($available_variation['attributes']['attribute_uppababy-color']) ) {

								$ny_variation_color_code = $available_variation['attributes']['attribute_uppababy-color'];
							}

							//$ny_variation_color_name = $ny_variation_object->get_formatted_variation_attributes( true );

							$ny_variation_color_name = wc_get_formatted_variation( $ny_variation_object );

							$ny_variation_color_name = str_replace( 'Color: ', '', $ny_variation_color_name );
							$ny_variation_color_name = str_replace( 'uppababy-color:', '', $ny_variation_color_name );

							/*$ny_dropdown_html_options .= '<option value="'.$available_variation['variation_id']
								.'_'.$ny_variation_color_code.'">'
								.$ny_variation_color_name
							.'</option>';*/

							$ny_dropdown_html_options .= '
							<option value="'.$available_variation['variation_id'].$ny_add_to_cart_text_conditional.'">'
								.$ny_variation_color_name
							.'</option>';

							$ny_variation_price = $available_variation['price_html'];

							$ny_dropdown_data_per_product = $available_variation['variation_id'].'|' .$ny_variation_color_code.'|'.$ny_variation_color_name.'|'.$ny_variation_price;

							$ny_color_attributes_js_object .= 'ny_dropdown_data_for_all["'.$ny_product_id.'"] = "'
							.$ny_dropdown_data_per_product.'";';
						}

						/*$a_href_to_return .= '<button style="display:none;" id="'
							.esc_attr( $ny_product_id ).'" class="add_to_cart_button button" onclick=\"rzt_change_select_to_add_to_cart("'.$ny_product_id.'"); return false;\">ADD TO CART</button>'; */

						$a_href_to_return = '

						<form class="variations_form cart" method="post" enctype="multipart/form-data" id="form-'.$ny_product_id.'" name="form-'.$ny_product_id.'">

							<input type="hidden" name="quantity" value="1">

							<button type="button" class="single_add_to_cart_button button alt add_to_cart_button disabled" id="button-'.$ny_product_id.'" name="button-'.$ny_product_id.'" onclick="return false;">Choose a color</button>

							<input type="hidden" name="add-to-cart" value="'.$ny_product_id.'">

							<input type="hidden" name="product_id" value="'.$ny_product_id.'">

							<input type="hidden" name="attribute_uppababy-color" id="selected_color_for_'.$ny_product_id.'" value="">

							<input type="hidden" name="variation_id" class="variation_id" id="selected_variation_for_'.$ny_product_id.'" value="">

						</form>';

						$a_href_to_return .= '
							<div class="select-box">

								<select name="color" id="dropdown-'.$ny_product_id.'">
									<option selected="" disabled="">Select Color</option>'
									.$ny_dropdown_html_options
								.'</select>

							</div>';

						//$a_href_to_return .='<script>'.$ny_color_attributes_js_object.'</script>';
					}

					if ( $ny_product_type == 'simple' ) {

						if( $product->is_in_stock() ) {

							$ny_class = ' class="'.esc_attr( isset( $class ) ? $class : 'button product_type_simple add_to_cart_button ajax_add_to_cart' ).'"';

							$ny_onclick = ' onclick="rzt_run_the_add_to_cart_ajax( this, 0, '.esc_attr( $ny_product_id ).', '.esc_attr( isset( $quantity ) ? $quantity : 1 ).' )"';

						} else {

							$ny_class = ' class="'.esc_attr( isset( $class ) ? $class : 'button product_type_simple add_to_cart_button ajax_add_to_cart' ).' disabled out-of-stock"';

							$ny_onclick = '';
						}

						$a_href_to_return =

							'<p class="addtocart">
							  <a rel="nofollow" data-quantity="'.esc_attr( isset( $quantity ) ? $quantity : 1 )

							  .'" data-product_id="'.esc_attr( $ny_product_id )
							  .'" data-product_sku="'.esc_attr( $product->get_sku() )

							  .'"'.$ny_class.$ny_onclick.'>'

							  .esc_html( $product->add_to_cart_text() )

							.'</a>
							</p>';
					}

					echo $a_href_to_return;
				?>

				</div>
			<?php
			}
		}
		wp_reset_query();

	echo '</div>';
			}
        }
	?>
</section>

<?php get_footer(); ?>