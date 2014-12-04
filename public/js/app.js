'use strict';

/* App Module */

var app = angular.module('app', ['appControllers'],
	function($interpolateProvider) 
	{
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	}
	);

app.controller('DicesController', ['$scope', function($scope){
	$scope.dices[{val:1,saved:false},
				{val:1,saved:false},
				{val:1,saved:false},
				{val:1,saved:false},
				{val:1,saved:false}];

	$scope.result['sum'=>function(){
		var val = 0;
		for(var dices of $scope.dices){
			val+=dices.val;
		}
		return val;
	}];
	
}])