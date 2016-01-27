
YUI.add('bb-navigationplugin', function (Y) {
    Y.namespace('bbSeo.Plugin');

    // view service plugins must extend Y.eZ.Plugin.ViewServiceBase
    // Y.eZ.Plugin.ViewServiceBase provides several method allowing to deeply
    // hook into the view service behaviour
    Y.bbSeo.Plugin.NavigationPlugin = Y.Base.create('ezconfNavigationPlugin', Y.eZ.Plugin.ViewServiceBase, [], {
        initializer: function () {
            var service = this.get('host'); // the plugged object is called host

            //add navigation Item
            service.addNavigationItem({
                Constructor: Y.eZ.NavigationItemView,
                config: {
                    title: "BB SEO",
                    identifier: "bbseo-dashboard",
                    route: {
                        name: "BBSeoDashboard" // same route name of the one added in the app plugin
                    }
                }
            }, 'platform'); // identifier of the zone called "Content" in the UI
        },
    }, {
        NS: 'ezconfNavigation'
    });

    Y.eZ.PluginRegistry.registerPlugin(
        Y.bbSeo.Plugin.NavigationPlugin, ['navigationHubViewService']
    );
});