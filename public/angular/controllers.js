'use strict';

/* Controllers */

var appControllers = angular.module('appControllers', ['ngSanitize','appConstants']);

appControllers.controller('ChatController', function($scope) {
	var global_channel = "global";
	$scope.messages=[];
	$scope.users=[];
	$scope.unreadedMessages = 0;
	$scope.name = '';
	$scope.channel = global_channel;

	$scope.setChatState = function(state){
		$scope.chatState = state;
		if(state){
			$('#chat').removeClass('minimized');
			if($scope.name != ''){
				$('#chat .setuser').addClass('hidden');
			}
		}else{
			$('#chat').addClass('minimized');
			if($scope.name == ''){
				$('#chat .setuser').removeClass('hidden');
			}
		}
		return state;
	}

	$scope.chatState = $scope.setChatState(true);

	//	Socket Listeners
	socket.on('chat:'+$scope.channel+':message:send', function (message) {
		$scope.messages.push(message);
	});

	socket.on('chat:'+$scope.channel+':user:join', function (data) {
		addMessage({
			user: 'chatroom',
			text: 'User ' + data.name + ' has joined.'
		});
		$scope.users.push(data.name);
	});

	socket.on('chat:'+$scope.channel+':user:left', function (data) {
		addMessage({
			user: 'chatroom',
			text: 'User ' + data.name + ' has left.'
		});
		var i, user;
		for (i = 0; i < $scope.users.length; i++) {
			user = $scope.users[i];
			if (user === data.name) {
				$scope.users.splice(i, 1);
				break;
			}
		}
	});

	$scope.joinChat = function(){
		if (typeof game_id !== 'undefined') {
			$scope.channel = game_id;
		}

		socket.emit('chat:'+$scope.channel+':user:join', {
			name: $scope.name
		});

		$('#chat .setuser').addClass('hidden');
	}

	$scope.sendMessage = function () {
		socket.emit('chat:'+$scope.channel+':message:send', {
			user: $scope.name,
			message: $scope.message
		});
		addMessage({
			user: $scope.name,
			text: $scope.message
		});

		$scope.message = '';
	};

	$scope.stringToColour = function(str) {
		var colour;
		for (var i = 0, hash = 0; i < str.length; ){
			hash = str.charCodeAt(i++) + ((hash << 5) - hash)
		}

		for (var i = 0, colour = "#"; i < 3; ){
			colour += ("00" + ((hash >> i++ * 8) & 0xFF).toString(16)).slice(-2)
		}

		return colour;
	}

	function addMessage(message){
		$scope.messages.push(message);
		if($scope.chatState){
			$scope.unreadedMessages = 0;
		}else{
			$scope.unreadedMessages++;
		}
	}
});

appControllers.controller('TestingNodeController', function($scope){
	$scope.response;
	$scope.sendRequest = function(){
		socket.emit('request', true);
	};
	socket.on('response', function (data) {
		$scope.response=data;
		$scope.$apply();
	});
});

appControllers.controller('TestingNodeContr', function($scope){
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

appControllers.controller('CreateGameController', function($scope,CurrentUser){
	$scope.players=[];
	$scope.bots=[];
	$scope.userIsLeader = function(){
		var leader = false
		if($scope.players.length == 0) return leader;
		$scope.players.forEach(function(player){
			if(player.user_id == CurrentUser.user_id && player.is_leader){
				leader = true;
				return;
			}
		})
		return leader;
	}
	$scope.roomIsFull = function(){
		return !($scope.players.length < 10);
	}
	$scope.havePlayers = function(){
		//get Players if foreign room 
		if($scope.players.length != 0) return true;
		if(!playersContainCurrentUser()){
			if($scope.players.length < 10 && CurrentUser.user_id != undefined){
				addPlayer(CurrentUser.player_id, CurrentUser.user_id, CurrentUser.username, CurrentUser.img_src);
			}else{
				// Throw room is full
			}
		}
		return true;
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
			var bot_id = $scope.bots.length + 1
			var username = "Robot "+bot_id;
			$scope.bots.push({
				player_id:bot_id,
				user_id:null,
				username:username,
				img_src:"../img/bot.png",
				is_user:false,
				is_leader:false
			});
		}
	}
	$scope.removeAllRobots = function(){
		while($scope.bots.length != 0){
			removeRobot();
		}
	}
	$scope.removePlayerOrBot = function(player_id){
		if (player_id<10) {
			var num_bots = $scope.bots.length-1;
			$scope.removeAllRobots();
			for(;num_bots>0;num_bots--){
				$scope.addRobot();
			}
		}else{
			if(confirm("Are you sure you want to remove this Player?")){
				for(var i = 0;i<$scope.players.length;i++){
					if($scope.players[i].player_id == player_id){
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
			if(player.user_id == CurrentUser.user_id) return true;
		});
		return false;
	}

	function addPlayer(player_id, user_id, username, img_src){
		if(($scope.players.length + $scope.bots.length) == 10){
			if($scope.bots.length>0){
				removeRobot();
			}else{
				return; // Throw room is full
			}
		}

		var isPlayer = user_id != null && user_id == CurrentUser.user_id;
		var isLeader = $scope.players.length == 0 || $scope.players[0].player_id == player_id;
		$scope.players.push({
			player_id:player_id,
			user_id:user_id,
			username:username,
			img_src:img_src,
			is_user:isPlayer,
			is_leader:isLeader
		});
		$scope.$apply();
		fixPortraits();
	}

	$scope.inviteFriend = function(){};
});

appControllers.controller('GamePlayController', function($scope, GamePlayPlayers){
	$scope.players=GamePlayPlayers;
	$scope.dices = [];

	//Current Score Snall Table
	$scope.currentScorePlayerNum = 0;
	$scope.currentScorePlayer = $scope.players[$scope.currentScorePlayerNum];
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
		}
		$scope.currentPlayer.rollsAvailable--;

		// Dices.getDices().then(function(data)
		// {
		// 	$scope.dices=data;
		// });
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