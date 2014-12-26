appControllers.controller('GamePlayController', function($scope, currentUser, gamePlayPlayer, Dices, Dice){
	$scope.players=[];
	$scope.dices = [];

	currentUser.success(function(data){
		var player = gamePlayPlayer(data.id, data.user_id, data.name, data.img_src, 0);
		$scope.players.push(player);
		initializeGame();
	})

	function initializeGame(){
		$scope.currentScorePlayerNum = 0;
		$scope.currentScorePlayer = $scope.players[0];
		$scope.currentPlayerNum = 0;
		$scope.currentPlayer = $scope.players[0];
	}

	//Current Score Table
	$scope.currentScorePlayerNum = 0;
	$scope.currentScorePlayer = [];

	$scope.previousCurrentScore = function(){
		$scope.currentScorePlayerNum--;
		if($scope.currentScorePlayerNum < 0){
			$scope.currentScorePlayerNum = $scope.players.length-1;
		}
		updateSmallScoreTable();
	};
	$scope.nextCurrentScore = function(){
		$scope.currentScorePlayerNum++;
		if($scope.currentScorePlayerNum >= $scope.players.length ){
			$scope.currentScorePlayerNum = 0;
		}
		updateSmallScoreTable();
	};	
	function updateSmallScoreTable(){
		$scope.currentScorePlayer = $scope.players[$scope.currentScorePlayerNum];
	}

	//Current Player Scores
	$scope.currentPlayerNum = 0;
	$scope.currentPlayer = [];

	$scope.roll = function() {
		if ($scope.currentPlayer.rollsAvailable > 0){
			getNewDices();
			updateScore();		
		}
	};

	$scope.pass = function () {

		$scope.currentPlayerNum++;
		$scope.currentPlayer = $scope.players[$scope.currentPlayerNum];
		if ($scope.currentPlayerNum >= $scope.players.length) {
			$scope.currentPlayerNum = 0;
			$scope.currentPlayer = $scope.players[$scope.currentPlayerNum];
		}
	};

	$scope.getInactiveOpponents = function () {
		var inactivePlayers = [];
		$scope.players.forEach(function (player) {
			if ($scope.currentPlayer.id != player.id)
				inactivePlayers.push(player);
		});
		fixPortraits();
		return inactivePlayers;
	};
	
	function getNewDices(){
		$scope.dices = [];
		var max = 5 - $scope.dices.length;
		for (var i = 0; i < max; i++) {
			$scope.dices.push(Dice(Math.ceil(Math.random()*6), false));
		}
		$scope.currentPlayer.rollsAvailable--;

	}

	function updateScore(){
		var score_indices = ['','ones','twos','threes','fours','fives','sixes'];

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
				sum += $scope.currentPlayer.score[score_indices[i]];
			}
			$scope.currentPlayer.score['sum'] = sum;
		}
		if(!$scope.currentPlayer.r_score['bonus']){
			$scope.currentPlayer.score['bonus'] = $scope.currentPlayer.score['sum']>63 ? 35 : 0;
		}
	}
	function diceCount(value){
		var val = 0;
		$scope.dices.forEach(function (element) {
			val += element.val == value ? 1 : 0;
		});
		return val;
	}


});