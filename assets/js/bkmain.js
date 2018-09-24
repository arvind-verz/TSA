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
	  autoplay: false,
	  autoplaySpeed: 6000
	 
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
	$('table.tbl-modal tr:nth-child(2n-1)').addClass('havebg');
	$('#menuchild li.open').children('ul').show();
	$('#menuchild li.has-sub>a').on('click', function(){
	  $(this).removeAttr('href');
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

});

function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}

$(window).load(function() {
	$(".scroll-content").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
});

$(window).resize(function(){
	
});
