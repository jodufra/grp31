appControllers.controller('GameShowController', function($scope, $rootScope, GAME, Spectators){
	$scope.started = false;
	$scope.user;
	$scope.player;
	$scope.game;

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
		if(!$scope.user){
			initSpectate();
		}else{
			var isPlayer = false;
			for (var i = 0; i < GAME['players'].length; i++) {
				var player = GAME['players'][i];
				if(player.user.name == $scope.user.name){
					isPlayer = true;
					break;
				}
			}
			if(isPlayer){
				socket.emit('game:show:init', {game:GAME, user:$scope.user});
				changeChatChannel('Game '+GAME['id']);
			}else{
				initSpectate();
			}
		}
	}

	function initSpectate(){
		var data = {};
		data['game_id'] = GAME['id'];
		if($scope.user){
			data['player_id'] = $scope.user.id;
		}
		Spectators.spectate(data).success(function(data){
			if(data.game_id){
				alert('You are spectating the game');
				socket.emit('game:show:init', {game_id:GAME['id'], user:$scope.user});
			}else{
				alert('You can\'t spectate because of an server error, please try reloading.');
			}
		}).error(function(){
			alert('You can\'t spectate because of an server error, please try reloading.');
		});
		changeChatChannel('Spectating Game '+GAME['id'])
	}

	function changeChatChannel(channel){
		var channel = channel;
		$rootScope.$broadcast('chat:init:public',{channel:channel});
	}

	socket.on('game:show:init', function(data){
		$scope.game = data.game;
		$scope.started = true;
		$scope.$apply();
	});

	

});