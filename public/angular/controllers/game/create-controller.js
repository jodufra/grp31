appControllers.controller('GameCreateController', function($scope, $rootScope, $window, Player, FriendList, NotificationGame, GameStore, CSRF_TOKEN){
	$scope.started = false;
	$scope.leader = '';
	$scope.players = [];
	$scope.invited = [];
	$scope.timeouts = [];
	$scope.canStart = true;

	$scope.user;
	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			$scope.user = data.user;
			socket.emit('game:create:init', {user:$scope.user});
		}else{
			alert('Server Error. Please, try reloading.');
		}
	});

	socket.on('disconnect', function () {
		$scope.started = false;
	});

	socket.on('game:create:init', function(data){
		$scope.leader = data.room.leader;
		$scope.players = data.room.players;
		$scope.invited = data.room.invited;
		$scope.timeouts = data.room.timeouts;
		$scope.started = true;
		changeChatChannel();
		$scope.$apply();
	});

	socket.on('game:create:update', function(data){
		if($scope.leader == data.room.leader){
			$scope.players = data.room.players;
			$scope.invited = data.room.invited;
			$scope.timeouts = data.room.timeouts;
		}
		$scope.$apply();
	});

	function changeChatChannel(){
		var channel = 'Creating '+$scope.leader+'\'s game';
		$rootScope.$broadcast('chat:init:public',{channel:channel});
	}

	$scope.isLeader = function(name){
		return $scope.started && $scope.leader == name;
	};
	
	$scope.isUser = function(name){
		return $scope.started && name == $scope.user.name;
	};

	$scope.havePlayers = function(){
		return $scope.started && $scope.players.length > 0;
	};

	$scope.canStartGame = function(){
		return $scope.started && $scope.isLeader($scope.user.name) && $scope.players.length > 1 && $scope.canStart;
	};

	$scope.botsCount = function(){
		var count = 0;
		if($scope.started){
			for (var i = 0; i < $scope.players.length; i++) {
				if($scope.players[i].id < 10){
					count++;
				}
			}
		}
		return count;
	};

	$scope.getPlayers = function(){
		var players = [];
		if($scope.started){
			var bots = [];
			for(name in $scope.players){
				var player = $scope.players[name];
				if(player.id < 10){
					bots.push(player);
				}else{
					players.push(player);
				}
			}
			bots.forEach(function(bot){
				players.push(bot);
			});
		}
		return players;
	};

	socket.on('game:create:removeplayer', function(data){
		if(data.name==$scope.user.name){
			$window.location.href = '/game/';
		}
		$scope.$apply();
	});

	$scope.addRobot = function(){
		if($scope.started && $scope.isLeader($scope.user.name) && $scope.players.length < 10){
			var bot_id = $scope.botsCount() + 1;
			var bot = Player(bot_id, null, "Robot "+bot_id, "../img/bot.png");
			socket.emit('game:create:addbot',{leader:$scope.user.name, player:bot});
		}
	};

	$scope.removeAllRobots = function(){
		if($scope.started && $scope.isLeader($scope.user.name)){
			socket.emit('game:create:removeallbots',{leader:$scope.user.name});
		}
	};

	$scope.removePlayerOrBot = function(id){
		if($scope.started && $scope.isLeader($scope.user.name)){
			if(id < 10){
				socket.emit('game:create:removebot',{leader:$scope.user.name});
			}else{
				if(confirm("Are you sure you want to remove this player?")){
					for (var i = 0; i < $scope.players.length; i++) {
						if($scope.players[i].id === id){
							player = $scope.players[i];
							break;
						}
					};
					socket.emit('game:create:removeplayer',{leader:$scope.user.name, player:player});
				}
			}
		}
	};

	$scope.leaveRoom = function(){
		socket.emit('game:create:leave',{leader:$scope.leader, player:$scope.user});
		$window.location.href = '/game';
	}

	$scope.getInvitedPlayers = function(){
		return $scope.invited;
	};

	$scope.onlineFriends = function(){
		var onlineFriends = [];
		if($scope.started){
			for(key in FriendList.onlineFriends){
				var onlineFriend = FriendList.onlineFriends[key];
				var notInvited = true;
				for (var i = 0; i < $scope.invited.length; i++) {
					if($scope.invited[i].name == onlineFriend.name){
						if($scope.invited[i].state != 'full'){
							notInvited = false;
						}
						break;
					}
				}
				if(notInvited){
					onlineFriends.push(onlineFriend);
				}

			}
		}

		return onlineFriends;
	};

	$scope.inviteFriend = function(name){
		if($scope.started && ($scope.players.length < 10 || $scope.botsCount() > 0)){
			var notification = NotificationGame(-1, $scope.leader, $scope.user.name);

			socket.emit('notification_handler:newNotification', {name:name, notification:notification});
			socket.emit('game:create:addinvited', {leader:$scope.leader, name:name});
		}
	};

	$scope.terminateRoom = function(){
		if($scope.started && $scope.isLeader($scope.user.name)){
			socket.emit('game:create:terminate', {leader:$scope.user.name});
		}
	};

	socket.on('game:create:terminate', function(data){
		if(data.leader==$scope.leader){
			$scope.started = false;
			$scope.$apply();
			if(data.leader!=$scope.user.name){
				alert('This room was closed by '+data.leader+'.');
			}
			$window.location.href = '/game/';
		}
		$scope.$apply();
	});

	$scope.startGame = function(){
		if($scope.started && $scope.isLeader($scope.user.name) && $scope.players.length > 1){
			$scope.canStart = false;
			if($scope.timeouts.length){
				var names = '';
				var first = true;
				var many = false;
				for(name in $scope.timeouts){
					if(first){
						names = names+name;
						first = false;
					}else{
						names = names+', '+name;
						many = true;
					}
				}
				if(many){
					alert('Users '+names+' are currently disconnected, please wait 5 seconds and try again.');
				}else{
					alert('User '+names+' is currently disconnected, please wait 5 seconds and try again.');
				}
				$scope.canStart = true;
			}else{
				if(confirm('Press OK when you feel ready to start?')){
					var store = {
						_token:CSRF_TOKEN,
						players:$scope.players
					}
					GameStore(store).success(function(data){
						emitStart(data.game_id);
					}).error(function(data){
						if(data.message){
							alert(data.message);
						}else{
							alert('Server Error. Please try again.');
						}
						$scope.canStart = true;
					});
				}else{
					$scope.canStart = true;
				}
			}
		}
	};

	function emitStart(game_id){
		socket.emit('game:create:start', {leader:$scope.user.name, game_id:game_id});
	}

	socket.on('game:create:start', function(data){
		if(data.leader==$scope.leader){
			$scope.started = false;
			$scope.$apply();
			alert('Game is starting. Press OK to continue.');
			$window.location.href = '/game/'+data.game_id;
		}
		$scope.$apply();
	});

});