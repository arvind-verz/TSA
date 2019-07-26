function updateWrapper() {
    var hscreen = $(window).height(),
        hfoot = $(".footer-wrapper").outerHeight(),
		hheader = $(".header").outerHeight();
		hinnbann = $(".inner-banner").outerHeight();
    	$("#wrapper").css({marginBottom: -hfoot});
    	$('.pushContainer').css({ height: hfoot });
		$('.thankyou-page .p2').css({bottom: hfoot});
		$(".thankyou-container").css({marginTop: hheader});
		$(".inner-banner>.bn-caption").css({height: hinnbann});
}

jQuery(document).ready(function() {

    updateWrapper();

    jQuery(window).resize(function() {

        updateWrapper();

    });

});

function bannerHeight(){
	var windowHeight = $(window).height()
	$('.main-banner').css('height',windowHeight);
}
jQuery(document).ready(function () {
	bannerHeight();
	jQuery(window).resize(function() {
		bannerHeight();
	});
});

$(document).ready(function() {

    $('.nav-container .nav').meanmenu({
        meanScreenWidth: "1023"
    });

});


// Avoid `console` errors in browsers that lack a console.

(function() {

    var method;

    var noop = function() {};

    var methods = [

        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',

        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',

        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',

        'timeStamp', 'trace', 'warn'

    ];

    var length = methods.length;

    var console = (window.console = window.console || {});



    while (length--) {

        method = methods[length];



        // Only stub undefined methods.

        if (!console[method]) {

            console[method] = noop;

        }

    }

}());



// placeHolderFallBack

function placeHolderFallBack() {

    if ("placeholder" in document.createElement("input")) {

        return;

    } else {

        $('[placeholder]').focus(function() {

            var input = $(this);

            if (input.val() == input.attr('placeholder')) {

                input.val('');

                input.removeClass('placeholder');

            }

        }).blur(function() {

            var input = $(this);



            if (input.val() == '' || input.val() == input.attr('placeholder')) {

                input.addClass('placeholder');

                input.val(input.attr('placeholder'));

            }

        }).blur();

        $('[placeholder]').parents('form').submit(function() {

            $(this).find('[placeholder]').each(function() {

                var input = $(this);

                if (input.val() == input.attr('placeholder')) {

                    input.val('');

                }

            })

        });

    }

}


equalheight = function(container) {

    var currentTallest = 0,

        currentRowStart = 0,

        rowDivs = new Array(),

        $el,

        topPosition = 0;

    $(container).each(function() {



        $el = $(this);

        $($el).height('auto')

        topPostion = $el.position().top;



        if (currentRowStart != topPostion) {

            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {

                rowDivs[currentDiv].height(currentTallest);

            }

            rowDivs.length = 0;

            currentRowStart = topPostion;

            currentTallest = $el.height();

            rowDivs.push($el);

        } else {

            rowDivs.push($el);

            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

        }

        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {

            rowDivs[currentDiv].height(currentTallest);

        }

    });

}



$(window).load(function() {

    equalheight('.equalheight');

    equalheight('.equalheight1');

    equalheight('.equalheight2');

    equalheight('.equalheight3');

    equalheight('.equalheight4');

    equalheight('.equalheight5');

});



$(window).resize(function() {

    equalheight('.equalheight');

    equalheight('.equalheight1');

    equalheight('.equalheight2');

    equalheight('.equalheight3');

    equalheight('.equalheight4');

    equalheight('.equalheight5');

});



$(window).load(function() {

    $('body, #wrapper, .footer-wrapper').css({
        opacity: 1
    });

});

$(window).load(function() {

    $(window).resize(function() {

    });

});

$(function() {
    $('.subject-nav a[href*=#]:not([href=#]),.bann-scroll a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') ||
            location.hostname == this.hostname) {

            var target = $(this.hash),
                headerHeight = $(".header").height(); // Get fixed header height

            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - headerHeight
                }, 500);
                return false;
            }
        }
    });
});

