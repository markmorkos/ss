define([
    'lodash',
    'backbone',
    './translation',
    'util/basemodel',
], function (_, Backbone, TranslationModel, BaseModle) {
    'use strict';

    var Model = Backbone.Collection.extend({
        "model": TranslationModel,
    });




    return Model;
});
