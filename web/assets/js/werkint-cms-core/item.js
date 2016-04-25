define([
    'jquery',
    'backbone',
    'lodash',
    'router',
    './translation/translation',
    './translation/translationCollection',
    'backbone.relational',
], function ($,Backbone,_, Routing, Translation,TranslationCollection ) {
    'use strict';

    var Model = Backbone.RelationalModel.extend({

        "relations": [
            {
                "type":         Backbone.HasOne,
                "key":          'parent',
                "relatedModel": Model,
            },
            {
                "type":           Backbone.HasMany,
                "key":            'translations',
                "relatedModel":   Translation,
                "collectionType": TranslationCollection
            },
        ],


    });

    return Model;
});