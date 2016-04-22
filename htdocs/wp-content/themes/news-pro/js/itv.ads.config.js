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
    if (this_utm_term == 'Safe') {
        this_utm_term = 'Safe';
    }
    else {
        this_utm_term = 'NS';
    }
}

function isMobile() {
    return ((document.documentElement.clientWidth || document.body.clientWidth) < 668);
}

function getRundomId() {
    return Math.floor(Math.random() * (99999 - 10000)) + 10000;
}

function TaboolaAds() {
    this.BelowPost = function (forceSafe, forceNS) {
        var term = this_utm_term;
        if (forceSafe) {
            term = 'Safe';
        }
        if (forceNS) {
            term = 'NS';
        }

        if (!isMobile()) {
            document.write('<div id="taboola-below-article-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-a",container:"taboola-below-article-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - Below ' + this_page_type + ' - Sponsored - ' + term + '",target_type:"mix"});' +
            '</script>');
        }
        else {
            document.write('<div id="mobile-taboola-below-article-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-e",container:"mobile-taboola-below-article-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - Below ' + this_page_type + ' - Sponsored - ' + term + ' - Mobile",target_type:"mix"});' +
            '</script>');
        }
    };

    this.BelowSlideshow = function (forceSafe, forceNS) {
        var term = this_utm_term;
        if (forceSafe) {
            term = 'Safe';
        }
        if (forceNS) {
            term = 'NS';
        }
        if (!isMobile()) {
            document.write('<div id="taboola-below-gallery-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-b",container:"taboola-below-gallery-thumbnails",placement:"ITV - ' +
            this_utm_source_value + ' - Below Slideshow - Sponsored - ' + term + '",target_type:"mix"});' +
            '</script>');
        }
    };

    this.BelowEndSlideshow = function () {
        document.write('<div id="taboola­native­end­of­gallery­thumbnails"></div>' +
        '<script type="text/javascript">' +
        'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-c",container:"taboola­native­end­of­gallery­thumbnails",placement:"ITV - '
        + this_utm_source_value + ' - ' + this_page_type + ' - Organic - ' + this_utm_term + '",target_type:"mix"});' +
        '</script>');
    };
}


var cccc = 0;

