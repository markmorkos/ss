define([
    'lodash',
    'jquery',
    'backbone',
], function (_, $, Backbone) {
    'use strict';

    var View = Backbone.View.extend({
        "events": {
            "click > .tabset a": function (e) {
                e.preventDefault();
                Backbone.history.navigate($(e.currentTarget).attr('href'), true);
            }
        },

        "render": function () {
            this.$el.html(this.template({
                "tab": this.model,
            }));

            var cont = this.$('>.tab-content');
            _.each(this.model.get('children'), function (row) {
                cont.append(row.get('view').el);
                if (row.get('active')) {
                    row.get('view').render();
                }
            });

            this.delegateEvents();

            return this;
        },

        "setTabArguments": function (url, args) {
            // Stub method
        },
    });

    return View;
});