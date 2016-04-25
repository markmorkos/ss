define([
    'jquery',
    'lodash',
    'backbone',
    'twig',
    'templating',
    './gallery',
    'wysiwyg',
    'backbone.modelbinder',
], function ($, _, Backbone, Twig, templating, Gallery) {
    'use strict';

    var viewId = '@SSApp/Admin/editView.twig';


    var View = Backbone.View.extend({
        "template":    templating.get(viewId),
        "keys":        [],
        "count":       0,
        "modelbackup": undefined,

        "initialize":  function (options) {
            this.parentView = options.parentView;
            this.modelBinder = new Backbone.ModelBinder();
        },

        "setModel":    function (model) {
            this.model = model;
            if (!this.model) {
                return;
            }
            this.model.attributes.keywords ? this.keys = this.model.attributes.keywords
                : this.model.attributes.keywords = [];
            this.modelbackup = this.model.toJSON();

            this.render();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);
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
            "click .add-key": function (e) {
                e.preventDefault();
                this.keys.push("");
                this.render();
            },

            "click .save-key": function (arg) {
                event.preventDefault();
                this.keys[$(arg.currentTarget).attr("data-value")] = ($('.input-keyword' + $(arg.currentTarget).attr("data-value")).val());
                this.render();
            },

            "click .delete-key": function (arg) {
                event.preventDefault();
                this.keys.splice($(arg.currentTarget).attr("data-value"),1);
                this.render();
            },

            "click .btn-save": 'saveModelCallback',

            "click .btn-cancel-edit": function (e) {
                e.preventDefault();
                this.model = this.modelbackup;
                this.parentView.hideViewEdit = true;
                this.parentView.render();

            },
            "click .nav-tabs a":      'selectTab',

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
        },


        "saveModelCallback": function () {
            var gallery = this.parentView.viewGallery.modelGallery.models;
            gallery.images = _.map(this.parentView.viewGallery.modelGallery.models, function(model){
                return model.attributes;
            });
            console.log(gallery);
            this.model.save(
                {
                    gallery: gallery,
                    keywords: this.keys,
                    type: this.model.attributes.type,
                },
                {
                    "success": _.bind(function () {
                        this.modelG = new Gallery({
                            images: gallery.images,
                            id:  this.model.attributes.gallery.id
                        });
                        this.modelG.save(null);
                        this.parentView.hideViewEdit = true;
                        this.parentView.render();
                    }, this.parentView.viewGallery)
                });
        },

        "render": function () {

            this.$el.html(this.template({
                "model":    this.model,
                "keywords": this.keys,
                "id":       this.count
            }));
            this.$('.collapse-link').click(function () {
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