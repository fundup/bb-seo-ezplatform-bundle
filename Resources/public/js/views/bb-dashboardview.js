
YUI.add('bbseo-dashboardview', function (Y) {
    Y.namespace('bbSeo');

    Y.bbSeo.DashboardView = Y.Base.create('bbSeoDashboardView', Y.eZ.ServerSideView, [], {

        events: {
            '.send-form': {
                'blur': '_sendAjaxForm'
            }
        },
        initializer: function () {
            this.containerTemplate = '<div class="ez-view-bbseodashboardview"/>';
        },

        //save meta when unfocus using Ajax ...
        _sendAjaxForm: function (e) {
            var input = e.target;
            e.preventDefault();
            //fire envent to send data
            this.fire('sendForm', {
                //get inline form
                jData : {
                    contentId: input.getData('content-id'),
                    metaType: input.getData('meta-type'),
                    inputValue: input.get('value')
                }
            });
        },
    });
});