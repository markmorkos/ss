void function(window){;
$webapp={"var":{}};
requirejs([
    'jquery',
    'backbone',
    'router',
    'reanimator-app/admin/indexView',
    'domReady!'
], function ($, Backbone, Routing, IndexView) {
    'use strict';

    $('.navbar-minimalize').click(function (e) {
        e.preventDefault();
        $('body').toggleClass('mini-navbar');
    });

    var view = new IndexView({
        "el":     $('#page_content'),
        "root":   Routing.generate('admin_dashboard').substr(1),
        "elTabs": $('#side-menu'),
    });
    view.render();
});
;
}(window)