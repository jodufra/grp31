appControllers.controller('GameCreateController', function($scope, $rootScope, $window, Player, FriendList, NotificationGame){
	$scope.started = false;
	$scope.leader = '';
	$scope.players = [];
	$scope.invited = [];
	$scope.timeouts = [];

	$scope.user;
	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			$scope.user = data.user;
			socket.emit('game:create:init', {user:$scope.user});
		}else{
			alert('Server Error. Please, try reloading.');
		}
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
});