
(function() {
  'use strict';
  angular.module('app.directives',[]).directive('question', question);

  /** @ngInject */
  function question() {
    var directive = {
      restrict: 'E',
      templateUrl: '/pmp_hugo/PMP/public/js/templates/question.template.html',
      //template: '<button type="button" class="btn btn-default">button</button>',
      scope: {
          question: '='
      },
      controller: questionsController,
      controllerAs: 'vm',
      bindToController: true,
      link: linkf
    };

    return directive;

    /** @ngInject */
     function linkf(scope, el, attr, vm){


     }
     /** @ngInject */
    function questionsController($timeout, $scope, $log) {
    	var vm = this;
    	vm.question.class = "";
    	vm.question.local_answer = null;

    	vm.set_selected_answer = function (qLetter) {
    		if(vm.question.answer==null){//si no tiene respuesta confirmada o marcada
    			//verificar si esta marcada
    			 
    				vm.question.class = "question question-info";
    				vm.question.local_answer = qLetter;
    				vm.question.marked = 0;
    			 
    		}else{
    			if(vm.question.marked==0){
    					alert("ya confirmo esta pregunta.")
    			}else{
    				vm.question.marked = 0;
    				vm.question.answer = null;
    				vm.question.local_answer = qLetter;
    			}
    		}
    		
    		 
    	}

    	vm.get_option_class = function (qLetter) {
    		if(vm.question.answer!=null){//TODO: si el tiempo es mayor a
    			if(vm.question.answer==qLetter){
	    			if(vm.question.marked==1){
	    				vm.question.class = "question question-warning";
	    			}else{
	    				vm.question.class = "question question-success";
	    			}
	    		}else{
	    			vm.question.class = "question";
	    		}
    		}else{
    			if(vm.question.local_answer==qLetter){
    				vm.question.class = "question question-info";
    			}else{
    				vm.question.class = "question";
    			}
    		}
    		return vm.question.class;
    	}
    	vm.confirmar = function (qIndex) {
    		//no ha seleccionado una pregunta
    		if(vm.question.local_answer==null){
    			//alerta
    			alert("No ha seleccionado una respuesta.");
    		}else{
	    		//
	    		if( vm.question.number == $scope.$parent.qTotal ){
	    			//no quedan mas preguntas por responder....
	    			alert("TODO:redireccionado a resultados");
	    			
	    		}else{
	    			//verificar si esta marcada
	    			 $scope.$parent.qIndex = vm.question.number + 1;
	    		  	 vm.question.time = new Date();
	    		  	 vm.question.answer = vm.question.local_answer;
	    		  	 vm.question.marked = 0; 
	    		  	 $scope.$parent.qCurrent =  $scope.$parent.questions[ $scope.$parent.qIndex -1];
	    		}

    		}
    		qIndex = "";
    	}
    	vm.marcar = function (qIndex ) {
    		//no ha seleccionado una pregunta
    		if(vm.question.local_answer== null){
    			//alerta
    			alert("No ha seleccionado una respuesta.");
    		}else{
	    		//
	    		if( vm.question.number == $scope.$parent.qTotal ){
	    			//no quedan mas preguntas por responder....
	    			alert("TODO:redireccionado a resultados");
	    			
	    		}else{
	    			 $scope.$parent.qIndex = vm.question.number + 1;
	    		  	 vm.question.time = new Date();
	    		  	 vm.question.answer = vm.question.local_answer;
	    		  	 vm.question.marked = 1;
	    		  	 $scope.$parent.qCurrent =  $scope.$parent.questions[ $scope.$parent.qIndex -1];
	    		}

    		}
    		
    		qIndex="";
    	}
    	vm.back = function (qIndex) {
    		 
    		 //SI todo ok, q index + 1
    		 if( $scope.$parent.qIndex > 1){
    		  $scope.$parent.qIndex = vm.question.number - 1;
    		  $scope.$parent.qCurrent =  $scope.$parent.questions[ $scope.$parent.qIndex - 1];
    		}
    	}
    	vm.next = function (qIndex) {
    		 
    		 //SI todo ok, q index + 1
    		 if( $scope.$parent.qIndex < $scope.$parent.qTotal){
    		  $scope.$parent.qIndex = vm.question.number + 1;
    		  $scope.$parent.qCurrent =  $scope.$parent.questions[ $scope.$parent.qIndex -1];
    		}
    	}
    }
}

})();
