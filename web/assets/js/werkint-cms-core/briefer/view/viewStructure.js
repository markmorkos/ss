define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'twig',
    'router',
    '../model/field/base',
    'backbone.modelbinder',
    'backbone.marionette',
    'jquery.textrange',// https://github.com/dwieeb/jquery-textrange/blob/1.x/bower.json
    'jquery.tabbable' // https://github.com/marklagendijk/jQuery.tabbable
], function ($, _, Backbone, templating, Twig, Routing, ModelBase) {
    'use strict';

    Twig.extendTest('fieldType', function (value, type) {
        return value instanceof ModelBase.prototype.subModelTypes[type];
    });
    Twig.extendFunction('fieldTypes', function () {
        return {
            'string': 'Строка',
            'text': 'Текст',
            'image': 'Картинка',
            'composite': 'Группа',
            'array': 'Массив',
            'html': 'HTML',
        };
    });

    var jq = function (myid) {
        return myid.replace(/(:|\.|\[|\])/g, "\\$1");
    };

    var viewId = '@WerkintCmsCore/Widgets/jsonStructure.twig';


    var View = Backbone.Marionette.ItemView.extend({
        "modelBinder": undefined,
        "template": '@WerkintCmsCore/Widgets/jsonStructure.twig',

        "initialize": function () {
            this.template = templating.get(this.template);

            this.modelBinder = new Backbone.ModelBinder();

            this.model.on('fieldChanged', function (field) {
                field.on('change', function (model) {
                    if (model.changedAttributes().type) {
                        this.render();
                    }
                }, this);
            }, this);
        },

        "render": function () {
            this.$el.html(this.template(this.model));
            this.modelBinder.bind(this.model.field, this.el);
            this.delegateEvents();

            return this;
        },

        "events": {
            "click .action-remove": "removeField",
            "click .action-add": "addField",
            "click .action-save": function () {
                this.trigger('structureSave');
            },
            "keyup .action": function (e) {
                if (e.keyCode === 13) {
                    $(e.currentTarget).trigger('click');
                }
            },
            "keyup input": function (e) {
                if (e.keyCode === 13) {
                    $.tabNext();
                }
            },
        },

        "removeField": function (e) {
            var el = this.$(e.currentTarget),
                name = el.data('name'),
                model = this.model.field.get(name);

            model.getParent().removeChild(model);

            this.render();
        },

        "addField": function (e) {
            var el = this.$(e.currentTarget),
                type = el.parent().children('select').val(),
                name = el.data('name'),
                model = name ? this.model.field.get(name) : this.model.field;
            var child = model.addChild(type);
            this.render();

            this.$el.find('[name=' + jq(child.fullName('name')) + ']')
                .focus().textrange('set');
        },

    });

    return View;
});