void function(window){;
$webapp={"var":{}};
requirejs([
    'jquery',
    'ss-app/index/views/baseView',
    'ss-app/index/pageCollection',
    'js/slick.min',
    'js/slideshow',
    'domReady!'
], function ($, BaseView, PageCollection) {
    'use strict';


    var pages = new PageCollection();
    pages.fetch();

    var baseView = new BaseView({
        model: pages
    });
    baseView.setElement($('.content'));
    baseView.render();


});;
}(window)