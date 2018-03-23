<?php
/*
   Template Name: Safety
*/

get_header(); the_post(); ?>



<?php $bannerImg = get_field('banner_image'); ?>
<section id="hero-banner" style="background-image:url('<?php echo $bannerImg['sizes']['hero-banner'] ?>'); background-size:cover; height:520px; width:1024px; background-repeat:no-repeat;">
    <div class="hero-content" <?php if(get_field('banner_content_top_padding')) {?>style="padding-top:<?php the_field('banner_content_top_padding');?>px;" <?php } ?>>
        <?php the_field('banner_content'); ?>
    </div>
</section>

<section id="sub-nav">
    <ul>
        <li class="current"><a href="#">Overview</a></li>
        <li><a href="#">Safety</a></li>
        <li><a href="#">Convenience</a></li>
        <li><a href="#">Accessories</a></li>
        <li><a href="#">Tech Specs</a></li>
    </ul>
</section>

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
                                                <div class="left-content">
                                                    <?php $Img = get_sub_field('youtube_image_left'); ?>
                                                    <a href="https://www.youtube.com/watch?v=<?php the_sub_field('youtube_id_left'); ?>" class="popup-youtube"><img src="<?php echo $Img['url'] ?>" /></a>
                                                </div>
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

<?php include 'include-mini-cart.php' ?>


<?php get_footer(); ?>
