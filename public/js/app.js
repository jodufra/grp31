'use strict';

/* App Module */

var app = angular.module('app', ['appControllers']);
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

	// Routes //
	$routeProvider.when('/game', {
		templateUrl: 'partials/game/lobby.html',
		controller: 'GameLobbyController',
		resolve:{  
			//currentGames : function(GameService){ return GameService.getCurrentGames(); }  
		}
	})
	.when('/game/:gameid/room', {
		templateUrl: 'partials/game/room.html',
		controller: 'GameRoomController',
		resolve:{  
			//players : function(GameService){ return GameService.getPlayers(:gameid); }
			//friends : function(FriendListService){ return FriendListService.get(); }  
		}
	})
	.when('/game/:gameid/play', {
		templateUrl: 'partials/game/play.html',
		controller: 'GamePlayController',
		resolve:{  
			//players : function(GameService){ return GameService.getPlayers(:gameid); }  
		}
	})
	.otherwise({ redirectTo: '/login' });
});

app.factory("GameService", function($http) {
	return {
		getCurrentGames: function() {
			return $http.get('/game/json/currentGames');
		},
		getPlayers: function(gameid) {
			return $http.get('/game/json/'+gameid+'/players');
		},
		getLastMoves: function(gameid) {
			return $http.get('/game/json/'+gameid+'/lastmoves');
		},
		getAllMoves: function(gameid) {
			return $http.get('/game/json/'+gameid+'/allmoves');
		}
	};
});
app.factory("FriendListService", function($http) {
	return {
		get: function() {
			return $http.get('/user/json/friendlist');
		}
	};
});

app.controller('GameLobbyController', function($scope, currentGames){});
app.controller('GameRoomController', function($scope, players, friends){});
app.controller('GamePlayController', function($scope, players){});