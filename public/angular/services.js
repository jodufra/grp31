'use strict';

/* Services */

var appServices = angular.module('appServices', []);

// GameService
appServices.factory("CurrentUser", function($q, $http) {

	var self = {};

	self.getUser = function(dices)
	{
		var d = $q.defer();
		$http.get( '/user/getCurrentUser' ).
		success(function (data){
			d.resolve(data);
		});
		return d.promise;
	};

	return self;
});

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
		getAll: function() {
			return $http.get('/user/friendlist/all');
		},
		getOnline: function() {
			return $http.get('/user/friendlist/online');
		}
	};
});

appServices.provider('GamePlayPlayers', function GamePlayPlayersProvider() {
	var players_count = 10;
	this.players_count = function(count) {
		players_count = count;
	};

	this.$get = function GamePlayPlayersFactory() {
		var players=[];
		for(var i=0; i<players_count; i++){
			players[i] = new GamePlayPlayer(i);
		}
		return players;
	};
});

function GamePlayPlayer(player_num){
	this.id = player_num;
	this.name = 'Player '+player_num;
	this.rollsAvailable = 3;
	this.score = {
		ones:0,
		twos:0,
		threes:0,
		fours:0,
		fives:0,
		sixes:0,
		sum:0,
		bonus:0,
		threeKind:0,
		fourKind:0,
		house:0,
		small_s:0,
		large_s:0,
		chance:0,
		yahtzee:0,
		total:0
	};
	this.r_score = {
		ones:0,
		twos:0,
		threes:0,
		fours:0,
		fives:0,
		sixes:0,
		sum:0,
		bonus:0,
		threeKind:0,
		fourKind:0,
		house:0,
		small_s:0,
		large_s:0,
		chance:0,
		yahtzee:0,
		total:0
	};
	return this;
}