<?php
/*
   Template Name: Overview
*/

get_header(); the_post(); ?>



<?php $bannerImg = get_field('banner_image'); ?>
<?php if(get_field('select_gradient_direction')) {
    $gradient = get_field('select_gradient_direction');
} ?>
<section id="overview-banner" class="<?php echo $gradient; ?>" style="background-image:url('<?php echo $bannerImg['sizes']['hero-banner'] ?>'); background-size:cover; height:520px; width:1024px; background-repeat:no-repeat;">
    <div class="hero-content" <?php if(get_field('banner_content_padding')) {?>style="padding:<?php the_field('banner_content_padding');?>;" <?php } ?> <?php if( get_field('do_you_need_dark_text')){ ?>style="color:#666;"<?php } ?>>
        <?php if(get_field('banner_youtube')) {
            $bannerYoutube = get_field('banner_youtube');?>
            <a href="https://www.youtube.com/watch?v=<?php the_field('banner_youtube_id'); ?>" class="popup-youtube"><img src="<?php echo $bannerYoutube['url'] ?>" /></a>
        <?php } ?>
        <?php the_field('banner_content'); ?>
    </div>
</section>
<?php $mobileBanner = get_field('mobile_banner');
      $bannerOverlay = get_field('mobile_banner_overlay'); ?>
<section id="mobile-banner" style="background-image:url('<?php echo $mobileBanner['sizes']['mobile-image']; ?>'); background-size:cover; width:100%; background-repeat:no-repeat; position:relative; z-index:1; height:190px;">
    <div class="mobile-overlay">
        <img src="<?php echo $bannerOverlay['sizes']['mobile-image']; ?>" style="position:absolute; bottom:20px; left:30px; z-index:2; max-width:200px;"/>
    </div>
</section>

<?php
    $needSubNav = get_field('select_sub_nav');
    if($needSubNav != 'none') { ?>
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
<?php }?>

