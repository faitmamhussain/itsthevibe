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
});
