angular.module('app.controllers', [])
.controller('SessionController', function($scope, $http, sessions, $log){
	var pathname = window.location.href;
	var session_id = pathname.split("/").pop(-1)
    $scope.pmp = {};
	$scope.pmp.data = {};
	$scope.pmp.questions = {};
	$scope.pmp.qTotal = 0;
    $scope.pmp.qIndex = 0;
	$scope.pmp.qCurrent = {};
	$scope.pmp.qMarked = [];
    $scope.pmp.qTotalAnswered  = 2; //TODO obtener de servidor
	$scope.pmp.dataHasLoaded = false;
    $scope.pmp.duration = 0;
    $scope.pmp.timerRunning = true;
   

//***from hugo
    $scope.selected = null;
    $scope.loading = false;

    $scope.setSelected = function(option){
        $scope.selected = option;
    }
//***from hugo

	sessions.getSessions(session_id, "token").then(function(data) { 

            if (!$.isEmptyObject(data) && data !== null && typeof(data) != "undefined") {
                $scope.pmp.data = data;


                active();
            }else{
                $scope.pmp.data= {};
            }
            $log.debug("recibido en sessions controller: " ,$scope.pmp.data);      
    });

    function active(){
    	//inicializacion
    	$scope.pmp.dataHasLoaded = true;
    	$scope.pmp.questions=$scope.pmp.data.questions;
    	$scope.pmp.qMarked = $scope.pmp.data.marked;
    	$scope.pmp.qCurrent = $scope.pmp.data.questions[0];
    	$scope.pmp.qTotal = $scope.pmp.data.session.exam.questions;
        $scope.pmp.duration = $scope.pmp.data.session.time;
        $scope.pmp.qIndex = 1;
        $scope.$broadcast('timer-set-countdown-seconds', $scope.pmp.duration);
        if($scope.pmp.data.session.active == 0){
             $scope.$broadcast('timer-stop');
             $scope.pmp.timerRunning = false;
        }

        //verificar si el examen ya finalizo
    }

    $scope.changeQuestion =function (number) {
         $scope.pmp.qCurrent =  $scope.pmp.data.questions[number-1];
         $scope.pmp.qIndex = number;
    }
    $scope.startTimer = function() {
     sessions.start(session_id, "token").then(function(data) {
         if (!$.isEmptyObject(data) && data !== null && typeof(data) != "undefined") {
             $scope.$broadcast('timer-start');
             $scope.pmp.timerRunning = true;
             $scope.pmp.duration = data.session.time;

         } else {
             $scope.pmp.timerRunning = false;
         }
     });
    };

    $scope.stopTimer = function (){
     sessions.stop(session_id, "token").then(function(data) {
         if (!$.isEmptyObject(data) && data !== null && typeof(data) != "undefined") {
             $scope.$broadcast('timer-stop');
             $scope.pmp.timerRunning = false;
             $scope.pmp.duration = data.session.time;

         } else {
             $scope.pmp.timerRunning = true;
         }
     });
    };

    $scope.finished = function () {
         swal("Se terminó el tiempo");
    }
    $scope.$on('timer-stopped', function (event, data){
                console.log('Timer Stopped - data = ', data);
    });
 
});