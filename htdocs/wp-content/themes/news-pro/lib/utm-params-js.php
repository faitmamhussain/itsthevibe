<?php global $thisPageType; ?>
<script type="text/javascript">
    //querystring params
    if( typeof String.prototype.getParamValue === "undefined" ){
        String.prototype.hashCode = function(){
            var hash = 0, i, char;
            if (this.length == 0) return hash;
            for (i = 0, l = this.length; i < l; i++) {
                char  = this.charCodeAt(i);
                hash  = ((hash<<5)-hash)+char;
                hash |= 0; // Convert to 32bit integer
            }
            return Math.abs(hash);
        };

        String.prototype.getParamValue = function(){
            var result = null;
            var query = window.location.toString().split('?')[1];
            if(query == undefined){
                //console.log('no query string on current page');
            }else{
                var vars = query.split('&');
                for (var i = 0; i < vars.length; i++) {
                    var pair = vars[i].split('=');
                    if (decodeURIComponent(pair[0]) == this) {
                        result = decodeURIComponent(pair[1]);
                    }
                }
            }
            return result;
        };

        String.prototype.getRefParamValue = function(){
            var result = null;
            var query = document.referrer.toString().split('?')[1];
            if(query != undefined){
                var vars = query.split('&');
                for (var i = 0; i < vars.length; i++) {
                    var pair = vars[i].split('=');
                    if (decodeURIComponent(pair[0]) == this) {
                        result = decodeURIComponent(pair[1]);
                    }
                }
            }
            return result;
        };
    }

    //cookies
    function setCookie(cname,cvalue) {
        document.cookie = cname+"="+cvalue+"; path=/";
    }

    function getCookie(cname) {
        var aCookie = document.cookie.split("; ");
        for (var i=0; i < aCookie.length; i++){
            var aCrumb = aCookie[i].split("=");
            if (cname == aCrumb[0])
                return unescape(aCrumb[1]);
        }
        return '';
    }

    //viewport check
    var viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    var minDesktopWidth = 1003;
    var isMobile = (Math.max(viewportWidth, viewportHeight) < minDesktopWidth);

    var currentPageUrl = window.location.href.split('?')[0];

    function getAndIncrementSessionDepth() {
        var sessionDepth = getCookie('itv_session_depth');
        if (sessionDepth == '') {
            setCookie('itv_session_depth', 0);
            sessionDepth = 0;
        }
        var newDepth = parseInt(sessionDepth) + 1;
        setCookie('itv_session_depth', newDepth);
        return sessionDepth;
    }

    function guid() {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    }

    function getAndUpdateUserId(){
        var expiration_date = new Date();
        expiration_date.setFullYear(expiration_date.getFullYear() + 1);
        var usr_id = getCookie('itv_user_id');
        if(usr_id == ''){
            usr_id = guid();
        }
        document.cookie = "itv_user_id="+usr_id+"; path=/; expires=" + expiration_date.toGMTString();
        return usr_id;
    }

    (function ($) {
        $(function() {
            var utm_source_value = 'utm_source'.getParamValue() || getCookie('itv_utm_source') || 'itv';

            //Callback function fired when the alm ajax request was finished.
            //We use it to update the href attributes properly.
            function setupParams(){
                $("a.post-link-catchable").each(function() {
                    var _this = $(this);
                    var pageType = '<?php echo $thisPageType ?>';
                    if(_this.data('url')){
                        if(utm_source_value == 'itv' && pageType == 'ITV_404'){
                            utm_source_value = '404';
                        }
                        $(this).attr("href", _this.data('url')
                            + '?utm_source=' + utm_source_value
                            + '&utm_medium=' + pageType
                            + '&utm_term=' + _this.data('term')
                            + '&utm_campaign=' + encodeURIComponent(currentPageUrl)
                            + '&utm_content=' + encodeURIComponent(_this.data('image'))
                        );
                    }
                });
            }

            $.fn.almComplete = setupParams;
        });
    })(jQuery);
</script>