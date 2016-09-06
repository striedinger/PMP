(function() {
    'use strict';
    angular.module('app.directives', []).directive('question', question);

    /** @ngInject */
    function question() {
        var directive = {
            restrict: 'E',
            templateUrl: '/pmp/public/js/templates/question.template.html',
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
        function linkf(scope, el, attr, vm) {
            vm.qTotal = vm.question.session.exam.questions;
            //vm.qIndex = scope.pmp.qIndex;

        }
        /** @ngInject */
        function questionsController($timeout, $scope, $log, sessions) {
            var vm = this;
            vm.animation  = "animated fadeIn";
            vm.question.class = "";
            vm.question.local_answer = null;
            vm.show_finalizar = false;
            vm.disable_next = true;
            vm.spinner = false;

            vm.set_selected_answer = function(qLetter) {
                if (vm.question.answer == null) { //si no tiene respuesta confirmada o marcada
                    //verificar si esta marcada

                    vm.question.class = "question question-info";
                    vm.question.local_answer = qLetter;
                    vm.question.marked = 0;

                } else {
                    if (vm.question.marked == 0) {
                        alert("ya confirmo esta pregunta.")
                    } else {
                        vm.question.marked = 0;
                        vm.question.answer = null;
                        vm.question.local_answer = qLetter;
                    }
                }
            }

            vm.get_option_class = function(qLetter) {
                if (vm.question.answer != null ) { //TODO: si el tiempo es mayor a
                    if (vm.question.answer == qLetter) {
                        if (vm.question.marked == 1) {
                            vm.question.class = "question question-warning";
                        } else {
                            vm.question.class = "question question-success";
                        }
                    } else {
                        vm.question.class = "question";
                    }
                } else {
                    if (vm.question.local_answer == qLetter) {
                        vm.question.class = "question question-info";
                    } else {
                        vm.question.class = "question";
                    }
                }
                return vm.question.class;
            }
            vm.next = function() { //Maneja siguiente, confirmar y finalizar
                //local_answer maneja respuestas locales, answer maneja respuesta final para serividor
                if (vm.question.number <= vm.qTotal) {
                    //Para dar siguiente se debe cumplir dos condiciones: que este marcada, o que este seleccionada al menos una respuesta En otro caso no avanzar
                    if (vm.question.marked == 1 || vm.question.local_answer != null ) { //Se ha seleccionado una pregunta o marcado
                        //Guardar y cargar siguiente pregunta.
                        vm.question.time = new Date();
                        if(vm.question.local_answer!=null){ //Si ya viene marcada de la bd no tiene local answer
                            vm.question.answer = vm.question.local_answer;
                        }
                        vm.question.marked = 0;
                        save_question();
                     
                    } else {
                        //Verificar si ya tiene una respuesta precargada o de pasos anteriores, en ese caso siguiente.
                        if (vm.question.answer == null) {
                            alert("No ha seleccionado una respuesta.");
                        }else{
                            if (vm.question.number != vm.qTotal) {
                                steps_question(1);
                            }
                        }


                    }
                    $('#question').animateCss('fadeIn');
                   
                }
                //Si esta marcada, actualizar la lista de marcados
                var qDeleteIndex = $scope.$parent.pmp.qMarked.indexOf(vm.question);
                if (qDeleteIndex != -1) {
                    $scope.$parent.pmp.qMarked.splice(qDeleteIndex, 1);
                }
                vm.question.marked = 0;
                
                //Si es la ultima pregunta
                if (vm.question.number == vm.qTotal) {
                    if ($scope.$parent.pmp.qMarked.length > 0) {
                        swal("aun tiene preguntas marcadas");
                        
                    } else {
                        swal("TODO:redireccionado a resultados"); //Ultima pregunta
                    }
                }



            }

            vm.marcar = function () {
            	//Marcar si no esta confirmada
            	if(vm.question.number <= vm.qTotal ){
                    if(vm.question.local_answer != null){//si se ha elejido alguna otra opcion.
                        vm.question.answer = vm.question.local_answer;
                    }
                    vm.question.marked = 1;
                    save_question();

            	}

            }



            vm.back = function(qIndex) {

                //SI todo ok, q index + 1
                if ($scope.$parent.pmp.qIndex > 1) {
                    steps_question(-1);
                }
                $('#question').animateCss("fadeIn");
            }

            vm.isConfirmarDisabled = function() {
                if (vm.question.answer == null && vm.question.local_answer == null) {
                    return true;
                } else {
                    return false;
                }
            }

            vm.isNextDisabled = function() {
                if (vm.question.answer != null && vm.question.marked==0) {
                    return false;
                } else {
                    return true;
                }
            }
            vm.isMarkDisabled = function() {
                if ((vm.question.answer == null && vm.question.local_answer == null) || (vm.question.answer != null && vm.question.marked == 0)) {
                    return true;
                } else {
                    return false;
                }
            }
            vm.isLastQ = function(argument) {
                return (vm.question.number == vm.question.session.exam.questions) ? true : false;
            }
            var steps_question = function(steps) {
                $scope.$parent.pmp.qIndex = vm.question.number + steps;
                $scope.$parent.pmp.qCurrent = $scope.$parent.pmp.questions[($scope.$parent.pmp.qIndex - 1)];
                vm.show_finalizar = false;

            }

            var save_question = function() {
                vm.spinner = true;
                vm.question.time = new Date();
                sessions.save(vm.question, "token").then(function(data) {
                    if(!$.isEmptyObject(data) && data !== null && typeof(data) != "undefined") {
                        if (data.answer != null) {
                            vm.question = data.answer;
                             if (vm.question.number < vm.qTotal) {
                                 steps_question(1); //cargar siguiente pregunta
                             }
                        } else {
                            swal(data.message);
                           
                        }

                    } else {
                      swal("pregunta habia sido respondida");
                    
                    }
                    $log.debug("recibido en sessions controller: ", vm.question);

                    //actualizar si esta marcada.
                    if (vm.question.marked == 1) {
                        //colocar en lista de marcados si esta marcada
                        var qIndex = $scope.$parent.pmp.qMarked.indexOf(vm.question);
                        if (qIndex == -1) {
                            $scope.$parent.pmp.qMarked.push(vm.question);
                        }
                    } else {
                        //swal("error");
                    };

                    vm.spinner = false;
                });
            }



        }

    }

})();
