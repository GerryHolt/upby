<?php
/*
   Template Name: Contact
*/

get_header('contact'); the_post(); ?>

<?php
$pageBannerImage = get_field('top_banner');
$global_rows = get_field('default_accessories_banner', 'options'); // get all the rows
$rand_global_row = $global_rows[ array_rand( $global_rows ) ]; // get a random row
$rand_global_row_image = $rand_global_row['accessories_banner' ]; // get the sub field value

if($pageBannerImage) {  ?>
    <section id="hero-banner" style="background-image:url('<?php echo $pageBannerImage['sizes']['hero-banner']; ?>'); background-size:cover; height:520px; width:1024px; background-repeat:no-repeat;">
<?php } elseif($rand_global_row_image) { ?>
    <section id="hero-banner" style="background-image:url('<?php echo $rand_global_row_image['sizes']['hero-banner']; ?>'); background-size:cover; height:520px; width:1024px; background-repeat:no-repeat;">
<?php } ?>

</section>

<!-- TO MAKE CHAT WIDGET OPTIONS ACTIVE-->
<script type="text/javascript">
window.zESettings = {
  webWidget: {
    contactOptions: {
      enabled: true,
      contactButton: { '*': 'Contact Button' },
      chatLabelOnline: { '*': 'Live Chat' },
      chatLabelOffline: { '*': 'Chat is unavailable' },
      contactFormLabel: { '*': 'Leave us a message' }
    }
  }
};
</script>

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
            <h2><?php the_field('contact_module_header'); ?></h2>
            <?php the_field('module_introduction'); ?>
            <?php if(have_rows('contact_module')) {
                $counter = 1;
                while(have_rows('contact_module')) { the_row(); ?>
                    <div class="zoo-box">
                        <div class="zoo-left">
                            <ul>
                                <li>
                                    <?php if($counter == 1) { ?>
                                      <a onclick="zE.activate();"  class="contact-btn" style="cursor:pointer;">EMAIL</a>
                                     <!-- <a href="https://support.uppababy.com/hc/requests/new"  class="contact-btn" style="cursor:pointer;">EMAIL</a>  -->
                                    <?php } else { ?>

                                    <a href="<?php the_sub_field('contact_button_url');  ?>" class="contact-btn"><?php the_sub_field('contact_button_text'); ?></a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                        <div class="zoo-right">
                            <?php the_sub_field('contact_information'); ?>
                        </div>
                    </div>
                    <?php $counter++; ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="did-you-know">
            <h5><?php the_field('section_header'); ?></h5>
            <div class="dyk-item">
                <div class="dyk-text">
                    <?php if(have_rows('section_items')) { ?>
                        <ul>
                            <?php while(have_rows('section_items')) { the_row(); ?>
                                <li>
                                    <a href="<?php the_sub_field('item_link'); ?>" ><?php the_sub_field('item_name'); ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="TB_inline" style="display:none;">
<div class="typeform-widget" data-url="https://uppababy.typeform.com/to/K35Aq9" style="width: 100%; height: 500px;" > </div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script> <div style="font-family: 'agenda_new';font-size: 12px;color: #999;opacity: 0.5; padding-top: 5px;" > powered by <a href="https://www.typeform.com/examples/forms/contact-form-template/?utm_campaign=K35Aq9&amp;utm_source=typeform.com-51674-Pro&amp;utm_medium=typeform&amp;utm_content=typeform-embedded-contactform&amp;utm_term=EN" style="color: #999" target="_blank">Typeform</a> </div>
</div>


<script>
$zopim(function() {
$zopim.livechat.hideAll();
});
</script>

<?php get_footer(); ?>
