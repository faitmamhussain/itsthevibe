var this_utm_source_value = utm_source_value;
if (this_utm_source_value == '') {
    this_utm_source_value = 'Undefined';
}
else {
    this_utm_source_value = this_utm_source_value.charAt(0).toUpperCase() + this_utm_source_value.slice(1);
}
var this_page_type = page_type;
if (this_page_type == '') {
    this_page_type = 'Undefined';
}
else {
    this_page_type = this_page_type.charAt(0).toUpperCase() + this_page_type.slice(1);
}
var this_utm_term = utm_term_value;
if (this_utm_term == '') {
    this_utm_term = 'Undefined';
}
else {
    if (this_utm_term.toUpperCase() == 'SAFE') {
        this_utm_term = 'SAFE';
    }
    else {
        this_utm_term = 'NS';
    }
}
var utm_source = this_utm_source_value;

function getRandomId() {
    return Math.floor(Math.random() * (99999 - 10000)) + 10000;
}

function TaboolaAds() {
    this.BelowPost = function (containerId, forceSafe, forceNS) {
        if (!jQuery('#' + containerId).length) {
            return;
        }
        var rand = getRandomId();
        var term = this_utm_term;
        if (forceSafe) {
            term = 'Safe';
        }
        if (forceNS) {
            term = 'NS';
        }

        if (!ITV_OBJ.isMobile) {
            jQuery('#' + containerId).append('<div id="taboola-below-article-thumbnails-' + rand + '"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-a",container:"taboola-below-article-thumbnails-' + rand + '",placement:"ITV - '
            + this_utm_source_value + ' - Below ' + this_page_type + ' - Sponsored - ' + term + '",target_type:"mix"});' +
            '</script>');
        }
        else {
            jQuery('#' + containerId).append('<div id="mobile-taboola-below-article-thumbnails-' + rand + '"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-e",container:"mobile-taboola-below-article-thumbnails-' + rand + '",placement:"ITV - '
            + this_utm_source_value + ' - Below ' + this_page_type + ' - Sponsored - ' + term + ' - Mobile",target_type:"mix"});' +
            '</script>');
        }
    };

    this.BelowSlideshow = function (containerId, forceSafe, forceNS, additionalPlacement) {
        if (!jQuery('#' + containerId).length) {
            return;
        }
        var rand = getRandomId();
        var term = this_utm_term;
        if (forceSafe) {
            term = 'Safe';
        }
        if (forceNS) {
            term = 'NS';
        }
        if( ! additionalPlacement ){
            additionalPlacement = '';
        }
        if (!ITV_OBJ.isMobile) {
            jQuery('#' + containerId).append('<div id="taboola-below-gallery-thumbnails-' + rand + '"></div>' +
                '<script type="text/javascript">' +
                'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-b",container:"taboola-below-gallery-thumbnails-' + rand + '",placement:"ITV - ' +
                this_utm_source_value + ' - Below Slideshow - Sponsored - ' + term + additionalPlacement + '",target_type:"mix"});' +
                '</script>');
        }
    };

    this.BelowEndSlideshow = function (containerId, forceSafe, forceNS) {
        if (!jQuery('#' + containerId).length) {
            return;
        }
        var rand = getRandomId();
        var term = this_utm_term;
        if (forceSafe) {
            term = 'Safe';
        }
        if (forceNS) {
            term = 'NS';
        }
        jQuery('#' + containerId).append('<div id="taboola­native­end­of­gallery­thumbnails-' + rand + '"></div>' +
        '<script type="text/javascript">' +
        'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-c",container:"taboola­native­end­of­gallery­thumbnails-' + rand + '",placement:"ITV - '
        + this_utm_source_value + ' - ' + this_page_type + ' - Organic - ' + term + '",target_type:"mix"});' +
        '</script>');
    };
}

