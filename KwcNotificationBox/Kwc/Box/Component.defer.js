"use strict";
var $ = require('jquery');
var onReady = require('kwf/on-ready');
var cookies = require('js-cookie');

onReady.onRender('.kwcClass', function (el) {

    var setCookieValue = function(key, value, daysUntilExpired) {
        cookies.set(key, value, { expires: daysUntilExpired });
    };

    var getCookieValue = function(key) {
        return cookies.get(key);
    };

    var getCookieIsSet =  function(key) {
        return !!cookies.get(key);
    };

    var removeCookie = function(key) {
        cookies.remove(key);
    };

    if (!getCookieIsSet('notificationSeen')) {
        var d = new Date();
        setCookieValue('notificationSeen', d.toUTCString(), 30);
    }

    var
        notificationSeen = getCookieValue('notificationSeen'),
        notificationChanged = el.data('date');

    if (new Date(notificationSeen) < new Date(notificationChanged)) {
        console.log('show');
        el.show();
        el.find('.kwcBem__accept').click(function(e) {
            e.preventDefault();
            el.hide();
            var d = new Date();
            removeCookie('notificationSeen');
            setCookieValue('notificationSeen', d.toUTCString(), 30);
            var body = $('body');
            body.removeClass('kwfUp-showNotificationBox').addClass('kwfUp-notificationSeen');
            onReady.callOnContentReady((body), { action: 'widthChange' });
        });
    }
});
