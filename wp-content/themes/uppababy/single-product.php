<?php get_header(); the_post(); ?>

<?php
$pageBannerImage = get_field('top_banner');
$global_rows = get_field('default_accessories_banner', 'options'); // get all the rows
$rand_global_row = $global_rows[ array_rand( $global_rows ) ]; // get a random row
$rand_global_row_image = $rand_global_row['accessories_banner' ]; // get the sub field value

if($pageBannerImage) {  ?>
    <section id="hero-banner" class="acc-banner" style="background-image:url('<?php echo $pageBannerImage['sizes']['hero-banner']; ?>'); background-size:cover; background-repeat:no-repeat;">
<?php } elseif($rand_global_row_image) { ?>
    <section id="hero-banner" class="acc-banner" style="background-image:url('<?php echo $rand_global_row_image['sizes']['hero-banner']; ?>'); background-size:cover; background-repeat:no-repeat;">
<?php } ?>

</section>

<section id="sub-nav">
    <?php wp_nav_menu('menu=accessories-sub-nav&container='); ?>
</section>

<section id="acc-product">
    <div class="acc-two-col product">
        <div class="wrap clearfix">

            <div class="right-col">

                <?php if(get_field('product_gallery')) {?>

                    <div class="img-box">
                        <div id="slider" class="owl-carousel">

                        <?php  //--- slider images

							$rzt_image_counter = 0;

							while(have_rows('product_gallery')) {
								the_row();

                                $mainIMG = get_sub_field('product_image');

								if ( $rzt_image_counter == 0 ) {

									$ny_image_id = ' id="rzt_first_image"';

								} else {

									$ny_image_id = '';
								}
                                echo '<div class="projectitem rzt-carousel-image">';

                                    echo '<img'.$ny_image_id.' src="'.$mainIMG['sizes']['accessories_main'].'" />';

                                echo '</div>';

							$rzt_image_counter = 1;
							}
						?>

                        </div>

                        <div id="navigation" class="owl-carousel">

                        <?php //--- slider thumbnails

							$rzt_thumb_counter = 0;

							while(have_rows('product_gallery')) {
								the_row();

                                $thumbIMG = get_sub_field('product_image');

								if ( $rzt_thumb_counter == 0 ) {

									$ny_thumb_id = ' id="rzt_first_thumb"';

								} else {

									$ny_thumb_id = '';
								}

                                echo '<div class="projectitem rzt-carousel-thumb">';

                                    echo '<img'.$ny_thumb_id.' src="'.$thumbIMG['sizes']['accessories_thumb'].'" />';

                                echo '</div>';

								$rzt_thumb_counter = 1;
                            }
							?>
                        </div>
                    </div>

                <?php }?>

            </div>
            <div class="left-col">
                <div class="acc-product-desc">
                    <?php wc_print_notices(); ?>
                    <h2><?php the_title() ?></h2>
                    <p>
                        <?php the_field('compatibility_information'); ?>
                    </p>
                    <?php the_field('product_information'); ?>
                </div>
                <?php if(get_field('tech_specs')) { ?>
                    <div class="acc-product-extra-info">
                        <input id="tab-one" type="checkbox" name="tabs">
                        <label for="tab-one">Tech Specs</label>
                        <div class="tab-content">
                            <?php the_field('tech_specs'); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if(get_field('additional_information')) { ?>
                    <div class="acc-product-extra-info">
                        <input id="tab-two" type="checkbox" name="tabs">
                        <label for="tab-two">Additional Information</label>
                        <div class="tab-content">
                            <?php the_field('additional_information'); ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="acc-product-links">
                    <ul>
                        <?php $post_object = get_field('product_manual');
                        if( $post_object ){
                        	// override $post
                        	$post = $post_object;
                        	setup_postdata( $post );
                            $manual = get_field('product_manual');
                            ?>
                            <li><strong><a href="<?php echo $manual['url']; ?>">Download Manual ></strong></a></li>
                            <?php wp_reset_postdata();
                        } ?>
                        <?php $post_object = get_field('configuration_chart');
                        if( $post_object ){
                        	// override $post
                        	$post = $post_object;
                        	setup_postdata( $post );
                            $chart = get_field('chart_image');
                            ?>
                            <li><strong><a href="<?php echo $manual['url']; ?>">Configuration Chart ></strong></a></li>
                            <?php wp_reset_postdata();
                        } ?>
                        <?php if(get_field('older_model')) {
                            $pageLink = get_field('older_model'); ?>
                            <li><strong><a href="<?php echo $pageLink; ?>">View Older Model ></a></strong></li>
                        <?php }?>
                        <?php if(get_field('additional_urls')) {
                            while(have_rows('additional_urls')) { the_row(); ?>
                                <li><strong><a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('url_text'); ?> ></a></strong></li>
                            <?php } ?>
                        <?php }?>
                    </ul>
                </div>

				<?php

				//---
				//---
				include 'include-mini-cart-accessories.php';
				//---
				//---

				?>

            </div>
            </div>

        </div>
    </div>
</section>


<?php get_footer(); ?>
