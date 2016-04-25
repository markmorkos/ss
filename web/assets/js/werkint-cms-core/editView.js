define([
    'jquery',
    'lodash',
    'backbone',
    'twig',
    'templating',
    'router',
    'dropzone',
    './item',
    './briefer/view/adminView',
    'wysiwyg',
    'backbone.modelbinder',
], function ($, _, Backbone, Twig, templating, Routing, Dropzone, Item, JsonAdminView) {
    'use strict';


    var viewId = '@WerkintCmsCore/Widgets/editItem.twig';


    var View = Backbone.View.extend({
        "template": templating.get(viewId),
        "modelbackup": undefined,

        "initialize": function (options) {
            this.parentView = options.parentView;


            this.modelBinder = new Backbone.ModelBinder();

        },
        "setModel":   function (model) {
            this.model = model;
            if (!this.model) {
                return ;
            }
            this.modelbackup = this.model.toJSON();
            if (this.model.get('discr') === 'block') {
                this.editJsonView = new JsonAdminView({'model': this.model});
            }

            this.render();
        },

        "showView": function () {
            if (this.parentView.hideViewEdit) {
                $(this.el).hide();
            }
            else {
                $(this.el).show();
            }
        },

        "events": {
            "click .btn-save": function (e) {
                e.preventDefault();
                this.model.save(null, {
                    "success": _.bind(function () {
                        this.parentView.hideViewEdit = true;
                        this.parentView.render();
                    }, this)
                });
            },
            "click .btn-cancel-edit": function(e){
                e.preventDefault();
                this.model = this.modelbackup;
                this.parentView.hideViewEdit = true;
                this.parentView.render();

            },
            "click .nav-tabs a": 'selectTab',

            "click .btn-remove": function (e) {
                e.preventDefault();
                this.model.destroy({
                    "silent":  true,
                    "success": function (m, response) {
                        if (response.error) {
                            window.alert('Cannot remove: ' + response.error);
                        } else {
                            this.parentView.hideViewEdit = true;
                            this.parentView.render();
                        }
                    }.bind(this)
                });
            },

            "click .add-child-block":  function (e) {
                e.preventDefault();
                var model = new Item();
                model.url = Routing.generate('werkint_cms_core_admin_block_create', {"parent": this.model.get('id')});
                model.fetch({
                    success: function () {
                        model.set('isNew', true);
                        this.setModel(model);
                    }.bind(this)
                });
            },
            "click .add-child-folder": function (e) {
                e.preventDefault();
                var model = new Backbone.Model();
                model.url = Routing.generate('werkint_cms_core_admin_folder_create', {"parent": this.model.get('id')});
                model.fetch({
                    success: function () {
                        model.set('isNew', true);
                        this.setModel(model);
                    }.bind(this)
                });
            },
        },


        "render": function () {

            if (!this.model) {
                this.$el.html('');
                return;
            }

            this.$el.html(this.template({
                "model": this.model,
            }));
            //todo: kate ?
            if (this.model.get('discr') === 'block') {
                this.editJsonView.setElement(this.$('.edit-json-data'));
                this.editJsonView.render();
            }

            this.$('.collapse-link').click( function() {
                var ibox = $(this).closest('div.ibox');
                var button = $(this).find('i');
                var content = ibox.find('div.ibox-content');
                content.slideToggle(200);
                button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
                ibox.toggleClass('').toggleClass('border-bottom');
                setTimeout(function () {
                    ibox.resize();
                    ibox.find('[id^=map-]').resize();
                }, 50);
            });

            this.modelBinder.bind(this.model, this.$('.parent-control'));

            this.delegateEvents();
            this.parentView.toggleTree(false);
            return this;
        },
    });

    return View;
});