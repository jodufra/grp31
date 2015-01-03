appControllers.controller('GameIndexController', function($scope, $http, $window, GameIndex){
	$scope.user;
	$scope.started = false;
	$scope.isUser = false;
	$scope.isPlaying = false;
	$scope.isSearching = false;
	$scope.ongoingGames = [];
	
	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			$scope.isUser = true;
			$scope.user = data.user;
		}
		$scope.started = true;
		init();
	});

	socket.on('disconnect', function () {
		$scope.started = false;
		$scope.isUser = false;
		$scope.isPlaying = false;
		$scope.isSearching = false;
	});

	function init(){
		GameIndex.getOngoingGames().success(function(data){
			$scope.ongoingGames = data;
		}).error(function(){
			$scope.ongoingGames = [];
		});
	}

	$scope.searchGame = function(){
		if($scope.started && $scope.isUser){
			socket.emit('game:create:addqueue',{user:$scope.user});
		}
	}

	socket.on('game:create:addqueue',function(data){
		if(data.name == $scope.user.name){
			$scope.isSearching = true;
		}
		$scope.apply();
	});

	$scope.stopSearching = function(){
		if($scope.started && $scope.isUser){
			socket.emit('game:create:removequeue',{user:$scope.user});
		}
	}

	socket.on('game:create:removequeue',function(data){
		if(data.name == $scope.user.name){
			$scope.isSearching = false;
		}
		$scope.apply();
	});

	socket.on('game:create:acceptedqueue',function(data){
		if(data.name == $scope.user.name){
			$scope.started = false;
			$scope.isUser = false;
			$scope.isPlaying = false;
			$scope.isSearching = false;
			$window.location.href = '/game/create';
			alert('You are entering the room.');
		}
		$scope.apply();
	});
	

});