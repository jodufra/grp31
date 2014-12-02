'use strict';

/* Controllers */

var appControllers = angular.module('appControllers', []);

appControllers.controller('DicesController', function($scope, $http) {
	var roll = function(){
		$http.get("/getDices").success(
			function(data) {
				alert($scope.dices = data);
			});

		/*Write here*/
	}
});