function RevcontentAds() {

    //Below
    this.BelowPost = function (containerId) {
        if (!jQuery('#' + containerId).length) {
            return;
        }
        var rand = getRandomId();
        var rcDefaultWidgetID = 29016;
        var rcCatMap = '{outbrain:30567,taboola:30568,revcontent:30569,gemini:30570,adblade:30571,fb:30572,"3lift":30573,g4:30574,houseads:30575,ha:30575,taboola_organic:30576,pinterest:30577,instagram:30578,cad:30579,twitter:30580}';
        if (ITV_OBJ.isMobile) {
            rcDefaultWidgetID = 30346;
            rcCatMap = '{outbrain:30581,taboola:30585,revcontent:30586,gemini:30587,adblade:30588,fb:30589,"3lift":30590,g4:30591,houseads:30592,ha:30592,taboola_organic:30593,pinterest:30594,instagram:30595,cad:30596,twitter:30597}';
        }
        jQuery('#' + containerId).append('<div id="rcjsload_4ht9wt3_' + rand + '"></div>' +
        '<script type="text/javascript">' +
        '(function() {var publisherCategory = "";var rcDefaultWidgetID = ' + rcDefaultWidgetID + ';var query = window.location.search.substring(1);' +
        'var vars = query.split("&");for (var i=0;i<vars.length;i++) {var pair = vars[i].split("=");' +
        'if(pair[0] == "utm_source"){publisherCategory = pair[1];}}' +
        'if (typeof utm_source_value !== "undefined" ) {publisherCategory = utm_source_value;}' +
        'var rcCatMap = ' + rcCatMap + ';var rcContextualCatID = rcCatMap[publisherCategory.toLowerCase()];if (typeof(rcContextualCatID) !== "undefined") { rcDefaultWidgetID = rcContextualCatID; }' +
        'var rcel = document.createElement("script");rcel.id = "rc_" + Math.floor(Math.random() * 1000);' +
        'rcel.type = "text/javascript";' +
        'rcel.src = "http://trends.revcontent.com/serve.js.php?w="+rcDefaultWidgetID+"&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);' +
        'rcel.async = true;var rcds = document.getElementById("rcjsload_4ht9wt3_' + rand + '"); rcds.appendChild(rcel);})();' +
        '</script>');
    };

    this.BelowSlideshow = function (containerId) {
        if (!jQuery('#' + containerId).length) {
            return;
        }
        var rand = getRandomId();
        var rcDefaultWidgetID = 29335;
        var rcCatMap = '{outbrain:30600,taboola:30601,revcontent:30602,gemini:30603,adblade:30604,fb:30605,"3lift":30606,g4:30607,houseads:30608,ha:30608,taboola_organic:30609,pinterest:30610,instagram:30611,cad:30612,twitter:30613}';
        if (ITV_OBJ.isMobile) {
            rcDefaultWidgetID = 29406;
            rcCatMap = '{outbrain:30620,taboola:30621,revcontent:30622,gemini:30623,adblade:30624,fb:30625,"3lift":30626,g4:30627,houseads:30628,ha:30628,taboola_organic:30629,pinterest:30630,instagram:30631,cad:30632,twitter:30633}';
        }
        jQuery('#' + containerId).append('<div id="rcjsload_4ht9wt3_' + rand + '"></div>' +
        '<script type="text/javascript">' +
        '(function() {var publisherCategory = "";var rcDefaultWidgetID = ' + rcDefaultWidgetID + ';var query = window.location.search.substring(1);' +
        'var vars = query.split("&");for (var i=0;i<vars.length;i++) {var pair = vars[i].split("=");' +
        'if(pair[0] == "utm_source"){publisherCategory = pair[1];}}' +
        'if (typeof utm_source_value !== "undefined" ) {publisherCategory = utm_source_value;}' +
        'var rcCatMap = ' + rcCatMap + ';var rcContextualCatID = rcCatMap[publisherCategory.toLowerCase()];if (typeof(rcContextualCatID) !== "undefined") { rcDefaultWidgetID = rcContextualCatID; }' +
        'var rcel = document.createElement("script");rcel.id = "rc_" + Math.floor(Math.random() * 1000);' +
        'rcel.type = "text/javascript";' +
        'rcel.src = "http://trends.revcontent.com/serve.js.php?w="+rcDefaultWidgetID+"&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);' +
        'rcel.async = true;var rcds = document.getElementById("rcjsload_4ht9wt3_' + rand + '"); rcds.appendChild(rcel);})();' +
        '</script>');
    };

    this.BelowEndSlideshow = function (containerId) {
        if (!jQuery('#' + containerId).length) {
            return;
        }
        var rand = getRandomId();
        var rcDefaultWidgetID = 29333;
        var rcCatMap = '{}';
        if (ITV_OBJ.isMobile) {
            rcDefaultWidgetID = 30345;
        }
        jQuery('#' + containerId).append('<div id="rcjsload_pu06hus_' + rand + '"></div>' +
        '<script type="text/javascript">' +
        '(function() {var publisherCategory = "";var rcDefaultWidgetID = ' + rcDefaultWidgetID + ';var query = window.location.search.substring(1);' +
        'var vars = query.split("&");for (var i=0;i<vars.length;i++) {var pair = vars[i].split("=");' +
        'if(pair[0] == "utm_source"){publisherCategory = pair[1];}}' +
        'if (typeof utm_source_value !== "undefined" ) {publisherCategory = utm_source_value;}' +
        'var rcCatMap = ' + rcCatMap + ';var rcContextualCatID = rcCatMap[publisherCategory.toLowerCase()];if (typeof(rcContextualCatID) !== "undefined") { rcDefaultWidgetID = rcContextualCatID; }' +
        'var rcel = document.createElement("script");rcel.id = "rc_" + Math.floor(Math.random() * 1000);' +
        'rcel.type = "text/javascript";' +
        'rcel.src = "http://trends.revcontent.com/serve.js.php?w="+rcDefaultWidgetID+"&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);' +
        'rcel.async = true;var rcds = document.getElementById("rcjsload_pu06hus_' + rand + '"); rcds.appendChild(rcel);})();' +
        '</script>');
    };

    //RR
    this.RightRailPost = function () {
        document.write('<div id="rcjsload_ubd3tix"></div>' +
        '<script src="http://publishers.revcontent.com/itsthevibe_internalitvpostrr1.js"></script>');
    };

    this.RightRailSlideshow = function () {
        document.write('<div id="rcjsload_scalnbg"></div>' +
        '<script src="http://publishers.revcontent.com/itsthevibe_internalitvslideshowrr1.js"></script>');
    };

    this.RightRailEndSlideshow = function () {
        document.write('<div id="rcjsload_zn3arqb"></div>' +
        '<script src="http://publishers.revcontent.com/itsthevibe_internalitvendslideshowrr.js"></script>');
    };

    //Popup
    this.ExitPopInternal = function () {
        if (ITV_OBJ.isSmartPhone) {
            document.write('<div id="rcjsload_m32zbkr"></div>' +
            '<script src="http://publishers.revcontent.com/itsthevibe_internalitvrevexit_mobile.js"></script>');
        }
        else if (ITV_OBJ.isTablet) {
            document.write('<div id="rcjsload_jl33waf"></div>' +
            '<script src="http://publishers.revcontent.com/itsthevibe_internalitvrevexit_tablet.js"></script>');
        }
        else {
            document.write('<div id="rcjsload_lcuvtcb"></div>' +
            '<script src="http://publishers.revcontent.com/itsthevibe_internalitvrevexit_desktop.js"></script>');
        }
    };

    this.ExitPop = function () {
        if (ITV_OBJ.isDesktop) {
            document.write('<div id="rcjsload_sp4f5cm"></div>' +
            '<script src="http://publishers.revcontent.com/itsthevibe_revexit_desktop.js"></script>');
        }
    }
}


