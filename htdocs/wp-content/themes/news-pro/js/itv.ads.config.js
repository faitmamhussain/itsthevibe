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
    return Math.random(10000, 99999);
}

function TaboolaAds() {
    this.BelowPost = function () {
        if (!isMobile) {
            document.write('<div id="taboola-below-article-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-c",container:"taboola-below-article-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - Below ' + this_page_type + ' - Sponsored - ' + this_utm_term + '",target_type:"mix"});' +
            '</script>');
        }
        else {
            document.write('<div id="mobile-taboola-below-article-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"mobile-thumbnails-a",container:"mobile-taboola-below-article-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - Below ' + this_page_type + ' - Sponsored - ' + this_utm_term + ' - Mobile,target_type:"mix"});' +
            '</script>');
        }
    };

    this.Sidebar = function () {
        if(this_utm_source_value.toUpperCase() == 'TABOOLA'){
            document.write('<div id="taboola-right-rail-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-d",container:"taboola-right-rail-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - Right Rail - Sponsored - ' + this_utm_term + '",target_type:"mix"});' +
            '</script>');
        }
    };

    this.BelowPostSafe = function () {
        if (!isMobile) {
            document.write('<div id="taboola-below-article-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-c",container:"taboola-below-article-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - Below ' + this_page_type + ' - Sponsored - ' + this_utm_term + '",target_type:"mix"});' +
            '</script>');
        }
        else {
            document.write('<div id="mobile-taboola-below-article-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"mobile-thumbnails-a",container:"mobile-taboola-below-article-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - Below ' + this_page_type + ' - Sponsored - ' + this_utm_term + ' - Mobile",target_type:"mix"});' +
            '</script>');
        }
    };

    this.EndSlateSafe = function () {
        if (!isMobile) {
            document.write('<div id="taboola-end-of-gallery-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-e",container:"taboola-end-of-gallery-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - End Gallery - Sponsored - ' + this_utm_term + '",target_type:"mix"});</script>');
        }
        else {
            document.write('<div id="taboola-end-of-gallery-thumbnails"></div>' +
            '<script type="text/javascript">' +
            'window._taboola=window._taboola||[],_taboola.push({mode:"thumbnails-e",container:"taboola-end-of-gallery-thumbnails",placement:"ITV - '
            + this_utm_source_value + ' - End Gallery - Sponsored - ' + this_utm_term + ' - Mobile",target_type:"mix"});' +
            '</script>');
        }
    };

    this.EndGalleryNative = function () {
        document.write('<div id="taboola-below-gallery-thumbnails"></div>' +
        '<script type="text/javascript">' +
        'window._taboola=window._taboola||[],_taboola.push({mode:"organic-thumbnails-d",container:"taboola-below-gallery-thumbnails",placement:"ITV - '
        + this_utm_source_value + ' - End Gallery - Native",target_type:"mix"});' +
        '</script>');
    };
}

