appControllers.controller('UserController', function($scope, $rootScope, currentUser) {	
	$scope.user = {};
	currentUser.success(function(data){
		if(data.name){
			$scope.user.id = data.id;
			$scope.user.user_id = data.user_id;
			$scope.user.name = data.name;
			$scope.user.img_src = data.img_src;
			setUserAsOnline();
		}else{
			broadcastUser(false);
		}
	}).error(function(){
		broadcastUser(false);
	});

	function setUserAsOnline(){
		socket.emit('user:init', {name:$scope.user.name});
	}

	socket.on('user:init', function(data){
		if(data.name == $scope.user.name){
			broadcastUser(true);
		}
	});

	function broadcastUser(isUser){
		$rootScope.$broadcast('user:init',{isUser:isUser, user:$scope.user});
	}

});