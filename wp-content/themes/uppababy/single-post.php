<?php get_header(); the_post(); ?>



<section id="news-post">
    <div class="wrap clearfix">
        <?php the_post_thumbnail('news-image'); ?>
        <h2><?php the_title(); ?></h2>
        <h4><?php the_date(); ?></h4>
        <?php the_content(); ?>
        <?php wp_link_pages(); ?> 
    </div>
</section>


<?php get_footer(); ?>
