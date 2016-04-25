define([
        './basemodel'
    ], function (BaseModel) {
        'use strict';

        var baseSync = BaseModel.prototype.sync;

        BaseModel.prototype.sync = function (po, hui, response) {

            var self = this;

            this.on('sync', function (po, hui, response) {
                var responseContent = JSON.parse(response.xhr.responseText);

                if (responseContent.errors && responseContent.errors.length !== 0) {
                    var errors = responseContent.errors;
                    self.trigger('serverValidationError', {
                        errors: errors
                    });
                } else {
                    self.trigger('serverValidationSuccess');
                }
            });

            return baseSync.apply(this, arguments);
        };

        return BaseModel;
    }
);