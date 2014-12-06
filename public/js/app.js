'use strict';

/* App Module */

var app = angular.module('app', ['ngRoute', 'appControllers']);
app.config(function($interpolateProvider) {
	//
	$interpolateProvider.startSymbol('[[');
	$interpolateProvider.endSymbol(']]');
});

/*
* /game -> Lobby
* /game/room -> Match Making
* /game/:gameid -> Jogo
*/
app.config(function($routeProvider) {
	$routeProvider.when('#/', {
		templateUrl: 'partials/home.html',
		controller: 'HomeController'
	})
	// Game //
	.when('#/game', {
		templateUrl: 'partials/game/lobby.html',
		controller: 'GameLobbyController'
	})
	.when('#/game/:gameid/room', {
		templateUrl: 'partials/game/room.html',
		controller: 'GameRoomController'
	})
	.when('#/game/:gameid/play', {
		templateUrl: 'partials/game/play.html',
		controller: 'GamePlayController'
	});
});
app.controller('HomeController', function($scope){});
app.controller('GameLobbyController', function($scope){});
app.controller('GameRoomController', function($scope, $routeParams){});
app.controller('GamePlayController', function($scope, $routeParams){});