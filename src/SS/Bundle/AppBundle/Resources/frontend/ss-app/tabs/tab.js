define([
    'lodash',
    'backbone',
    'location',
    'util/basemodel',
    './tabsView',
], function (_, Backbone, location, BaseModel, TabsView) {
    'use strict';

    var Model = BaseModel.extend({
        "initialize": function () {
            if (!this.get('name')) {
                this.set('name', this.get('uri'));
            }

            var root = this.get('root') ? this.get('root') : '';
            if (this.get('route')) {
                root += this.get('route');
            } else if (root.length && root[root.length - 1] !== '/') {
                root += '/';
            }

            var token = this.get('token'),
                children = {};
            _.each(this.get('children'), function (node, index) {
                var yes = true;
                if (node.access) {
                    if (typeof node.access !== "function") {
                        yes = node.access;
                    } else {
                        yes = node.access(token);
                    }
                }
                if (yes) {
                    children[index] = node;
                }
            }, this);

            this.set('children', _.map(children, function (row, url) {
                var child = new Model(_.extend({}, row, {
                    'uri':     url,
                    'root':    root + url,
                    'router':  this.get('router'),
                    'options': this.get('options'),
                    'parent':  this,
                    'token': token,
                }));
                child.on('change:count', function () {
                    this.trigger('tabcount');
                }, this);
                return child;
            }, this));

            this.initializeRouter();
            this.initializeView(this.get('options'));
            this.get('router').route(this.get('root'), _.bind(function () {
                this.route(location.pathname.substr(1), this, this, arguments);
            }, this));
            if (this.get('route')) {
                // TODO: плохо
                this.get('router').route(this.get('root') + this.get('route'), _.bind(function () {
                    this.route(location.pathname.substr(1), this, this, _.toArray(arguments));
                }, this));
            }
        },

        "initializeRouter": function () {
            if (!this.get('router')) {
                this.set('router', new Backbone.Router());
            }
        },
        "initializeView":   function (options) {
            var opts = {
                "model": this,
            };
            if (options) {
                opts.userId = options.userId;
            }
            var Model = this.get('view') || Backbone.View;
            this.set('view', new Model(opts));
        },

        "tabByName":  function (name) {
            // TODO: to collection
            return _.find(this.get('children'), function (tab) {
                return tab.get('name') === name;
            });
        },
        "currentTab": function () {
            // TODO: cache
            return _.find(this.get('children'), function (tab) {
                return tab.get('active');
            });
        },

        "defaults": {
            "root":  '',
            'route': '',
        },

        "route": function (url, caller, originalCaller, args) {
            if (args[1] === 'edit/17'){
                throw {};
            }
            if (caller === this && this.get('children').length) {
                Backbone.history.navigate(this.get('children')[0].getUrl(), {
                    "trigger": true,
                    "replace": true,
                });
                return;
            }

            _.each(this.get('children'), function (tab) {
                var view = tab.get('view');
                tab.set('active', tab === caller);
                if (tab.get('active')) {
                    view.$el.show();
                    if (view instanceof TabsView) {
                        view.setTabArguments(url, args);
                    }
                    view.render();
                } else {
                    view.$el.hide();
                    if (view instanceof TabsView) {
                        view.setTabArguments(url, null);
                    }
                    view.remove();
                }
            });
            this.trigger('route', url, caller, originalCaller, args);
            if (this.get('parent')) {
                this.get('parent').route(url, this, originalCaller, args);
            }
        },

        "getUrl": function () {
            return '/' + this.get('root');
        },

        "hasCount": function () {
            return _.isNumber(this.get('count'));
        },
    });

    return Model;
});
