<?php
/*
   Template Name: Support
*/

get_header(); the_post(); ?>

<?php
$pageBannerImage = get_field('banner_image');
$global_rows = get_field('default_accessories_banner', 'options'); // get all the rows
$rand_global_row = $global_rows[ array_rand( $global_rows ) ]; // get a random row
$rand_global_row_image = $rand_global_row['accessories_banner' ]; // get the sub field value
if(get_field('select_gradient_direction')) {
    $gradient = get_field('select_gradient_direction');
}
if($pageBannerImage) {  ?>
    <section id="hero-banner" class="<?php echo $gradient; ?>" style="background-image:url('<?php echo $pageBannerImage['sizes']['hero-banner'] ?>'); background-size:cover;  background-repeat:no-repeat;">
        <div class="hero-content" <?php if(get_field('banner_content_padding')) {?>style="padding:<?php the_field('banner_content_padding');?>;" <?php } ?> <?php if( get_field('do_you_need_dark_text')){ ?>style="color:#666;"<?php } ?>>
            <?php the_field('banner_content'); ?>
        </div>
<?php } elseif($rand_global_row_image) { ?>
    <section id="hero-banner" class="<?php echo $gradient; ?>" style="background-image:url('<?php echo $rand_global_row_image['sizes']['hero-banner'] ?>'); background-size:cover; background-repeat:no-repeat;">
        <div class="hero-content" <?php if(get_field('banner_content_padding')) {?>style="padding:<?php the_field('banner_content_padding');?>;" <?php } ?> <?php if( get_field('do_you_need_dark_text')){ ?>style="color:#666;"<?php } ?>>
            <?php the_field('banner_content'); ?>
        </div>
<?php } ?>

</section>

<section id="support">
    <div class="content-wrap">
        <div class="contact-box">
            <?php if(have_rows('address_box', 'option')) {
                while(have_rows('address_box', 'option')) { the_row(); ?>
                    <h3><?php the_sub_field('address_header', 'option'); ?></h3>
                    <?php the_sub_field('address_text', 'option'); ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="support-column">
            <?php if(get_field('support_grid')) { ?>
                <div class="support-list">
                    <ul class="support-item">
                        <?php while(have_rows('support_grid')) { the_row(); ?>
                            <li>
                                <a href="<?php the_sub_field('support_url'); ?>">
                                    <?php $supportIMG = get_sub_field('support_image'); ?>
                                    <img src="<?php echo $supportIMG['sizes']['support-image']; ?>" alt="<?php echo $supportIMG['alt']; ?>" class="title-img" />
                                    <h4><?php the_sub_field('support_title'); ?></h4>
                                    <p>
                                        <?php the_sub_field('support_info'); ?>
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if(get_field('distributor_information')) { ?>
                <div class="support-content">
                    <div class="distributor-row">
                        <?php while(have_rows('distributor_information')) { the_row(); ?>
                            <h2><?php the_sub_field('distributor_country'); ?></h2>
                            <?php if(get_sub_field('country_details')): ?>    
                                <p><i><?php the_sub_field('country_details'); ?></i></p>
                            <?php endif; ?>
                            <p class="name"><b><?php the_sub_field('distributor_name'); ?></b></p>
                            <p class="address"><?php the_sub_field('distributor_address'); ?></p>
                            <?php if(get_sub_field('distributor_phone_number')): ?>
                                <p class="phone"><b>Phone: </b><?php the_sub_field('distributor_phone_number'); ?></p>
                            <?php endif; ?>
                            <?php if(get_sub_field('distributor_fax')): ?>
                                <p class="fax"><b>Fax: </b><?php the_sub_field('distributor_fax'); ?></p>
                            <?php endif; ?>
                            <?php if(get_sub_field('distributor_email')): ?>
                                <p class="email"><b>Email: </b><?php the_sub_field('distributor_email'); ?></p>
                            <?php endif; ?>
                            <div class="inquiries">
                                <?php the_sub_field('customer_inquiries'); ?>
                            </div>
                            <?php if(get_sub_field('extra_information')): ?>
                                <?php while(have_rows('extra_information')) { the_row(); ?>
                                    <p class="sub-header"><b><?php the_sub_field('content_header'); ?></b></p>
                                    <p class="sub-details"><?php the_sub_field('content_details'); ?></p>
                                <?php } ?>
                            <?php endif; ?>
                            <?php if(get_sub_field('distributor_url')): ?>
                                <p class="url"><b>URL: </b><a href="<?php the_sub_field('distributor_url'); ?>" target="_blank"><?php the_sub_field('distributor_url'); ?></a></p>
                            <?php endif; ?>
                            <hr />
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if(get_field('content')) { ?>
                <div class="support-content">
                    <?php the_field('content'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
