 /* custom JS here */

 

$(document).ready(function(){

	$('.list-group1-item').matchHeight({ });

	$('.selectpicker').selectpicker({

	});

	$("#cssmenu").menumaker({

		title: "Menu",

		breakpoint: 992,

		format: "multitoggle"

	});

	$('.slider-home').slick({

	  infinite: true,

	  fade: true,

	   arrows: false,

	  autoplay: false,

	   dots: true,

	  autoplaySpeed: 6000

	 

	});

	$('.slider-adv').slick({

	  infinite: true,

	  autoplay: true,

	  autoplaySpeed: 4000

	 

	});

	

	$('#datetimepicker1').datetimepicker({

           format: 'DD/MM/YYYY'

    });

	

	$('#datetimepicker2').datetimepicker({

          format: 'DD/MM/YYYY'

    });



	$('.btn-nav').each(function() {

		$(this).click(function(event){

			event.preventDefault();

			$(this).next().slideToggle();

			$(this).toggleClass('open-nav');			

		});

    });

	/*Focus placeholder*/

	$('.search-top .form-control').data('holder', $('.search-top .form-control').attr('placeholder'));



    $('.search-top .form-control').focusin(function () {

        $(this).attr('placeholder', '');

    });

    $('.search-top .form-control').focusout(function () {

        $(this).attr('placeholder', $(this).data('holder'));

    });

	

	$('.ipt-box-email input').data('holder', $('.ipt-box-email input').attr('placeholder'));



    $('.ipt-box-email input').focusin(function () {

        $(this).attr('placeholder', '');

    });

    $('.ipt-box-email input').focusout(function () {

        $(this).attr('placeholder', $(this).data('holder'));

    });

	

	/*Show payment*/

	$('#paypal-method').on('change', function () {

    if(this.value === "Offline"){

        $(".show-from").show();
		$("#offline_payment").attr('required', true);

    } else {

        $(".show-from").hide();
		$("#offline_payment").attr('required', false);
    }

});

	



	$('.scroll-up').hide();

	$(window).scroll(function() {

		if ($(this).scrollTop()) {

			$('.scroll-up').fadeIn();

		} else {

			$('.scroll-up').fadeOut();

		}

	});

	$('.scroll-up').click(function(e){

		  var href = $(this).attr("href"),

			 offsetTop = href === "#" ? 0 : $(href).offset().top;

		  $('html, body').stop().animate({ 

			  scrollTop: offsetTop

		  }, 1000);

		  e.preventDefault();

		});

	

	$('table.tbl-modal tr:nth-child(2n-1)').addClass('havebg');

	$('#menuchild li.open').children('ul').show();

	

	$('#menuchild li.has-sub').each(function(){

		//$(this).children('a').first().attr('href', 'javascript:void()');

	});

	

	$('#menuchild li.has-sub>a').on('click', function(event){

	  var element = $(this).parent('li');

	  if (element.hasClass('open')) {

		element.removeClass('open');

		element.find('li').removeClass('open');

		element.find('ul').slideUp();

	  } else {

		element.addClass('open');

		element.children('ul').slideDown();

		element.siblings('li').children('ul').slideUp();

		element.siblings('li').removeClass('open');

		element.siblings('li').find('li').removeClass('open');

		element.siblings('li').find('ul').slideUp();

	  }

	});

	$('.showradio').click(function(event) {

		event.preventDefault();

		$(this).closest('.tab-pane').find('.hidecontent').hide();

		$(this).closest('.tab-pane').find('.' + $(this).data('rel')).show();

		$(this).closest('.tab-pane').find('.showradio').removeClass('active');

		$(this).addClass('active');

	});

});



function zeroPad(num, places) {

  var zero = places - num.toString().length + 1;

  return Array(+(zero > 0 && zero)).join("0") + num;

}

function responheight() {

	var hfoot = $('.footer').outerHeight();

	$('.childpage').css({marginBottom:-hfoot});	

	$('.mainchild').css({paddingBottom:hfoot+40});	

}



$(window).load(function() {

	responheight(); 

	$(".scroll-content").mCustomScrollbar({

					scrollButtons:{

						enable:true

					}

				});

});



$(window).resize(function(){

	responheight(); 

});

