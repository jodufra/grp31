appControllers.controller('GameIndexController', function($scope, $http){
	$scope.user;
	$scope.started = false;
	$scope.isUser = false;
	$scope.$on('user:init', function(event, data) {
		if(data.isUser){
			$scope.isUser = true;
			$scope.user = data.user;
		}
		$scope.started = true;
	});

	$scope.isPlaying = false;
	$scope.isSearching = false;

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