appControllers.controller('ChatController', function($scope) {
	var global_channel = "global";
	$scope.name = '';
	$scope.messages=[];
	$scope.unreadedMessages = 0;
	$scope.channel = global_channel;

	$scope.setChatState = function(state){
		$scope.chatState = state;
		if(state){
			$('#chat').removeClass('minimized');
			if($scope.name != ''){
				$('#chat .setuser').addClass('hidden');
			}
			$scope.unreadedMessages = 0;
		}else{
			$('#chat').addClass('minimized');
			if($scope.name == ''){
				$('#chat .setuser').removeClass('hidden');
			}
		}
		return state;
	}

	$scope.chatState = $scope.setChatState(true);

	$scope.joinChat = function(){
		if (typeof game_id !== 'undefined') {
			$scope.channel = "Game "+game_id;
		}

		socket.emit('chat:innit', {
			user: $scope.name,
			channel: $scope.channel
		});

	}

	socket.on('chat:innit', function (data) {
		$scope.name = data.user;
		$scope.channel = data.channel;
		$('#chat .setuser').addClass('hidden');
		addMessage({user:'ChatRoom',message:'You joined the chat!'});
		$scope.$apply();
	});

	socket.on('chat:message:buffer', function (messages) {
		messages.forEach(function(msg){
			addMessage(msg);
		});
		$scope.$apply();
	});

	socket.on('chat:message:send', function (message) {
		if(message.channel == $scope.channel) addMessage(message);
		$scope.$apply();
	});

	socket.on('chat:user:join', function (data) {
		if(data.channel == $scope.channel){
			addMessage({
				user: 'ChatRoom',
				message: 'User ' + data.user + ' has joined.'
			});
		}
		$scope.$apply();
	});

	socket.on('chat:user:left', function (data) {
		if(data.channel == $scope.channel){
			addMessage({
				user: 'ChatRoom',
				message: 'User ' + data.user + ' has left.'
			});
		}
		$scope.$apply();
	});
	

	$scope.sendMessage = function () {
		socket.emit('chat:message:send', {
			user: $scope.name,
			channel: $scope.channel,
			message: $scope.message
		});
		addMessage({
			user: $scope.name,
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
	}
});