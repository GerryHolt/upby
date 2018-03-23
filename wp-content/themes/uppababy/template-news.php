<?php
/*
Template Name: News
*/

get_header(); the_post(); ?>



</section>

<section id="news">
    <div class="featured">
        <h2>PRESS</h2>
        <?php if(get_field('featured_posts', 'option')) {
            while(have_rows('featured_posts', 'option')) { the_row(); ?>
                <div class="featured-news">
                    <?php $featureObj = get_sub_field('featured', 'option');
                    $featureID = $featureObj->ID;
                    $featuredPOST = get_post($featureID);?>
                    <?php
                     echo get_the_post_thumbnail( $featuredPOST->ID, 'news-featured' ); ?>
                    <h2><a href="<?php echo get_permalink($featureID); ?>"><?php echo $featuredPOST->post_title; ?></a></h2>
                    <p>
                        <?php echo wp_trim_words( $featuredPOST->post_content, 50, '...' ); ?>
                    </p>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="wrap clearfix">
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'posts_per_page' => '30',
            'paged' => $paged,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $query = new WP_Query( $args );
        if( $query->have_posts()) { ?>
            <?php while( $query->have_posts() ) {
                $query->the_post(); ?>
                <div class="news-result">
                    <?php the_post_thumbnail('news-result'); ?>
                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php the_excerpt(); ?>
                </div>
            <?php } ?>
        <?php } ?>
        <section id="loadmore">
            <?php next_posts_link('Load More',$query->max_num_pages); ?>
        </section>
    </div>
</section>


<?php get_footer(); ?>