<section id="panels">

    <?php if( have_rows('panel')) {
        while(have_rows('panel')) { the_row();
            if( get_row_layout() == 'image_only' ) { ?>
                <div class="image-only panel">
                    <?php $panelImg = get_sub_field('panel_image'); ?>
                    <div class="wrap clearfix">
                        <a href="<?php the_sub_field('image_url'); ?>"><img src="<?php echo $panelImg['sizes']['full-column'] ?>" alt="naturally fire retardant" /></a>
                    </div>
                </div>
            <? } /* close image_only */
            if( get_row_layout() == 'two_column_panel' ) { ?>
                <div class="two-column panel">
                    <div class="wrap clearfix">
                        <?php if(get_sub_field('optional_background')) {
                            $panelBG = get_sub_field('optional_background')?>
                            <div class="two-col-bg" style="background-image:url('<?php echo $panelBG['url']; ?>'); min-height:<?php echo $panelBG['height']; ?>px; padding-top:<?php the_sub_field('top_padding');?>px; background-position:<?php the_sub_field('background_alignment'); ?>;">
                        <?php } else { ?>
                            <div class="two-col-bg">
                        <?php } ?>
                            <div class="left-col" <?php if(get_sub_field('left_side_padding')) { ?>style="padding:<?php the_sub_field('left_side_padding'); ?>;" <?php }?>>
                                <?php if( have_rows('left_side')) {
                                    while(have_rows('left_side')) { the_row(); ?>
                                        <?php if( get_row_layout() == 'select_image_left' ) { ?>
                                            <div class="left-item" <?php if(get_sub_field('image_padding')) { ?>style="padding:<?php the_sub_field('image_padding'); ?>;" <?php }?>>
                                                <?php if(get_sub_field('image_url')) { ?>
                                                    <?php $loneImg = get_sub_field('image_left'); ?>
                                                    <a href="<?php the_sub_field('image_url'); ?>"><img src="<?php echo $loneImg['url'] ?>" /></a>
                                                <?php } else {?>
                                                    <?php $loneImg = get_sub_field('image_left'); ?>
                                                    <img src="<?php echo $loneImg['url'] ?>" />
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if( get_row_layout() == 'select_youtube_left' ) { ?>
                                            <div class="left-item" <?php if(get_sub_field('youtube_padding')) { ?>style="padding:<?php the_sub_field('youtube_padding'); ?>;" <?php }?>>

                                                    <?php $Img = get_sub_field('youtube_image_left'); ?>
                                                    <a href="https://www.youtube.com/watch?v=<?php the_sub_field('youtube_id_left'); ?>" class="popup-youtube"><img src="<?php echo $Img['url'] ?>" /></a>

                                            </div>
                                        <?php } ?>
                                        <?php if( get_row_layout() == 'select_content_left' ) { ?>
                                            <div class="left-item" <?php if(get_sub_field('content_padding')) { ?>style="padding:<?php the_sub_field('content_padding'); ?>;" <?php }?>>
                                                <div class="left-content">
                                                    <?php the_sub_field('content_left'); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php }
                                } ?>
                            </div>
                            <div class="right-col" <?php if(get_sub_field('right_side_padding')) { ?>style="padding:<?php the_sub_field('right_side_padding'); ?>;" <?php }?>>
                                <?php if( have_rows('right_side')) {
                                    while(have_rows('right_side')) { the_row(); ?>
                                        <?php if( get_row_layout() == 'select_image_right' ) { ?>
                                            <div class="right-item" <?php if(get_sub_field('image_padding')) { ?>style="padding:<?php the_sub_field('image_padding'); ?>;" <?php }?>>
                                                <?php if(get_sub_field('image_url')) { ?>
                                                    <?php $loneImg = get_sub_field('image_right'); ?>
                                                    <a href="<?php the_sub_field('image_url'); ?>"><img src="<?php echo $loneImg['url'] ?>" /></a>
                                                <?php } else {?>
                                                    <?php $loneImg = get_sub_field('image_right'); ?>
                                                    <img src="<?php echo $loneImg['url'] ?>" />
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if( get_row_layout() == 'select_youtube_left' ) { ?>
                                            <div class="right-item" <?php if(get_sub_field('youtube_padding')) { ?>style="padding:<?php the_sub_field('youtube_padding'); ?>;" <?php }?>>
                                                <?php $Img = get_sub_field('youtube_image_right'); ?>
                                                <a href="https://www.youtube.com/watch?v=<?php the_sub_field('youtube_id_right'); ?>" class="popup-youtube"><img src="<?php echo $Img['url'] ?>" /></a>
                                            </div>
                                        <?php } ?>
                                        <?php if( get_row_layout() == 'select_content_right' ) { ?>
                                            <div class="right-item" <?php if(get_sub_field('content_padding')) { ?>style="padding:<?php the_sub_field('content_padding'); ?>;" <?php }?>>
                                                <div class="right-content">
                                                    <?php the_sub_field('content_right'); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }  /* close two_column_panel */
            if( get_row_layout() == 'three_column_background' ) { ?>
                <div class="three-column-bg panel">
                    <div class="wrap clearfix">
                        <div class="left-col">
                            <?php if( have_rows('left_side')) {
                                while(have_rows('left_side')) { the_row(); ?>
                                    <?php if( get_row_layout() == 'select_image_left' ) { ?>
                                        <div class="left-item">
                                            <?php if(get_sub_field('image_url')) { ?>
                                                <?php $loneImg = get_sub_field('image_left'); ?>
                                                <a href="<?php the_sub_field('image_url'); ?>"><img src="<?php echo $loneImg['url'] ?>" /></a>
                                            <?php } else {?>
                                                <?php $loneImg = get_sub_field('image_left'); ?>
                                                <img src="<?php echo $loneImg['url'] ?>" />
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <?php if( get_row_layout() == 'select_youtube_left' ) { ?>
                                        <div class="left-item">
                                            <div class="left-content">
                                                <?php $Img = get_sub_field('youtube_image_left'); ?>
                                                <a href="https://www.youtube.com/watch?v=<?php the_sub_field('youtube_id_left'); ?>" class="popup-youtube"><img src="<?php echo $Img['url'] ?>" /></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if( get_row_layout() == 'select_content_left' ) { ?>
                                        <div class="left-item">
                                            <div class="left-content">
                                                <?php the_sub_field('content_left'); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php }
                            } ?>
                        </div>
                        <div class="right-col">
                            <?php $threebgImg = get_sub_field('right_background'); ?>
                            <div class="right-bg" style="background-image:url('<?php echo $threebgImg['sizes']['three-col-bg'] ?>'); background-repeat:no-repeat;  background-position: right; min-height:<?php echo $threebgImg['height']; ?>px;" >
                                <?php if( have_rows('center')) {
                                    while(have_rows('center')) { the_row(); ?>
                                        <?php if( get_row_layout() == 'select_image_center' ) { ?>
                                            <div class="right-item">
                                                <?php if(get_sub_field('image_url')) { ?>
                                                    <?php $loneImg = get_sub_field('image_center'); ?>
                                                    <a href="<?php the_sub_field('image_url'); ?>"><img src="<?php echo $loneImg['url'] ?>" /></a>
                                                <?php } else {?>
                                                    <?php $loneImg = get_sub_field('image_center'); ?>
                                                    <img src="<?php echo $loneImg['url'] ?>" />
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if( get_row_layout() == 'select_youtube_center' ) { ?>
                                            <div class="right-item">
                                                <?php $Img = get_sub_field('youtube_image_center'); ?>
                                                <a href="https://www.youtube.com/watch?v=<?php the_sub_field('youtube_id_center'); ?>" class="popup-youtube"><img src="<?php echo $Img['url'] ?>" /></a>
                                            </div>
                                        <?php } ?>
                                        <?php if( get_row_layout() == 'select_content_center' ) { ?>
                                            <div class="right-item">
                                                <div class="right-content">
                                                    <?php the_sub_field('content_center'); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } /* close three column bg */
            if( get_row_layout() == 'half-column-with-bg' ) { ?>
                <?php $panelBgImg = get_sub_field('background_image'); ?>
                <div class="half-column-with-bg panel" style="background-image:url('<?php echo $panelBgImg['sizes']['full-column'] ?>'); background-size:cover; width:1024px; background-repeat:no-repeat;">
                    <div class="wrap clearfix">
                        <?php the_sub_field('content'); ?>
                        <?php $youtubeImg = get_sub_field('youtube_video_image');?>
                        <a href="https://www.youtube.com/watch?v=<?php the_sub_field('youtube_video_id'); ?>" class="popup-youtube" style="padding-left:15px;"><img src="<?php echo $youtubeImg['url'] ?>" /></a>
                    </div>
                </div>
            <?php } /* close half-column-with-bg */
            if( get_row_layout() == 'performance_panel' ) { ?>
                <?php $performanceImg = get_sub_field('performance_background_image'); ?>
                <div class="performance-system panel" style="background-image:url('<?php echo $performanceImg['sizes']['full-column'] ?>'); background-size:cover; width:1024px; background-repeat:no-repeat;">
                    <div class="wrap clearfix">
                        <?php the_sub_field('performance_top_content');?>
                        <div class="performance-last">
                            <?php the_sub_field('performance_bottom_content');?>
                        </div>

                    </div>
                </div>
            <?php } /* close performance_panel */
        } /* close panel while */
    } /* close panel if */ ?>
</section>

<section id="panels-mobile">
    <?php $counter = 1;
    if(have_rows('mobile_content')) {
        while(have_rows('mobile_content')) { the_row();
            if( get_row_layout() == 'images' ) { ?>
                <div class="image-only-m panel-m" style="padding:<?php the_sub_field('padding');?>; margin-top:<?php the_sub_field('negative_margin');?>;">
                    <?php $imgMobile = get_sub_field('image-mobile');
                    if(get_sub_field('image_url')) { ?>
                        <a href="<?php the_sub_field('image_url'); ?>"><img src="<?php echo $imgMobile['sizes']['mobile-image']; ?>" alt="<?php echo $imgMobile['alt']; ?>" /></a>
                    <?php } else { ?>
                        <img src="<?php echo $imgMobile['sizes']['mobile-image']; ?>" alt="<?php echo $imgMobile['alt']; ?>" />
                    <?php } ?>
                </div>
            <?php } // close mobile image only
            if( get_row_layout() == 'text_content' ) { ?>
                <div class="text-content-m panel-m" style="margin-top:<?php the_sub_field('negative_margin');?>;">
                    <?php the_sub_field('content'); ?>
                </div>
            <?php } // close text_content
            if( get_row_layout() == 'youtube' ) { ?>
                <div class="youtube-m panel-m" style="padding:<?php the_sub_field('padding');?>; margin-top:<?php the_sub_field('negative_margin');?>;">
                    <?php $youtubeMobile = get_sub_field('youtube_thumbnails');?>
                    <a href="https://www.youtube.com/watch?v=<?php the_sub_field('youtube_id'); ?>" class="popup-youtube"><img src="<?php echo $youtubeMobile['url'] ?>" /></a>
                </div>
            <?php } // close youtube
            if( get_row_layout() == 'background_with_text' ) { ?>
                <?php $bgImg = get_sub_field('background_image'); ?>
                <div class="background-text-m panel-m" style="background-image:url('<?php echo $bgImg['sizes']['mobile-image'];?>'); background-position:<?php the_sub_field('background_alignment'); ?>; background-size: 50%">
                    <div style="padding:<?php the_sub_field('text_padding');?>">
                        <?php the_sub_field('text'); ?>
                    </div>
                </div>
            <?php } // close background with text
            if( get_row_layout() == 'video_slider' ) { ?>
                <?php if (get_sub_field('slide')) { ?>
                    <div class="video-slider-m mobile-info owl-carousel owl-theme panel-m">
                        <?php while(have_rows('slide')) { the_row();
                            $vidImg = get_sub_field('youtube_thumbnail');  ?>
                            <div class="item">
                                <?php if(get_sub_field('video_id')) { ?>
                                    <a href="https://www.youtube.com/watch?v=<?php the_sub_field('video_id'); ?>" class="popup-youtube"><img src="<?php echo $vidImg['sizes']['mobile-image']; ?>" alt="<?php echo $vidImg['alt']; ?>" /></a>
                                <?php } else { ?>
                                    <img src="<?php echo $vidImg['sizes']['mobile-image']; ?>" alt="<?php echo $vidImg['alt']; ?>" />
                                <?php } ?>
                                <div class="slide-text">
                                    <?php the_sub_field('content'); ?>
                                </div>
                                <?php if(get_sub_field('button_text')) { ?>
                                    <div class="event-btn">
                                        <a href="<?php the_sub_field('button_url'); ?>"><?php the_sub_field('button_text'); ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php }?>
            <?php } // close video slider
            if( get_row_layout() == 'accordion_content' ) { ?>
                <div class="accordion-m">
                    <div class="acc-product-extra-info">
                        <input id="tab-<?php echo $counter;?>" type="checkbox" name="tabs">
                        <label for="tab-<?php echo $counter;?>"><?php the_sub_field('accordion_label'); ?></label>
                        <div class="tab-content">
                            <?php the_sub_field('content'); ?>
                        </div>
                    </div>
                </div>
                <?php $counter++;?>
            <?php } // close accordion
            if( get_row_layout() == 'slider_content' ) { ?>
                <?php if (get_sub_field('slider')) { ?>
                    <div class="slider-m mobile-info owl-carousel owl-theme panel-m">
                        <?php while(have_rows('slider')) { the_row(); ?>
                            <?php if(get_row_layout() == 'images_slides' ) { ?>
                                <div class="item">
                                    <?php $mobileSlide = get_sub_field('slider_image_real'); ?>?>
                                    <img src="<?php echo $mobileSlide['sizes']['mobile-image']; ?>" alt="<?php echo $mobileSlide['alt']; ?>" /></a>
                                </div>
                            <?php }
                            if(get_row_layout() == 'text_slides' ) {?>
                                <div class="item">
                                    <?php the_sub_field('slider_image'); ?>
                                </div>

                            <?php }?>

                        <?php } ?>
                    </div>
                <?php }?>
            <?php } // close Slider
            if( get_row_layout() == 'spacers' ) { ?>
                <div class="spacers-m" style="padding-top:<?php the_sub_field('spacer'); ?>"></div>
            <?php } // close spacers ?>
        <?php } //close mobile_content while ?>
    <?php } //close mobile_content if ?>
</section>

<?php if(get_field('ny_related_product_to_display')) { ?>
    <?php include 'include-mini-cart.php' ?>
<?php }?>

<?php if(have_rows('bottom_links')) { ?>
    <section id="mobile-links">
        <?php while(have_rows('bottom_links')) { the_row();?>
            <div class="link">
                <a href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_text'); ?></a>
            </div>
        <?php } ?>
    </section>
<?php } ?>

<?php get_footer(); ?>
