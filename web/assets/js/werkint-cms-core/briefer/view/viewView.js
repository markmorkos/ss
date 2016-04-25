define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'backbone.marionette',
    'highlightjs',
    'css!/assets/css/highlightjs/solarized_dark'
], function ($, _, Backbone, templating, Marionette, hljs) {
    'use strict';

    var viewId = '@WerkintCmsCore/Widgets/viewPage.twig';

    var View = Backbone.Marionette.ItemView.extend({
        "template": templating.get(viewId),

        "render": function () {
            this.$el.html(this.template(this.model));

            this.$el.find('pre').each(function () {
                hljs.highlightBlock(this);
            });

            return this;
        },
    });

    return View;
});