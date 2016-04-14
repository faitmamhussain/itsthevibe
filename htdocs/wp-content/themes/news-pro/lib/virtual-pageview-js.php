<script type="text/javascript">
    (function ($) {
        $(function() {
            function sendVirtualPageView(alm){
                var elem = $(alm.content).find('.alm-reveal').last().find('article');
                if(elem.length > 0){
                    dataLayer.push({
                        'event': 'VirtualPageview',
                        'virtualPageURL': elem.data('anchor-url'),
                        'virtualPageTitle' : elem.data('anchor-title')
                    });
                }
            }
            $.fn.almComplete = sendVirtualPageView;
        });
    })(jQuery);
</script>