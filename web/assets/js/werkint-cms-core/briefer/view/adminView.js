define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    './viewStructure',
    './viewData',
    './viewView',
    '../model/field/composite',
    '../model/brief',
    '../model/field/all',
    'backbone.marionette',
    'domReady!',
], function ($, _, Backbone, templating, ViewStructure, ViewData, ViewView,  FieldComposite, Brief) {
    'use strict';

    var viewId = '@WerkintCmsCore/Widgets/jsonAdmin.twig';

    var View = Backbone.View.extend({
        "template":   templating.get(viewId),
        "currenttab": "structure",

        "initialize": function () {
            this.brief = new Brief();
            this.briefs = [];
            this.dataViews = {};
            this.brief.setField(new FieldComposite({
                'type':     'composite',
                'children': [],
            }));

            this.brief.currentPage = null;

            this.brief.setField(new FieldComposite({
                'type':     'composite',
                'children': this.model.get('dataStructure')?this.model.get('dataStructure'):{},
            }));

            this.views = {
                'structure': {
                    'title': 'Structure',
                    'view':  new ViewStructure({'model': this.brief}),
                },
                'view':{
                    'title':'View',
                    'view': new ViewView({'model': this.brief}),
                }
            };
            this.initialLanguage();

            this.views.structure.view.on('structureSave', function(){
                this.model.set('dataStructure', this.brief.field.get('children').toJSON());
                this.initialLanguage();
            },this);

            _.each(this.dataViews, function (item,lang) {
                var translate= this.model.get('translations').find(function (obj) {
                    return obj.get('locale') === lang;
                });
                item.view.on('dataSave', function(){
                    translate.set('dataJson', this.briefs[lang].field.toValue());
                },this);
            }, this);

        },

        "initialLanguage": function(){
            _.each(window.$langs, function (lang) {
                var translate = this.model.get('translations').find(function (obj) {
                    return obj.get('locale') === lang;
                });
                this.briefs[lang] = new Brief();
                this.briefs[lang].setField(new FieldComposite({
                    'type':     'composite',
                    'children': this.model.get('dataStructure')?this.model.get('dataStructure'):{},
                }));
                this.briefs[lang].field = this.briefs[lang].field.setValue(translate.get('dataJson'));

                this.views[lang] = {
                    'title': 'data_'+lang,
                    'view':  new ViewData({'model': this.briefs[lang]}),
                };
                this.dataViews[lang] =  this.views[lang];
            }, this);
        },

        "events":     {
            "click .change-tab":  function (e) {
                e.preventDefault();
                var obj = $(e.currentTarget);
                this.currenttab = obj.data('view');
                this.render();
            }
        },

        "render": function () {
            this.$el.html(this.template({
                "tabs":       this.views,
                "currenttab": this.currenttab
            }));

            _.each(this.views, function (row, key) {
                row.view.setElement($('.tab-' + key));
                if (key == this.currenttab) {
                    row.view.$el.show();
                    row.view.render();
                }
                else {
                    row.view.$el.hide();
                }
            }.bind(this));


            return this;
        }

    });

    return View;


})
;