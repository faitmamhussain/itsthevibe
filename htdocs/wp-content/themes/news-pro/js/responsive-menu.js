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

	$(window).scroll(function(event){

	   var st = $(this).scrollTop();

	   if (st > lastScrollTop){

	   		if( $('.site-header').is(":visible") )
	   			$('.site-header').slideUp(200);
	       

	   } else {

	   		if( $('.site-header').is(":hidden") )
	   			$('.site-header').slideDown(200);

	   }
	   lastScrollTop = st;
	});

});