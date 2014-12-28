appControllers.controller('NotificationsController', function($scope, $rootScope, NotificationNormal, NotificationGame, NotificationFriend) {
	$scope.started = false;

	$scope.user = {};

	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			$scope.started = true;
			var user = data.user;
			$scope.user.name = user.name;
			$scope.user.img_src = user.img_src;
			getFriendsList();
			getNotifications();
		}
	});


	// Friends List
	var friends = [];

	function getFriendsList(){
		friends["qualquercoisa"] = {online:true, user:{name:"qualquercoisa", img_src:"/img/default.png"}};
		friends["Friend2"] = {online:true, user:{name:"Friend2", img_src:"/img/default.png"}};
		friends["Friend3"] = {online:true, user:{name:"Friend3", img_src:"/img/default.png"}};
		friends["Friend4"] = {online:true, user:{name:"Friend4", img_src:"/img/default.png"}};
		friends["Friend5"] = {online:true, user:{name:"Friend5", img_src:"/img/default.png"}};

		requestFriendsOnlineState();
	}

	function requestFriendsOnlineState(){
		var users = [];
		for(name in friends){
			users.push(name);
		}
		socket.emit('user:states', {users:users});
	}

	socket.on('user:states', function(data){
		for (var i = 0; i < data.users.length; i++) {
			var user = data.users[i];
			friends[user.name].online = user.online;
		};
		$scope.$apply();
	});

	socket.on('user:init', function(data){
		if($scope.started && data.name != $scope.user.name){
			if (friends[data.name] != null) {
				friends[data.name].online = true;
			};
		}
		$scope.$apply();
	});

	socket.on('user:disconnect', function(data){
		if($scope.started && data.name != $scope.user.name){
			if (friends[data.name] != null) {
				friends[data.name].online = false;
			};
		}
		$scope.$apply();
	});

	$scope.haveOnlineFriends = function(){
		return $scope.onlineFriends().length != 0;
	}

	$scope.onlineFriends = function(){
		var onlineFriends = [];
		for(key in friends){
			var friend =  friends[key];
			if(friend.online){
				onlineFriends.push(friend.user);
			}
		}
		return onlineFriends;
	}

	$scope.sendMessageToFriend = function(friendName){
		$rootScope.$broadcast('chat:init:private', {addressee:friendName});
	}




	// Notifications 
	const NOTIFICATION_NORMAL = 1;
	const NOTIFICATION_GAME = 2;
	const NOTIFICATION_FRIEND = 3;

	var notifications = [];

	function getNotifications(){
		socket.emit('notification:getNotifications',{name:$scope.user.name});
	}

	socket.on('notification:getNotifications', function(data){
		for (var i = 0; i < data.notification.length; i++) {
			var notification = data.notification[i];
			notifications.push(notification);
		};
		$scope.$apply();
	});

	socket.on('notification:notification', function(data){
		if(data.name === $scope.user.name){
			addNotification(data.notification.id, data.notification.type, data.notification.message);
		}
		$scope.$apply();
	});

	socket.on('notification:gameinvite', function(data){
		if(data.name === $scope.user.name){
			addNotification(data.notification.id, data.notification.type, data.notification.game);
		}
		$scope.$apply();
	});

	socket.on('notification:friendrequest', function(data){
		if(data.name === $scope.user.name){
			addNotification(data.notification.id, data.notification.type, data.notification.user);
		}
		$scope.$apply();
	});

	$scope.haveNotifications = function(){
		return notifications.length !== 0;
	}

	$scope.notificationsCount = function(){
		return notifications.length;
	}

	function getNotificationsByType(type){
		var notes = [];
		if($scope.haveNotifications){
			for(key in notifications){
				var n = notifications[key];
				if(n.type === type){
					notes.push(n);
				}
			}
		}
		return notes;
	}

	$scope.getNormalNotifications = function(){
		return getNotificationsByType(NOTIFICATION_NORMAL);
	}

	$scope.getGameNotifications = function(){
		return getNotificationsByType(NOTIFICATION_GAME);
	}

	$scope.getFriendNotifications = function(){
		return getNotificationsByType(NOTIFICATION_FRIEND);
	}

	function addNotification(id, type, note){
		var notification = {};
		switch(type){
			case NOTIFICATION_NORMAL:
			notification = NotificationNormal(id, note.type, note.text);
			break;
			case NOTIFICATION_GAME:
			notification = NotificationGame(id, note.owner, note.inviter);
			break;
			case NOTIFICATION_FRIEND:
			notification = NotificationFriend(id, note.id, note.name);
			break;
		}
		notifications.push(notification);
	}

});