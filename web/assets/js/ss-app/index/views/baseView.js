define([
    'jquery',
    'templating',
    'backbone',
    'ss-app/views/pageView',
    'ss-app/imageCollection',
    'jquery/tabslet'
], function ($, templating, Backbone, PageView,  ImagesCollection) {
    'use strict';

    var View = Backbone.View.extend({
        "templateName":   '@SSApp/Index/tabsView.twig',
        "initialize": function (options) {
            this.model = options.model;
            this.template = templating.get(this.templateName);
            var mainImagesCollection = new ImagesCollection({diskr: 'main'});
            var galleryImagesCollection = new ImagesCollection({diskr: 'gallery'});
            var mainView = new PageView({
                templateName: "@SSApp/Index/mainView.twig",
                model: mainImagesCollection,
                el: $('#tab-main')
            });
            mainView.render();
            var galleryView = new PageView({
                templateName: "@SSApp/Index/galleryView.twig",
                model: galleryImagesCollection,
                el: $('#tab-gallery')
            });
            galleryView.render();
        },

        "render": function () {
            this.$el.html(this.template({
                "pages": this.model,
            }));
            $('.tabs').tabslet();
        }
    });

    return View;
});