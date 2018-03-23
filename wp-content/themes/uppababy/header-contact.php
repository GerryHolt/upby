<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <?php if (is_front_page()) { ?>
        <title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
    <?php } else { ?>
        <title><?php wp_title(''); ?> | <?php bloginfo('name'); ?></title>
    <?php }; ?>
    <link type="text/plain" rel="author" href="<?php bloginfo('url'); ?>/authors.txt" />

    <?php wp_head(); ?>
    <link type="image/x-icon" rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" />
    <!-- Start of uppababy Zendesk Widget script -->
    <script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="uppababy.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
    /*]]>*/</script>
    <!-- End of uppababy Zendesk Widget script -->
    <script>
        window['_fs_debug'] = false;
        window['_fs_host'] = 'fullstory.com';
        window['_fs_org'] = 'A70HY';
        window['_fs_namespace'] = 'FS';
        (function(m,n,e,t,l,o,g,y){
            if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;}
            g=m[e]=function(a,b){g.q?g.q.push([a,b]):g._api(a,b);};g.q=[];
            o=n.createElement(t);o.async=1;o.src='https://'+_fs_host+'/s/fs.js';
            y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
            g.identify=function(i,v){g(l,{uid:i});if(v)g(l,v)};g.setUserVars=function(v){g(l,v)};
            y="rec";g.shutdown=function(i,v){g(y,!1)};g.restart=function(i,v){g(y,!0)};
            g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
            g.clearUserCookie=function(){};
        })(window,document,window['_fs_namespace'],'script','user');
    </script>
</head>

<body id="body" <?php body_class(); ?>>

  <div id="rzt-cart-overlay" onclick="rzt_cart_overlay_close();"></div>

    <div id="site-center" class="menu-normal">
        <section id="header">
            <div class="wrap">
                <div class="util-nav">
                    <div class="country-selector">
                        <ul>
                            <li class="icon-globe"><a href="/country-select/" style="display: block; height: 20px; width: 20px; position: absolute; top: 10px;"></a></li>
                            <li>
                                <form action="<?php echo home_url('/'); ?>" method="get" id="searchform">
                                    <input type="checkbox" />
                                    <input type="text" placeholder="Search" name="s" class="hm-search" />
                                </form>
                                <form action="<?php echo home_url('/'); ?>" method="get" id="searchform2">
                                    <span class="icon-search"></span>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="top-nav">
                        <?php wp_nav_menu('menu=top-nav&container='); ?>
						<?php
							global $woocommerce;
							$ny_cart_contents_count = $woocommerce->cart->cart_contents_count;

							if( $ny_cart_contents_count > 0 ) {

								$ny_show_hide_cart_icon_style = ' style="position: absolute; right: 0px; top: 1px; display:block;"';

								$ny_show_hide_cart_popup_style = ' style=""';

							} else {

								$ny_show_hide_cart_icon_style = ' style="position: absolute; right: 0px; top: 1px; display:none"';

								$ny_show_hide_cart_popup_style = ' style="display:none"';
							}

							echo '<div class="upShopping"'.$ny_show_hide_cart_icon_style.'>';
						?>
							  <ul class="udClear">
								<li style="padding-left:17px;">
									<?php

										echo '<span class="small-cart-icon">
											<img src="'.content_url().'/themes/uppababy/images/icon-shopping-cart.png" border="0" alt="">
											</span>&nbsp;';

										echo '
										<span class="small-cart-count">

											<a class="cart-contents" href="" title="" onclick="rzt_show_the_mini_cart_widget(); return false;">'

											.$ny_cart_contents_count

											.'</a>
										</span>';
									?>
								</li>
							  </ul>
							</div>
                    </div>

                </div>

				<?php
						echo '<div id="rzt-cart"'.$ny_show_hide_cart_popup_style.'>';
							the_widget( 'WC_Widget_Cart', 'title=' );
						echo '</div>';
				?>

                <div class="logo">
                    <?php $siteLogo = get_field('site_logo', 'option');?>
                    <a href="<?php bloginfo('url'); ?>"><img src="<?php echo $siteLogo['sizes']['site-logo']; ?>" alt="<?php echo $siteLogo['alt']; ?>" /></a>
                </div>
                <div id="m-toggle" class="icon-bars">
                    <span></span>
                </div>
                <div class="mobile-nav">
                    <?php wp_nav_menu('menu=mobile-nav&container='); ?>
                </div>
                <div class="main-nav">
                        <?php wp_nav_menu('menu=new-main-nav&container='); ?>
                </div>
            </div>
        </section>