function RevcontentAds(){
    this.BelowPost = function(){
        document.write('<div id="rcjsload_90a25c"></div><script type="text/javascript">!function(){var t=document.createElement("script");t.id="rc_"+Math.floor(1e3*Math.random()),t.type="text/javascript",t.src="//trends.revcontent.com/serve.js.php?w=1200&t="+t.id+"&c="+(new Date).getTime()+"&width="+(window.outerWidth||document.documentElement.clientWidth),t.async=!0;var e=document.getElementById("rcjsload_90a25c");e.appendChild(t)}();</script>');
    };

    this.Sidebar = function(){
        document.write('<div id="rcjsload_7d6cb7"></div>' +
        '<script type="text/javascript">' +
        '!function(){var t=document.createElement("script");' +
        't.id="rc_"+Math.floor(1e3*Math.random()),t.type="text/javascript",t.src="//trends.revcontent.com/serve.js.php?w=3012&t="+t.id+"&c="+(new Date).getTime()+"&width="+(window.outerWidth||document.documentElement.clientWidth),t.async=!0;' +
        'var e=document.getElementById("rcjsload_7d6cb7");e.appendChild(t)}();' +
        '</script>');
    };

    // new tags
    this.BelowPostNew = function(){
        if(!isMobile){
            document.write('<div id="rcjsload_a4gu7k"></div><script src="http://publishers.revcontent.com/yourdailydish_belowarticle_desktop.js"></script>');
        }
        else{
            document.write('<div id="rcjsload_a5gu7k"></div><script src="http://publishers.revcontent.com/yourdailydish_belowarticle_mobile.js"></script>');
        }
    };

    this.EndSlateNew = function(){
        if(!isMobile){
            document.write('<div id="rcjsload_a6gu7k"></div><script src="http://publishers.revcontent.com/yourdailydish_endofgallery_desktop.js"></script>');
        }
        else{
            document.write('<div id="rcjsload_a7gu7k"></div><script src="http://publishers.revcontent.com/yourdailydish_endofgallery_mobile.js"></script>');
        }
    }

    this.ExitPopNew = function(){
        document.write('<div id="rcjsload_a9gu7k"></div><script src="http://publishers.revcontent.com/yourdailydish_revexit_desktop.js"></script>');
    }

    this.SidebarInternalGallery = function(){
        document.write('<div id="rcjsload_sdf5hdh"></div><script src="http://publishers.revcontent.com/yourdailydish_internal_rr1.js"></script>');
    }

    this.SidebarInternalGallery2 = function(){
        document.write('<div id="rcjsload_sdfg4hs"></div><script src="http://publishers.revcontent.com/yourdailydish_internal_rr2.js"></script>');
    }

    this.SidebarInternalEndGallery = function(){
        document.write('<div id="rcjsload_ac3d49"></div><script type="text/javascript">(function(){var rcel=document.createElement("script");rcel.id="rc_" + Math.floor(Math.random() * 1000);rcel.type="text/javascript";rcel.src="http://trends.revcontent.com/serve.js.php?w=17325&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);rcel.async=true;var rcds=document.getElementById("rcjsload_ac3d49"); rcds.appendChild(rcel);})();</script>');
    }

    this.SidebarInternalEndGallery2 = function(){
        document.write('<div id="rcjsload_2812bf"></div><script type="text/javascript">(function(){var rcel=document.createElement("script");rcel.id="rc_" + Math.floor(Math.random() * 1000);rcel.type="text/javascript";rcel.src="http://trends.revcontent.com/serve.js.php?w=17304&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);rcel.async=true;var rcds=document.getElementById("rcjsload_2812bf"); rcds.appendChild(rcel);})();</script>');
    }

    this.SidebarInternalArticle = function(){
        document.write('<div id="rcjsload_f68903"></div>' +
        '<script type="text/javascript">' +
        '(function(){var rcel=document.createElement("script");' +
        'rcel.id="rc_" + Math.floor(Math.random() * 1000);' +
        'rcel.type="text/javascript";' +
        'rcel.src="http://trends.revcontent.com/serve.js.php?w=17335&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);' +
        'rcel.async=true;var rcds=document.getElementById("rcjsload_f68903");' +
        'rcds.appendChild(rcel);})();' +
        '</script>');
    }

    this.SidebarInternalArticle2 = function(){
        document.write('<div id="rcjsload_ff3c8b"></div>' +
        '<script type="text/javascript">(function(){var rcel=document.createElement("script");' +
        'rcel.id="rc_" + Math.floor(Math.random() * 1000);rcel.type="text/javascript";' +
        'rcel.src="http://trends.revcontent.com/serve.js.php?w=17341&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);rcel.async=true;var rcds=document.getElementById("rcjsload_ff3c8b"); rcds.appendChild(rcel);})();</script>');
    }

    this.ExitPopInternal = function(){
        document.write('<script type="text/javascript" id="rev2exit" src="http://labs-cdn.revcontent.com/build/revexit.min.js?w=17297&p=1059&k=f035fc90f62128fa6c44debbd72082538985aff5&d=yourdailydish.com&t=false&i=all&x=false&z=10"></script>');
    }

    this.BelowPostInternal = function(){
        document.write('<div id="rcjsload_96f300"></div><script type="text/javascript">(function(){var rcel=document.createElement("script");rcel.id="rc_" + Math.floor(Math.random() * 1000);rcel.type="text/javascript";rcel.src="http://trends.revcontent.com/serve.js.php?w=17473&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);rcel.async=true;var rcds=document.getElementById("rcjsload_96f300"); rcds.appendChild(rcel);})();</script>');
    }

    this.BelowPostInternalMobile = function(){
        document.write('<div id="rcjsload_f6ad21"></div><script type="text/javascript">(function(){var rcel=document.createElement("script");rcel.id="rc_" + Math.floor(Math.random() * 1000);rcel.type="text/javascript";rcel.src="http://trends.revcontent.com/serve.js.php?w=17494&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);rcel.async=true;var rcds=document.getElementById("rcjsload_f6ad21"); rcds.appendChild(rcel);})();</script>');
    }
}


