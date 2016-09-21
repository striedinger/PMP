angular.module('app.controllers', [])
.controller('SessionController', function($scope, $http, sessions, $log,$filter){
	var pathname = window.location.href;
	var session_id = pathname.split("/").pop(-1)
    $scope.pmp = {};
	$scope.pmp.data = {};
	$scope.pmp.questions = {};
	$scope.pmp.qTotal = 0;
    $scope.pmp.qIndex = 0;
	$scope.pmp.qCurrent = {};
	$scope.pmp.qMarked = [];
    $scope.pmp.qTotalAnswered  = 0; //TODO obtener de servidor
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
        $scope.pmp.created_at = $scope.pmp.data.session.created_at;
        $scope.pmp.updated_at = $scope.pmp.data.session.updated_at;
        $scope.pmp.qIndex = 1;
        $scope.init_time = 0;
        $scope.pmp.qTotalAnswered =  $scope.pmp.data.session.total_answered;
//calcular tiempo restante cuando se da reload a la pagina


        $scope.$broadcast('timer-set-countdown-seconds', $scope.pmp.duration);
        if($scope.pmp.data.session.active == 0){
             $scope.$broadcast('timer-stop');
             $scope.pmp.timerRunning = false;
             $scope.$broadcast('auto-start-false-timer', false);

        }else{
            $scope.$broadcast('timer-start');
            $scope.pmp.timerRunning = true;
            $scope.pmp.duration = $scope.pmp.duration;
            

        }

        if($scope.pmp.data.session.exam.duration == 0){
            $scope.infinito = true;
            //$scope.$broadcast('timer-reset');
            date_init = new Date( $scope.pmp.created_at );
            date_updated = new Date( $scope.pmp.updated_at );
            stoped_time = $scope.dayDiff(date_updated);
            $scope.init_time =  date_init.getTime() + stoped_time;
          //  $scope.$broadcast('timer-set-startTime', $scope.init_time );
          $scope.startTimer();

        }else{
            $scope.infinito = false;
        }


        //verificar si el examen ya finalizo

        if($scope.pmp.duration == 0 && $scope.pmp.data.session.exam.duration !=0){
            swal("Este examen ya finalizó");
        }

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
             $scope.pmp.duration = data.session.time ;
         } else {
             $scope.pmp.timerRunning = true;
         }
     });
    };

    $scope.finished = function () {
        swal({
            text:"Se terminó el tiempo", 
        }).then(function(){
                window.location.replace("http://localhost/pmp_hugo/PMP/public/results"); //CAMBIAR
        });
    }


    $scope.$on('timer-stopped', function (event, data){
                console.log('Timer Stopped - data = ', data);
    });

    $scope.dayDiff = function(firstDate){
        var date2 = new Date();
        var date1 = new Date(firstDate);
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());   
        var diffDays = Math.ceil(timeDiff / (1000 )); 
        return diffDays;
    }






 
});