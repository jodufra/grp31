'use strict';

/* Routes */

var appRoutes = angular.module('appRoutes', ['ngRoute']);

appRoutes.config(function($routeProvider) {
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