function RevcontentAds() {

    //Below
    this.BelowPost = function (containerId) {
        if(!jQuery('#'+containerId).length){
            return;
        }
        var rand = getRundomId();
        var rcDefaultWidgetID = 29016;
        var rcCatMap = '{outbrain:30567,taboola:30568,revcontent:30569,gemini:30570,adblade:30571,fb:30572,"3lift":30573,g4:30574,houseads:30575,ha:30575,taboola_organic:30576,pinterest:30577,instagram:30578,cad:30579,twitter:30580}';
        if (isMobile()) {
            rcDefaultWidgetID = 30346;
            rcCatMap = '{outbrain:30581,taboola:30585,revcontent:30586,gemini:30587,adblade:30588,fb:30589,"3lift":30590,g4:30591,houseads:30592,ha:30592,taboola_organic:30593,pinterest:30594,instagram:30595,cad:30596,twitter:30597}';
        }
        jQuery('#'+containerId).append('<div id="rcjsload_4ht9wt3_' + rand + '"></div>' +
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

    this.BelowSlideshow = function () {
        var rand = getRundomId();
        var rcDefaultWidgetID = 29335;
        var rcCatMap = '{outbrain:30600,taboola:30601,revcontent:30602,gemini:30603,adblade:30604,fb:30605,"3lift":30606,g4:30607,houseads:30608,ha:30608,taboola_organic:30609,pinterest:30610,instagram:30611,cad:30612,twitter:30613}';
        if (isMobile()) {
            rcDefaultWidgetID = 29406;
            rcCatMap = '{outbrain:30620,taboola:30621,revcontent:30622,gemini:30623,adblade:30624,fb:30625,"3lift":30626,g4:30627,houseads:30628,ha:30628,taboola_organic:30629,pinterest:30630,instagram:30631,cad:30632,twitter:30633}';
        }
        document.write('<div id="rcjsload_4ht9wt3_' + rand + '"></div>' +
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

    this.BelowEndSlideshow = function () {
        var rand = getRundomId();
        var rcDefaultWidgetID = 29333;
        var rcCatMap = '{}';
        if (isMobile()) {
            rcDefaultWidgetID = 30345;
        }
        document.write('<div id="rcjsload_pu06hus_' + rand + '"></div>' +
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
    /*if (
     utm_source_value.toUpperCase() == 'TABOOLA'
     ) {
     Taboola.BelowPost();
     }
     else if(
     utm_source_value.toUpperCase() == 'EDGE' ||
     utm_source_value.toUpperCase() == 'FB' ||
     utm_source_value.toUpperCase() == 'UNDEFINED'
     ){
     Taboola.BelowPost(false, true); //forceSafe = false, forceNS = true
     }
     else{
     Revcontent.BelowPost();
     }*/

    Revcontent.BelowPost(containerId);
}

/******************************
 Below Slideshow
 ******************************/
function BelowSlideshow() {
    if (isMobile()) {
        Revcontent.BelowSlideshow();
    }
    else {
        if (
            utm_source_value.toUpperCase() == 'TABOOLA'
        ) {
            Taboola.BelowSlideshow();
        }
        else if (
            utm_source_value.toUpperCase() == 'EDGE' ||
            utm_source_value.toUpperCase() == 'FB' ||
            utm_source_value.toUpperCase() == 'UNDEFINED'
        ) {
            Taboola.BelowSlideshow(false, true); //forceSafe = false, forceNS = true
        }
        else {
            Revcontent.BelowSlideshow();
        }
    }
}

function BelowCategorySlideshow() {
    Revcontent.BelowSlideshow();
}

/******************************
 Below End Slideshow
 ******************************/
function BelowEndSlideshow() {
    if (isMobile()) {
        Revcontent.BelowEndSlideshow()
    }
    else {
        if (
            utm_source_value.toUpperCase() == 'TABOOLA' ||
            utm_source_value.toUpperCase() == 'EDGE' ||
            utm_source_value.toUpperCase() == 'FB' ||
            utm_source_value.toUpperCase() == 'UNDEFINED'
        ) {
            Taboola.BelowEndSlideshow();
        }
        else {
            Revcontent.BelowEndSlideshow();
        }
    }
}

/******************************
 exit pop
 ******************************/
function ExitPop() {
    if (!isMobile()) {
        if (
            utm_source_value.toUpperCase() == 'REVCONTENT' ||
            utm_source_value.toUpperCase() == 'OUTBRAIN' ||
            utm_source_value.toUpperCase() == 'FB' ||
            utm_source_value.toUpperCase() == 'GOOGLE' ||
            utm_source_value.toUpperCase() == 'PINTEREST' ||
            utm_source_value.toUpperCase() == 'HOUSEADS' ||
            utm_source_value.toUpperCase() == 'INSTAGRAM' ||
            utm_source_value.toUpperCase() == 'TWITTER' ||
            (utm_source_value.toUpperCase() == 'TABOOLA' && utm_term_value != 'safe') ||
            utm_source_value.toUpperCase() == 'TABOOLA_ORGANIC' ||
            utm_source_value.toUpperCase() == 'TABOOLA_NATIVE'
        ) {
            //Revcontent.ExitPopNew();
        }
        else if (
            utm_source_value.toUpperCase() == undefined ||
            utm_source_value.toUpperCase() == ''
        ) {
            //Revcontent.ExitPopInternal();
        }
        else if (
            utm_source_value.toUpperCase() == 'YAHOO' ||
            utm_source_value.toUpperCase() == 'GEMINI'
        ) {
            if (page_num >= 1) {
                //Revcontent.ExitPopInternal();
            }
        }
    }
}