angular.module('app.config', []).config(config);

  /** @ngInject */
  function config($logProvider) {
    // Enable log
    $logProvider.debugEnabled(true);  
    
     
  }

 