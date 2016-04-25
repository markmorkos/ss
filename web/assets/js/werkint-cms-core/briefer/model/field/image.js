define([
    'lodash',
    'backbone',
    './base',
], function (_, Backbone, ModelBase) {
    'use strict';

    var Model = ModelBase.extend({
        "defaults": {
            "type": 'image',
        },
    });

    Backbone.Relational.store.currentScope.BrieferFieldImage = Model;

    return Model;
});