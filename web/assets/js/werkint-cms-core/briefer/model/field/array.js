define([
    'lodash',
    'backbone',
    './composite',
    './text',
], function (_, Backbone, ModelComposite, FieldText) {
    'use strict';

    var Model = ModelComposite.extend({
        "defaults": {
            "type":    'array',
            "isAssoc": false,
        },

        "relations": [
            {
                "type":            Backbone.HasMany,
                "key":             'children',
                "relatedModel":    'BrieferFieldBase',
                "reverseRelation": {
                    "key": 'parentSuper',
                }
            },
            {
                "type":            Backbone.HasOne,
                "key":             'prototype',
                "relatedModel":    'BrieferFieldBase',
                "reverseRelation": {
                    "type": Backbone.HasOne,
                    "key":  'parentArray',
                },
            },
        ],

        "toValue": function () {
            if(this.get('isAssoc')){
                return ModelComposite.prototype.toValue.apply(this, arguments);
            }
            return this.get('children').map(function (row) {
                return row.toValue();
            });
        },

        "setValue": function (data) {
            _.each(data,function (row) {
                this.get('children').last();
                this.addChild();
                this.get('children').last().setValue(row);
            }.bind(this));
        },


        "initialize": function () {
            ModelComposite.prototype.initialize.apply(this, arguments);

            if (!this.get('prototype')) {
                this.set('prototype', new FieldText({
                    'name':        '__prototype__',
                    'parentArray': this,
                }));
            }
        },

        "addChild": function (name) {
            var type = this.get('prototype.type'),
                cls = this.findChildType(type),
                child;
            if(name){
                child = new cls(_.merge(this.get('prototype').toJSON(), {
                    "type":        type,
                    "parentSuper": this,
                    "name":        name,
                }));
            }
            else{
                child = new cls(_.merge(this.get('prototype').toJSON(), {
                    "type":        type,
                    "parentSuper": this,
                }));
            }
            this.get('children').add(child);
            return child;
        },

        "canChangeField": function (field) {
            if (field === 'type') {
                return true;
            }
            return ModelComposite.prototype.canChangeField.apply(this, arguments);
        },
    });

    Backbone.Relational.store.currentScope.BrieferFieldArray = Model;

    return Model;
});