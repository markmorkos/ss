define([
    'lodash',
    'backbone',
    './image',
], function (_, Backbone, ImageModel) {
    'use strict';


    var Collection = Backbone.Collection.extend({
        "model":    ImageModel,
        initialize: function () {
            this.on('sync', this.sort, this);
        },
        comparator: function (model) {
            return model.get('ordinal');
        },
    });

    return Collection;
});