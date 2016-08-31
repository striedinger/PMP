angular.module('app.controllers', [])
 
.controller('SessionController', function($scope, $http, sessions, $log){
	var pathname = window.location.href;
	var session_id = pathname.split("/").pop(-1)
	$scope.data = {};
	$scope.questions = {};
	$scope.qTotal = 0;
	$scope.qIndex = 0;
	$scope.qCurrent = {};
	$scope.qMarked = {};

    $scope.selected = null;
    $scope.loading = false;

    $scope.setSelected = function(option){
        $scope.selected = option;
    }

	sessions.getSessions(session_id, "token").then(function(data) { //TODO: obtener el id de la seccion
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