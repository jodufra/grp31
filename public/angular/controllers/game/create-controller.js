appControllers.controller('GameCreateController', function($scope, currentUser, player, gameCreatePlayer){
	$scope.roomID;
	$scope.players=[];
	$scope.bots=[];
	$scope.currentUser;

	currentUser.success(function(data){
		$scope.currentUser = player(data.id, data.user_id, data.name, data.img_src);
		// emit socket innit
		initializeRoom(1, [], []);
	}).error(function(data){
		console.log(data);
		alert('Internal Server Error. Please, try reloading.');
	});


	// on socket innit initializeRoom()


	function initializeRoom(roomID, players, bots){
		$scope.roomID = 1;
		$scope.players = players;
		$scope.bots = bots;

		if(!playersContainCurrentUser()){
			addPlayer($scope.currentUser.id, $scope.currentUser.user_id, $scope.currentUser.name, $scope.currentUser.img_src);
		}

	}

	$scope.userIsLeader = function(){
		var leader = false;
		if($scope.players.length != 0){
			$scope.players.forEach(function(player){
				if(player.user_id == $scope.currentUser.user_id && player.is_leader){
					leader = true;
					return;
				}
			});
		}
		return leader;
	}

	$scope.havePlayers = function(){
		return $scope.players.length > 0;
	}

	$scope.getPlayers = function(){
		var players = [];
		$scope.players.forEach(function(player){
			players.push(player);
		});
		$scope.bots.forEach(function(bot){
			players.push(bot);
		});
		return players;
	}
	$scope.addRobot = function(){
		if($scope.userIsLeader() && $scope.players.length != 0 && ($scope.players.length + $scope.bots.length) < 10){
			var bot_id = $scope.bots.length + 1;
			var bot = gameCreatePlayer(bot_id, null, "Robot "+bot_id, "../img/bot.png", false, false);
			$scope.bots.push(bot);
		}
	}
	$scope.removeAllRobots = function(){
		while($scope.bots.length != 0){
			removeRobot();
		}
	}
	$scope.removePlayerOrBot = function(id){
		if (id<10) {
			var num_bots = $scope.bots.length-1;
			$scope.removeAllRobots();
			for(;num_bots>0;num_bots--){
				$scope.addRobot();
			}
		}else{
			if(confirm("Are you sure you want to remove this Player?")){
				for(var i = 0;i<$scope.players.length;i++){
					if($scope.players[i].id == id){
						$scope.players.splice(i, 1);
						return;
					}
				}
			}
		}
	}
	function removeRobot(){
		if($scope.userIsLeader() && $scope.bots.length != 0){
			$scope.bots.splice($scope.bots.length - 1, 1);
		}
	}

	function playersContainCurrentUser(){
		if($scope.players.length == 0) return false;
		$scope.players.forEach(function(player){
			if(player.user_id == $scope.currentUser.user_id) return true;
		});
		return false;
	}

	function addPlayer(id, user_id, name, img_src){
		if(($scope.players.length + $scope.bots.length) == 10){
			if($scope.bots.length>0){
				removeRobot();
			}else{
				alert('This room is full!');
			}
		}

		var isUser = user_id != null && user_id == $scope.currentUser.user_id;
		var isLeader = $scope.players.length == 0 || $scope.players[0].id == id;

		var player = gameCreatePlayer(id, user_id, name, img_src, isUser, isLeader);
		$scope.players.push(player);
	}

	$scope.inviteFriend = function(){};
});