(function() {
  'use strict';

  angular
    .module('app')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider, $urlRouterProvider) {

    $stateProvider
      .state('session', {
        url: '/{id}',
        controller: 'SessionController',
        controllerAs: 'landingCtrl',
        authenticate: false
      });


    $urlRouterProvider.otherwise('/');
  }

})();
