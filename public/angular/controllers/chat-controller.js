appControllers.controller('ChatController', function($scope, currentUser, PrivateChat, PublicChat, ChatUser) {
	const DEFAULT_CHAT_CHANNEL = "global";
	const DEFAULT_IMG_SRC = '/img/default.png';
	const SELF_CHAT_USER = ChatUser('Yahtzee Chat', '/img/yahtzee-nt.png');

	$scope.publicChat = PublicChat(null);
	$scope.privateChats = [];
	$scope.user = ChatUser('',DEFAULT_IMG_SRC);

	currentUser.success(function(data){
		$scope.user.name = data.name;
		$scope.user.img_src = data.img_src;
		initPublicChat();
	}).error(function(){
		initPublicChat();
	});

	function initPublicChat(){
		$scope.privateChats['Private Chat 1'] = PrivateChat('Private Chat 1');
		$scope.privateChats['Private Chat 2'] = PrivateChat('Private Chat 2');
		$scope.privateChats['Private Chat 3'] = PrivateChat('Private Chat 3');
		$scope.privateChats['Private Chat 4'] = PrivateChat('Private Chat 4');
		var chatChannel;

		if (typeof game_id !== 'undefined') {
			chatChannel = "Game "+game_id;
		}else{
			chatChannel = DEFAULT_CHAT_CHANNEL;
		}

		socket.emit('chat:init:public', {
			user: $scope.user,
			channel: chatChannel,
		});
	}

	$scope.initPrivateChat = function(addressee){
		if($scope.user.name.str.search('/guest/i') != -1){
			if(!$scope.privateChats[addressee]){
				$scope.privateChats[addressee] = PrivateChat(addressee);
				$scope.privateChats[addressee].init = true;
			} else if($scope.privateChats[addressee].minimized){
				$scope.privateChats[addressee].minimized = false;
			}
		}else{
			alert('You must register or login to use the private chatting.')
		}
	}

	socket.on('chat:init:public', function (data) {
		$scope.user.name = data.user.name;
		$scope.publicChat.channel = data.channel;
		$scope.publicChat.init = true;
		addMessage($scope.publicChat, {user:SELF_CHAT_USER, message:'You joined the chat!'});
	});

	socket.on('chat:message:buffer', function (data) {
		if(!data.privateChat){
			if(data.channel == $scope.publicChat.channel){
				data.messages.forEach(function(message){
					addMessage($scope.publicChat, message);
				});
			} 
		}else{
			if(data.addressee == $scope.user.name){
				var sender_name = data.user.name;
				if($scope.privateChats[sender_name]){
					data.messages.forEach(function(message){
						addMessage($scope.privateChats[sender_name], message);
					});
				}
			}
		}
	});

	socket.on('chat:message:receive', function (data) {
		var message = {user:data.user, message:data.message};

		if(!data.privateChat){
			if(data.channel == $scope.publicChat.channel){
				addMessage($scope.publicChat, message);
			} 
		}else{
			if(data.addressee == $scope.user.name){
				var sender_name = data.user.name;
				if(!$scope.privateChats[sender_name]){
					$scope.privateChats[sender_name] = PrivateChat(sender_name);
				}

				addMessage($scope.privateChats[sender_name], message);
			}
		}
	});

	socket.on('reconnect', function () {
		if($scope.publicChat.init){
			addMessage($scope.publicChat, {user:SELF_CHAT_USER, message:'You were reconnected!'});
		}
	});

	socket.on('disconnect', function () {
		if($scope.publicChat.init){
			addMessage($scope.publicChat, {user:SELF_CHAT_USER, message:'You were disconnected!'});
		}
	});

	$scope.sendMessage = function (chat) {
		var message = {
			user: $scope.user,
			privateChat: chat.privateChat,
			channel: chat.channel,
			addressee: chat.addressee,
			message: chat.message,
		}

		socket.emit('chat:message:send', message);

		chat.message = '';
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

	function addMessage(chat, data){
		if(chat.messages.length > 0 && data.user.name == chat.messages[chat.messages.length -1].user.name){
			chat.messages[chat.messages.length -1].message += "\n"+ data.message;
		}else{
			chat.messages.push(data);
		}
		if(chat.minimized){
			chat.unreadedMessages++;
		}else{
			chat.unreadedMessages = 0;
		}
		$scope.$apply();
	}

	$scope.getChats = function(){
		var chats = [];
		for(addressee in $scope.privateChats){
			chats.push($scope.privateChats[addressee]);
		}
		chats.push($scope.publicChat);
		return chats;
	}

	$scope.closeChat = function(chat){
		var addressee = chat.addressee;
		if(chat.closable && addressee){
			delete $scope.privateChats[addressee];
		}
	}
});