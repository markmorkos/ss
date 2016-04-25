define([
    'jquery',
    'templating',
    'backbone',
    'ss-app/views/mainView',
    'ss-app/views/galleryView',
    'ss-app/imageCollection',
    'jquery/tabslet'
], function ($, templating, Backbone, MainView, GalleryView, ImagesCollection) {
    'use strict';

    var View = Backbone.View.extend({
        "initialize": function (options) {
            this.model = options.model;
            this.template = templating.get(options.templateName);
        },

        "render": function () {
            this.$el.html(this.template({
                "images": this.model,
            }));
        }
    });

    return View;
});