jQuery(document).ready(function($) {
$('.navigation').click(function() {
$('.sub-nav ul').toggleClass('active');
});
$('.get-btn').click(function() {
$('.get-in-touch').toggleClass('active');
});
$('.intrest-btn').click(function() {
$('.get-in-touch').addClass('active');
});

$('.subject-nav li a').click(function() {
    $('.subject-nav li a.active').removeClass('active');
    $(this).addClass('active');
});
    // browser window scroll (in pixels) after which the "back to top" link is shown

    var offset = 300,

        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced

        offset_opacity = 1200,

        //duration of the top scrolling animation (in ms)

        scroll_top_duration = 700,

        //grab the "back to top" link

        $back_to_top = $('.cd-top');



    //hide or show the "back to top" link

    $(window).scroll(function() {

        ($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible'): $back_to_top.removeClass('cd-is-visible cd-fade-out');

        if ($(this).scrollTop() > offset_opacity) {

            $back_to_top.addClass('cd-fade-out');

        }
        if ($(this).scrollTop() > 1) {
            $('.header').addClass("sticky");
            //$('.banner-holder').addClass("sticky");
        } else {
            $('.header').removeClass("sticky");
            //$('.banner-holder').addClass("sticky");
        }

    });



    //smooth scroll to top

    $back_to_top.on('click', function(event) {

        event.preventDefault();

        $('body,html').animate({

                scrollTop: 0,

            }, scroll_top_duration

        );

    });


    //Home Banner Slider
    var $status = $('.pagingInfo');
    var $slickElement = $('.home-banner');
    $slickElement.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {
        //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
        var i = (currentSlide ? currentSlide : 0) + 1;
        $status.html('<span class="active">0' + i + '</span>/' + '0' + slick.slideCount);
    });
    $slickElement.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 1000,
        dots: false,
        slide: 'div',
        arrows: true,
        prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="jcon-left-open-big"></i></button>',
        nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="jcon-right-open-big"></i></button>',
        fade: false,
    });
    //Home Banner Slider END
    //Gallery Slider
    $('.gallery-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        autoplay: false,
        asNavFor: '.gallery-thumb'
    });
    $('.gallery-thumb').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.gallery-for',
        dots: false,
        centerMode: false,
        arrows: false,
        autoplay: false,
        focusOnSelect: true
    });
	

    //three Col Slider
    $('.home-testimonial').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        setPosition: 1,
        speed: 1000,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        slide: 'div',
        arrows: true,
        infinite: true,
        focusOnSelect: false,
        centerMode: true,
        prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="jcon-left-open-big"></i></button>',
        nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="jcon-right-open-big"></i></button>',
        responsive: [{
                breakpoint: 979,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint:666,
                settings: {
                    slidesToShow: 1,
					centerMode: false,
                }
            },
        ]
    });
    //Single Slider
    $('.single-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        setPosition: 1,
        speed: 1000,
        autoplay: false,
        autoplaySpeed: 2000,
        dots: true,
        slide: 'div',
        arrows: true,
        adaptiveHeight: false,
        infinite: true,
        focusOnSelect: false,
        centerMode: false,
        prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"></button>',
        nextArrow: '<button class="slick-next" aria-label="Next" type="button"></button>',
		responsive: [{
                breakpoint: 1147,
                settings: {
                     adaptiveHeight: false,
                }
            },
        ]
    });
    
    
}); //(document).ready function-END

//parallax Start
/* detect touch */
if ("ontouchstart" in window) {
    document.documentElement.className = document.documentElement.className + " touch";
}
if (!$("html").hasClass("touch")) {
    /* background fix */
    $(".parallax").css("background-attachment", "fixed");
}

/* fix vertical when not overflow
call fullscreenFix() if .fullscreen content changes */
function fullscreenFix() {
    var h = $('body').height();
    // set .fullscreen height
    $(".content-b").each(function(i) {
        if ($(this).innerHeight() <= h) {
            $(this).closest(".fullscreen").addClass("not-overflow");
        }
    });
}
$(window).resize(fullscreenFix);
fullscreenFix();

/* resize background images */
function backgroundResize() {
    var windowH = $(window).height();
    $(".background").each(function(i) {
        var path = $(this);
        // variables
        var contW = path.width();
        var contH = path.height();
        var imgW = path.attr("data-img-width");
        var imgH = path.attr("data-img-height");
        var ratio = imgW / imgH;
        // overflowing difference
        var diff = parseFloat(path.attr("data-diff"));
        diff = diff ? diff : 0;
        // remaining height to have fullscreen image only on parallax
        var remainingH = 0;
        if (path.hasClass("parallax") && !$("html").hasClass("touch")) {
            var maxH = contH > windowH ? contH : windowH;
            remainingH = windowH - contH;
        }
        // set img values depending on cont
        imgH = contH + remainingH + diff;
        imgW = imgH * ratio;
        // fix when too large
        if (contW > imgW) {
            imgW = contW;
            imgH = imgW / ratio;
        }
        //
        path.data("resized-imgW", imgW);
        path.data("resized-imgH", imgH);
        path.css("background-size", imgW + "px " + imgH + "px");
    });
}
$(window).resize(backgroundResize);
$(window).focus(backgroundResize);
$(window).load(backgroundResize);
backgroundResize();

/* set parallax background-position */
function parallaxPosition(e) {
    var heightWindow = $(window).height();
    var topWindow = $(window).scrollTop();
    var bottomWindow = topWindow + heightWindow;
    var currentWindow = (topWindow + bottomWindow) / 2;
    $(".parallax").each(function(i) {
        var path = $(this);
        var height = path.height();
        var top = path.offset().top;
        var bottom = top + height;
        // only when in range
        if (bottomWindow > top && topWindow < bottom) {
            var imgW = path.data("resized-imgW");
            var imgH = path.data("resized-imgH");
            // min when image touch top of window
            var min = 0;
            // max when image touch bottom of window
            var max = -imgH + heightWindow;
            // overflow changes parallax
            var overflowH = height < heightWindow ? imgH - height : imgH - heightWindow; // fix height on overflow
            top = top - overflowH;
            bottom = bottom + overflowH;
            // value with linear interpolation
            var value = min + (max - min) * (currentWindow - top) / (bottom - top);
            // set background-position
            //var orizontalPosition = path.attr("data-oriz-pos");
            //orizontalPosition = orizontalPosition ? orizontalPosition : "50%";
            //$(this).css("background-position", orizontalPosition + " " + value + "px");
        }
    });
}
if (!$("html").hasClass("touch")) {
    $(window).resize(parallaxPosition);
    //$(window).focus(parallaxPosition);
    $(window).scroll(parallaxPosition);
$(window).load(parallaxPosition);
    parallaxPosition();
}

//parallax End

