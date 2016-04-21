var config_obj;
var wdevice = (jQuery(window).width() <= 1188) ? ((jQuery(window).width() < 763) ? 'mobile' : 'tablet') : 'desktop';

jQuery(document).on('click', '.button-facebook', function(event) {
    event.preventDefault;
    var jQuerythis = jQuery(this);
    var popwidth = 626;
    var popheight = 456;
    var url = '';

    if (typeof jQuery(this).attr('data-domain') !== typeof undefined && jQuery(this).attr('data-domain') === 'itsthevibe') {
        url = encodeURIComponent((new PwShareUrlPrepare).append(window.location.href, {
            'utm_medium': 'fb_share'
        }));
    } else {
        url = encodeURIComponent(window.location.href);
    }

    window.open('http://www.facebook.com/sharer/sharer.php?u=' + url, "Share", "toolbar=0,status=0,width=" + popwidth + ",height=" + popheight + ",top=" + (jQuery(window).height() - popheight) / 2 + ",left=" + (jQuery(window).width() - popwidth) / 2);
    return false;
});


function show_button(selector, mode, animatecount, gatrack) {
    if (animatecount || (wdevice == 'mobile' && jQuery(selector + ' .counter').length)) jQuery(selector + ' .counter').hide();

    if (mode == 'api' && wdevice != 'mobile' && jQuery(selector + ' .counter').length) {
        var url = jQuery(selector + ' .counter').attr('data-fb-api-uri');

        jQuery.getJSON("http://graph.facebook.com/" + url).done(function(data) {
            if (typeof data.shares !== 'undefined' && data.shares !== null && data.shares > 0) {
                if (data.shares > 0) data.shares = data.shares + 1000;

                var shares = formatNumber(data.shares);

                if (animatecount) {
                    jQuery(selector + ' .counter .value').html(data.shares);
                } else {
                    jQuery(selector + ' .counter .value').html(shares);
                    jQuery(selector + ' .counter').css('display', 'table-cell');
                    recalc_button(selector);
                }
            }

            var share_val = parseInt(jQuery(selector + ' .counter .value').html());
            var has_share = (!isNaN(share_val) && share_val != 0);

            if (has_share && share_val > 0 && animatecount && wdevice != 'mobile' && jQuery(selector + ' .counter').length) {
                var start = new Date().getTime();
                jQuery(selector + ' .counter').css('display', 'table-cell');
                jQuery({
                    someValue: 0
                }).animate({
                    someValue: (share_val - 100)
                }, {
                    duration: 25000,
                    step: function() {
                        var end = new Date().getTime();
                        jQuery(selector + ' .counter .value').html(formatNumber(Math.round(this.someValue)));
                        recalc_button(selector);
                    },
                    done: function() {
                        jQuery({
                            someValue: (share_val - 100)
                        }).animate({
                            someValue: share_val
                        }, {
                            duration: 10000,
                            step: function() {
                                var end = new Date().getTime();
                                jQuery(selector + ' .counter .value').html(formatNumber(Math.round(this.someValue)));
                                recalc_button(selector);
                            }
                        });
                    }
                })
            }

            recalc_button(selector);

        });
    }


    // track FB button Engagement
    var btnID = selector;

    // for tracking FB Share Button loads
    dataLayer.push({
        'event':'FBShareBtnLoad',
        'FBbuttonID':btnID
    });

    // for tracking FB Share Button clicks
    jQuery(document).on('click', selector + ' a.fb-button', function(){
        var vPageTitle = document.title;
        var vPageUrl = location.pathname;
        dataLayer.push({
            'event':'FBShareBtnClick',
            'FBbuttonID':btnID
        });
    })


    recalc_button(selector);

}

