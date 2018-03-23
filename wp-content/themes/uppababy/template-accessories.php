<?php
/*
   Template Name: Accessories
*/

get_header(); the_post(); ?>


<?php
$pageBannerImage = get_field('banner_image');
$global_rows = get_field('default_accessories_banner', 'options'); // get all the rows
$rand_global_row = $global_rows[ array_rand( $global_rows ) ]; // get a random row
$rand_global_row_image = $rand_global_row['accessories_banner' ]; // get the sub field value

if($pageBannerImage) {  ?>
    <section id="hero-banner" style="background-image:url('<?php echo $pageBannerImage['sizes']['hero-banner']; ?>'); background-size:cover; background-repeat:no-repeat;">
<?php } elseif($rand_global_row_image) { ?>
    <section id="hero-banner" style="background-image:url('<?php echo $rand_global_row_image['sizes']['hero-banner']; ?>'); background-size:cover; background-repeat:no-repeat;">
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
    <?php the_field('product_category_heading'); ?>
    <?php
        if(get_field('category_list')) {
            while(have_rows('category_list')) { the_row();
                $prodCat = get_sub_field('category_slug');
                $prodSlug = $prodCat->slug;
                $prodLabel = $prodCat->name;
                $args = array(
                'posts_per_page' => '-1',
                'product_cat' => $prodSlug,
                'post_type' => 'product',
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ); ?>
            <div class="acc-section">
                <h2><?php echo $prodLabel; ?></h2>
                <? $query = new WP_Query( $args );
                if( $query->have_posts()) {
                    while( $query->have_posts() ) {
                        $query->the_post(); ?>
                        <div class="item">
                            <?php $accIMG = get_field('hero_thumbnail');?>
                            <a href="<?php the_permalink();?>"><img src="<?php echo $accIMG['sizes']['acc-list-img'];?>" alt="<?php echo $accIMG['alt']; ?>" /></a>
                            <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
                            <p class="price">
                                <a href="<?php the_permalink();?>"><?php echo $product->get_price_html(); ?></a>
                            </p>
                        </div>
                    <?php }
                }
                wp_reset_query(); ?>

            </div>
            <?php }
        }?>
</section>





<?php get_footer(); ?>