function DeclareITV() {
    Taboola = new TaboolaAds;
    Revcontent = new RevcontentAds;
}

/******************************
 Article RR
 ******************************/
function RightRailPost() {
    Revcontent.RightRailPost();
}

/******************************
 Gallery RR
 ******************************/
function RightRailSlideshow() {
    Revcontent.RightRailSlideshow();
}

/******************************
 End Slideshow RR
 ******************************/
function RightRailEndSlideshow() {
    Revcontent.RightRailEndSlideshow();
}

/******************************
 Below Post
 ******************************/
function BelowPost(containerId) {
    var utm_source_uppercase = utm_source_value.toUpperCase();
    if (
        utm_source_uppercase == 'TABOOLA'
    ) {
        Taboola.BelowPost(containerId);
    }
    else if (
        utm_source_uppercase == 'EDGE' ||
        utm_source_uppercase == 'FB' ||
        utm_source_uppercase == 'UNDEFINED'
    ) {
        Taboola.BelowPost(containerId, false, true); //forceSafe = false, forceNS = true
    }
    else {
        Revcontent.BelowPost(containerId);
    }
}

/******************************
 Below Slideshow
 ******************************/
function BelowSlideshow(containerId) {
    var utm_source_uppercase = utm_source_value.toUpperCase();
    if (ITV_OBJ.isMobile) {
        Revcontent.BelowSlideshow(containerId);
    }
    else {
        if (utm_source_uppercase == 'TABOOLA') {
            Taboola.BelowSlideshow(containerId);
        }
        else if (
            utm_source_uppercase == 'EDGE' ||
            utm_source_uppercase == 'FB' ||
            utm_source_uppercase == 'UNDEFINED' ||
            utm_source_uppercase == 'TABOOLA_ORGANIC' ||
            utm_source_uppercase == 'TABOOLA_NATIVE'
        ) {
            Taboola.BelowSlideshow(containerId, false, true); //forceSafe = false, forceNS = true
        }
        else if (utm_source_uppercase == 'GEMINI') {
            //wait for adblock check
            window.setTimeout(function() {
                if (ITV_OBJ.adsBlocked) {
                    Taboola.BelowSlideshow(containerId, false, false, ' - Adblock');
                } else {
                    Revcontent.BelowSlideshow(containerId);
                }
            }, 100);
        }
        else {
            Revcontent.BelowSlideshow(containerId);
        }
    }
}

