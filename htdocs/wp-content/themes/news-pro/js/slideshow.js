(function ($) {
    $(function() {
        $(window).on('scroll', function(){
            if(!$('.sidebar-secondary').length){
                var sidebarElem = $('.sidebar-primary');
                var mainContent = $('main.content');
                if((document.body.clientHeight+$(window).scrollTop()-110) > sidebarElem.height()){
                    if(sidebarElem.css('position') !== 'fixed'){
                        sidebarElem.css({
                            'left': mainContent.offset().left+mainContent.width()+3+'px',
                            'position' : 'fixed',
                            'bottom': 0
                        });
                    }
                }
                else{
                    sidebarElem.css({
                        'position' : 'static'
                    });
                }
            }
        });

        $(window).on('resize', function(){
            if(!$('.sidebar-secondary').length) {
                var sidebarElem = $('.sidebar-primary');
                var mainContent = $('main.content');
                if (sidebarElem.css('position') == 'fixed') {
                    sidebarElem.css({
                        'left': mainContent.offset().left + mainContent.width() + 3 + 'px'
                    });
                }
            }
        });
    });
})(jQuery);