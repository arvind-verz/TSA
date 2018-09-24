$(document).ready(function () {	


	var responsiveMenu = $("#menu").html();
	$('body').prepend("<div id='responsiveMenu'><div id='responsiveMenuInner'><p><span>Menu</span> <a href='javascript:void(0)' class='menuClose'></a></p>" + responsiveMenu + "</div></div>")
	
	//$('body').wrapInner('<div class="overFlowHidden"></div>');
	
	$('#menu').prepend("<a href='javascript:void(0)' class='menuDown'><span>Menu</span></a>");
	
		var responsivemenu = $('#menu').html();
	$('#Banner_wrap').before('<div class="Nav_wrap responsiveWrapper"><nav class="menu" id="menu"></nav></div>');
	$('.responsiveWrapper .menu').html(responsivemenu);
	
	
	
	
	
	$('#responsiveMenu ul li').each(function(index) {
		if ($(this).find('ul').length > 0) {
			$(this).append('<a href="javascript:void(0)" class="downarrow"><span></span></a>');
		}
		else {
			$(this).append('');
		}
	});
    $(".downarrow").click(function () {
		$(this).parent().find('ul:eq(0)').slideToggle();
		$(this).parent().addClass('selected');
		$(this).toggleClass('uparrow');
    });
	

	/*************************************** main menu *******************************/
	$('#menu > ul > li').each(function(index) {
		if ($(this).find('ul').length > 0) {
			$(this).append('<span class="downarrow"></span>');
		}
		else {
			$(this).append('');
		}
	});
	$('#menu ul li ul li').each(function(index) {
		if ($(this).find('ul').length > 0) {
			$(this).append('<span class="rightarrow"></span>');
		}
		else {
			$(this).append('');
		}
	});
	
    $("#menu > ul > li").hover(function () {
        //var itemheight = $(this).height(); /* Getting the LI width */
        $(this).children("ul:eq(0)").animate({height:'show', opacity:'show'}, 300, function(){
			$(this).css({'overflow': 'visible'});
		});
        $(this).children("a:eq(0)").addClass('selected');
    }, function () {
        $(this).find("ul").animate({height:'hide', opacity:'hide'}, 200); /* fading out the sub menu */
        $(this).children("a").removeClass('selected');
    });
    $("#menu li li").hover(function () {
        $(this).children("a:eq(0)").addClass('selected');
        $(this).children("ul:eq(0)").animate({height:'show', opacity:'show'}, 300);
    }, function () {
        $(this).find("ul").animate({height:'hide', opacity:'hide'}, 200); /* fading out the sub menu */
        $(this).children("a").removeClass('selected');
    });
	
	/*****************************************************************************************/
//	$('.responsivemenu ul li').each(function(index) {
//		if ($(this).find('ul').length > 0) {
//			$(this).append('<span class="downarrow"></span>');
//		}
//		else {
//			$(this).append('');
//		}
//	});
	
    $("#menu .menuDown").click(function () {
		$("#responsiveMenu").fadeIn(200, function(){
			$('#responsiveMenuInner').addClass('bounceInDown animated');
		});
		$('.overFlowHidden').css({'position': 'absolute', 'overflow': 'hidden', 'width': '100%', 'height': '100%'});
    });
    $("#responsiveMenu .menuClose").click(function () {
		$('#responsiveMenuInner').removeClass('bounceInDown').addClass('bounceOutDown');
		setTimeout(function(){
			$("#responsiveMenu").fadeOut(200);
			$('.overFlowHidden').removeAttr('style');
			$('#responsiveMenuInner').removeClass('bounceOutDown');
		}, 500);
    });
		
		
	$("#topMenu").find("ul li").addClass('hiddenNav');
	
	var topNav = $("#topMenu").find("ul").html();
	$("#menu > ul").append(topNav);
	
	/*****************************************************/
	
	
});

