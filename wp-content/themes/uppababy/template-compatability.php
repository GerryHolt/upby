<?php
/*
   Template Name: Compatability
*/
get_header(); the_post(); ?>

<?php $pageBannerImage = get_field('top_banner');
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

<section id="compat-chart">
    <?php if(have_rows('chart')) {
        $counterOut = 1;
        $counterIn = 20;?>
        <h2>Compatability Chart</h2>
        <?php the_field('instructions') ?>
        <?php while(have_rows('chart')) { the_row(); ?>
            <div class="acc-product-extra-info">
                <input id="tab-<?php echo $counterOut; ?>" type="checkbox" name="tabs">
                <label for="tab-<?php echo $counterOut; ?>">Upper Seat <?php the_sub_field('upper_seat_name') ?></label>
                <div class="tab-content">
                    <?php if(have_rows('you_will_need_upper')) {  ?>
                        <h3>Upper Seat Adapter</h3>
                        <div class="upper-list">
                            <?php while(have_rows('you_will_need_upper')) { the_row();
                                $upperImg = get_sub_field('image'); ?>
                                <div class="upper-item">
                                    <img src="<?php echo $upperImg['url'];?>" />
                                    <h4><?php the_sub_field('name'); ?></h4>
                                    <?php the_sub_field('description'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if(have_rows('lower_seat_options')) {
                        while(have_rows('lower_seat_options')) { the_row(); ?>
                            <input id="tab-in-<?php echo $counterIn; ?>" type="checkbox" name="tabs">
                            <label for="tab-in-<?php echo $counterIn; ?>">Lower Seat <?php the_sub_field('lower_seat_name') ?></label>
                            <?php $counterIn++; ?>
                            <div class="tab-content-inner">
                                <?php if(have_rows('lower_you_will_need')) { ?>
                                    <h3>Lower Seat Adapter</h3>
                                    <div class="lower-list">
                                        <?php while(have_rows('lower_you_will_need')) { the_row();
                                            $lowerImg = get_sub_field('lower_image');?>
                                            <div class="lower-item">
                                                <img src="<?php echo $lowerImg['url'];?>" />
                                                <h4><?php the_sub_field('lower_title'); ?></h4>
                                                <?php the_sub_field('lower_description'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php }?>
                            </div>
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>
            <?php $counterOut++;
        } ?>
    <?php } ?>
</section>

<?php get_footer(); ?>
