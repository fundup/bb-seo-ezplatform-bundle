
YUI.add('bbseo-dashboardservice', function (Y) {
    Y.namespace('bbSeo');
    Y.use('json-parse');

    Y.bbSeo.DashboardService = Y.Base.create('bbSeoDashboardService', Y.eZ.ServerSideViewService, [], {
        initializer: function () {
            //action send form with ajax
            this.on('*:sendForm', function (e) {
                var $this = this; //to access this in success
                //do the ajax call with YUI
                Y.io('/bbseo/savemeta', {
                    method: 'POST',
                    data: Y.JSON.stringify(e.jData),
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    on: {
                        success: function (id, response) {
                            $this._saveMetaSuccess(response);
                        } //TODO on error
                    }
                });
            });
        },

        //load view and get infos from controller
        _load: function (callback) {
            var uri = this.get('app').get('apiRoot') + 'bbseo/adminview';
            Y.io(uri, {
                method: 'GET',
                on: {
                    success: function (tId, response) {
                        this._parseResponse(response);
                        callback(this);
                    },
                    failure: this._handleLoadFailure,
                },
                context: this,
            });
        },

        //on('*:sendForm) success
        _saveMetaSuccess: function(response) {
            var message = response.responseText;
            //define node for notif
            var node = Y.Node.create('<li data-state="done">'+message+'</li>');
            this._notifyUser(node);
        }
    });
});