function BelowCategorySlideshow(containerId) {
    Revcontent.BelowSlideshow(containerId);
}

/******************************
 Below End Slideshow
 ******************************/
function BelowEndSlideshow(containerId) {
    var utm_source_uppercase = utm_source_value.toUpperCase();
    if (ITV_OBJ.isSmartPhone) {
        if (
            utm_source_uppercase == 'TABOOLA'
        ) {
            Taboola.BelowEndSlideshow(containerId);
        }
        else if(
            utm_source_uppercase == 'FB' ||
            utm_source_uppercase == 'UNDEFINED' ||
            utm_source_uppercase == ''
        ){
            Taboola.BelowEndSlideshow(containerId, true, false);
        }
        else if (
            utm_source_uppercase == 'OUTBRAIN' ||
            utm_source_uppercase == 'TABOOLA_NATIVE' ||
            utm_source_uppercase == 'TABOOLA_ORGANIC' ||
            utm_source_uppercase == 'REVCONTENT' ||
            utm_source_uppercase == 'EDGE' ||
            utm_source_uppercase == 'PINTEREST' ||
            utm_source_uppercase == 'HA' ||
            utm_source_uppercase == 'WF_RIGHTRAIL' ||
            utm_source_uppercase == 'TWITTER' ||
            utm_source_uppercase == 'BGARD' ||
            utm_source_uppercase == 'SHRD' ||
            utm_source_uppercase == 'G4' ||
            utm_source_uppercase == '3LIFT' ||
            utm_source_uppercase == 'APPLE' ||
            utm_source_uppercase == 'TABOOLA' ||
            utm_source_uppercase == 'GOOGLE' ||
            utm_source_uppercase == 'GEMINI'
        ) {
            Taboola.BelowEndSlideshow(containerId);
        }

    }
    else if ((ITV_OBJ.isTablet || ITV_OBJ.isDesktop)&& (
        utm_source_uppercase == 'OUTBRAIN' ||
        utm_source_uppercase == 'TABOOLA_NATIVE' ||
        utm_source_uppercase == 'TABOOLA_ORGANIC' ||
        utm_source_uppercase == 'REVCONTENT' ||
        utm_source_uppercase == 'EDGE' ||
        utm_source_uppercase == 'PINTEREST' ||
        utm_source_uppercase == 'HA' ||
        utm_source_uppercase == 'WF_RIGHTRAIL' ||
        utm_source_uppercase == 'TWITTER' ||
        utm_source_uppercase == 'BGARD' ||
        utm_source_uppercase == 'SHRD' ||
        utm_source_uppercase == 'G4' ||
        utm_source_uppercase == '3LIFT' ||
        utm_source_uppercase == 'APPLE' ||
        utm_source_uppercase == 'TABOOLA' ||
        utm_source_uppercase == 'FB' ||
        utm_source_uppercase == 'GOOGLE' ||
        utm_source_uppercase == 'UNDEFINED' ||
        utm_source_uppercase == '' ||
        utm_source_uppercase == 'GEMINI'
        )) {
        Taboola.BelowEndSlideshow(containerId);
    }
}

/******************************
 exit pop
 ******************************/
function ExitPop() {
    var utm_source_uppercase = utm_source_value.toUpperCase();
    if (
        utm_source_uppercase == 'OUTBRAIN' ||
        utm_source_uppercase == 'TABOOLA_NATIVE' ||
        utm_source_uppercase == 'TABOOLA_ORGANIC' ||
        utm_source_uppercase == 'REVCONTENT' ||
        utm_source_uppercase == 'EDGE' ||
        utm_source_uppercase == 'PINTEREST' ||
        utm_source_uppercase == 'HA' ||
        utm_source_uppercase == 'WF_RIGHTRAIL' ||
        utm_source_uppercase == 'TWITTER' ||
        utm_source_uppercase == 'BGARD' ||
        utm_source_uppercase == 'SHRD' ||
        utm_source_uppercase == 'G4' ||
        utm_source_uppercase == '3LIFT' ||
        utm_source_uppercase == 'APPLE'
    ) {
        Revcontent.ExitPop();
    }
    else if (
        utm_source_uppercase == 'TABOOLA' ||
        utm_source_uppercase == 'FB' ||
        utm_source_uppercase == 'GOOGLE' ||
        utm_source_value == 'UNDEFINED' ||
        utm_source_uppercase == '' ||
        utm_source_uppercase == 'GEMINI'
    ) {
        Revcontent.ExitPopInternal();
    }
}