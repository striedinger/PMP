
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
    	vm.question.selected = "";
    	vm.question.class = "";

    	vm.set_selected = function (qLetter) {
    		if(vm.question.class !="question-success"){
    		vm.question.selected = qLetter;
    		vm.question.class = "question-info";
    		}else{
    			//mensaje de errro
    		}

    	}
    	vm.set_selected_class = function (qLetter) {
    		if(vm.question.class !="question-success"){
    			if(vm.question.class !="question-warning"){
    				vm.question.class = "question-info";
    			}
    		 return qLetter == vm.question.selected? vm.question.class :"questions";
    		}else{
    			//mensaje de que ya no se puede cambiar
    			return qLetter == vm.question.selected? vm.question.class :"questions";
    		}
    		
    	}
    	vm.confirmar = function (qIndex) {
    		 //SI todo ok, q index + 1
    		 if( $scope.$parent.qIndex< $scope.$parent.qTotal && (qIndex!="" || typeof(qIndex) == "undefined")){
    		  $scope.$parent.qIndex = vm.question.number + 1;
    		  vm.question.class = "question-success";
    		  $scope.$parent.qCurrent =  $scope.$parent.questions[ $scope.$parent.qIndex -1];
    		 }else{
    		 	//no quedan mas preguntas por responder....

    		 	//no ha seleccionado una pregunta
    		 }
    		
    		qIndex = "";
    	}
    	vm.marcar = function (qIndex ) {
    		 //SI todo ok, q index + 1
    		 if( $scope.$parent.qIndex< $scope.$parent.qTotal && qIndex!=""){
    		  $scope.$parent.qIndex = vm.question.number + 1;
    		  vm.question.class = "question-warning";
    		  $scope.$parent.qCurrent =  $scope.$parent.questions[ $scope.$parent.qIndex -1];
    		  vm.selected = "";
    		}else{
    			  		 	//no quedan mas preguntas por responder....

    		 	//no ha seleccionado una pregunta
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
