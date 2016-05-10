//querystring params

var SP_OBJ = SP_OBJ || {};
SP_OBJ.SESSION = {};

//save utm params to cookies
var itvtargeting = ['utm_source', 'utm_campaign', 'utm_medium', 'utm_content', 'utm_term', 'test'];
for(var x = 0; x < itvtargeting.length; x++){
    var targetValue = itvtargeting[x].getParamValue();
    if( targetValue ){
        setCookie('itv_'+itvtargeting[x], targetValue);
    }
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



//viewport check
SP_OBJ.SESSION.USER_ID = getAndUpdateUserId();
SP_OBJ.SESSION.isMobile = isMobile();
SP_OBJ.SESSION.isSmartPhone = isSmartPhone();
SP_OBJ.SESSION.isTablet = isTablet();
SP_OBJ.SESSION.isDesktop = isDesktop();

var currentPageUrl = window.location.href.split('?')[0];



(function ($) {
    $(document).on( "customAlmComplete", function( event, alm ) {
        setupUtmParams();
    });

    $(function() {
        //Callback function fired when the alm ajax request was finished.
        $.fn.almComplete = function(alm){
            $(document).trigger( "customAlmComplete", [alm] );
        };
    });
})(jQuery);