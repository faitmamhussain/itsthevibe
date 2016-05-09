//querystring params

var ITV_OBJ = ITV_OBJ || {};

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


//arrays
function isInArray(value, array) {
    return array.indexOf(value) > -1;
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

var utm_source_value = 'utm_source'.getParamValue() || getCookie('itv_utm_source');
var utm_campaign_value = 'utm_campaign'.getParamValue() || getCookie('itv_utm_campaign');
var utm_medium_value = 'utm_medium'.getParamValue() || getCookie('itv_utm_medium');
var utm_term_value = 'utm_term'.getParamValue() || getCookie('itv_utm_term');
var utm_content_value = 'utm_content'.getParamValue() || getCookie('itv_utm_content');
var test_value = 'test'.getParamValue() || getCookie('itv_test');
var page_type = post.type;
var post_tags =  post.tags;
var post_id = post.id;
var post_slug = post.slug;

if( ! utm_source_value ){
    utm_source_value = 'Undefined';
}

var explicitCheck;
if((page_type == 'ITV_Article' ||  page_type == 'ITV_Slideshow') && isInArray('explicit', post_tags)){
    explicitCheck = 'true';
}
else{
    explicitCheck = 'false'
}

//save utm params to cookies
var itvtargeting = ['utm_source', 'utm_campaign', 'utm_medium', 'utm_content', 'utm_term', 'test'];
for(var x = 0; x < itvtargeting.length; x++){
    var targetValue = itvtargeting[x].getParamValue();
    if( targetValue ){
        setCookie('itv_'+itvtargeting[x], targetValue);
    }
}

//viewport check
var viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
var minDesktopWidth = 1003;
ITV_OBJ.isMobile = isMobile();
ITV_OBJ.isSmartPhone = isSmartPhone();
ITV_OBJ.isTablet = isTablet();
ITV_OBJ.isDesktop = isDesktop();

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

function isMobile() {
    return ((document.documentElement.clientWidth || document.body.clientWidth) < 668);
}

function isSmartPhone() {
    return (window.matchMedia && window.matchMedia(" only screen and (min-device-width : 320px) and (max-device-width : 480px)").matches || /(iPhone|iPod)/g.test(navigator.userAgent));
}
function isTablet() {
    return (window.matchMedia && window.matchMedia(" only screen and (min-device-width : 768px) and (max-device-width : 1024px)").matches || /(iPhone|iPod)/g.test(navigator.userAgent));
}
function isDesktop() {
    return !(isSmartPhone() || isTablet())
}

(function ($) {
    $(function() {
        //Callback function fired when the alm ajax request was finished.
        //We use it to update the href attributes properly.
        function setupParams(){
            $("a.post-link-catchable").each(function() {
                var _this = $(this);
                var pageType = post.type;
                if(_this.data('url')){
                    if(utm_source_value == 'Undefined' && pageType == 'ITV_404'){
                        utm_source_value = pageType;
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