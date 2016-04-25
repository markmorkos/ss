define([
    'lodash',
    'backbone',
    'twig',
    'translator',
    'assetic',
    'router',
    'moment',
], function (_, Backbone, Twig, Translator, assets, Routing, moment) {
    'use strict';

    Twig.extendFunction('asset', function (val) {
        return assets.asset(val);
    });

    Twig.extendFunction('id', function () {
        var id = null, ind = 0;
        return function () {
            return ++ind % 2 === 0 ? id : id = _.uniqueId('form');
        };
    }());

    /**
     * Port twig trans
     */
    Twig.extendFilter('trans', function (val, options) {
        options.unshift(val);
        return Translator.trans.apply(Translator, options);
    });

    /**
     * Port object routes
     */
    Twig.extendFunction('object_path', function (type, obj) {
        if (obj instanceof Backbone.Model) {
            var routes = obj.get('object_routes');
            if (routes && routes[type]) {
                return routes[type].path;
            }
            return;
        }

        if (!(obj.object_routes && obj.object_routes[type])) {
            return;
        }

        return obj.object_routes[type].path;
    });

    Twig.extendFilter('localizeddate', function (value, options) {

        var format = options && options[0] ? options[0] : null;
        return moment(value === 'now' ? undefined : value).format(format);
    });

    /**
     * Port object routes
     */
    Twig.extendFunction('object_url', function (type, obj) {
        if (!(obj.object_routes && obj.object_routes[type])) {
            return;
        }

        return obj.object_routes[type].url;
    });

    /**
     * Url for files
     */
    Twig.extendFunction('file_url', function (obj) {

        if (obj instanceof Backbone.Model && obj.has('uri')) {
            return obj.get('uri');
        }

        if (!obj || !obj.uri) {
            return;
        }
        return obj.uri;
    });

    Twig.extendFunction('path', function () {
        var args = Array.prototype.slice.call(arguments, 0);
        _.each(args, function (arg) {
            if (_.isObject(arg)) {
                delete arg._keys;
            }
        });
        return Routing.generate.apply(Routing, args);
    });

    Twig.extendFilter('miniature', function () {
        return ;
    });

    
    /**
     * Console.log for twig
     */
    Twig.extendFilter('console', function () {
        console.log.apply(console, arguments);
    });

    /**
     * @param date for moment.js
     */
    Twig.extendFilter('time_ago_in_words', function (date) {
        return moment(date).fromNow();
    });


    /**
     * @param object
     * @returns integer
     */
    var imageRatio = function (object) {
        if (!_.has(object, 'ratio')) {
            return undefined;
        }

        return object.ratio;
    };
    Twig.extendFunction('image_ratio', imageRatio);
    Twig.extendFilter('image_ratio', imageRatio);

    /**
     *
     * @param object
     * @param _default value if can not be calculated
     * @returns string
     */
    Twig.extendFilter('image_scale_helper', function (object, _default) {
        var ratio = imageRatio(object);
        if (ratio !== undefined) {
            return ratio > 1 ? 'horizontal' : 'vertical';
        }

        return _default;
    });

    return Twig;
});