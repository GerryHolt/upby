/* ========================================================================= */
/* BE SURE TO COMMENT CODE/IDENTIFY PER PLUGIN CALL */
/* ========================================================================= */

jQuery(function($){

    // ORPHANIZER
    $(".orphan").each(function() {
        var txt = $(this).html().trim().replace('&nbsp;',' ');
        var wordArray = txt.split(" ");
        if (wordArray.length > 1) {
            wordArray[wordArray.length-2] += "&nbsp;" + wordArray[wordArray.length-1];
            wordArray.pop();
            $(this).html(wordArray.join(" "));
        }
    });

    //contact even when online

    window.zESettings = {
      webWidget: {
        contactOptions: {
          enabled: true
        }
      }
    };


    //popup videos
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,

      fixedContentPos: false
    });

    //mobile nav toggle
    $('#m-toggle').on('click',function(){
        $(this).toggleClass('x');
        $('.menu-normal').toggleClass('menu-open');
        $('#body').toggleClass('stop-scroll');
        $('.mobile-nav').slideToggle(150);
    });

    $(window).on('resize',function(){
        var ww = $(window).width();
        if(ww > 960){
            $('.mobile-nav').removeAttr('style');
            $('#m-toggle').removeClass('x');
        }
    })



    $('#menu-mobile-nav>li').on('click', function() {
		$('#menu-mobile-nav li .sub-menu').each(function() {
			if($(this).is(":visible")) {
				$(this).toggleClass('x').slideUp();
			}
		});
		if($(this).children('.sub-menu').length) {
            $(this).toggleClass('x');
			if(!$(this).children('.sub-menu').is(":visible")) {

				$(this).children('.sub-menu').slideToggle();

			}
			return false;
		}
	});

    $('a').on('click',function(e){
        e.stopPropagation();
    });

    // sub-menu accordion




    $("a").on('click', function() {
        $('.sub-menu').css('display', 'none');
        $(this).parent().children("ul").slideToggle( {
            duration: 'fast',
            step: function() {
                if ($(this).css('display') == 'block') {
                    $(this).css('display', 'table');
                }
            },
            complete: function() {
                if ($(this).css('display') == 'block') {
                    $(this).css('display', 'table');
                }
            }
        });
    })

    //OWLS HOME PAGE
    $('.home-slider').owlCarousel({
        loop:true,
        autoplay:true,
        nav:false,
        items:1
    })

    //mobile slider
    $('.mobile-info').owlCarousel({
        loop:true,
        autoplay:true,
        nav:false,
        items:1
    })

    //OWLS ACC IMG CONTROLS
    jQuery(document).ready(function(){

    var sync1 = $("#slider");
	var sync2 = $("#navigation");

	var flag = false;

	var slides = sync1.owlCarousel({
		items:1,
		loop:true,
		margin:10,
		autoplay:false,
		autoplayTimeout:6000,
		autoplayHoverPause:false,
		nav: false,
		dots: true,
        autoHeight:true
	});
	var thumbs = sync2.owlCarousel({
        items:4,
		loop:false,
		margin:10,
		autoplay:false,
		nav: false,
		dots: false
	}).on('click', '.owl-item', function(e) {
        e.preventDefault();
        sync1.trigger('to.owl.carousel', [$(e.target).parents('.owl-item').index(), 300, true]);
	}).on('change.owl.carousel', function(e) {
                if (e.namespace && e.property.name === 'position' && !flag) {
                //nsole.log('...');
    }
	}).data('owl.carousel');

});

$('#searchform input[type=checkbox]').on('click', function() {
     $('.hm-search').focus();
});

    // PARALLAX
/*
    $(document).scroll(function(){
        var nm = $("html").scrollTop();
        var nw = $("body").scrollTop();
        var n = (nm > nw ? nm : nw);

        $('#element').css({
            'webkitTransform' : 'translate3d(0, ' + n + 'px, 0)',
            'MozTransform'    : 'translate3d(0, ' + n + 'px, 0)',
            'msTransform'     : 'translateY('     + n + 'px)',
            'OTransform'      : 'translate3d(0, ' + n + 'px, 0)',
            'transform'       : 'translate3d(0, ' + n + 'px, 0)',
        });

        // if transform3d isn't available, use top over background-position
        //$('#element').css('top', Math.ceil(n/2) + 'px');

    });
*/



    /* ====== Twitter API Call =============================================
        This script automatically adds <li> before and after template. Don't forget to setup Auth info in /twitter/index.php */
    /*
    $('#tweets-loading').tweet({
        modpath: '/path/to/twitter/', // only needed if twitter folder is not in root
        username: 'jackrabbits',
        count: 1,
	template: '<p>{text}</p><p class="tweetlink">{time}</p>'
    });
    $('.tweet_text a').each(function(){
        $(this).attr('target','_blank');
    });
    */

});
