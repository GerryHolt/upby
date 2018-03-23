<?php
	/**	   Template Name: Simplemap Retailer Locator	*/

	get_header();
?>

<div id="panels" class="rzt-retailer-locator">

	<div id="content" role="main">

		<?php while ( have_posts() ) {

			the_post(); 

			if ( has_post_thumbnail() ) { 

				//the_post_thumbnail('full');

				$ny_banner_image_id = get_post_thumbnail_id( $post->ID, 'full');

				$ny_banner_image = wp_get_attachment_image_src( $ny_banner_image_id )[0];

			} else {

				if ( function_exists('rzt_get_page_hero_banner_image') ) {
					$ny_banner_image = rzt_get_page_hero_banner_image( );
				}
			}

			if ( isset ($ny_banner_image) && $ny_banner_image != false ) {

				if ( get_field('banner_content_padding')) {
					$ny_padding = 'style="padding:'.get_field('banner_content_padding').'"';
				}

				if ( get_field('do_you_need_dark_text')) {
					$ny_dark_text = 'style="color:#666;"';
				}

				echo '<section id="hero-banner" style="background-image:url(\''.$ny_banner_image.'\'); background-size:cover;  background-repeat:no-repeat;">';

				echo '<div class="hero-content"';

				echo ' '.(isset( $ny_padding ) ? $ny_padding : '');

				echo ' '.(isset( $ny_dark_text ) ? $ny_dark_text : '');

				echo '>';

					echo get_field('banner_content');

				echo '</div>';
				echo '</section>';			
			}
		?>

		<section id="support">

			<div class="content-wrap">

				<div class="contact-box">

					<?php if( have_rows('address_box', 'option') ) {

						while( have_rows('address_box', 'option')) { the_row(); ?>

							<h3>
							<?php the_sub_field('address_header', 'option'); ?>
							</h3>

							<?php the_sub_field('address_text', 'option'); ?>

						<?php } ?>

					<?php } ?>
				</div>

				<div class="support-column">
				  <div class="support-item rzt-simplemap">

					<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>

					<div class="support-content entry-content">

						<?php the_content(); 
						
						$ny_show_the_google_map = rzt_check_if_simplemap_option_true_false ( 'show_the_google_map', $post->ID );

						$ny_show_the_search_form = rzt_check_if_simplemap_option_true_false ( 'show_the_search_form', $post->ID );

						$ny_shortcode = '[simplemap';

						//if ( isset($ny_show_the_google_map) && $ny_show_the_google_map != false ) {
						if ( $ny_show_the_google_map ) {

							//$ny_shortcode .= ' hide_map=false';

						} else {

							$ny_shortcode .= ' hide_map=true';
						}

						//if ( isset($ny_show_the_search_form) && $ny_show_the_search_form != false ) {
						if ( $ny_show_the_search_form ) {

							//$ny_shortcode .= ' hide_search=false';

						} else {

							$ny_shortcode .= ' hide_search=true';
						}


						$ny_zip_field_is_available = rzt_check_if_simplemap_option_is_set ( 'zip_field_is_available', false, $post->ID );

						$ny_city_field_is_available = rzt_check_if_simplemap_option_is_set ( 'city_field_is_available', 0, $post->ID );

						$ny_state_field_is_available = rzt_check_if_simplemap_option_is_set ( 'state_field_is_available', 0, $post->ID );


						$ny_search_fields = ' search_fields="empty';
						
						if ( isset($ny_city_field_is_available) && $ny_city_field_is_available != false ) {

							$ny_search_fields .= '||labelsp_city';

						} else {

							$ny_search_fields .= '||empty';
						}
						
						if ( isset($ny_state_field_is_available) && $ny_state_field_is_available != false ) {

							$ny_search_fields .= '||labelsp_state';

						} else {

							$ny_search_fields .= '||empty';
						}

						if ( isset($ny_zip_field_is_available) && $ny_zip_field_is_available != false ) {

							$ny_search_fields .= '||labelsp_zip';

						} else {

							$ny_search_fields .= '||empty';
						}

						$ny_search_fields .= '||empty||empty||empty||submit||empty||empty||empty"';

						$ny_shortcode .= $ny_search_fields;

						$ny_shortcode .= ' search_form_cols=4';

						$ny_shortcode .= ']';

						echo do_shortcode( $ny_shortcode );		
						
						?>
					</div>
				  </div>

				</div>

			</div>

		</section>

		<?php } ?>  <!--  // end of the loop -->

	</div>  <!-- #content -->
</div>      <!-- #panels -->

<?php get_footer(); ?>