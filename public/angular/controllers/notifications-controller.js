appControllers.controller('NotificationsController', function($scope, $rootScope, $window, FriendList, NotificationNormal, NotificationGame, NotificationFriend) {
	$scope.started = false;
	$scope.user = {};

	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			$scope.started = true;
			$scope.user = data.user;
			getFriendsList();
			getNotifications();
		}
	});

	socket.on('disconnect', function () {
		$scope.started = false;
	});

	// Friends List
	$scope.friendRequestName = {name:''};
	var friends = [];

	function getFriendsList(){
		friends['qualquercoisa'] = {online:false, user:{id:2, player_id:12, name:"qualquercoisa", img_src:"/img/default.png"}};
		requestFriendsOnlineState();
	}

	function requestFriendsOnlineState(){
		var users = [];
		for(name in friends){
			users.push(name);
		}
		socket.emit('user:states', {users:users});
	}

	socket.on('user:init', function(data){
		if(data.name != $scope.user.name){
			if (friends[data.name] != null) {
				friends[data.name].online = true;
			};
		}
		$scope.$apply();
	});

	socket.on('user:states', function(data){
		for (var i = 0; i < data.users.length; i++) {
			var user = data.users[i];
			friends[user.name].online = user.online;
		};

		$scope.$apply();
	});

	socket.on('user:disconnect', function(data){
		if(data.name != $scope.user.name){
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
		FriendList.onlineFriends = [];
		for(key in friends){
			var friend = friends[key];
			if(friend.online){
				FriendList.onlineFriends.push(friend.user);
			}
		}
		return FriendList.onlineFriends;
	}

	$scope.sendMessageToFriend = function(friendName){
		$rootScope.$broadcast('chat:init:private', {addressee:friendName});
	}

	$scope.sendFriendRequest = function(data){
		if($scope.started){
			var notification = NotificationFriend(-1, $scope.user.id, $scope.user.name);
			socket.emit('notification_handler:newNotification', {name:data.name, notification:notification});
			data.name = '';
		}
	}

	// Notifications 
	const NOTIFICATION_NORMAL = 1;
	const NOTIFICATION_GAME = 2;
	const NOTIFICATION_FRIEND = 3;

	var notifications = [];

	function getNotifications(){
		socket.emit('notification_handler:getNotifications',{name:$scope.user.name});
	}

	socket.on('notification_handler:getNotifications', function(data){
		for (var i = 0; i < data.notifications.length; i++) {
			var notification = data.notifications[i];
			notifications.push(notification);
		};
		$scope.$apply();
	});

	socket.on('notification_handler:newNotification', function(data){
		if(data.name == $scope.user.name){
			switch(data.notification.type){
				case NOTIFICATION_NORMAL:
				addNotification(data.notification.id, data.notification.type, data.notification.message);
				break;
				case NOTIFICATION_GAME:
				addNotification(data.notification.id, data.notification.type, data.notification.game);
				break;
				case NOTIFICATION_FRIEND:
				addNotification(data.notification.id, data.notification.type, data.notification.user);
				break;
			}
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

	$scope.dismissNotification = function(notificationID){
		if($scope.started){
			socket.emit('notification_handler:dismissNotification',{name:$scope.user.name, id:notificationID});
		}
	}

	socket.on('notification_handler:dismissNotification', function(data){
		var notes = [];
		for(key in notifications){
			if(notifications[key].id == data.id){
				continue;
			}
			notes.push(notifications[key]);
		}
		notifications = notes;
		$scope.$apply();
	});

	$scope.acceptGameInvite = function(notification){
		if($scope.started){
			var leader = notification.game.owner;
			socket.emit('game:create:acceptinvite', {leader:leader, player:$scope.user});
			socket.emit('notification_handler:dismissNotification',{name:$scope.user.name, id:notification.id});
		}
	}

	socket.on('game:create:acceptinvite', function(data){
		if(data.name==$scope.user.name){
			$window.location.href = '/game/create';
		}
	});

	$scope.dismissGameInvite = function(notification){
		if($scope.started){
			var leader = notification.game.owner;
			socket.emit('game:create:declineinvite', {leader:leader, name:$scope.user.name});
			socket.emit('notification_handler:dismissNotification',{name:$scope.user.name, id:notification.id});
		}
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