define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'router',
    'dropzone',
    './image',
    './imageCollection',
    'jquery-ui',
], function ($, _, Backbone, templating, Routing, Dropzone, ImageModel, ImageCollection) {
    'use strict';

    var View = Backbone.View.extend({
        "relatedModel": ImageModel,
        "isMultiple":   true,
        "dropzone":     null,
        "templateName": '@SSApp/Admin/gallery.twig',
        "template":     undefined,
        "model":        null,
        "modelbackup":  undefined,
        "modelGallery": undefined,

        "initialize": function (options) {
            this.parentView = options.parentView;
            this.template = templating.get(this.templateName);
            this.collectionPatched = true;
            //CollectionView.prototype.initialize.apply(this, arguments);
        },

        "setModel": function (model) {
            this.model = model;

            if (!this.model) {
                return;
            }

            var collection = null;
            if (this.model.attributes.gallery) {
                collection = new ImageCollection(model.toJSON().gallery.images);
            } else {
                collection = new ImageCollection();
            }
            this.modelGallery = collection;
            this.modelbackup = this.model.toJSON();

            this.render();

            this.model.on('change sync', function () {
                if (this.model.attributes.gallery) {
                    collection = new ImageCollection(model.toJSON().gallery.images);
                } else {
                    collection = new ImageCollection();
                }
                this.modelGallery = collection;
                this.render();
            }, this);
        },

        "showView": function () {
            this.$el.toggle(!this.parentView.hideViewEdit);
        },


        "events": {
            "click .remove":       "removeImage",
            "sortstop .drop-list": "sortStopImages"
        },

        "removeDropzone": function () {
            if (this.dropzone) {
                this.dropzone.disable();
            }
            this.dropzone = null;
        },

        "render": function () {
            this.removeDropzone();
            if (!this.model) {
                this.isMultiple = false;
            }
            this.sortByOrdinal(this.modelGallery);
            this.$el.html(this.template({
                'model':      this.modelGallery,
                'isMultiple': this.isMultiple,
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

            this.dropzoneinit();

            if (this.$('.drop-list').size()) {
                this.$('.drop-list').sortable({
                    "items": "li.added"
                }).disableSelection();
            }

            this.delegateEvents();

            return this;
        },

        "dropzoneinit": function () {
            this.$('.dropzone').each(_.bind(function (ind, el) {
                this.dropzone = new Dropzone(el, {
                    "url":            Routing.generate('_uploader_upload_projects'),
                   // "uploadMultiple": true,
                    //"parallelUploads": 999
                });
                this.dropzone.on('uploadprogress', _.bind(function () {
                    this.$('.uploadable .img-holder').addClass('loading');
                }, this));
                this.dropzone.on('success', _.bind(function () {
                    this.$('.uploadable .img-holder').removeClass('loading');
                }, this));

                this.dropzone.on('dragover', _.bind(function (event) {
                    this.$('.dropzone').css("border", '1px solid #00adc7');
                }, this));

                this.dropzone.on('dragleave', _.bind(function (event) {
                    this.$('.dropzone').css("border", '1px solid #ffffff');
                }, this));

                this.dropzone.on('success', _.bind(function (event, data) {
                        if (data.error === true) {
                            if (data.message) {
                                window.alert(data.message);
                            }
                        } else {
                            var maxOrdinal = !this.modelGallery.length ? 0 :
                                             this.modelGallery.models[this.modelGallery.models.length - 1].get('ordinal') + 1;
                            data.name = data.basename;
                            var model = new ImageModel(data);
                            model.set('ordinal', maxOrdinal);
                            this.modelGallery.add(model);

                            this.render();
                        }
                    }, this)
                );

                this.dropzone.maxFilesize = 10000000;
            }, this));
        },

        "removeImage": function (e) {
            e.preventDefault();
            var obj   = this.$(e.currentTarget),
                index = obj.closest('li').data('ordinal');
            this.modelGallery.models.splice(index, 1);
            this.render();
        },


        "sortByOrdinal": function (array) {
            return array.sort(function (a, b) {
                var x = a.attributes.ordinal;
                var y = b.attributes.ordinal;
                return ((x < y) ? -1 : ((x > y) ? 1 : 0));
            });
        },

        "sortStopImages": function (e, ui) {
            e.preventDefault();
            var that = this,
                list = that.modelGallery.models;
            $(e.currentTarget).find('li[data-image-id]').each(function () {
                var li    = $(this),
                    id    = li.data('image-id'),
                    index = li.index();
                var result = $.grep(list, function (e) {
                    return e.id === id;
                });
                result[0].attributes.ordinal = index;
            });
            list = this.sortByOrdinal(list);


            this.render();
        }
    });

    return View;
});