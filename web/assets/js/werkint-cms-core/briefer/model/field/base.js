define([
    'lodash',
    'backbone',
    '../generic',
], function (_, Backbone, GenericModel) {
    'use strict';

    var Model = GenericModel.extend({
        "defaults":      {
            "name":  null,
            "value": '',
            "type":  null,
        },
        "subModelTypes": {
            "image":     'BrieferFieldImage',
            "text":      'BrieferFieldText',
            "string":    'BrieferFieldString',
            "array":     'BrieferFieldArray',
            "composite": 'BrieferFieldComposite',
            "html":      'BrieferFieldHtml',
        },

        "initialize": function () {
            GenericModel.prototype.initialize.apply(this, arguments);

            this.on('change', function () {

                var bublleTarget = this.getParent();

                if (this.changedAttributes().type) {
                    var clsParent = this.getParentType(),
                        clsChildren = 'children';
                    if (clsParent === 'parentArray') {
                        clsChildren = 'prototype';
                    }
                    var children = this.get(clsParent).get(clsChildren),
                        cls = this.get(clsParent).findChildType(this.get('type'));

                    var dat = {
                        "name": this.get('name'),
                    };
                    dat[clsParent] = this.get(clsParent);

                    var newRow = bublleTarget = new cls(dat);

                    if (children.indexOf) {
                        children.models[children.indexOf(this)] = newRow;
                    } else {
                        dat[clsParent].set(clsChildren, newRow);
                    }
                    Backbone.Relational.store.unregister(this);
                    if (this.get('prototype')) {
                        Backbone.Relational.store.unregister(this.get('prototype'));
                    }
                }

                // Event bubbling
                if (bublleTarget) {
                    var args = _.toArray(arguments);
                    args.unshift('change');
                    bublleTarget.trigger.apply(bublleTarget, args);
                }
            });
        },

        "mapChangedAttributes": function (parent) {
            return _.object(_.map(this.changedAttributes(), function (attr, key) {
                return [this.fullName(key, parent), attr];
            }, this));
        },

        "fullName": function (fieldName, topParent) {
            var ret = [], field = this;
            if (fieldName) {
                ret.push(fieldName);
            }
            while (field) {
                if (field.get('parent') && field.get('parent') !== topParent) {
                    ret.push('children[' + field.collection.indexOf(field) + ']');
                    field = field.get('parent');
                } else if (field.get('parentSuper') && field.get('parentSuper') !== topParent) {
                    ret.push('children[' + field.collection.indexOf(field) + ']');
                    field = field.get('parentSuper');
                } else if (field.get('parentArray') && field.get('parentArray') !== topParent) {
                    ret.push('prototype');
                    field = field.get('parentArray');
                } else {
                    break;
                }
            }
            return ret.reverse().join('.');
        },
        "topName":  function () {
            var ret = [], field = this;
            while (field) {
                if (field.get('parent')) {
                    ret.push(field.get('name'));
                    field = field.get('parent');
                } else {
                    if (field.get('parentArray')) {
                        ret.push(field.rowName());
                    }
                    break;
                }
            }
            return ret.reverse().join('.');
        },
        "rowName":  function () {
            return 'row';
        },

        "toJSON":  function () {
            var data = GenericModel.prototype.toJSON.apply(this, arguments);

            if (data) {
                delete data.parent;
                delete data.parentArray;
            }

            return data;
        },
        "toValue": function () {
            return String(this.get('value'));
        },

        "setValue": function (value) {
            this.set('value', value);
        },

        "isComposite":    function () {
            return false;
        },
        "canChangeField": function (field) {
            if (field === 'name') {
                return this.getParentType() !== 'parentArray';
            }
            return true;
        },
        "canBeRemoved":   function () {
            return this.getParentType() !== 'parentArray';
        },

        "getParentType": function () {
            if (this.get('parentArray')) {
                return 'parentArray';
            }
            if (this.get('parentSuper')) {
                return 'parentSuper';
            }
            return 'parent';
        },
        "getParent":     function () {
            return this.get(this.getParentType());
        },
    });

    Backbone.Relational.store.currentScope.BrieferFieldBase = Model;

    return Model;
});