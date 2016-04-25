define([
    'jquery',
    'backbone',
    'templating',
    'ss-app/tabs/tab',
    'ss-app/tabs/tabsView',
    'ss-app/viewSidebar',
], function ($, Backbone, templating, TabModel, TabsView, ViewSidebarStatic) {
    'use strict';

    var map = {
        'pages':    {
            'title': 'Pages',
            "view":  ViewSidebarStatic,
            "attr":  {
                'icon': 'fa fa-bullhorn',
            }
        }
    };

    var View = TabsView.extend({
        "template": '@SSApp/Admin/indexView.twig',

        "initialize": function (options) {
            this.$elTabs = $(options.elTabs);

            this.template = templating.get(this.template);

            this.model = new TabModel({
                'children': map,
                'root':     options.root,
            });
            this.model.on('route', this.render, this);
            this.model.on('tabcount', this.render, this);

            Backbone.history.start({
                "pushState": true,
                "root":      '',
            });
        },

        "render": function () {
            this.$elTabs.children('li.tab').detach();
            TabsView.prototype.render.apply(this, arguments);

            this.$elTabs.append(this.$('>.tabset').children());
            this.$('>.tabset').detach();

            this.$elTabs.find('a').on('click', function (e) {
                e.preventDefault();
                Backbone.history.navigate($(e.currentTarget).attr('href'), true);
            });
        },
    });

    return View;
});