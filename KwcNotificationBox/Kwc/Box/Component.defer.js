"use strict";
var $ = require('jquery');
var onReady = require('kwf/on-ready');
var cookies = require('js-cookie');

onReady.onRender('.kwcClass', function (el) {

    if (!!cookies.get('notificationSeen')) {
        var d = new Date();
        cookies.set('notificationSeen', d.toUTCString(), { expires: 30 });
    }

    var
        notificationSeen = cookies.get('notificationSeen'),
        notificationChanged = el.data('date');

    if (new Date(notificationSeen) < new Date(notificationChanged)) {
        console.log('show');
        el.show();
        el.find('.kwcBem__accept').click(function(e) {
            e.preventDefault();
            el.hide();
            var d = new Date();
            cookies.remove('notificationSeen');
            cookies.set('notificationSeen', d.toUTCString(), { expires: 30 });
            var body = $('body');
            body.removeClass('kwfUp-showNotificationBox').addClass('kwfUp-notificationSeen');
            onReady.callOnContentReady((body), { action: 'widthChange' });
        });
    }
});
