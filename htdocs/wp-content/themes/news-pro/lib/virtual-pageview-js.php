<script type="text/javascript">
    (function ($) {
        function sendVirtualPageView(alm){
            if(alm){
                var elem = $(alm.content).find('.alm-reveal').last().find('article');
                if(elem.length > 0){
                    dataLayer.push({
                        'event': 'VirtualPageview',
                        'virtualPageURL': elem.data('anchor-url'),
                        'virtualPageTitle' : elem.data('anchor-title')
                    });
                }
            }
        }

        $(document).on( "customAlmComplete", function( event, alm ) {
            sendVirtualPageView(alm);
        });
    })(jQuery);
</script>