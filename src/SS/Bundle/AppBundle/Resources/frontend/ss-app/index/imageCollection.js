define([
    'lodash',
    'backbone',
    'router',
    './model',
], function (_, Backbone, Router,Model) {
    'use strict';


    var Collection = Backbone.Collection.extend({
        "model":    Model,
        "diskr": "main",
        "url": function(){
            return Router.generate('images_list', {'diskr': this.diskr});
        }
    });

    return Collection;
});