angular.module('app.controllers', [])

.controller('SessionController', function($scope, $http, sessions, $log){
	$scope.data = {};
	$scope.questions = {};
	$scope.qTotal = 0;
	$scope.qIndex = 0;
	$scope.qCurrent = {};
	$scope.qMarked = {};

	sessions.getSessions(1, "token").then(function(data) {
            //$scope.answers = data;
            if (!$.isEmptyObject(data) && data !== null && typeof(data) != "undefined") {
                $scope.data = data;
                active();
            }else{
                $scope.data= {};
            }
            $log.debug("recibido en sessions controller: " ,$scope.data);      
    });

    function active(){
    	//inicializacion
    	$scope.questions=$scope.data.questions;
    	$scope.qMarked =$scope.data.marked;
    	$scope.qCurrent = $scope.data.questions[0];
    	$scope.qTotal = $scope.data.session.exam.questions;
    	$scope.qIndex = 1;
    	
    }

	
});