function DeclareITV() {
    Taboola = new TaboolaAds;
    Revcontent = new RevcontentAds;
}

/******************************
 below article
 ******************************/
function BelowPost() {
    if (!isMobile) {
        if (utm_source_value.toUpperCase() == 'TABOOLA') {
            if (utm_term_value == 'safe') {
                Taboola.BelowPostSafe();
            }
            else {
                Taboola.BelowPost();
            }
        }
        else if (
            utm_source_value.toUpperCase() == 'REVCONTENT' ||
            utm_source_value.toUpperCase() == 'GEMINI' ||
            utm_source_value.toUpperCase() == 'YAHOO' ||
            utm_source_value.toUpperCase() == 'OUTBRAIN' ||
            utm_source_value.toUpperCase() == 'PINTEREST' ||
            utm_source_value.toUpperCase() == 'INSTAGRAM' ||
            utm_source_value.toUpperCase() == 'FB' ||
            utm_source_value.toUpperCase() == 'GOOGLE' ||
            utm_source_value.toUpperCase() == 'HOUSEADS' ||
            utm_source_value.toUpperCase() == 'TWITTER' ||
            utm_source_value.toUpperCase() == 'TABOOLA_ORGANIC'
        ) {
            Revcontent.BelowPostNew();
        }
        else if (utm_source_value.toUpperCase() == 'TABOOLA') {
            if (utm_term_value == 'safe') {
                Taboola.BelowPostSafe();
            }
            else {
                //Revcontent.BelowPostNew();
            }
        }
        else if (
            utm_source_value.toUpperCase() == 'GEMINI' ||
            utm_source_value.toUpperCase() == 'YAHOO' ||
            utm_source_value.toUpperCase() == 'REVCONTENT' ||
            utm_source_value.toUpperCase() == 'PINTEREST' ||
            utm_source_value.toUpperCase() == 'INSTAGRAM' ||
            utm_source_value.toUpperCase() == 'OUTBRAIN' ||
            utm_source_value.toUpperCase() == 'HOUSEADS' ||
            utm_source_value.toUpperCase() == 'TWITTER' ||
            utm_source_value.toUpperCase() == 'TABOOLA_ORGANIC'
        ) {
            //Revcontent.BelowPostNew();
        }
        else if (
            utm_source_value.toUpperCase() == 'FB' ||
            utm_source_value.toUpperCase() == 'EDGE'
        ) {
            Taboola.BelowPost();
        }
        else if (utm_source_value.toUpperCase() == 'GOOGLE') {
            //Revcontent.BelowPostInternalMobile();
        }
        else {
            //Revcontent.BelowPostInternalMobile();
        }
    }
}


/******************************
 article RR 1
 ******************************/
function RightRailArticleNative1() {
    Revcontent.SidebarInternalArticle();
}


/******************************
 article RR 1
 ******************************/
function RightRailArticleNative2() {
    Revcontent.SidebarInternalArticle2();
}


/******************************
 below gallery
 ******************************/
function BelowGalleryNative() {
    if (!isMobile) {
        if (utm_source_value.toUpperCase() == 'TABOOLA') {
            if (utm_term_value == 'safe') {
                Taboola.BelowPostSafe();
            }
            else {
                Taboola.BelowPost();
            }
        }
        else if (
            utm_source_value.toUpperCase() == 'REVCONTENT' ||
            utm_source_value.toUpperCase() == 'YAHOO' ||
            utm_source_value.toUpperCase() == 'OUTBRAIN' ||
            utm_source_value.toUpperCase() == 'PINTEREST' ||
            utm_source_value.toUpperCase() == 'INSTAGRAM' ||
            utm_source_value.toUpperCase() == 'FB' ||
            utm_source_value.toUpperCase() == 'GOOGLE' ||
            utm_source_value.toUpperCase() == 'HOUSEADS' ||
            utm_source_value.toUpperCase() == 'TWITTER' ||
            utm_source_value.toUpperCase() == 'TABOOLA_ORGANIC'
        ) {
            Revcontent.BelowPostNew();
        }
        else {
            Revcontent.BelowPostInternal();
        }
    }
    else if (utm_source_value.toUpperCase() == 'TABOOLA') {
        if (utm_term_value == 'safe') {
            Taboola.BelowPostSafe();
        }
        else {
            Revcontent.BelowPostNew();
        }
    }
    else if (
        utm_source_value.toUpperCase() == 'GEMINI' ||
        utm_source_value.toUpperCase() == 'YAHOO' ||
        utm_source_value.toUpperCase() == 'REVCONTENT' ||
        utm_source_value.toUpperCase() == 'PINTEREST' ||
        utm_source_value.toUpperCase() == 'INSTAGRAM' ||
        utm_source_value.toUpperCase() == 'OUTBRAIN' ||
        utm_source_value.toUpperCase() == 'ADBLADE' ||
        utm_source_value.toUpperCase() == 'HOUSEADS' ||
        utm_source_value.toUpperCase() == 'TWITTER' ||
        utm_source_value.toUpperCase() == 'TABOOLA_ORGANIC'
    ) {
        Revcontent.BelowPostNew();
    }
    else if (
        utm_source_value.toUpperCase() == 'FB' ||
        utm_source_value.toUpperCase() == 'EDGE'
    ) {
        Taboola.BelowPost();
    }
    else if (utm_source_value.toUpperCase() == 'GOOGLE') {
        Revcontent.BelowPostInternalMobile();
    }
    else {
        Revcontent.BelowPostInternalMobile();
    }
}


