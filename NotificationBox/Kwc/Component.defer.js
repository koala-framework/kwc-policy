"use strict";
var $ = require('jquery');
var onReady = require('kwf/on-ready');

function setCookieValue(key, value) {
    var d = new Date();
    d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
    var expires = 'expires=' + d.toUTCString();
    document.cookie = key + '=' + value + ';' + expires + ';path=/';
}

function getCookieValue(key) {
    var name = key + '=',
        decoded = decodeURIComponent(document.cookie),
        ca = decoded.split(';');
    for (var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return '';
}

onReady.onRender('.kwcClass', function (el, config) {
    var
        notificationSeen = getCookieValue('notificationSeen'),
        notificationChanged = config.changeDate;
    
    if (!notificationSeen || (new Date(notificationSeen) < new Date(notificationChanged))) {
        el.show();
        el.find('.kwcBem__accept').click(function(e) {
            e.preventDefault();
            el.hide();
            setCookieValue('notificationSeen', new Date().toUTCString(), 30);
            var body = $('body');
            body.removeClass('kwfUp-showCookieBanner').addClass('kwfUp-cookieAccepted');
            onReady.callOnContentReady((body), { action: 'widthChange' });
        });
    }
});
