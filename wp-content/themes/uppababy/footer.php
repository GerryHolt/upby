

    <section id="footer">
        <div class="wrap">
            <ul class="social-foot">
                <li class="icon-facebook"><a href="<?php the_field('facebook', 'options'); ?>" target="_blank"></a></li>
                <li class="icon-instagram"><a href="<?php the_field('instagram', 'options'); ?>" target="_blank"></a></li>
                <li class="icon-twitter"><a href="<?php the_field('twitter', 'options'); ?>" target="_blank"></a></li>
                <li class="icon-youtube"><a href="<?php the_field('youtube', 'options'); ?>" target="_blank"></a></li>
                <li class="icon-pinterest"><a href="<?php the_field('pinterest', 'options'); ?>" target="_blank"></a></li>
            </ul>
            <ul class="links-foot">
                <li>&copy;<?php echo date("Y"); ?> UPPAbaby</li>
                <li>Rockland, MA</li>
                <li><a href="<?php echo site_url(); ?>/legal-docs/terms-service">Terms</a></li>
                <li><a href="<?php echo site_url(); ?>/retailer-resources/"><img src="/ui/images/RetailerResources.png"/>Retailers</a></li>
            </ul>
            <div id="newsletterSignup" class="newsLetterBox" style="margin-top:0px;">
                <div class="newsletter-box">
                    <div class="newsletter-left">
                        <a href="https://experiences.wyng.com/campaign/?experience=5924a64823847f1cae7f3d67" target="_blank" class="newsletter-link">Sign up for UPPAbaby News &amp; Updates</a>
                    </div>
                    <div class="newsletter-right">
                        <a href="https://experiences.wyng.com/campaign/?experience=5924a64823847f1cae7f3d67" target="_blank"><img src="https://uppababy.com/ui/images/subscribe-arrow.jpg"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php wp_footer(); ?>
</body>
</html>
