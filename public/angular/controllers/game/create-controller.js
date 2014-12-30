appControllers.controller('GameCreateController', function($scope, Player, FriendList){
	$scope.started = false;
	$scope.roomLeader = '';
	$scope.players = [];
	$scope.invited = [];

	$scope.user;
	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			$scope.user = data.user;
			$scope.started = true;
			requestRoom();
		}else{
			alert('Server Error. Please, try reloading.');
		}
	});

	function requestRoom(){
		var players = [];
		players.push($scope.user);

		initializeRoom($scope.user.name, players);
	}
	// on socket innit initializeRoom()


	function initializeRoom(roomLeader, players){
		$scope.roomLeader = roomLeader;
		$scope.players = players;
	}

	$scope.isLeader = function(name){
		return $scope.roomLeader == name;
	}
	
	$scope.isUser = function(name){
		return name == $scope.user.name;
	}

	$scope.havePlayers = function(){
		return $scope.players.length > 0;
	}

	$scope.botsCount = function(){
		var count = 0;
		for (var i = 0; i < $scope.players.length; i++) {
			if($scope.players[i].id < 10){
				count++;
			}
			
		};
		return count;
	}

	$scope.getPlayers = function(){
		var players = [];
		var bots = [];
		$scope.players.forEach(function(player){
			if(player.id < 10){
				bots.push(player);
			}else{
				players.push(player);
			}
		});
		bots.forEach(function(bot){
			players.push(bot);
		});

		return players;
	}

	$scope.addRobot = function(){
		if($scope.started && $scope.isLeader($scope.user.name) && $scope.players.length < 10){
			var bot_id = $scope.botsCount() + 1;
			var bot = Player(bot_id, null, "Robot "+bot_id, "../img/bot.png");
			$scope.players.push(bot);
		}
	}

	function removeLastRobot(){
		if($scope.started && $scope.isLeader($scope.user.name)){
			var lastIndex = -1;
			var lastID = -1;
			for (var i = 0; i < $scope.players.length; i++) {
				var id = $scope.players[i].id;
				if(id < 10 && id > lastID){
					lastID = id;
					lastIndex = i;
				}
			};
			if(lastIndex !== -1){
				$scope.players.splice(lastIndex,1);
			}
		}
	}

	function addPlayer(id, user_id, name, img_src){
		if($scope.started && $scope.isLeader($scope.user.name)){
			if($scope.players.length === 10){
				if($scope.botsCount() > 0){
					removeLastRobot();
				}else{
					alert('This room is full!');
				}
			}
			$scope.players.push(Player(id, user_id, name, img_src));
		}
	}

	$scope.removeAllRobots = function(){
		if($scope.started && $scope.isLeader($scope.user.name)){
			var players = [];
			$scope.players.forEach(function(player){
				if(player.user_id){
					players.push(player);
				}
			});
			$scope.players = players;
		}
	}

	$scope.removePlayerOrBot = function(id){
		if($scope.started && $scope.isLeader($scope.user.name)){
			if(id < 10){
				removeLastRobot();
			}else{
				if(confirm("Are you sure you want to remove this player?")){
					var players = [];
					$scope.players.forEach(function(player){
						if(player.id !== id){
							players.push(player);
						}
					});
					$scope.players = players;
				}
			}
		}
	}

	$scope.invitedPlayers = [];

	$scope.onlineFriends = function(){
		return FriendList.onlineFriends;
	}
	$scope.inviteFriend = function(){};
});