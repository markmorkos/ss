define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'twig',
    'router',
    './editView',
    './item',
    'jquery.jstree',
], function ($, _, Backbone, templating, Twig, Routing, EditView, Item) {
    'use strict';

    var viewId = '@WerkintCmsCore/Widgets/sidebar.twig';

    return Backbone.View.extend({
        "template": templating.get(viewId),

        "initialize": function () {
            this.viewEdit = new EditView({
                "parentView": this,
            });
        },

        "events": {
            "click .add-root-item": function (e) {
                e.preventDefault();
                var view = this;
                var model = new Item();
                model.url = Routing.generate('werkint_cms_core_admin_folder_create');
                model.fetch({
                    success: function () {
                        view.viewEdit.setModel(model);
                    }.bind(this)
                });

            },
            "click .type-choice":   function (e) {
                e.preventDefault();

                this.type = $(e.currentTarget).data('type');
                this.render();
            }
        },

        "toggleTree": function (opt) {
            this.$('.item-tree').toggleClass('disabled', !opt);
        },

        "render": function () {
            var view = this;
            this.$el.html(this.template(this.model));

            if(this.viewEdit){
                this.viewEdit.showView();
            }

            this.hideViewEdit = false;

            this.$('.item-edit-holder').append(this.viewEdit.el);


            this.$el.find('#jstree-proton-1').jstree({
                'core': {
                    'themes': {
                        'name':       'default',
                        'responsive': true
                    },
                    'data':   function (node, callback) {
                        var url = node.id !== '#' ? Routing.generate('werkint_cms_core_admin_list', {
                            "parent": node.id,
                        }) : Routing.generate('werkint_cms_core_admin_list_root');
                        $.ajax(url).done(_.bind(function (data) {
                            callback.call(this, _.map(data, function (row) {
                                return _.merge({
                                    "text": row.title,
                                    "icon": row.icon,
                                    "id":   row.id,
                                    "data": {
                                        "row": row,
                                        "id":  row.id
                                    }
                                }, !row.hasChildren ? {} : {
                                    "state": {
                                        "loaded": false,
                                    },
                                });
                            }));
                        }, this));
                    },
                }
            }).on("select_node.jstree", function (e, data) {
                var model = Item.findOrCreate({id: data.node.id});
                model.url = Routing.generate('werkint_cms_core_admin_item', {"item": data.node.id});
                model.fetch({
                    success: function () {
                        view.viewEdit.showView();
                        view.viewEdit.setModel(model);
                    }.bind(this)
                });
            });

            this.delegateEvents();

            return this;
        },
    });
});