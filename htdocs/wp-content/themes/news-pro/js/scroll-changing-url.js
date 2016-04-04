jQuery( document ).ready(function( $ ) {
    var initialTitle = document.title;
    var initialUrl = window.location.href;
    var currentHash = initialUrl;
    var alm = $('#ajax-load-more');

    if(alm.length){
        $(document).scroll(function () {
            $('.anchor_post').each(function () {
                var offset = window.pageYOffset;
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

            if (alm.offset().top > window.pageYOffset && currentHash != initialUrl) {
                window.history.pushState({"pageTitle":initialTitle},'', initialUrl);
                document.title = initialTitle;
                currentHash = initialUrl;
            }
        });
    }
});
