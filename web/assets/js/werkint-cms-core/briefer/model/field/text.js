define([
    'lodash',
    'backbone',
    './base',
], function (_, Backbone, ModelBase) {
    'use strict';

    var Model = ModelBase.extend({
        "defaults": {
            "type": 'text',
        },
    });

    Backbone.Relational.store.currentScope.BrieferFieldText = Model;

    return Model;
});