requirejs([
    'jquery',
    'ss-app/index/views/baseView',
    'ss-app/index/pageCollection',
    'domReady!'
], function ($, BaseView, PageCollection) {
    'use strict';

    var pages = new PageCollection();
    pages.fetch();

    var baseView = new BaseView({
        model: pages
    });
    baseView.setElement($('.content-tabs'));
    baseView.render();


});