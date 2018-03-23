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

if($pageBannerImage) {  ?>
    <section id="hero-banner" style="background-image:url('<?php echo $pageBannerImage['sizes']['hero-banner'] ?>'); background-size:cover;  background-repeat:no-repeat;">
        <div class="hero-content" <?php if(get_field('banner_content_padding')) {?>style="padding:<?php the_field('banner_content_padding');?>;" <?php } ?> <?php if( get_field('do_you_need_dark_text')){ ?>style="color:#666;"<?php } ?>>
            <?php the_field('banner_content'); ?>
        </div>
<?php } elseif($rand_global_row_image) { ?>
    <section id="hero-banner" style="background-image:url('<?php echo $rand_global_row_image['sizes']['hero-banner'] ?>'); background-size:cover; background-repeat:no-repeat;">
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
            <h2>Product Manuals</h2>
            <?php
                if(get_field('category_list')) {
                    $counter = 1;
                    while(have_rows('category_list')) { the_row();
                        $prodCat = get_sub_field('category_slug');
                        $prodSlug = $prodCat->slug;
                        $prodLabel = $prodCat->name;
                        $args = array(
                            'posts_per_page' => '-1',
                            'manual-category' => $prodSlug,
                            'post_type' => 'manuals',
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        ); ?>
                        <div class="acc-product-extra-info">
                            <input id="tab-<?php echo $counter; ?>" type="checkbox" name="tabs">
                            <label for="tab-<?php echo $counter; ?>"><?php echo $prodLabel; ?></label>
                            <? $query = new WP_Query( $args );
                            if( $query->have_posts()) {
                                while( $query->have_posts() ) {
                                    $query->the_post(); ?>
                                    <div class="tab-content">
                                        <?php $file = get_field('product_manual'); ?>
                                        <h4 class="title"><a href="<?php echo $file['url']; ?>"><?php the_title(); ?></a></h4>
                                    </div>
                                <?php }
                            }
                            wp_reset_query();
                            $counter++;?>
                        </div>
                    <?php }
                }
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
