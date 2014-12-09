'use strict';

/* Controllers */

var appControllers = angular.module('appControllers', []);


appControllers.controller('TestingNodeController', function($scope,$socket){
	$scope.value = 0;
	$scope.increaseValue = function(){
		Users.create($scope.user).then(function(data)
		{
			console.log(data);
		});
		console.log("create user");
	};
	socket.on('example.update', function (data) {
		$scope.value=JSON.parse(data);
	});

});

appControllers.controller('HomeController', function($scope){});

appControllers.controller('GameLobbyController', function($scope){});

appControllers.controller('GameRoomController', function($scope, $routeParams){});

appControllers.controller('GamePlayController', function($scope, $routeParams){});

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