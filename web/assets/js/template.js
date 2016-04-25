/**
 * @author <Vladimir Odesskij> [odesskij1992@gmail.com]
 */
define([
    'text',
    'router',
    'templating'
], function (text, Routing, templating) {
    'use strict';

    return {
        "load": function (name, req, onLoad, config) {
            if (config.isBuild) {
                onLoad(null);
            } else {

                if (templating.findBlock(name)) {
                    onLoad(templating.get(name));
                    return;
                }

                text.get(Routing.generate('ajax_templating', {
                        "template": name
                    }), function (data) {
                        try {
                            JSON.parse(data).forEach(function (template) {
                                if (!templating.findBlock(template.name)) {
                                    templating.addTemplate(template.name, template.source);
                                }
                            });
                            onLoad(templating.get(name));
                        } catch (e) {
                            onLoad.error(e);
                        }
                    },
                    onLoad.error, {
                        "accept": 'application/json'
                    }
                );

            }
        }
    };
});
