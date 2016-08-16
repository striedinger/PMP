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
        var apiHost = 'http://localhost/pmp_hugo/PMP/public/api/sessions';
        var service = {
            apiHost: apiHost,
            getSessions: getSessions
        };

        return service;


        function getSessions(id,token) {
            var new_answers = {};
            $log.info("obteniendo datos de la session" + id + " del usuario:" + token);
            return $http.get(apiHost +"/" + id + "/questions")
                .then(getAnswersComplete)
                .catch(getAnswersFailed);

            function getAnswersComplete(response) {
                $log.info("devolviendo :", response);
                if (response.status == 200) { //Respuesta ok
                    if (typeof(response.data.questions) != "undefined" && response.data.questions != null) {//verificar que envio preguntas
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

       






    }
 
