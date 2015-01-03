appControllers.controller('GameIndexController', function($scope, $http, GameIndex){
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

	function init(){
		GameIndex.getOngoingGames().success(function(data){
			$scope.ongoingGames = data;
		}).error(function(){
			$scope.ongoingGames = [];
		});
	}

	$scope.searchGame = function(){
		$scope.isSearching = true;
	}

	$scope.stopSearching = function(){
		$scope.isSearching = false;
	}



	// $http.get("https://grp31.dad:4430/getGames").success(function(data) {
	// 	$scope.games = data;
	// });
	// setInterval(function () {
	// 	$http.get("https://grp31.dad:4430/getGames").success(function(data) {$scope.games = data;});
	// }, 5000);


});