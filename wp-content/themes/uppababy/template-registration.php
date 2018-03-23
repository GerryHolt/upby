<?php
/*
   Template Name: Registration
*/

get_header(); the_post(); ?>

<?php
$pageBannerImage = get_field('top_banner');
$global_rows = get_field('default_accessories_banner', 'options'); // get all the rows
$rand_global_row = $global_rows[ array_rand( $global_rows ) ]; // get a random row
$rand_global_row_image = $rand_global_row['accessories_banner' ]; // get the sub field value

if($pageBannerImage) {  ?>
    <section id="hero-banner" style="background-image:url('<?php echo $pageBannerImage['sizes']['hero-banner']; ?>'); background-size:cover;  background-repeat:no-repeat;">
<?php } elseif($rand_global_row_image) { ?>
    <section id="hero-banner" style="background-image:url('<?php echo $rand_global_row_image['sizes']['hero-banner']; ?>'); background-size:cover; background-repeat:no-repeat;">
<?php } ?>

</section>

<section id="contact">
    <div class="wrap clearfix">
        <div class="address-info">
            <div class="contact-info">
                <?php if(have_rows('address_box', 'option')) {
                    while(have_rows('address_box', 'option')) { the_row(); ?>
                        <h3><?php the_sub_field('address_header', 'option'); ?></h3>
                        <?php the_sub_field('address_text', 'option'); ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="contact-box">
        <!-- <div class="registration-box"> -->
            <?php
                $regPage = get_field('which_registration_page_is_this');

                if($regPage == 'stroller') {
                    include 'include-registration-stroller.php';
                }
                if($regPage == 'carseat') {
                    include 'include-registration-carseat.php';
                }
                if($regPage == 'accessories') {
                    include 'include-registration-accessories.php';
                }
            ?>
        </div>
        <?php if(get_field('sidebar_images')) { ?>
            <div class="did-you-know rzt-registration-sidebar">

                <?php
                if( $regPage != 'carseat' && $regPage != 'stroller') {

					while(have_rows('sidebar_images')) { the_row();?>

						<div class="dyk-item">
							<?php if(get_sub_field('sidebar_image')) {
								$subIMG = get_sub_field('sidebar_image');?>
								<img src="<?php echo $subIMG['sizes']['']; ?>" alt="<?php echo $subIMG['alt'];?>" />
							<?php }
							the_sub_field('sidebar_content');?>
						</div>
					<?php
					}

				} else if( $regPage == 'stroller') {

					// taken from the current US site //
				?>
					<style>

						 .slidingDiv, .slidingDiv2, .slidingDiv3, .slidingDiv4 {
							min-height:300px;
							padding:20px;
							margin-top:10px;
						}


						.show_hide a, .show_hide2 a, .show_hide3 a, .show_hide4 a {
							background-image: url(/wp-content/themes/UPPAbaby/images/more-link.jpg);
							background-repeat: no-repeat;
							padding-left: 11px;
							cursor: pointer;
						}

						h2{
							text-transform: uppercase;
							color: #2482B6;
							font-size: 15px;
							font-style: normal;
							font-weight: 700;
						}

						.ui-accordion-header{
							color: #79bde8;
							font-family: 'agenda-bold', Arial, Helvetica, sans-serif;
							font-size: 16px;
							font-style: normal;
							height: auto;
							line-height: 20px;
							border: none;
						}

						.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
							background-color: transparent;
							background-image: none;
						}

						.ui-accordion, ui-accordion-content{
							border: none;
						}
						.ui-accordion .ui-accordion-content {
							border: 0;
						}

						.ui-accordion .ui-accordion-icons {
							padding-left: 1.5em;
						}

						.ui-accordion .ui-accordion-content {
							font-size: 14px;
						}

						.ui-accordion .ui-accordion-header .ui-icon {
							position: relative;
							left: -5px;
							top: 0px;
							margin-top: 0px;
							float: left;
						}

						.ui-icon-triangle-1-s {
							background-position: -64px -15px;
						}

						.ui-accordion .ui-accordion-icons {
							padding-left: 0px;
						}

						#contact .did-you-know.rzt-registration-sidebar {
							width: 350px;
							background: #fff;
							padding: 0px;
						}
					</style>
					<script type="text/javascript">
					  jQuery(document).ready(function (){

						jQuery( "#accordion" ).accordion({
						  collapsible: true,
								heightStyle: "content",
								active: false
						});
					   <!-- jQuery('#accordion').accordion('activate', -1);-->
					  });
					</script>

					<div style="/*width:261px;float:left;margin-right:0px;margin-left:15px*/">

						<h2 style="margin-bottom:10px; margin-top:10px;">Where To Find Your Serial Number</h2>

						<div id="accordion" class="rzt-sidebar-accordion">
							<?php
							while( have_rows('sidebar_images') ) {
								the_row();

								if( get_sub_field('sidebar_title') ) {
									echo '<h4>'.get_sub_field('sidebar_title').'</h4>';
								}

								echo '<div class="dyk-item">';
									if( get_sub_field('sidebar_content') ) {
										echo '<h4>'.get_sub_field('sidebar_content').'</h4>';
									}

									if( get_sub_field('sidebar_image') ) {

										$subIMG = get_sub_field('sidebar_image');

										echo '<img src="'.$subIMG['sizes']['medium_large'].'" alt="'.$subIMG['alt'].'" style="border: 0px; margin:20px 0px;" width="200" />';
									}
								echo '</div>';
							}
							?>

						  </div>
					  </div>
				<?php

				} else if( $regPage == 'carseat' ) {
				?>
					<style> /* styles taken from the current US site */

						h2{
							text-transform: uppercase;
							color: #2482B6;
							font-size: 15px;
							font-style: normal;
							font-weight: 700;
						}
						.ui-accordion-header{
							color: #79bde8;
							font-family: 'agenda-bold', Arial, Helvetica, sans-serif;
							font-size: 16px;
							font-style: normal;
							height: auto;
							line-height: 20px;
							border: none;
						}
						.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
							background-color: transparent;
							background-image: none;
						}
						.ui-accordion, .ui-accordion-content {
							border: none;
						}
						.ui-accordion .ui-accordion-content {
							border: 0;
						}
						.ui-accordion .ui-accordion-icons {
							padding-left: 1.5em;
						}
						.ui-accordion .ui-accordion-content {
							font-size: 14px;
						}
						.ui-accordion .ui-accordion-header .ui-icon {
							position: relative;
							left: -5px;
							top: 0px;
							margin-top: 0px;
							float: left;
						}
						.ui-icon-triangle-1-s {
							background-position: -6px 0px;
						}
						.ui-accordion .ui-accordion-icons {
							padding-left: 0px;
						}

						#contact .did-you-know.rzt-registration-sidebar {
							width: 350px;
							background: #fff;
							padding: 0px;
						}

					</style>

					<div style="width:261px;float:left;margin-right:0px;margin-left:15px">


						<h2 style="margin-bottom:10px">Where To Find Your Serial Number</h2>

						<div id="accordion">
							<?php
							while(have_rows('sidebar_images')) {
								the_row();

								echo '<div class="dyk-item">';

									if( get_sub_field('sidebar_content') ) {
										echo '<h4>'.get_sub_field('sidebar_content').'</h4>';
									}

									if( get_sub_field('sidebar_image') ) {

										$subIMG = get_sub_field('sidebar_image');

										echo '<img src="'.$subIMG['sizes']['medium_large'].'" alt="'.$subIMG['alt'].'" style="border: 0px; margin:20px 0px;" width="200" />';
									}

								echo '</div>';
							}
							?>

						  </div>
					  </div>
				<?php } ?>

            </div>
        <?php } ?>
    </div>
</section>

<?php get_footer(); ?>