function PwShareUrlPrepare() {
    this.params_regular_expression = /([?|&][a-zA-Z0-9\-\_]+\=[a-zA-Z0-9\-\_]+)/g;

    this.append = function(url, set_params) {
        var params_match = url.match(this.params_regular_expression);
        var params = [];
        var tmp_params = [];

        if (params_match !== null) {
            for (p_index in params_match) {
                var tmp_param = '';
                tmp_param = this.trim(params_match[p_index], '\?');
                tmp_param = this.trim(tmp_param, '&');
                params.push(this.parse_query_string(tmp_param));
            }
        }

        for (index in set_params) {
            var param = index;
            var check = this.checkKeyExist(param, params);

            if (check !== -1) {
                //params.splice(check, 1);
                continue;
            }

            var tmp_obj = {};
            tmp_obj[param] = set_params[param];
            params.push(tmp_obj);
        }

        return this.prepare_url(url, params);
    }

    this.checkKeyExist = function(key, obj) {
        for (index in obj) {
            if (typeof obj[index][key] !== 'undefined') {
                return index;
            }
        }

        return -1;
    }

    this.parse_query_string = function(queryString) {
        var params = {},
            queries, temp, i, l;

        // Split into key/value pairs
        queries = queryString.split("&");

        // Convert the array of strings into an object
        for (i = 0, l = queries.length; i < l; i++) {
            temp = queries[i].split('=');
            params[temp[0]] = temp[1];
        }

        return params;
    };

    this.trim = function(str, characters, flags) {
        flags = flags || "g";
        if (typeof str !== "string" || typeof characters !== "string" || typeof flags !== "string") {
            throw new TypeError("argument must be string");
        }

        if (!/^[gi]*jQuery/.test(flags)) {
            throw new TypeError("Invalid flags supplied '" + flags.match(new RegExp("[^gi]*")) + "'");
        }

        characters = this.escapeRegex(characters);
        return str.replace(new RegExp("^[" + characters + "]+|[" + characters + "]+jQuery", flags), '');
    };

    this.prepare_url = function(url, params) {
        return this.cast_params(url) + this.stringify_params(params);
    }

    this.cast_params = function(url) {
        return url.replace(this.params_regular_expression, '');
    }

    this.stringify_params = function(params) {
        var str = '';
        if (this.countObj(params) > 0) {
            for (var index in params) {
                for (var ix in params[index]) {
                    str += ix + '=' + params[index][ix] + '&';
                }

            }
        }

        if (str != '') {
            str = '?' + str.substr(0, str.length - 1);
        }

        return str;
    }

    this.countObj = function(obj) {
        var size = 0,
            key;
        for (key in obj) {
            if (obj.hasOwnProperty(key)) size++;
        }
        return size;
    }

    this.escapeRegex = function(string) {
        return string.replace(/[\[\](){}?*+\^jQuery\\.|\-]/g, "\\jQuery&");
    };
}

var ranges = [{
    divider: 1e9,
    suffix: 'G'
}, {
    divider: 1e6,
    suffix: 'M'
}, {
    divider: 1e3,
    suffix: 'K'
}];

function formatNumber(n) {
    for (var i = 0; i < ranges.length; i++) {
        if (n >= ranges[i].divider) {

            var num = n / ranges[i].divider;
            // if(Math.round(num) !== num) {
            num = num.toFixed(1);

            // }
            return num.toString() + ranges[i].suffix;
        }
    }

    return n;
}


function recalc_button(selector) {
    var tc_w = jQuery(selector + ' .text ').width() - 20;

    var jQuerytone = jQuery(selector + ' .hide-1');
    var jQueryttwo = jQuery(selector + ' .hide-2');
    var jQuerytnoh = jQuery(selector + ' .no-hide');

    jQuerytone.css({
        position: "absolute",
        visibility: "hidden",
        display: "block"
    });
    var tone_w = jQuerytone.width();
    jQuerytone.css({
        position: "",
        visibility: "",
        display: ""
    });

    jQueryttwo.css({
        position: "absolute",
        visibility: "hidden",
        display: "block"
    });
    var ttwo_w = jQueryttwo.width();
    jQueryttwo.css({
        position: "",
        visibility: "",
        display: ""
    });

    jQuerytnoh.css({
        position: "absolute",
        visibility: "hidden",
        display: "block"
    });
    var tnoh_w = jQuerytnoh.width();
    jQuerytnoh.css({
        position: "",
        visibility: "",
        display: ""
    });

    if (tc_w < tnoh_w + ttwo_w + tone_w) {
        jQuery(selector + ' .hide-1').hide();
    } else {
        jQuery(selector + ' .hide-1').css({
            position: "static",
            visibility: "visible",
            display: ""
        });
    }

    if (tc_w < tnoh_w + ttwo_w) {
        jQuery(selector + ' .hide-2').hide();
    } else {
        jQuery(selector + ' .hide-2').css({
            position: "static",
            visibility: "visible",
            display: ""
        });
    }
}

jQuery(document).ready(function() {
    jQuery(window).resize(function() {
        jQuery('.button-facebook').each(function() {
            recalc_button('.' + jQuery(this).attr('class'));
        });
    });
});