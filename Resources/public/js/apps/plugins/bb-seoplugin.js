
YUI.add('bb-seoplugin', function (Y) {
    // Good practices: use a custom namespace
    Y.namespace('bbSeo.Plugin');

    Y.bbSeo.Plugin.SeoPlugin = Y.Base.create('bbSeoPlugin', Y.Plugin.Base, [], {
        initializer: function () {
            var app = this.get('host'); // the plugged object is called host

            app.views.bbSeoDashboardView = {
                type: Y.bbSeo.DashboardView,
            };
            //routing
            app.route({
                name: "BBSeoDashboard",
                path: "/bbseo/dashboard",
                view: "bbSeoDashboardView",
                service: Y.bbSeo.DashboardService, // constructor function to use to instantiate the view service
                // we want the navigationHub (top menu) but not the discoveryBar
                sideViews: {'navigationHub': true, 'discoveryBar': false},
                callbacks: ['open', 'checkUser', 'handleSideViews', 'handleMainView'],
            });
        },
    }, {
        NS: 'bbseoTypeApp' // don't forget that
    });

    // registering the plugin for the app
    Y.eZ.PluginRegistry.registerPlugin(
        Y.bbSeo.Plugin.SeoPlugin, ['platformuiApp']
    );
});