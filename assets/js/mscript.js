
(function(jQuery){

	jQuery(window).load(function(){

		jQuery(".scroll-container").mCustomScrollbar({

			autoHideScrollbar:false,

			theme:"inset-2-dark",
			
			autoHideScrollbar: true ,

			mouseWheel:0,

			axis:"x",

			advanced:{

				updateOnContentResize:true,

				autoScrollOnFocus:false,

				autoExpandHorizontalScroll:true

			}

		});

	});

})(jQuery);