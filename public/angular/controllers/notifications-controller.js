appControllers.controller('NotificationsController', function($scope, $rootScope, currentUser) {
	$scope.normalNotifications = [
		{text:'This is a Sample 1 Notification'},
		{text:'This is a Sample 2 Notification'},
		{text:'This is a Sample 3 Notification'},
		{text:'This is a Sample 4 Notification'},
	];
	$scope.friendRequestNotifications = [
		{user_id:10, name:"Wanabe Friend 1"},
		{user_id:10, name:"Wanabe Friend 2"},
		{user_id:10, name:"Wanabe Friend 3"},
		{user_id:10, name:"Wanabe Friend 4"},
	];
	$scope.onlineFriends = [
		{name:"Guest 1", img_src:"/img/default.png"},
		{name:"Friend2", img_src:"/img/default.png"},
		{name:"Friend3", img_src:"/img/default.png"},
		{name:"Friend4", img_src:"/img/default.png"},
	];

	$scope.haveNotifications = function(){
		return $scope.normalNotifications.length != 0 && $scope.friendRequestNotifications.length != 0;
	}

	$scope.haveOnlineFriends = function(){
		return $scope.onlineFriends.length != 0;
	}

	$scope.sendMessageToFriend = function(friendName){
		$rootScope.$broadcast('chat:init:private', {addressee:friendName});
	}

	
});