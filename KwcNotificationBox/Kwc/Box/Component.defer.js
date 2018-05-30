"use strict";
var $ = require('jquery');
var onReady = require('kwf/on-ready');
var cookies = require('js-cookie');

onReady.onRender('.kwcClass', function (el) {

    // Logic: The box will be shown to all visitors for 30 days, starting with the alteration date.
    // Once a visitor clicks it away, the box will be shown again when the alteration date changes.

    var alterationDate = new Date(el.data('alteration-date'));
    var expirationDate = new Date(alterationDate);
        expirationDate.setDate(alterationDate.getDate() + 30);
    var cookie = cookies.get('kwfUp-kwcNotificationBox');

    if (cookie) {
        var notificationSeen = new Date(alterationDate) < new Date(cookie);
    }

    if (!notificationSeen && alterationDate < new Date() && expirationDate > new Date()) {
        el.removeClass('kwcBem__hidden');
        el.find('.kwcBem__accept').click(function(e) {
            e.preventDefault();
            el.addClass('kwcBem__hidden');

            var d = new Date();
            cookies.set('kwfUp-kwcNotificationBox', d.toUTCString());

            var body = $('body');
            body.removeClass('kwfUp-showNotificationBox').addClass('kwfUp-notificationSeen');
            onReady.callOnContentReady((body), { action: 'widthChange' });
        });
    }
});
