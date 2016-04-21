jQuery(function( $ ){

	$("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');

	$(".responsive-menu-icon").click(function(){
		$(this).next("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu").slideToggle();
	});

	$(window).resize(function(){
		if(window.innerWidth > 600) {
			$("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu, nav .sub-menu").removeAttr("style");
			$(".responsive-menu > .menu-item").removeClass("menu-open");
		}
	});

	$(".responsive-menu > .menu-item").click(function(event){
		if (event.target !== this)
		return;
			$(this).find(".sub-menu:first").slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});

	/* Scroling menu */
	var lastScrollTop = 0;

	if( !detectmob() ){

		$(window).scroll(function(event){

			if( !$('body').hasClass('home') ){

				var st = $(this).scrollTop();

			   if (st > lastScrollTop){

			   		if( $('.site-header').is(":visible") ){
		                $('.site-header').slideUp(200, function(){
		                    if($('.sidebar-secondary').length){
		                        $('.sidebar-secondary').css({
		                            'top': $('.site-container').offset().top
		                        });
		                    }
		                });
		            }

			   } else {

			   		if( $('.site-header').is(":hidden") ) {
		                $('.site-header').slideDown(200, function () {
		                    if($('.sidebar-secondary').length){
		                        $('.sidebar-secondary').css({
		                            'top': $('main.content').offset().top
		                        });
		                    }
		                });
		            }
			   }
			   lastScrollTop = st;

			} 

		});

	}

	$('.share-button-toggle-icon').click(function(event){

		event.preventDefault();

		$(this).toggleClass('open');
		$('.post-share-buttons .twitter-share-button,.post-share-buttons .pinterest-share-button,.post-share-buttons .whatsapp-share-button').fadeToggle().css("display", "inline-block");

	});

	function detectmob() { 
	 	
	 	 if(typeof window.orientation !== 'undefined'){

	 	 	return true;

	 	 }else{

	 	 	return false;
	 	 	
	 	 }

	 	

	}

});