appControllers.controller('GameIndexController', function($scope, $http){
	$http.get("https://grp31.dad:4430/getGames").success(function(data) {$scope.games = data;});
	setInterval(function () {
		$http.get("https://grp31.dad:4430/getGames").success(function(data) {$scope.games = data;});
	}, 5000);
 

});