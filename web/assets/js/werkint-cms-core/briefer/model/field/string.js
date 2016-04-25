define([
    'lodash',
    'backbone',
    './base',
], function (_, Backbone, ModelBase) {
    'use strict';

    var Model = ModelBase.extend({
        "defaults": {
            "type": 'string',
        },
    });

    Backbone.Relational.store.currentScope.BrieferFieldString = Model;

    return Model;
});