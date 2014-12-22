appControllers.controller('ChatController', function($scope, currentUser) {
	var global_channel = "global";
	$scope.canJoin = false;
	$scope.hasJoined = false;

	$scope.name = '';
	$scope.channel;

	$scope.messages=[];
	$scope.unreadedMessages = 0;

	currentUser.success(function(data){
		$scope.name = data.name;
		$scope.canJoin = true;
	}).error(function(data){
		$scope.name = '';
		$scope.canJoin = true;
	});


	$scope.setChatState = function(state){
		$scope.chatState = state;
		if(state){
			$('#chat').removeClass('minimized');
			if($scope.canJoin && typeof $scope.channel !== 'undefined'){
				$('#chat .setuser').addClass('hidden');
			}
			$scope.unreadedMessages = 0;
		}else{
			$('#chat').addClass('minimized');
			if(!$scope.canJoin || typeof $scope.channel === 'undefined'){
				$('#chat .setuser').removeClass('hidden');
			}
		}
		return state;
	}

	$scope.chatState = $scope.setChatState(true);



	$scope.joinChat = function(){
		if($scope.canJoin){
			if (typeof game_id !== 'undefined') {
				$scope.channel = "Game "+game_id;
			}else{
				$scope.channel = global_channel;
			}
			socket.emit('chat:innit', {
				user: $scope.name,
				channel: $scope.channel
			});
		}
	}

	socket.on('reconnect', function () {
		if($scope.canJoin && typeof $scope.channel !== 'undefined'){
			addMessage({user:'Yahtzee Chat',message:'You were reconnected!'});
			$scope.joinChat();
		}
	});

	socket.on('chat:innit', function (data) {
		$scope.name = data.user;
		$scope.channel = data.channel;
		$('#chat .setuser').addClass('hidden');
		addMessage({user:'Yahtzee Chat',message:'You joined the chat!'});
	});

	socket.on('chat:message:buffer', function (messages) {
		messages.forEach(function(msg){
			addMessage(msg);
		});
	});

	socket.on('chat:message:send', function (message) {
		if(message.channel == $scope.channel){
			addMessage(message);
		} 		
	});

	socket.on('chat:user:join', function (data) {
		if(data.channel == $scope.channel){
			addMessage({
				user: 'Yahtzee Chat',
				message: 'User ' + data.user + ' has joined.'
			});
		}
	});

	socket.on('chat:user:left', function (data) {
		if(data.channel == $scope.channel){
			addMessage({
				user: 'Yahtzee Chat',
				message: 'User ' + data.user + ' has left.'
			});
		}
	});
	
	socket.on('disconnect', function (data) {
		if($scope.canJoin && typeof $scope.channel !== 'undefined'){
			addMessage({user:'Yahtzee Chat',message:'You were disconnected!'});
		}
	});

	$scope.sendMessage = function () {
		socket.emit('chat:message:send', {
			user: $scope.name,
			channel: $scope.channel,
			message: $scope.message
		});
		$scope.message = '';
	};

	$scope.stringToColour = function(str) {
		var colour;
		for (var i = 0, hash = 0; i < str.length; ){
			hash = str.charCodeAt(i++) + ((hash << 5) - hash);
		}

		for (var i = 0, colour = "#"; i < 3; ){
			colour += ("00" + ((hash >> i++ * 8) & 0xFF).toString(16)).slice(-2);
		}

		return colour;
	}

	function addMessage(message){
		if($scope.messages.length > 0 && message.user == $scope.messages[$scope.messages.length -1].user){
			$scope.messages[$scope.messages.length -1].message += "\n"+ message.message;
		}else{
			$scope.messages.push(message);
		}

		if($scope.chatState){
			$scope.unreadedMessages = 0;
		}else{
			$scope.unreadedMessages++;
		}
		$scope.$apply();
	}
});