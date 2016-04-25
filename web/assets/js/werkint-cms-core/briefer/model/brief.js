define([
    'lodash',
    'backbone',
], function (_, Backbone) {
    'use strict';

    var Model = function () {
        _.extend(this, Backbone.Events);
    };

    Model.prototype.toJSON = function () {
        return {
            'field': this.field.toJSON(),
        };
    };

    Model.prototype.setField = function (field) {
        this.field = field;

        this.trigger('fieldChanged', field);
    };

    return Model;
});