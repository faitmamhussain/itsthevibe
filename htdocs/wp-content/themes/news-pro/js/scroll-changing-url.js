jQuery( document ).ready(function( $ ) {
    var initialTitle = document.title;
    var initialUrl = window.location.href;
    var currentHash = initialUrl;
    var alm = $('#ajax-load-more');

    if(alm.length){
        var w = window, d = document, e = d.documentElement, g = d.getElementsByTagName('body')[0];
        $(document).scroll(function () {
            var offset = window.pageYOffset;
            offset += w.innerHeight|| e.clientHeight|| g.clientHeight;

            $('.alm-reveal > .entry').each(function () {
                var distanceTop = $(this).offset().top;
                var distanceBottom = distanceTop + $(this).height();
                var hash = $(this).data('anchor-url');
                var title = $(this).data('anchor-title');

                if (distanceTop < offset && distanceBottom > offset && currentHash != hash) {
                    if(title){
                        window.history.pushState({"pageTitle":title},'', hash);
                        document.title = title;

                        if($('.slideshow-post-title').length){
                            var shortTitle = title.substr(0, (40 - 3));
                            shortTitle = shortTitle.replace(/ [^ ]*$/, ' ...');
                            $('.slideshow-post-title').html(shortTitle);
                        }

                    } else {
                        window.history.pushState('','', hash);
                    }
                    currentHash = hash;
                }
            });

            if (alm.offset().top > offset && currentHash != initialUrl) {
                window.history.pushState({"pageTitle":initialTitle},'', initialUrl);
                document.title = initialTitle;
                currentHash = initialUrl;
            }
        });
    }

    if(!ITV_OBJ.isMobile && typeof(refreshSidebarMidAd) == "function"){
        setInterval(function(){
            //refreshSidebarMidAd(); - uncomment when ads are ready
        }, 10000);
    }

    //stick second sidebar section (wait while first ad loads)
    setTimeout(function() {
        var elem = $('.sidebar-primary section:nth-child(2)');
        if(elem.length){
            var addHeight = 0;
            if($('.site-header').length){
                addHeight += $('.site-header').height();
            }
            var elemOffset = $(".sidebar-primary section:nth-child(1)").height() + addHeight - 20;
            var controller = new ScrollMagic.Controller();
            var scene = new ScrollMagic.Scene({offset: elemOffset})
                .setPin(".sidebar-primary section:nth-child(2)")
                .addTo(controller);
        }
    }, 2000);

});
