// JavaScript Document

 $(document).ready(function(){

    $("div#morecontent").hide();

    $("a.toggle").click(function () {

      $("div#morecontent").slideToggle(1500);

	return false;

    });



  });

  

  	$(function () {

			var tabContainers = $('div.tabs > div');

			tabContainers.hide().filter(':first').show();

			
			$('div.tabs ul.tabNavigation a').click(function () {

				tabContainers.hide();

				tabContainers.filter(this.hash).show();

				$('div.tabs ul.tabNavigation a').removeClass('selected');

				$(this).addClass('selected');

				return false;

			}).filter(':first').click();

		});

	

	

	

/******************************************************************/

 $(document).ready(function(){

    $("div#morecontent").hide();

    $("a.toggle").click(function () {

      $("div#morecontent").slideToggle(1500);

	return false;

    });



  });

  

  	$(function () {

			var tabContainers = $('div.tabss > div');

			tabContainers.hide().filter(':first').show();

			

			$('div.tabss ul.tabNavigationn a').click(function () {

				tabContainers.hide();

				tabContainers.filter(this.hash).show();

				$('div.tabss ul.tabNavigationn a').removeClass('selected');

				$(this).addClass('selected');

				return false;

			}).filter(':first').click();

		});