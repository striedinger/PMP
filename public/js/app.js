var app = angular.module('app', 
	[
	    '19degrees.ngSweetAlert2',	
	    'ngCookies',
		'app.controllers',
		'ui.bootstrap',
		'app.services',  
		'app.directives',
		'app.config',
		'ui.router',
		'timer',
		'angular-loading-bar',
		'angularSpinner'
		]); 

$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
