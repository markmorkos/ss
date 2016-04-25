define([
    'lodash',
    'backbone',
    './base',
], function (_, Backbone, ModelBase) {
    'use strict';

    var Model = ModelBase.extend({
        "defaults": {
            "type": 'composite',
        },

        "relations": [
            {
                "type":            Backbone.HasMany,
                "key":             'children',
                "relatedModel":    'BrieferFieldBase',
                "reverseRelation": {
                    "key": 'parent',
                }
            },
        ],

        "toValue": function () {
            return _.object(this.get('children').map(function (row) {
                return [row.get('name'), row.toValue()];
            }));
        },

        "setValue": function (data) {
            this.get('children').map(function (row) {
                var key = row.get('name');
                if (row.get('isAssoc')) {
                    _.each(data[key], function (qrow, keyrow) {
                        row.addChild(keyrow);
                        row.get('children').last().setValue(qrow);
                    }.bind(this));
                }
                else {
                    if (data) {
                        row.setValue(data[key] ? data[key] : null);
                    }
                    else{
                        row.setValue(null);
                    }

                }
            }.bind(this));
            return this;
        },


        "isComposite":    function () {
            return true;
        },
        "canChangeField": function (field) {
            if (field === 'type') {
                return this.get('children').length === 0;
            }
            return ModelBase.prototype.canChangeField.apply(this, arguments);
        },

        "removeChild": function (model) {
            return this.get('children').remove(model);
        },

        "addChild": function (type, name) {
            var cls = this.findChildType(type);
            var child = new cls({
                'type': type,
                'name': name ? name : '_new',
            });
            this.get('children').add(child);
            return child;
        },

        "findChildType": function (type) {
            var cls = ModelBase.prototype.subModelTypes[type];
            return Backbone.Relational.store.getObjectByName(cls);
        },
    });

    Backbone.Relational.store.currentScope.BrieferFieldComposite = Model;

    return Model;
});