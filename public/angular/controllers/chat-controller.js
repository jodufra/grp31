appControllers.controller('ChatController', function($scope, PrivateChat, PublicChat, ChatUser) {
	const DEFAULT_CHAT_CHANNEL = "Yahtzee";
	const SELF_CHAT_USER = ChatUser('Yahtzee Chat', '/img/yahtzee-nt.png');

	const maxVisibleChats = 3;
	var chatsCount = 1;
	var oldChatsCount = 0;
	var visibleChats = [];
	var hiddenChats = [];

	var publicChat = PublicChat(null);
	var privateChats = [];

	var userIsGuest = true;
	$scope.user = {name:'', img_src:'/img/default.png'};

	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			var user = data.user;
			$scope.user.name = user.name;
			$scope.user.img_src = user.img_src;
			userIsGuest = false;
			initPublicChat();
		}else{
			initPublicChat();
		}
	});

	$scope.$on('chat:init:private', function(event, data) {
		initPrivateChat(data.addressee);
	});

	function initPublicChat(){
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

	socket.on('chat:init:public', function (data) {
		$scope.user.name = data.user.name;
		publicChat.channel = data.channel;
		publicChat.init = true;
		addMessage(publicChat, {user:SELF_CHAT_USER, message:'You joined the chat!'});
	});

	socket.on('chat:message:buffer', function (data) {
		if(!data.privateChat){
			if(data.channel == publicChat.channel){
				for (var i = 0; i < data.messages.length; i++) {
					var message = data.messages[i];
					addMessage(publicChat, message);
				};
			} 
		}else{
			if(data.addressee == $scope.user.name){
				var sender_name = data.user.name;
				if(privateChats[sender_name]){
					for (var i = 0; i < data.messages.length; i++) {
						var message = data.messages[i];
						addMessage(privateChats[sender_name], message);
					};
				}
			}
		}
	});

	socket.on('chat:message:receive', function (data) {
		var message = {user:data.user, message:data.message};

		if(!data.privateChat){
			if(data.channel == publicChat.channel){
				addMessage(publicChat, message);
			} 
		}else{
			var sender_name;
			if(data.addressee == $scope.user.name){
				sender_name = data.user.name;
				initPrivateChat(sender_name);
			}
			if(data.user.name == $scope.user.name){
				var sender_name = data.addressee;
			}
			addMessage(privateChats[sender_name], message);
		}
	});


	function initPrivateChat(addressee){
		if(!userIsGuest){
			if(privateChats[addressee] === undefined){
				privateChats[addressee] = PrivateChat(addressee);
				privateChats[addressee].init = true;
				chatsCount++;
			} else if(privateChats[addressee].minimized){
				$scope.maximizeChat(privateChats[addressee]);
			}
		}else{
			alert('You must login to use the private chat.');
		}
	}
	
	socket.on('reconnect', function () {
		if(publicChat.init){
			addMessage(publicChat, {user:SELF_CHAT_USER, message:'You were reconnected!'});
		}
	});

	socket.on('disconnect', function () {
		if(publicChat.init){
			addMessage(publicChat, {user:SELF_CHAT_USER, message:'You were disconnected!'});
		}
	});

	$scope.sendMessage = function (chat) {
		if(chat.message && chat.message != ''){
			var message = {
				user: $scope.user,
				privateChat: chat.privateChat,
				channel: chat.channel,
				addressee: chat.addressee,
				message: chat.message,
			}

			socket.emit('chat:message:send', message);

		}
		chat.message = '';	
	};

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

		if(chatsCount != (hiddenChats.length + visibleChats.length)){
			visibleChats=[]
			hiddenChats=[]
			visibleChats.push(publicChat);

			for(addressee in privateChats){
				var chat = privateChats[addressee];

				if(chatsCount >= maxVisibleChats){
					if(visibleChats.length < maxVisibleChats){
						visibleChats.push(chat);
					}else{
						privateChats[addressee].minimized = true;
						hiddenChats.push(chat);
					}
				}else{
					visibleChats.push(privateChats[addressee]);
				}
			}

			oldChatsCount = chatsCount + 0;

		}


		return {chats:visibleChats, hiddenChats:hiddenChats};
	}

	$scope.minimizeChat = function(chat){
		chat.minimized = true;
	}

	$scope.maximizeChat = function(chat){
		chat.minimized = false;
		chat.unreadedMessages = 0;
		var indexChat = hiddenChats.indexOf(chat);
		if(indexChat>=0){
			if(visibleChats.length == maxVisibleChats){
				hiddenChats[indexChat] = visibleChats[2];
				visibleChats[2] = visibleChats[1];
				visibleChats[1] = chat;
			}else{
				visibleChats.push(chat);
				hiddenChats.splice(indexChat, 1);
			}
		}
	}

	$scope.closeChat = function(chat){
		var addressee = chat.addressee;
		if(chat.closable && addressee){
			delete privateChats[addressee];
			chatsCount--;
		}
	}

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
});