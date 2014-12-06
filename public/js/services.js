'use strict';

/* Services */

var appServices = angular.module('appServices', []);

// GameService
appServices.factory("GameService", function($http) {
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

// FriendListService
appServices.factory("FriendListService", function($http) {
	return {
		get: function() {
			return $http.get('/user/json/friendlist');
		}
	};
});