/******************************
 gallery RR 1
 ******************************/
function RightRailGalleryNative1() {
    Revcontent.SidebarInternalGallery();
}


/******************************
 gallery RR 1
 ******************************/
function RightRailGalleryNative2() {
    Revcontent.SidebarInternalGallery2();
}


/******************************
 end gallery
 ******************************/
function EndGalleryNative() {
    if (!isMobile) {
        if (
            utm_source_value.toUpperCase() == 'OUTBRAIN' ||
            utm_source_value.toUpperCase() == 'GEMINI' ||
            utm_source_value.toUpperCase() == 'YAHOO' ||
            utm_source_value.toUpperCase() == 'GOOGLE' ||
            utm_source_value.toUpperCase() == 'FB' ||
            utm_source_value.toUpperCase() == 'PINTEREST' ||
            utm_source_value.toUpperCase() == 'INSTAGRAM' ||
            utm_source_value.toUpperCase() == 'HOUSEADS' ||
            utm_source_value.toUpperCase() == 'ADBLADE' ||
            utm_source_value.toUpperCase() == 'REVCONTENT' ||
            utm_source_value.toUpperCase() == 'TWITTER' ||
            utm_source_value.toUpperCase() == 'TABOOLA_ORGANIC' ||
            utm_source_value.toUpperCase() == 'TABOOLA'
        ) {
            Taboola.EndGalleryNative();
        }
        else if (
            utm_source_value.toUpperCase() == 'TABOOLA_NATIVE'
        ) {
            //Revcontent.EndSlateNew();
        }
        else {
            Taboola.EndGalleryNative();
        }
    }
    else {
        if (utm_source_value.toUpperCase() == 'TABOOLA') {
            if (utm_term_value == 'safe') {
                Taboola.EndSlateSafe();
            }
            else {
                //Revcontent.EndSlateNew();
            }
        }
        else if (
            utm_source_value.toUpperCase() == 'YAHOO' ||
            utm_source_value.toUpperCase() == 'GEMINI' ||
            utm_source_value.toUpperCase() == 'REVCONTENT' ||
            utm_source_value.toUpperCase() == 'FB' ||
            utm_source_value.toUpperCase() == 'OUTBRAIN' ||
            utm_source_value.toUpperCase() == 'GOOGLE' ||
            utm_source_value.toUpperCase() == 'PINTEREST' ||
            utm_source_value.toUpperCase() == 'INSTAGRAM' ||
            utm_source_value.toUpperCase() == 'G4' ||
            utm_source_value.toUpperCase() == 'ADBLADE' ||
            utm_source_value.toUpperCase() == 'HOUSEADS' ||
            utm_source_value.toUpperCase() == 'TWITTER' ||
            utm_source_value.toUpperCase() == 'TABOOLA_ORGANIC'
        ) {
            //Revcontent.EndSlateNew();
        }
        else {
            Taboola.EndSlateSafe();
        }
    }
}

/******************************
 end gallery RR 1
 ******************************/
function RightRailEndGalleryNative1() {
    //Revcontent.SidebarInternalEndGallery();
}


/******************************
 end gallery RR 2
 ******************************/
function RightRailEndGalleryNative2() {
    //Revcontent.SidebarInternalEndGallery2();
}


/******************************
 exit pop
 ******************************/
function ExitPop() {
    if (!isMobile) {
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

//DeclareITV();