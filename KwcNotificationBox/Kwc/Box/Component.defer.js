"use strict";
var $ = require('jquery');
var onReady = require('kwf/on-ready');
var cookies = require('js-cookie');

onReady.onRender('.kwcClass', function (el) {

    if (!cookies.get('notificationSeen')) {
        var d = new Date();
        cookies.set('notificationSeen', d.toUTCString(), { expires: 30 });
    }

    var
        notificationSeen = cookies.get('notificationSeen'),
        notificationChanged = el.find('.kwcBem__alterationDate').data('alteration-date');

    if (new Date(notificationSeen) < new Date(notificationChanged)) {
        el.removeClass('kwcBem__hidden');
        el.find('.kwcBem__accept').click(function(e) {
            e.preventDefault();
            el.addClass('kwcBem__hidden');
            var d = new Date();
            cookies.remove('notificationSeen');
            cookies.set('notificationSeen', d.toUTCString(), { expires: 30 });
            var body = $('body');
            body.removeClass('kwfUp-showNotificationBox').addClass('kwfUp-notificationSeen');
            onReady.callOnContentReady((body), { action: 'widthChange' });
        });
    }
});
