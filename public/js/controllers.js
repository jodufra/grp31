'use strict';

/* Controllers */

var appControllers = angular.module('appControllers', []);

appControllers.controller('DicesController', ['$scope', function($scope){

	$scope.result = [];
	$scope.dices = [{val:1,saved:false},
	{val:1,saved:false},
	{val:1,saved:false},
	{val:1,saved:false},
	{val:1,saved:false}];

	$scope.result['sum'] = function(){
		var val = 0;
		for (var i in $scope.dices) {
			val += $scope.dices[i].val;
		}
		return val;
	};

	$scope.randomize = function() {
		$scope.dices = [];
		var max = 5 - $scope.dices.length;
		for (var i = 0; i < max; i++) {
			$scope.dices.push({val:(Math.ceil(Math.random()*6)),saved:false});
		};
	};
}]);

appControllers.controller('SidebarController', ['$scope', function($scope){
	$scope.updateActive = function(id) {
		$('.sidebar .list-group-item').removeClass('active');
		$('.sidebar #list-group-item-'+id).addClass('active');
	};
}]);
