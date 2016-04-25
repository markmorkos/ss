void function(window){;
$webapp={"var":{}};
requirejs([
    'jquery',
    'ss-app/index/views/baseView',
    'ss-app/index/pageCollection',
    'domReady!'
], function ($, BaseView, PageCollection) {
    'use strict';

    console.log('11111111111111111');

    var pages = new PageCollection();
    pages.fetch();

    var baseView = new BaseView({
        model: pages
    });
    baseView.setElement($('.content-tabs'));
    baseView.render();


});;
}(window)