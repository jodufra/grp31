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

appControllers.controller('GamePlayController', function($scope, Players){
	$scope.players=Players;
	$scope.dices = [];

	//Current Score
	$scope.currentScorePlayerNum = $scope.players[0].num;
	$scope.currentScorePlayerName = $scope.players[$scope.currentScorePlayerNum].name;
	$scope.currentScore = function(){
		return $scope.players[$scope.currentScorePlayerNum].score;
	};
	$scope.previousCurrentScore = function(){
		$scope.currentScorePlayerNum--;
		if($scope.currentScorePlayerNum < 0){
			$scope.currentScorePlayerNum = $scope.players.length-1;
		}
		$scope.currentScorePlayerName = $scope.players[$scope.currentScorePlayerNum].name;
	};
	$scope.nextCurrentScore = function(){
		$scope.currentScorePlayerNum++;
		if($scope.currentScorePlayerNum >= $scope.players.length ){
			$scope.currentScorePlayerNum = 0;
		}
		$scope.currentScorePlayerName = $scope.players[$scope.currentScorePlayerNum].name;
	};

	//Current Player Scores
	$scope.currentPlayerNum = 0;
	$scope.currentPlayer = $scope.players[$scope.currentPlayerNum];

	$scope.roll = function() {
		if ($scope.currentPlayer.rollsAvailable > 0){
			getNewDices();
			updateScore();		
		}
	};
	function getNewDices(){
		$scope.dices = [];
		var max = 5 - $scope.dices.length;
		for (var i = 0; i < max; i++) {
			$scope.dices.push({val:(Math.ceil(Math.random()*6)),saved:false});
		};
		$scope.currentPlayer.rollsAvailable--;	
	}
	function updateScore(){
		var dices_amount = {
			1:diceCount(1),
			2:diceCount(2),
			3:diceCount(3),
			4:diceCount(4),
			5:diceCount(5),
			6:diceCount(6)
		};
		if(!$scope.currentPlayer.r_score['ones']){
			$scope.currentPlayer.score['ones'] = dices_amount[1];
		}
		if(!$scope.currentPlayer.r_score['twos']){
			$scope.currentPlayer.score['twos'] = dices_amount[2]*2;
		}
		if(!$scope.currentPlayer.r_score['threes']){
			$scope.currentPlayer.score['threes'] = dices_amount[3]*3;
		}
		if(!$scope.currentPlayer.r_score['fours']){
			$scope.currentPlayer.score['fours'] = dices_amount[4]*4;
		}
		if(!$scope.currentPlayer.r_score['fives']){
			$scope.currentPlayer.score['fives'] = dices_amount[5]*5;
		}
		if(!$scope.currentPlayer.r_score['sixes']){
			$scope.currentPlayer.score['sixes'] = dices_amount[6]*6;
		}
		if(!$scope.currentPlayer.r_score['sum']){
			var sum = 0;
			for(var i = 1; i<=6; i++) {
				sum += dices_amount[i]*i;
			}
			$scope.currentPlayer.score['sum'] = sum;
		}
		if(!$scope.currentPlayer.r_score['bonus']){
			$scope.currentPlayer.score['bonus'] = $scope.currentPlayer.score['sum']>63 ? 35 : 0;
		}
	}
	function diceCount(value){
		var val = 0;
		for (var i in $scope.dices) {
			val += $scope.dices[i].val == value ? 1 : 0;
		}
		return val;
	}


});

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