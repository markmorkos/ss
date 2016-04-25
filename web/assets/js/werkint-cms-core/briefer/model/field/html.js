define([
    'lodash',
    'backbone',
    './base',
], function (_, Backbone, ModelBase) {
    'use strict';

    var Model = ModelBase.extend({
        "defaults": {
            "type": 'html',
        },
    });

    Backbone.Relational.store.currentScope.BrieferFieldHtml = Model;

    return Model;
});