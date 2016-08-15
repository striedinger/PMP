angular.module('app.controllers', [])

.controller('SessionController', function($scope, $http, sessions){
	$scope.questions = {};
	sessions.getSessions(1, "token").then(function(data) {
            //$scope.answers = data;
            if (!$.isEmptyObject(data) && data !== null && typeof(data) != "undefined") {
                $scope.questions = data;
                active();
            }else{
                $scope.questions= {};
            }
            $log.debug("recibido en sessions controller: " ,$scope.questions);      
    });
	
});