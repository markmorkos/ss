define([
  'module',
  'jquery',
  'lodash',
  'twig',
  'domReady!',
], function (module, $, _, Twig) {
  'use strict';

  var config = _.defaults(module.config(), {
    "scriptType": 'text/x-twig-template',
    "templateContainer": '#global_page_templates'
  });

  var templatesStore = [];

  var addTemplate = function (name, source) {
    var template = Twig.twig({
      "id": name,
      "data": source,
      "allowInlineIncludes": true,
      "autoescape": true,
    });

    templatesStore.push({
      "template": template,
      "name": name
    });
  };

  var cont = $(config.templateContainer);
  cont.find('script[type="' + config.scriptType + '"]').each(function () {
    addTemplate($(this).data('id'), $(this).html());
  });

  var templating = {
    "twig": Twig,
    "render": function () {
      var args = _.toArray(arguments),
        name = args.shift();
      return this.get(name).apply(this, args);
    },
    "findBlock": function (name) {
      return Twig.twig({
        'ref': name,
      });
    },
    "get": function (name, contextGlobal) {
      var tpl = this.findBlock(name);
      if (!tpl) {
        throw 'Template not found: ' + name;
      }
      return _.bind(function (contextIn, params) {
        var context = _.merge({}, contextGlobal, contextIn);
        return tpl.render.call(tpl, context, params);
      }, this);
    },
    "addTemplate": addTemplate,
    "templatesStore": templatesStore
  };

  return templating;
});
