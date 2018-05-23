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

    var
        notificationSeen = getCookieValue('notificationSeen'),
        notificationChanged = el.data('date');

    if (!notificationSeen || (new Date(notificationSeen) < new Date(notificationChanged))) {
        el.show();
        el.find('.kwcBem__accept').click(function(e) {
            e.preventDefault();
            el.hide();
            setCookieValue('notificationSeen', config.changeDate, 30);
            var body = $('body');
            body.removeClass('kwfUp-showNotificationBox').addClass('kwfUp-notificationSeen');
            onReady.callOnContentReady((body), { action: 'widthChange' });
        });
    }
});
