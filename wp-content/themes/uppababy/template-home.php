<?php
/*
   Template Name: Home
*/

get_header(); the_post(); ?>

<section id="home-carousel">

    <div class="owl-carousel home-slider owl-theme">
        <?php if (get_field('slides')) {
            while(have_rows('slides')) { the_row();
                $heroSlide = get_sub_field('slide_image'); ?>
                <div class="item">
                    <?php if(get_sub_field('slide_link')) { ?>
                        <a href="<?php the_sub_field('slide_link'); ?>"><img src="<?php echo $heroSlide['sizes']['hero-banner']; ?>" alt="<?php echo $heroSlide['alt']; ?>" /></a>
                    <?php } else {?>
                        <img src="<?php echo $heroSlide['sizes']['hero-banner']; ?>" alt="<?php echo $heroSlide['alt']; ?>" />
                    <?php }?>
                </div>
            <?php } ?>
        <?php }?>
    </div>
</section>
<?php if ( is_user_logged_in() ) {
    $geo = WPEngine\GeoIp::instance();
    $country = getenv('HTTP_GEOIP_COUNTRY_CODE');
        printr($country);
  } else {
    // your code for logged out user
  }
 ?>

<section id="home-promos">
    <div class="promo1">
        <?php
            $promoTop = get_field('promo_top');
            $promoBottom = get_field('promo_bottom');
        ?>
        <a href="<?php the_field('promo_top_url'); ?>"><img src="<?php echo $promoTop['sizes']['home-half-promo']; ?>" alt="<?php echo $promoTop['alt']; ?>" class="top-promo" /></a>
        <a href="<?php the_field('promo_bottom_url'); ?>" class="bottom-promo"><img src="<?php echo $promoBottom['sizes']['home-half-promo']; ?>" alt="<?php echo $promoBottom['alt']; ?>" class="bottom-promo" /></a>
    </div>
    <div class="promo2">
        <img src="/ui/images/UbUGC_Homepage_hdr.png" alt="Be part of the UPPAbaby Family" style="padding-bottom:7px;">
        <div class="IGfeed"><?php echo do_shortcode('[instagram-feed]') ?></div>
    </div>
    <div class="promo3">

        <?php
            $rightTop = get_field('right_promo_top');
            $rightBottom = get_field('right_promo_bottom');
        ?>
        <?php if(get_field('right_promo_video_id')) { ?>
            <a href="https://www.youtube.com/watch?v=<?php the_field('right_promo_video_id'); ?>" class="popup-youtube"><img src="<?php echo $rightTop['sizes']['home-right-top-promo'] ?>" alt="<?php echo $rightTop['alt'] ?>" style="padding-bottom:10px;" /></a>
        <?php }else if(get_field('right_promo_url')){ ?>
            <a href="<?php the_field('right_promo_url'); ?>"><img src="<?php echo $rightTop['sizes']['home-right-top-promo'] ?>" alt="<?php echo $rightTop['alt'] ?>" style="padding-bottom:10px;" /></a>
        <?php }else{ ?>
            <img src="<?php echo $rightTop['sizes']['home-right-top-promo'] ?>" alt="<?php echo $rightTop['alt'] ?>" style="padding-bottom:10px;" />
        <?php } ?>
        <a href="<?php the_field('right_promo_bottom_url'); ?>"><img src="<?php echo $rightBottom['sizes']['home-right-bot-promo'] ?>" alt="<?php echo $rightBottom['alt'] ?>" /></a>
    </div>
</section>

<section id="mobile-home">
    <?php if(have_rows('mobile_promo_images')) {
        while(have_rows('mobile_promo_images')) { the_row();
            $mobilePromo = get_sub_field('promo_image'); ?>
            <div class="mobile-promos">
                <?php if(get_sub_field('promo_url')) {?>
                        <a href="<?php the_sub_field('promo_url'); ?>"><img src="<?php echo $mobilePromo['sizes']['mobile-image']; ?>" alt="<?php echo $mobilePromo['alt']; ?>" /></a>
                <?php } else { ?>
                    <img src="<?php echo $mobilePromo['sizes']['mobile-image']; ?>" alt="<?php echo $mobilePromo['alt']; ?>" />
                <?php } ?>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="promo3">
        <?php
            $rightTop = get_field('right_promo_top');
            $rightBottom = get_field('right_promo_bottom');
        ?>
        <a href="https://www.youtube.com/watch?v=<?php the_field('right_promo_video_id'); ?>" class="popup-youtube"><img src="<?php echo $rightTop['sizes']['home-right-top-promo'] ?>" alt="<?php echo $rightTop['alt'] ?>" /></a>
    </div>
    <div class="tune-up-promo">
        <?php the_field('tune_up_content');?>
        <div class="event-btn">
            <a href="<?php the_field('tune_up_url'); ?>"><?php the_field('tune_up_button_text'); ?></a>
        </div>
    </div>
    <div class="alert">
        <?php $alertImg = get_field('alert_images'); ?>
        <a href="<?php the_field('tune_up_url'); ?>"><img src="<?php echo $alertImg['sizes']['mobile-image']; ?>" alt="<?php echo $alertImg['alt']; ?>" /></a>
    </div>
    <div class="register">
        <a href="<?php the_field('register_url'); ?>"><?php the_field('register_text'); ?></a>
    </div>
</section>
<?php get_footer(); ?>
