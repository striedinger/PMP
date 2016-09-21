angular.module('app.config', []).config(config);

  /** @ngInject */
  function config($logProvider) {
    // Enable log
    $logProvider.debugEnabled(true);  
    
     
  }

var local = {
  	"apiHost": "http://localhost/pmp_hugo/PMP/public/api",
    "questionTemplate": "/pmp_hugo/pmp/public/js/templates/question.template.html",
    "resultUrl":"http://localhost/pmp_hugo/PMP/public/results/"
  };
  var prod = {
    "login":  "http://colorado.uninorte.edu.co/evadoc_api/login/google",
    "logout": "http://colorado.uninorte.edu.co/evadoc_api/logout",
    "base":   "http://colorado.uninorte.edu.co/evadoc_api/",
    "port": "80"
  };
angular.module("app")
	   .constant('apiConf',local);
 