define([
    'backbone',
    'util/basemodel',
], function (Backbone, BaseModel) {
    'use strict';


    var Model = BaseModel.extend({
        "defaults": {
            "uri":     null, // Не url !!!
            "ordinal": 0,
        },
    });

    return Model;
});