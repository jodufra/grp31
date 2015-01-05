appControllers.controller('GameShowController', function($scope, $rootScope, GAME, Spectators, Dices){
	$scope.started = false;
	$scope.user;
	$scope.player;
	$scope.game;
	$scope.rolling = false;
	$scope.endingturn = false;

	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			$scope.user = data.user;
		}
		initGame();
	});

	socket.on('disconnect', function () {
		$scope.started = false;
		$scope.$apply();
	});

	function initGame(){
		socket.emit('game:show:gameinit', {game_id:GAME.id});
	}

	socket.on('game:show:gameinit', function(data){
		if(data.game && data.game.id == GAME.id){
			$scope.game = data.game;
			initUser();
		}
		$scope.$apply();
	});

	function initUser(){
		if(getInGameIndex() != -1){
			socket.emit('game:show:userinit', {game_id:$scope.game.id, user:$scope.user});
			changeChatChannel('Game '+GAME['id']);
			return;
		}
		initSpectate();
	}

	function getInGameIndex(){
		if($scope.user != null){
			for (var i = 0; i < $scope.game.players.length; i++) {
				if($scope.game.players[i].user.id == $scope.user.id){
					$scope.player = $scope.game.players[i];
					return i;
				}
			};
		}
		return -1;
	}

	function getPlayerByNum(player_num){
		for (var i = 0; i < $scope.game.players.length; i++) {
			if($scope.game.players[i].player_num == player_num){
				return $scope.game.players[i];
			}
		};
	}

	socket.on('game:show:userinit', function(data){
		$scope.game = data.game;
		$scope.started = true;
		if(!$scope.game.play){
			alert("Waiting for players to join.");
		}
		$scope.$apply();
	});

	socket.on('game:show:startgame', function(data){
		if($scope.game.id == data.game.id){
			$scope.game = data.game;
			alert("The game is starting...");
		}
		$scope.$apply();
	});


	function initSpectate(){
		var data = {};
		if($scope.user){
			data['player_id'] = $scope.user.id;
		}
		data['game_id'] = GAME['id'];
		Spectators.spectate(data).success(function(data){
			var ok = 'You are spectating the game';
			var error = 'You can\'t spectate because of an server error, please try reloading.';
			if(data.game_id){
				alert(ok);
			}else{
				alert(error);
			}
		}).error(function(){
			alert(error);
		});
		changeChatChannel('Spectating Game '+GAME['id'])
	}

	function changeChatChannel(channel){
		var channel = channel;
		$rootScope.$broadcast('chat:init:public',{channel:channel});
	}

	$scope.isDisconnected = function(player){
		for (var i = 0; i < $scope.game.timeouts.length; i++) {
			if($scope.game.timeouts[i].user.name == player.name){
				return true;
			}
		};
	};

	$scope.getOpponent = function(){
		var num = $scope.game.turn;
		if(num == 0){
			num++;
		}
		if($scope.user && $scope.player.player_num == num){
			num++;
			if(num > $scope.game.players.length){
				num = 1;
			}
		}
		return getPlayerByNum(num);
	};

	$scope.getUser = function(){
		if(getInGameIndex() != -1){
			return $scope.user;
		}
		return null;
	};

	socket.on('game:show:update', function(data){
		console.log(data);
		if(data.game.id == $scope.game.id){
			$scope.game = data.game;
			getInGameIndex();
		}
		$scope.$apply();
	});

	$scope.canRoll = function(){
		return ($scope.player && !$scope.rolling && !$scope.endingturn && $scope.game.play && $scope.game.turn == $scope.player.player_num && $scope.player.rollsAvailable);
	}

	$scope.canEndTurn = function(){
		return ($scope.player && !$scope.endingturn && $scope.game.play && $scope.game.turn == $scope.player.player_num && $scope.player.rollsAvailable < 3);
	}

	function updateGame(){
		socket.emit('game:show:update', {game:$scope.game});
	}

	$scope.roll = function(){
		if($scope.canRoll()){
			$scope.rolling = true;
			if($scope.player.rollsAvailable == 3){
				Dices.getDices().success(function(data){
					if(data.dices){
						console.log(data.dices);
						$scope.game.players[getInGameIndex()].dices = data.dices;
						$scope.game.players[getInGameIndex()].rollsAvailable--;
						updateGame();
					}
					$scope.rolling = false;
				});
			}else{
				var data = []
				data['dices'] = $scope.player.dices;
				Dices.getReroll(data).success(function(data){
					if(data.dices){
						$scope.game.players[getInGameIndex()].dices = data.dices;
						$scope.game.players[getInGameIndex()].rollsAvailable--;
						updateGame();
						if($scope.game.players[getInGameIndex()].rollsAvailable == 0){
							$scope.endTurn();
						}
					}
					$scope.rolling = false;
				});
			}
		}
	}

	$scope.endTurn = function(){
		if($scope.canEndTurn()){
			$scope.endingturn = true;
		}
	}

	$scope.saveDice = function(dice){
		if($scope.started && $scope.game.turn == $scope.player.player_num && !$scope.rolling && !$scope.endingturn){
			dice.saved = true;
			updateGame();
		}
	}

	$scope.unsaveDice = function(dice){
		if($scope.started && $scope.game.turn == $scope.player.player_num && !$scope.rolling && !$scope.endingturn){
			dice.saved = false;
			updateGame();
		}
	}

	$scope.getPlayerOpponentSavedDices = function(){
		var dices = [];
		if($scope.started && $scope.game.turn != 0){
			if($scope.game.turn != $scope.player.player_num){
				var player = getPlayerByNum($scope.game.turn);
				for (var i = 0; i < player.dices.length; i++) {
					if(player.dices[i].saved){
						dices.push(player.dices[i]);
					}
				};
			}	
		}
		return dices;
	}

	$scope.getPlayerDices = function(){
		var dices = [];
		if($scope.started && $scope.game.turn != 0){
			var player = getPlayerByNum($scope.game.turn);
			for (var i = 0; i < player.dices.length; i++) {
				if(!player.dices[i].saved){
					dices.push(player.dices[i]);
				}
			};
		}
		return dices;
	}

	$scope.getPlayerSavedDices = function(){
		var dices = [];
		if($scope.started && $scope.game.turn != 0){
			if($scope.game.turn == $scope.player.player_num){
				var player = getPlayerByNum($scope.game.turn);
				for (var i = 0; i < player.dices.length; i++) {
					if(player.dices[i].saved){
						dices.push(player.dices[i]);
					}
				};
			}	
		}
		return dices;
	}
	

});