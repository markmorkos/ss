define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'twig',
    'router',
    './admin/editView',
    './admin/model',
    './admin/galleryView',
    'jquery.jstree',
], function ($, _, Backbone, templating, Twig, Routing, EditView, Page, GalleryView) {
    'use strict';

    var viewId = '@SSApp/Admin/sidebar.twig';

    return Backbone.View.extend({
        "template": templating.get(viewId),

        "initialize": function () {
            this.viewEdit = new EditView({
                "parentView": this,
            });
            this.viewGallery = new GalleryView({
                "parentView": this,
            });
        },

        "events": {
            "click .add-project": function (e) {
                e.preventDefault();
                var view = this;
                var model = new Page();
                model.url = Routing.generate('ss_admin_page_create');
                model.fetch({
                    success: function () {
                        view.viewGallery.setModel(model);
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

            if (this.hideViewEdit) {
                this.viewEdit.showView();
                this.viewGallery.showView();
            }

            this.hideViewEdit = false;

            this.$('.item-edit-holder').append(this.viewEdit.el);
            this.$('.item-edit-gallery-holder').append(this.viewGallery.el);


            this.$el.find('#jstree-proton-1').jstree({
                'core': {
                    'themes': {
                        'name':       'default',
                        'responsive': true
                    },
                    'data':   function (node, callback) {
                        var url = Routing.generate('ss_admin_pages_list');
                        $.ajax(url).done(_.bind(function (data) {
                            callback.call(this, _.map(data, function (row) {
                                return _.merge({
                                    "text": row.identifier,
                                    "title": row.identifier,
                                    "id":   row.id
                                });
                            }));
                        }, this));
                    },
                }
            }).on("select_node.jstree", function (e, data) {
                var model = Page.findOrCreate({id: data.node.id});
                model.url = Routing.generate('ss_admin_item', {"item": data.node.id});
                model.fetch({
                    success: function () {
                        view.viewEdit.showView();
                        view.viewGallery.showView();
                        view.viewEdit.setModel(model);
                        view.viewGallery.setModel(model);
                    }.bind(this)
                });
            });

            this.delegateEvents();

            return this;
        },
    });
});