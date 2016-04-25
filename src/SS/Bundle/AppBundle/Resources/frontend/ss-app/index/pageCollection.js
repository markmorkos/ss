define([
    'lodash',
    'backbone',
    'router',
    './model',
], function (_, Backbone, Router,Model) {
    'use strict';


    var Collection = Backbone.Collection.extend({
        "model":    Model,
        "url": function(){
            return Router.generate('pages_list');
        }
    });

    return Collection;
});