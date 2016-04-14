<script type="text/javascript">
    (function ($) {
        $(window).load(function() {

            var headerElem = $('header.site-header');
            var nextButton = $('.slideshow-menu-right a.slideshow-button');

            setupPostTitleAndHref();
            handleScroll();
            $(window).scroll(handleScroll);

            function setupPostTitleAndHref(){
                var trimmedString = $('article header h1.entry-title').text().substr(0, 47);
                trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" "))) + '...';
                headerElem.find('h1.slideshow-post-title').text(trimmedString);

                var href = $('.slideshow-navigation a').last().attr('href');
                nextButton.attr('href', href);
            }

            function handleScroll(){
                var headerBottom = $('header.site-header').offset().top + $('header.site-header').height();
                var content = $('header.entry-header').offset().top;

                if(headerBottom > content){
                    showSlideshowHeader();
                }else{
                    hideSlideshowHeader();
                }
            }

            function showSlideshowHeader(){
                if(!headerElem.hasClass('slideshow-header')){
                    headerElem.addClass('slideshow-header');
                }
            }

            function hideSlideshowHeader(){
                if(headerElem.hasClass('slideshow-header')){
                    headerElem.removeClass('slideshow-header');
                }
            }
        });
    })(jQuery);
</script>