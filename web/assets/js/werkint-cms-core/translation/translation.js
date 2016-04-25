define([
    'backbone',
    'util/basemodel',
], function (Backbone, BaseModel) {
    'use strict';

    var Model = BaseModel.extend({
        "defaults": {
            "locale": null
        }
    });

    return Model;
});
