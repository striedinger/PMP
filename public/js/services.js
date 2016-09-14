/*var url = "http://localhost:8888/pmp/public/";

angular.module('app.services', [])

.factory('Test', function($http){
	return{
		
	}
});*/

  angular.module('app.services',[])

  	.factory('sessions', sessions);

    /** @ngInject */
    function sessions($log, $http) {
        var apiHost = 'http://localhost:8888/pmp/public/api';
        var service = {
            apiHost: apiHost,
            getSessions: getSessions,
            save: save,
            stop: stop,
            start: start
        };  
        var config = {};

        return service;


        function getSessions(id,token) {
            var new_answers = {};
            $log.info("obteniendo datos de la session" + id + " del usuario:" + token);
            return $http.get(apiHost +"/sessions/" + id + "/questions")
                .then(getAnswersComplete)
                .catch(getAnswersFailed);

            function getAnswersComplete(response) {
                $log.info("devolviendo :", response);
                if (response.status == 200) { //Respuesta ok
                    if (typeof(response.data.questions) != "undefined" && response.data.questions != null) {//verificar que envio preguntas
                        response.data.session.exam.questions = parseInt(response.data.session.exam.questions);
                        response.data.session.time = parseInt(response.data.session.time);
                        response.data.session.exam.duration = parseInt(response.data.session.exam.duration);
                        return response.data;
                    } else {
                        return null //si no se ha realizado el insturmento
                    }
                }

                return new_answers;

            }

            function getAnswersFailed(error) {
                $log.error('XHR Failed for getAnswers.\n' + angular.toJson(error.data, true));
                return new_answers;
            }
        }

        function save(question, token) {
            var new_answers = jQuery.extend(true, {}, question);
            new_answers.option =  new_answers.answer;
            new_answers.answer =  new_answers.id;
            $log.info("obteniendo datos de la session" + new_answers.session_id + " del usuario:" + token);
            return $http.post(apiHost +"/sessions/" + new_answers.session_id, new_answers, config)
                .then(getAnswersComplete)
                .catch(getAnswersFailed);

            function getAnswersComplete(response) {
                $log.info("devolviendo :", response);
                if (response.status == 200) { //Respuesta ok
                    if (typeof(response.data) != "undefined" && response.data != null) {//verificar que envio preguntas
                        question.local_answer = null; //Revisar
                        return response.data;
                    } else {
                        return null //si no se ha realizado el insturmento
                    }
                }

                return new_answers;

            }

            function getAnswersFailed(error) {
                $log.error('XHR Failed for getAnswers.\n' + angular.toJson(error.data, true));
                return new_answers;
            }
        }

         function stop(id,token) {
            $log.info("deteniendo la seccion");
            return $http.post(apiHost +"/sessions/" + id + "/end")
                .then(session_stopComplete)
                .catch(session_stopFailed);

            function session_stopComplete(response) {
                $log.info("devolviendo de stop:", response);
                if (response.status == 200) { //Respuesta ok
                    if (typeof(response.data) != "undefined" && response.data != null) {//verificar que envio preguntas
                        return response.data;
                    } else {
                        return null //si no se ha realizado el insturmento
                    }
                }

                return null;

            }

            function session_stopFailed(error) {
                $log.error('XHR Failed for stop:.\n' + angular.toJson(error.data, true));
                return null;
            }
        }

        function start(id,token) {
            $log.info("deteniendo la seccion");
            return $http.post(apiHost +"/sessions/" + id + "/start")
                .then(session_startComplete)
                .catch(session_startFailed);

            function session_startComplete(response) {
                $log.info("devolviendo de start:", response);
                if (response.status == 200) { //Respuesta ok
                    if (typeof(response.data) != "undefined" && response.data != null) {//verificar que envio preguntas
                        return response.data;
                    } else {
                        return null //si no se ha realizado el insturmento
                    }
                }

                return null;

            }

            function session_startFailed(error) {
                $log.error('XHR Failed for start:.\n' + angular.toJson(error.data, true));
                return null;
            }
        }

      

       






    }
 
