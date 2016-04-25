define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'dropzone',
    'router',
    'backbone.modelbinder',
    'wysiwyg',
    'jquery.elastic',//https://libraries.io/bower/jakobmattsson-jquery-elastic
], function ($, _, Backbone, templating, Dropzone, Routing) {
    'use strict';

    var viewId = '@WerkintCmsCore/Widgets/jsonData.twig';


    var View = Backbone.View.extend({
        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function () {
            this.modelBinder = new Backbone.ModelBinder();
        },

        "render": function () {
            if (this.dropzone) {
                this.dropzone.disable();
            }
            var view = this;
            this.$el.html(this.template(this.model));
            this.modelBinder.bind(this.model.field, this.el);
            this.delegateEvents();
            this.$('.upload').each(function (ind, el) {
                $(this).data('dropzone', new Dropzone(el, {
                    "url":     Routing.generate('_uploader_upload_cms'),
                    "success": _.bind(function (file, ret) {
                        $(el).data('input').val(ret.uri).trigger('change');
                        $(el).attr('src', ret.uri);
                    }, this)
                })).data('input', $(this).parent().children('input'));
            });

            this.$('textarea.blockhtml').each(function (ind, el) {
                view.addWysiwyg(el);
            });
            this.$el.find('textarea').elastic();

            return this;
        },


        "events": {
            "click .action-remove": "removeField",
            "click .action-add":    "addField",
            "click .next":          "renderNext",
            "click .prev":          "renderPrev",
            "click .showInfo":      "show Info",
            "click .action-save": function () {
                this.trigger('dataSave');
            },
        },

        "renderNext": function (e) {
            var ref = $(e.currentTarget).data('refnext');
            this.model.field.get(ref)._page = this.model.field.newPage + 5;
            console.log(this.model.field.newPage);
            //this.model.field.newPage = this.model.field.get(ref)._page;
            //this.render();
        },
        "renderPrev": function (e) {
            var ref = $(e.currentTarget).data('refprev');
            this.model.field.get(ref)._page = this.model.field.newPage - 5;
            this.model.field.newPage = this.model.field.get(ref)._page;
            this.render();
        },


        "addField": function (e) {
            var el = this.$(e.currentTarget),
                name = el.data('name'),
                model = name ? this.model.field.get(name) : this.model.field;

            var child = model.addChild();
            this.render();
        },

        "removeField": function (e) {
            var el = this.$(e.currentTarget),
                name = el.data('name'),
                model = this.model.field.get(name);

            model.getParent().removeChild(model);

            this.render();
        },

        "addWysiwyg": function (element) {
            $(element).wysiwyg({
                classes:          'some-more-classes',
                toolbar:          'top-selection',
                buttons:          {
                    insertimage: {
                        title:         'Insert image',
                        image:         '\uf030', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: true    // wanted on selection
                    },
                    insertlink:  {
                        title: 'Insert link',
                        image: '\uf08e' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },
                    // Fontname plugin
                    fontname:    false,

                    // Fontsize plugin
                    fontsize:      false,
                    // Header plugin
                    header:        {
                        title: 'Header',
                        image: '\uf1dc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        popup: function ($popup, $button) {
                            var list_headers = {
                                // Name : Font
                                'Header 1': '<h1>',
                                'Header 2': '<h2>',
                                'Header 3': '<h3>',
                                'Header 4': '<h4>',
                                'Header 5': '<h5>',
                                'Header 6': '<h6>',
                                'Code':     '<pre>'
                            };
                            var $list = $('<div/>').addClass('wysiwyg-plugin-list')
                                .attr('unselectable', 'on');
                            $.each(list_headers, function (name, format) {
                                var $link = $('<a/>').attr('href', '#')
                                    .css('font-family', format)
                                    .html(name)
                                    .click(function (event) {
                                        $(element).wysiwyg('shell').format(format).closePopup();
                                        // prevent link-href-#
                                        event.stopPropagation();
                                        event.preventDefault();
                                        return false;
                                    }.bind(this));
                                $list.append($link);
                            });
                            $popup.append($list);
                        }
                        //showstatic: true,    // wanted on the toolbar
                        //showselection: false    // wanted on selection
                    },
                    bold:          {
                        title:  'Bold (Ctrl+B)',
                        image:  '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'b'
                    },
                    italic:        {
                        title:  'Italic (Ctrl+I)',
                        image:  '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'i'
                    },
                    underline:     {
                        title:  'Underline (Ctrl+U)',
                        image:  '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'u'
                    },
                    strikethrough: {
                        title:  'Strikethrough (Ctrl+S)',
                        image:  '\uf0cc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 's'
                    },
                    forecolor:     {
                        title: 'Text color',
                        image: '\uf1fc' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },
                    highlight:     {
                        title: 'Background color',
                        image: '\uf043' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },
                    alignleft:     {
                        title:         'Left',
                        image:         '\uf036', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false    // wanted on selection
                    },
                    aligncenter:   {
                        title:         'Center',
                        image:         '\uf037', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false    // wanted on selection
                    },
                    alignright:    {
                        title:         'Right',
                        image:         '\uf038', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false    // wanted on selection
                    },
                    alignjustify:  {
                        title:         'Justify',
                        image:         '\uf039', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false    // wanted on selection
                    },
                    orderedList:   {
                        title:         'Ordered list',
                        image:         '\uf0cb', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false    // wanted on selection
                    },
                    unorderedList: {
                        title:         'Unordered list',
                        image:         '\uf0ca', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false    // wanted on selection
                    },
                },
                submit:           {
                    title: 'Submit',
                    image: '\uf00c' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                selectImage:      'Click or drop image',
                placeholderUrl:   'www.example.com',
                placeholderEmbed: '<embed/>',
                maxImageSize:     [600, 200],
                imageUrl:         Routing.generate('_uploader_upload_cms'),
                forceImageUpload: true,
            });

        },
    });

    return View;
});