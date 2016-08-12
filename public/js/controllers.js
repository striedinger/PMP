angular.module('app.controllers', [])

.controller('SessionController', function($scope, $http, Test){
	$scope.selected = null;
	$scope.loading = false;

	$scope.setSelected = function(option){
		$scope.selected = option;
	}
});