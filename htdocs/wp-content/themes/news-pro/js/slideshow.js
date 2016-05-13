(function ($) {
    $(function () {
        $(window).on('scroll', function () {

            if (isDesktop() && $('.sidebar-primary').is(':visible')) {
                var sidebarElem = $('.sidebar-primary');
                var mainContent = $('main.content');
                if (($(window).height() + $(window).scrollTop() - 110) > sidebarElem.height() && sidebarElem.height() < mainContent.height() ) {
                    if (sidebarElem.css('position') !== 'fixed') {
                        sidebarElem.css({
                            'left': mainContent.offset().left + mainContent.width() + 3 + 'px',
                            'position': 'fixed',
                            'bottom': 0
                        });
                    }
                }

                if($(window).height() + $(window).scrollTop() + 400 < sidebarElem.height()){
                    sidebarElem.css({
                        'position': 'static'
                    });
                }
            }
        });

        $(window).on('resize', function () {
            var sidebarElem = $('.sidebar-primary');
            var mainContent = $('main.content');
            if (sidebarElem.css('position') == 'fixed') {
                sidebarElem.css({
                    'left': mainContent.offset().left + mainContent.width() + 3 + 'px'
                });
            }
        });
    });
})(jQuery);