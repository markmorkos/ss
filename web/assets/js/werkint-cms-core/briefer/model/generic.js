define([
    'backbone',
    'backbone.relational',
], function (Backbone) {
    'use strict';

    Backbone.Relational.store.removeModelScope();
    Backbone.Relational.store.currentScope = {};
    Backbone.Relational.store.addModelScope(
        Backbone.Relational.store.currentScope
    );
    return Backbone.RelationalModel;
});