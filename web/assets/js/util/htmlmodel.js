/**
 * Это специальная модель Backbone, созданная для загрузки данных,
 * содержащих в себе html. Основная цель её - догружать стили и скрипты при выводе.
 */
define([
    'jquery',
    'lodash',
    'backbone',
    'util/basemodel',
    './htmlmeta',
], function ($, _, Backbone, BaseModel, HtmlMeta) {
    'use strict';

    var relations = [
        {
            "type":         Backbone.HasOne,
            "relatedModel": HtmlMeta,
            "key":          '_meta',
        }
    ];

    var Model = BaseModel.extend({
        "defaults": {
            "_html": null,
        },

        "constructor": function () {
            this.relations = this.relations.concat(relations);
            this.defaults = _.extend({}, Model.prototype.defaults, this.defaults);

            return BaseModel.prototype.constructor.apply(this, arguments);
        },

        "initialize": function () {
            this.on('beforeFetch', function () {
                this.set({
                    '_meta': null,
                    '_html': null,
                }, false);
                $('.mytmp').detach();
            });
            this.on('sync', function () {
                var data = this.get('_meta').toJSON();
                var pathCss = data.respath + '/' + data.blocks.page.css + '.css';

                // TODO: multiple
                var loader = _.bind(function () {
                    this.trigger('stylesLoaded');
                }, this);

                $('<link/>', {
                    'href':  pathCss,
                    'rel':   'stylesheet',
                    'type':  'text/css',
                    'class': 'mytmp',
                }).on('load', function () {
                    loader();
                }).appendTo('head');
            }, this);
        },

        "fetch": function (options) {
            if (this._xhr) {
                this._xhr.abort();
            }

            this.set({
                "_meta": null,
                "_html": null,
            }, false);

            this.trigger('beforeFetch');

            this._xhr = BaseModel.prototype.fetch.apply(this, arguments);
        },
    });

    return Model;
});